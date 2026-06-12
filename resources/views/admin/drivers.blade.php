<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jibli — Admin Drivers</title>
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: #f0f2f5;
            min-height: 100vh;
        }
        .header {
            background: #1a1a2e;
            color: white;
            padding: 16px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header h1 { font-size: 20px; color: #6c63ff; }

        .container { max-width: 1100px; margin: 24px auto; padding: 0 20px; }

        .stats { display: grid; grid-template-columns: repeat(4,1fr); gap: 16px; margin-bottom: 24px; }
        .stat-card {
            background: white;
            border-radius: 16px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.06);
        }
        .stat-number { font-size: 36px; font-weight: 700; margin-bottom: 6px; }
        .stat-label  { font-size: 12px; color: #888; text-transform: uppercase; }
        .stat-total     .stat-number { color: #6c63ff; }
        .stat-available .stat-number { color: #10b981; }
        .stat-busy      .stat-number { color: #f59e0b; }
        .stat-offline   .stat-number { color: #94a3b8; }

        .grid { display: grid; grid-template-columns: 1fr 340px; gap: 20px; }

        .card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.06);
            overflow: hidden;
        }
        .card-header {
            padding: 16px 20px;
            border-bottom: 1px solid #f0f0f0;
            font-size: 14px;
            font-weight: 700;
            color: #1a1a2e;
        }

        table { width: 100%; border-collapse: collapse; }
        th {
            background: #f8fafc;
            padding: 10px 16px;
            text-align: left;
            font-size: 11px;
            color: #888;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 1px solid #f0f0f0;
        }
        td {
            padding: 12px 16px;
            font-size: 13px;
            color: #333;
            border-bottom: 1px solid #f8f8f8;
            vertical-align: middle;
        }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: #fafafa; }

        .badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
        }
        .badge-available { background: #d4edda; color: #155724; }
        .badge-busy      { background: #fff3cd; color: #856404; }
        .badge-offline   { background: #e2e8f0; color: #64748b; }

        .btn-group { display: flex; gap: 6px; flex-wrap: wrap; }
        .btn {
            padding: 5px 12px;
            border: none;
            border-radius: 8px;
            font-size: 11px;
            font-weight: 600;
            cursor: pointer;
            transition: opacity 0.2s;
        }
        .btn:hover { opacity: 0.8; }
        .btn-available { background: #d4edda; color: #155724; }
        .btn-busy      { background: #fff3cd; color: #856404; }
        .btn-offline   { background: #e2e8f0; color: #64748b; }
        .btn-delete    { background: #f8d7da; color: #721c24; }

        /* Create form */
        .form-group { margin-bottom: 14px; }
        .form-group label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            color: #555;
            margin-bottom: 5px;
        }
        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px 12px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 13px;
            outline: none;
            transition: border 0.2s;
        }
        .form-group input:focus,
        .form-group select:focus { border-color: #6c63ff; }

        .btn-create {
            width: 100%;
            padding: 12px;
            background: #6c63ff;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
        }
        .btn-create:hover { background: #5a52d5; }

        .alert-success {
            background: #d4edda;
            color: #155724;
            padding: 12px 16px;
            border-radius: 10px;
            margin-bottom: 16px;
            font-size: 13px;
        }

        .active-order {
            font-size: 11px;
            color: #6c63ff;
            font-weight: 600;
        }

        .form-padding { padding: 20px; }
    </style>
</head>
<body>

<div class="header">
    <div>
        <h1>🚀 Jibli Admin</h1>
        <span>Driver Management</span>
    </div>
    <div style="display:flex;gap:12px;align-items:center;">
        <a href="/admin/orders"  style="color:#aaa;text-decoration:none;font-size:13px;">📦 Orders</a>
        <a href="/admin/drivers" style="color:#6c63ff;text-decoration:none;font-size:13px;font-weight:600;">🚗 Drivers</a>
    </div>
</div>

<div class="container">

    @if(session('success'))
        <div class="alert-success">✅ {{ session('success') }}</div>
    @endif

    {{-- Stats --}}
    <div class="stats">
        <div class="stat-card stat-total">
            <div class="stat-number">{{ $stats['total'] }}</div>
            <div class="stat-label">Total Drivers</div>
        </div>
        <div class="stat-card stat-available">
            <div class="stat-number">{{ $stats['available'] }}</div>
            <div class="stat-label">Available</div>
        </div>
        <div class="stat-card stat-busy">
            <div class="stat-number">{{ $stats['busy'] }}</div>
            <div class="stat-label">Busy</div>
        </div>
        <div class="stat-card stat-offline">
            <div class="stat-number">{{ $stats['offline'] }}</div>
            <div class="stat-label">Offline</div>
        </div>
    </div>

    <div class="grid">

        {{-- Drivers Table --}}
        <div class="card">
            <div class="card-header">🚗 All Drivers ({{ $stats['total'] }})</div>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>District</th>
                        <th>Status</th>
                        <th>Active Order</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($drivers as $driver)
                    <tr>
                        <td>{{ $driver->id }}</td>
                        <td><strong>{{ $driver->name }}</strong></td>
                        <td>{{ $driver->phone }}</td>
                        <td style="font-size:11px;color:#888;">{{ $driver->district->name_en ?? '—' }}</td>
                        <td>
                            <span class="badge badge-{{ $driver->status }}">
                                {{ ucfirst($driver->status) }}
                            </span>
                        </td>
                        <td>
                            @if($driver->active_order)
                                <span class="active-order">
                                    #{{ $driver->active_order->id }}<br>
                                    {{ $driver->active_order->area_name }}
                                </span>
                            @else
                                <span style="color:#ccc;font-size:11px;">—</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group">
                                <form method="POST" action="/admin/drivers/{{ $driver->id }}/status" style="display:inline">
                                    @csrf
                                    <input type="hidden" name="status" value="available">
                                    <button type="submit" class="btn btn-available">✓ Available</button>
                                </form>
                                <form method="POST" action="/admin/drivers/{{ $driver->id }}/status" style="display:inline">
                                    @csrf
                                    <input type="hidden" name="status" value="busy">
                                    <button type="submit" class="btn btn-busy">Busy</button>
                                </form>
                                <form method="POST" action="/admin/drivers/{{ $driver->id }}/status" style="display:inline">
                                    @csrf
                                    <input type="hidden" name="status" value="offline">
                                    <button type="submit" class="btn btn-offline">Offline</button>
                                </form>
                                <form method="POST" action="/admin/drivers/{{ $driver->id }}/delete" style="display:inline"
                                      onsubmit="return confirm('Delete {{ $driver->name }}?')">
                                    @csrf
                                    <button type="submit" class="btn btn-delete">🗑</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Create Driver Form --}}
<div class="card">
    <div class="card-header">➕ Create New Driver</div>
    <div class="form-padding">
        <form method="POST" action="/admin/drivers/create">
            @csrf

            @if($errors->any())
                <div style="background:#f8d7da;color:#721c24;padding:10px 14px;border-radius:8px;margin-bottom:14px;font-size:13px;">
                    @foreach($errors->all() as $error)
                        <div>⚠️ {{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="name"
                       placeholder="Ahmad Khalil"
                       value="{{ old('name') }}"
                       required>
            </div>

            <div class="form-group">
                <label>Phone Number</label>
                <input type="text" name="phone"
                       placeholder="03xxxxxx"
                       value="{{ old('phone') }}"
                       required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password"
                       placeholder="Min 6 characters"
                       required>
            </div>

            {{-- Searchable District --}}
            <div class="form-group">
                <label>District</label>
                <input
                    type="text"
                    id="districtSearch"
                    placeholder="Type to search: metn, zahle, beirut..."
                    autocomplete="off"
                    style="margin-bottom:6px;"
                >
                <input type="hidden" name="district_id" id="districtId" value="{{ old('district_id') }}" required>

                <div id="districtDropdown" style="
                    display:none;
                    border:2px solid #6c63ff;
                    border-radius:10px;
                    max-height:200px;
                    overflow-y:auto;
                    background:white;
                    box-shadow:0 4px 12px rgba(0,0,0,0.1);
                ">
                    @foreach(\App\Models\District::with('governorate')->orderBy('name_en')->get() as $district)
                        <div class="district-option"
                             data-id="{{ $district->id }}"
                             data-name="{{ $district->name_en }} ({{ $district->governorate->name_en }})"
                             style="padding:10px 14px;cursor:pointer;font-size:13px;border-bottom:1px solid #f0f0f0;">
                            {{ $district->name_en }}
                            <span style="color:#888;font-size:11px;">({{ $district->governorate->name_en }})</span>
                        </div>
                    @endforeach
                </div>

                <div id="districtSelected" style="
                    display:none;
                    padding:8px 12px;
                    background:#eef2ff;
                    border-radius:8px;
                    font-size:13px;
                    color:#6c63ff;
                    font-weight:600;
                    margin-top:6px;
                "></div>
            </div>

            <button type="submit" class="btn-create">
                🚗 Create Driver
            </button>
        </form>
    </div>
</div>
<script>
    setTimeout(() => location.reload(), 15000);
</script>
<script>
// ── Searchable District Dropdown ──────────────────────
const searchInput = document.getElementById('districtSearch');
const dropdown    = document.getElementById('districtDropdown');
const districtId  = document.getElementById('districtId');
const selected    = document.getElementById('districtSelected');
const options     = document.querySelectorAll('.district-option');

// Restore old value if validation failed
@if(old('district_id'))
    const oldId  = '{{ old('district_id') }}';
    const oldOpt = document.querySelector(`.district-option[data-id="${oldId}"]`);
    if (oldOpt) {
        districtId.value       = oldId;
        selected.textContent   = oldOpt.dataset.name;
        selected.style.display = 'block';
        searchInput.value      = oldOpt.dataset.name;
    }
@endif

// Show dropdown on focus
searchInput.addEventListener('focus', () => {
    dropdown.style.display = 'block';
    filterOptions('');
});

// Filter on input
searchInput.addEventListener('input', () => {
    filterOptions(searchInput.value);
    dropdown.style.display = 'block';
    districtId.value       = '';
    selected.style.display = 'none';
});

// Close dropdown when clicking outside
document.addEventListener('click', (e) => {
    if (!e.target.closest('#districtSearch') && !e.target.closest('#districtDropdown')) {
        dropdown.style.display = 'none';
    }
});

// Hover effects + selection
options.forEach(option => {
    option.addEventListener('mouseenter', () => {
        option.style.background = '#eef2ff';
    });
    option.addEventListener('mouseleave', () => {
        option.style.background = 'white';
    });
    option.addEventListener('click', () => {
        districtId.value       = option.dataset.id;
        searchInput.value      = option.dataset.name;
        selected.textContent   = '✓ ' + option.dataset.name;
        selected.style.display = 'block';
        dropdown.style.display = 'none';
    });
});

// Filter function
function filterOptions(query) {
    const q = query.toLowerCase();
    options.forEach(opt => {
        const text = opt.dataset.name.toLowerCase();
        opt.style.display = text.includes(q) ? 'block' : 'none';
    });
}

// ── Auto-refresh — only when form is empty ─────────────
setInterval(() => {
    const nameVal  = document.querySelector('input[name="name"]').value.trim();
    const phoneVal = document.querySelector('input[name="phone"]').value.trim();
    const passVal  = document.querySelector('input[name="password"]').value.trim();
    const formEmpty = !nameVal && !phoneVal && !passVal;

    if (formEmpty && dropdown.style.display === 'none') {
        location.reload();
    }
}, 15000);
</script>

</body>
</html>