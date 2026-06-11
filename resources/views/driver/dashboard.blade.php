<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Jibli — Driver Dashboard</title>
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
            padding: 14px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header h1 { font-size: 20px; color: #6c63ff; }
        .header span { font-size: 13px; color: #aaa; }
        .logout-btn {
            background: none;
            border: 1px solid #555;
            color: #aaa;
            padding: 6px 14px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 12px;
        }
        .container { max-width: 600px; margin: 24px auto; padding: 0 16px; }

        .driver-info {
            background: white;
            border-radius: 16px;
            padding: 16px 20px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 14px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.06);
        }
        .avatar {
            width: 48px; height: 48px;
            background: #6c63ff;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 22px; color: white;
        }
        .driver-info h3 { font-size: 16px; color: #1a1a2e; }
        .driver-info span { font-size: 12px; color: #888; }
        .status-badge {
            margin-left: auto;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
        .status-available { background: #d4edda; color: #155724; }
        .status-busy      { background: #fff3cd; color: #856404; }
        .status-offline   { background: #f8d7da; color: #721c24; }

        .card {
            background: white;
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 16px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.06);
        }
        .card-title {
            font-size: 13px;
            font-weight: 700;
            color: #6c63ff;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 16px;
        }

        .order-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #f0f0f0;
            font-size: 14px;
        }
        .order-row:last-of-type { border-bottom: none; }
        .order-row .label { color: #888; }
        .order-row .value { color: #1a1a2e; font-weight: 600; text-align: right; max-width: 60%; }

        .price-badge {
            background: #d4edda;
            color: #155724;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 15px;
            font-weight: 700;
            display: inline-block;
            margin: 12px 0;
        }

        .btn-group { display: flex; gap: 10px; margin-top: 16px; }
        .btn {
            flex: 1;
            padding: 13px;
            border: none;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: opacity 0.2s;
        }
        .btn:hover    { opacity: 0.85; }
        .btn:disabled { opacity: 0.5; cursor: not-allowed; }
        .btn-accept   { background: #28a745; color: white; }
        .btn-reject   { background: #dc3545; color: white; }
        .btn-complete { background: #6c63ff; color: white; width: 100%; }

        .idle-state {
            text-align: center;
            padding: 40px 20px;
            color: #aaa;
        }
        .idle-state .icon { font-size: 48px; margin-bottom: 12px; }
        .idle-state p { font-size: 14px; }

        .task-badge {
            display: inline-block;
            background: #eef2ff;
            color: #6c63ff;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 12px;
        }
    </style>
</head>
<body>

<div class="header">
    <div>
        <h1>🚀 Jibli Driver</h1>
        <span>Dashboard</span>
    </div>
    <form method="POST" action="/driver/logout" style="display:inline">
        @csrf
        <button type="submit" class="logout-btn">Logout</button>
    </form>
</div>

<div class="container">

    {{-- Driver Info --}}
    <div class="driver-info">
        <div class="avatar">🚗</div>
        <div>
            <h3>{{ $driver->name }}</h3>
            <span>{{ $driver->phone }}</span>
        </div>
        <span class="status-badge status-{{ $driver->status }}">
            {{ ucfirst($driver->status) }}
        </span>
    </div>

    {{-- Active Order --}}
    @if($activeOffer)
    <div class="card">
        <div class="card-title">🟢 Active Order</div>

        <div class="task-badge">
            {{ str_replace('_', ' ', ucfirst($activeOffer->order->task_type)) }}
        </div>

        <div class="order-row">
            <span class="label">Area</span>
            <span class="value">{{ $activeOffer->order->area_name ?? $activeOffer->order->area_text }}</span>
        </div>
        <div class="order-row">
            <span class="label">Address</span>
            <span class="value">{{ $activeOffer->order->exact_address }}</span>
        </div>
        <div class="order-row">
            <span class="label">Customer</span>
            <span class="value">
                <a href="tel:{{ $activeOffer->order->customer_phone }}" style="color:#6c63ff;">
                    {{ $activeOffer->order->customer_phone }}
                </a>
            </span>
        </div>
        <div class="order-row">
            <span class="label">District</span>
            <span class="value">{{ $activeOffer->order->district_name }}</span>
        </div>

        <div class="price-badge">💰 ${{ number_format($activeOffer->order->price, 2) }}</div>

        <form method="POST" action="/driver/order/{{ $activeOffer->order->id }}/complete">
            @csrf
            <button type="submit" class="btn btn-complete" onclick="this.disabled=true;this.form.submit();">
                ✅ Mark as Completed
            </button>
        </form>
    </div>

    {{-- Pending Offer --}}
    @elseif($pendingOffer)
    <div class="card">
        <div class="card-title">🔔 New Order Request</div>

        <div class="task-badge">
            {{ str_replace('_', ' ', ucfirst($pendingOffer->order->task_type)) }}
        </div>

        <div class="order-row">
            <span class="label">Area</span>
            <span class="value">{{ $pendingOffer->order->area_name ?? $pendingOffer->order->area_text }}</span>
        </div>
        <div class="order-row">
            <span class="label">Address</span>
            <span class="value">{{ $pendingOffer->order->exact_address }}</span>
        </div>
        <div class="order-row">
            <span class="label">Customer Phone</span>
            <span class="value">{{ $pendingOffer->order->customer_phone }}</span>
        </div>
        <div class="order-row">
            <span class="label">District</span>
            <span class="value">{{ $pendingOffer->order->district_name }}</span>
        </div>

        <div class="price-badge">💰 ${{ number_format($pendingOffer->order->price, 2) }}</div>

        <div class="btn-group">
            <form method="POST" action="/driver/offer/{{ $pendingOffer->id }}/accept" style="flex:1">
                @csrf
                <button type="submit" class="btn btn-accept"
                        onclick="this.disabled=true;this.form.submit();" style="width:100%">
                    ✅ Accept
                </button>
            </form>
            <form method="POST" action="/driver/offer/{{ $pendingOffer->id }}/reject" style="flex:1">
                @csrf
                <button type="submit" class="btn btn-reject"
                        onclick="this.disabled=true;this.form.submit();" style="width:100%">
                    ❌ Reject
                </button>
            </form>
        </div>
    </div>

    {{-- Idle --}}
    @else
    <div class="card">
        <div class="idle-state">
            <div class="icon">🕐</div>
            <p>No orders yet.<br>Waiting for new requests...</p>
        </div>
    </div>
    @endif

</div>

{{-- Auto-refresh every 5 seconds --}}
<script>
setTimeout(() => location.reload(), 5000);
</script>

</body>
</html>
