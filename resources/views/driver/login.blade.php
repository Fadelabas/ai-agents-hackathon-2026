<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jibli — Driver Login</title>
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: #f0f2f5;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            width: 100%;
            max-width: 380px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.1);
        }
        h2 { color: #1a1a2e; margin-bottom: 6px; font-size: 24px; }
        p  { color: #888; font-size: 13px; margin-bottom: 28px; }
        label { display:block; font-size:13px; color:#555; margin-bottom:6px; font-weight:600; }
        input {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 14px;
            margin-bottom: 16px;
            outline: none;
            transition: border 0.2s;
        }
        input:focus { border-color: #6c63ff; }
        button {
            width: 100%;
            padding: 14px;
            background: #6c63ff;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 4px;
        }
        button:hover { background: #5a52d5; }
        .error { color: #e53e3e; font-size: 13px; margin-bottom: 12px; }
        .logo { font-size: 32px; margin-bottom: 12px; }
    </style>
</head>
<body>
<div class="card">
    <div class="logo">🚀</div>
    <h2>Jibli Driver</h2>
    <p>Sign in to your driver account</p>

    @if($errors->any())
        <div class="error">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="/driver/login">
        @csrf
        <label>Phone Number</label>
        <input type="text" name="phone" placeholder="03xxxxxx"
               value="{{ old('phone') }}" required autofocus />

        <label>Password</label>
        <input type="password" name="password" placeholder="••••••••" required />

        <button type="submit">Sign In</button>
    </form>
</div>
</body>
</html>