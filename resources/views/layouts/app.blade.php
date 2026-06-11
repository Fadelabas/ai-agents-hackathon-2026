<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Jibli — Smart Delivery</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: #f0f2f5;
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .header {
            background: #1a1a2e;
            color: white;
            width: 100%;
            padding: 14px 20px;
            text-align: center;
            position: fixed;
            top: 0;
            z-index: 100;
        }

        .header h1 {
            font-size: 22px;
            font-weight: 700;
            color: #6c63ff;
        }

        .header span {
            font-size: 12px;
            color: #aaa;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>🚀 Jibli</h1>
        <span>Smart AI Delivery Agent · Lebanon</span>
    </div>

    @yield('content')

    @yield('scripts')
</body>
</html>