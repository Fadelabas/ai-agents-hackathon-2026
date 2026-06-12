<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DemoReset extends Command
{
    protected $signature   = 'demo:reset';
    protected $description = 'Reset demo environment between rehearsal runs';

    public function handle(): void
    {
        $this->info('Resetting demo environment...');

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('orders')->truncate();
        DB::table('driver_offers')->truncate();
        DB::table('conversation_sessions')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        DB::table('drivers')->update(['status' => 'available']);

        $this->info('');
        $this->info('✅ Demo environment reset successfully.');
        $this->info('   Orders:                cleared');
        $this->info('   Driver offers:         cleared');
        $this->info('   Conversation sessions: cleared');
        $this->info('   Drivers:               all set to available');
        $this->info('');
    }
}