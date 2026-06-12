<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jibli — Admin Dashboard</title>
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
        .header span { font-size: 12px; color: #aaa; }

        .container { max-width: 1200px; margin: 24px auto; padding: 0 20px; }

        /* Stats */
        .stats { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 24px; }
        .stat-card {
            background: white;
            border-radius: 16px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.06);
        }
        .stat-number { font-size: 36px; font-weight: 700; margin-bottom: 6px; }
        .stat-label  { font-size: 12px; color: #888; text-transform: uppercase; letter-spacing: 0.5px; }
        .stat-total     .stat-number { color: #6c63ff; }
        .stat-pending   .stat-number { color: #f59e0b; }
        .stat-active    .stat-number { color: #3b82f6; }
        .stat-completed .stat-number { color: #10b981; }

        /* Table */
        .table-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.06);
            overflow: hidden;
        }
        .table-header {
            padding: 16px 20px;
            border-bottom: 1px solid #f0f0f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .table-header h2 { font-size: 15px; color: #1a1a2e; }
        .refresh-btn {
            background: #6c63ff;
            color: white;
            border: none;
            padding: 7px 16px;
            border-radius: 8px;
            font-size: 12px;
            cursor: pointer;
            text-decoration: none;
        }

        table { width: 100%; border-collapse: collapse; }
        th {
            background: #f8fafc;
            padding: 12px 16px;
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

        /* Status badges */
        .badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
        }
        .badge-pending         { background: #fff3cd; color: #856404; }
        .badge-driver_assigned { background: #cce5ff; color: #004085; }
        .badge-in_progress     { background: #d1ecf1; color: #0c5460; }
        .badge-completed       { background: #d4edda; color: #155724; }
        .badge-cancelled       { background: #f8d7da; color: #721c24; }

        /* Task badges */
        .task-badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 20px;
            font-size: 11px;
            background: #eef2ff;
            color: #6c63ff;
            font-weight: 600;
        }

        .driver-name { color: #6c63ff; font-weight: 600; }
        .no-driver   { color: #ccc; font-size: 12px; }
        .price       { font-weight: 700; color: #10b981; }
        .time        { color: #aaa; font-size: 11px; }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #aaa;
        }
        .empty-state .icon { font-size: 48px; margin-bottom: 12px; }

        /* Auto-refresh indicator */
        .live-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #d4edda;
            color: #155724;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
        }
        .live-dot {
            width: 6px; height: 6px;
            background: #28a745;
            border-radius: 50%;
            animation: pulse 1.5s infinite;
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50%       { opacity: 0.3; }
        }

        @media (max-width: 768px) {
            .stats { grid-template-columns: repeat(2, 1fr); }
            table  { font-size: 12px; }
            th, td { padding: 8px 10px; }
        }
    </style>
</head>
<body>

<div class="header">
    <div>
        <h1>🚀 Jibli Admin</h1>
        <span>Order Monitoring Dashboard</span>
    </div>
    <div style="display:flex;gap:12px;align-items:center;">
        <a href="/admin/orders"  style="color:#6c63ff;text-decoration:none;font-size:13px;font-weight:600;">📦 Orders</a>
        <a href="/admin/drivers" style="color:#aaa;text-decoration:none;font-size:13px;">🚗 Drivers</a>
        <div class="live-badge">
            <div class="live-dot"></div>
            Live
        </div>
    </div>
</div>

<div class="container">

    {{-- Stats --}}
    <div class="stats">
        <div class="stat-card stat-total">
            <div class="stat-number">{{ $stats['total'] }}</div>
            <div class="stat-label">Total Orders</div>
        </div>
        <div class="stat-card stat-pending">
            <div class="stat-number">{{ $stats['pending'] }}</div>
            <div class="stat-label">Pending</div>
        </div>
        <div class="stat-card stat-active">
            <div class="stat-number">{{ $stats['active'] }}</div>
            <div class="stat-label">Active</div>
        </div>
        <div class="stat-card stat-completed">
            <div class="stat-number">{{ $stats['completed'] }}</div>
            <div class="stat-label">Completed</div>
        </div>
    </div>

    {{-- Orders Table --}}
    <div class="table-card">
        <div class="table-header">
            <h2>📦 All Orders ({{ $stats['total'] }})</h2>
            <a href="/admin/orders" class="refresh-btn">🔄 Refresh</a>
        </div>

        @if($orders->isEmpty())
            <div class="empty-state">
                <div class="icon">📭</div>
                <p>No orders yet. Run <strong>php artisan demo:reset</strong> and start a test.</p>
            </div>
        @else
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Type</th>
                    <th>Area</th>
                    <th>Address</th>
                    <th>Customer</th>
                    <th>Price</th>
                    <th>Driver</th>
                    <th>Status</th>
                    <th>Time</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td><strong>#{{ $order->id }}</strong></td>
                    <td>
                        <span class="task-badge">
                            {{ str_replace('_', ' ', $order->task_type) }}
                        </span>
                    </td>
                    <td>
                        {{ $order->area_name ?? $order->area_text }}
                        @if($order->district_name)
                            <br><span style="font-size:11px;color:#aaa;">{{ $order->district_name }}</span>
                        @endif
                    </td>
                    <td style="max-width:180px;">{{ $order->exact_address }}</td>
                    <td>{{ $order->customer_phone }}</td>
                    <td>
                        <span class="price">${{ number_format($order->price, 2) }}</span>
                        <br><span style="font-size:10px;color:#aaa;">{{ $order->price_source }}</span>
                    </td>
                    <td>
                        @if($order->assignedDriver)
                            <span class="driver-name">{{ $order->assignedDriver->name }}</span>
                            <br><span style="font-size:11px;color:#aaa;">{{ $order->assignedDriver->phone }}</span>
                        @else
                            <span class="no-driver">— unassigned</span>
                        @endif
                    </td>
                    <td>
                        <span class="badge badge-{{ $order->status }}">
                            {{ str_replace('_', ' ', $order->status) }}
                        </span>
                    </td>
                    <td>
                        <span class="time">
                            {{ $order->created_at->diffForHumans() }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>

</div>

{{-- Auto refresh every 10 seconds --}}
<script>
    setTimeout(() => location.reload(), 10000);
</script>

</body>
</html>