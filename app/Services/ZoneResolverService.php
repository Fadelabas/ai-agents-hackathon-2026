<?php

namespace App\Services;

use App\Models\AreaAlias;
use App\Models\Area;

class ZoneResolverService
{
    /**
     * Resolve raw area text to full geographic hierarchy.
     * Returns array with area, district, governorate data.
     */
    public function resolve(string $areaText): array
    {
        $normalized = $this->normalize($areaText);

        // ── Step 1: Exact alias match ─────────────────────────
        $alias = AreaAlias::whereRaw('LOWER(alias) = ?', [$normalized])
            ->with('area.district.governorate')
            ->first();

        if ($alias) {
            return $this->buildResult($alias->area, 'exact_alias');
        }

        // ── Step 2: Fuzzy match (Levenshtein) ─────────────────
        $bestMatch  = null;
        $bestScore  = PHP_INT_MAX;
        $threshold  = 2;

        $aliases = AreaAlias::with('area.district.governorate')->get();

        foreach ($aliases as $candidate) {
            $distance = levenshtein($normalized, strtolower($candidate->alias));
            if ($distance < $bestScore) {
                $bestScore = $distance;
                $bestMatch = $candidate;
            }
        }

        if ($bestMatch && $bestScore <= $threshold) {
            return $this->buildResult($bestMatch->area, 'fuzzy_match');
        }

        // ── Step 3: Unresolved fallback ───────────────────────
        return $this->unresolvedResult();
    }

    /**
     * Normalize input: lowercase and trim.
     */
    private function normalize(string $text): string
    {
        return strtolower(trim($text));
    }

    /**
     * Build a resolved result array from an Area model.
     */
    private function buildResult(Area $area, string $method): array
    {
        $district    = $area->district;
        $governorate = $district->governorate;

        return [
            'resolved'          => true,
            'resolution_method' => $method,
            'area_id'           => $area->id,
            'area_name'         => $area->name_en,
            'district_id'       => $district->id,
            'district_name'     => $district->name_en,
            'governorate_id'    => $governorate->id,
            'governorate_name'  => $governorate->name_en,
        ];
    }

    /**
     * Return unresolved result when no match found.
     */
    private function unresolvedResult(): array
    {
        return [
            'resolved'          => false,
            'resolution_method' => 'unresolved',
            'area_id'           => null,
            'area_name'         => null,
            'district_id'       => null,
            'district_name'     => null,
            'governorate_id'    => null,
            'governorate_name'  => null,
        ];
    }
}
