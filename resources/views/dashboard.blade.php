<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard — BASA</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Inter', sans-serif;
            background: #0F172A;
            color: #F1F5F9;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 24px;
            -webkit-font-smoothing: antialiased;
        }
        .card {
            background: rgba(30,41,59,0.85);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 16px;
            padding: 40px 48px;
            text-align: center;
            max-width: 480px;
            width: 90%;
        }
        .avatar {
            width: 64px; height: 64px;
            border-radius: 50%;
            background: linear-gradient(135deg, #F59E0B, #D97706);
            display: flex; align-items: center; justify-content: center;
            font-size: 26px; font-weight: 700; color: #0F172A;
            margin: 0 auto 20px;
        }
        h1 { font-size: 22px; font-weight: 700; margin-bottom: 6px; }
        .role-badge {
            display: inline-block;
            background: rgba(245,158,11,0.15);
            color: #FCD34D;
            border: 1px solid rgba(245,158,11,0.3);
            border-radius: 20px;
            padding: 4px 14px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            margin-bottom: 24px;
        }
        p { font-size: 13px; color: #94A3B8; line-height: 1.6; }
        form { margin-top: 28px; }
        .btn-logout {
            background: rgba(239,68,68,0.12);
            border: 1px solid rgba(239,68,68,0.3);
            color: #FCA5A5;
            padding: 10px 24px;
            border-radius: 8px;
            font-family: 'Inter', sans-serif;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
        }
        .btn-logout:hover {
            background: rgba(239,68,68,0.22);
            border-color: rgba(239,68,68,0.5);
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
        <h1>Welcome, {{ auth()->user()->name }}!</h1>
        <div class="role-badge">{{ auth()->user()->getRoleNames()->first() ?? 'No Role' }}</div>
        <p>You are successfully signed in to the BASA School Management System. Your dashboard is being set up.</p>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-logout">Sign Out</button>
        </form>
    </div>
</body>
</html>
