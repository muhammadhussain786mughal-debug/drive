<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CloudBox - Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
        <link rel="stylesheet" href="//resources/css/style.css">
    <style>
        :root {
            --primary: #4f46e5;
            --bg-main: #f8fafc;
            --surface: #ffffff;
            --sidebar-bg: #0f172a;
            --text-dark: #0f172a;
            --text-muted: #64748b;
            --border: #e2e8f0;
            --radius-lg: 16px;
            --radius-md: 12px;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', system-ui, sans-serif; }
        body { background-color: var(--bg-main); color: var(--text-dark); }
        .layout { display: flex; min-height: 100vh; }

        .sidebar {
            width: 260px; background: var(--sidebar-bg); color: #fff;
            padding: 32px 20px; display: flex; flex-direction: column;
            position: fixed; height: 100vh;
        }
        .brand { display: flex; align-items: center; gap: 12px; margin-bottom: 36px; }
        .brand-icon {
            width: 40px; height: 40px; background: linear-gradient(135deg, #6366f1, #4f46e5);
            border-radius: 10px; display: flex; align-items: center; justify-content: center;
            font-size: 18px; color: #fff;
        }
        .brand h2 { font-size: 18px; font-weight: 700; }
        .brand p { font-size: 11px; color: #94a3b8; }

        .sidebar-menu { display: flex; flex-direction: column; gap: 6px; }
        .sidebar-menu a {
            display: flex; align-items: center; gap: 14px; padding: 12px 16px;
            color: #94a3b8; text-decoration: none; font-size: 14px; font-weight: 500;
            border-radius: var(--radius-md); transition: 0.2s;
        }
        .sidebar-menu a:hover { color: #fff; background: rgba(255, 255, 255, 0.05); }
        .sidebar-menu a.active { color: #fff; background: var(--primary); }

        .logout-form { margin-top: auto; padding-top: 20px; }
        .logout-form button {
            width: 100%; padding: 10px 14px; background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1); color: #ef4444; border-radius: var(--radius-md);
            cursor: pointer; display: flex; align-items: center; gap: 10px; font-size: 14px;
        }
        .logout-form button:hover { background: rgba(239, 68, 68, 0.1); }

        .main { margin-left: 260px; flex: 1; padding: 32px 40px; }
        
        .topbar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 32px; }
        .search-box { position: relative; width: 340px; }
        .search-box i { position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: var(--text-muted); }
        .search-box input {
            width: 100%; padding: 12px 16px 12px 44px; background: var(--surface);
            border: 1px solid var(--border); border-radius: var(--radius-md); font-size: 14px; outline: none;
        }
        .user-badge { display: flex; align-items: center; gap: 10px; background: var(--surface); padding: 8px 16px; border-radius: var(--radius-md); border: 1px solid var(--border); font-weight: 600; font-size: 14px;}

        .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 28px; }
        .page-header h1 { font-size: 26px; font-weight: 700; }
        .page-header p { color: var(--text-muted); font-size: 14px; }
        .btn-upload {
            background: var(--primary); color: white; text-decoration: none; padding: 12px 20px;
            border-radius: var(--radius-md); font-weight: 600; font-size: 14px; display: inline-flex; align-items: center; gap: 8px;
        }

        .welcome-card {
            background: linear-gradient(135deg, #4f46e5, #3730a3); color: white;
            border-radius: var(--radius-lg); padding: 32px; display: flex; justify-content: space-between;
            align-items: center; margin-bottom: 32px;
        }
        .welcome-card h2 { font-size: 22px; margin-bottom: 6px; }
        .welcome-card p { opacity: 0.85; font-size: 14px; }

        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px; margin-bottom: 32px; }
        .stat-card {
            background: var(--surface); border: 1px solid var(--border); padding: 20px;
            border-radius: var(--radius-lg); box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }
        .stat-icon {
            width: 44px; height: 44px; border-radius: 10px; display: flex;
            align-items: center; justify-content: center; font-size: 18px; margin-bottom: 16px;
        }
        .stat-blue { background: #e0e7ff; color: #4338ca; }
        .stat-purple { background: #f3e8ff; color: #6b21a8; }
        .stat-green { background: #dcfce7; color: #15803d; }
        .stat-orange { background: #ffedd5; color: #c2410c; }
        .stat-card h3 { font-size: 24px; margin-bottom: 4px; }
        .stat-card p { font-size: 13px; color: var(--text-muted); }

        .bottom-grid { display: grid; grid-template-columns: 1.5fr 1fr; gap: 20px; }
        .panel { background: var(--surface); border: 1px solid var(--border); padding: 24px; border-radius: var(--radius-lg); }
        .panel h3 { font-size: 16px; margin-bottom: 16px; }
        .quick-link {
            display: flex; align-items: center; gap: 12px; padding: 14px; border: 1px solid var(--border);
            border-radius: var(--radius-md); text-decoration: none; color: var(--text-dark); margin-bottom: 10px;
            font-size: 14px; font-weight: 500; transition: 0.2s;
        }
        .quick-link:hover { background: var(--bg-main); border-color: var(--primary); }
        .quick-link i { color: var(--primary); }
    </style>
</head>
<body>

<div class="layout">
    <aside class="sidebar">
        <div class="brand">
            <div class="brand-icon"><i class="fa-solid fa-cloud"></i></div>
            <div>
                <h2>CloudBox</h2>
                <p>Cloud Storage</p>
            </div>
        </div>

        <nav class="sidebar-menu">
            <a href="{{ url('/index') }}" class="active">
                <i class="fa-solid fa-house"></i> <span>Dashboard</span>
            </a>
            <a href="{{ url('/my_folder') }}">
                <i class="fa-solid fa-folder"></i> <span>My Folders</span>
            </a>
            <a href="{{ route('create_folder') }}">
                <i class="fa-solid fa-cloud-arrow-up"></i> <span>Upload Folder</span>
            </a>
            <a href="#">
                <i class="fa-solid fa-clock-rotate-left"></i> <span>Recent Activity</span>
            </a>
            <a href="#">
                <i class="fa-solid fa-user"></i> <span>Profile</span>
            </a>
        </nav>

        <form action="logout" method="post" class="logout-form">
            @csrf
            <button type="submit">
                <i class="fa-solid fa-right-from-bracket"></i> Logout Account
            </button>
        </form>
    </aside>

    <main class="main">
        <div class="topbar">
            <div class="search-box">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" placeholder="Search folders...">
            </div>
            <div class="user-badge">
                <i class="fa-solid fa-circle-user"></i>
                {{ auth()->user()->name }}
            </div>
        </div>

        <div class="page-header">
            <div>
                <h1>Dashboard Overview</h1>
                <p>Manage your uploaded items and cloud workspace.</p>
            </div>
            <a href="{{ route('create_folder') }}" class="btn-upload">
                <i class="fa-solid fa-plus"></i> Upload Folder
            </a>
        </div>

        <div class="welcome-card">
            <div>
                <h2>Welcome Back to CloudBox!</h2>
                <p>Your secure personal storage is online and ready.</p>
            </div>
            <i class="fa-solid fa-cloud-arrow-up" style="font-size: 48px; opacity: 0.8;"></i>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon stat-blue"><i class="fa-solid fa-folder"></i></div>
                <h3>{{ $totalFolders ?? 0 }}</h3>
                <p>Total Folders</p>
            </div>
            <div class="stat-card">
                <div class="stat-icon stat-purple"><i class="fa-solid fa-cloud-arrow-up"></i></div>
                <h3>—</h3>
                <p>Recent Uploads</p>
            </div>
            <div class="stat-card">
                <div class="stat-icon stat-green"><i class="fa-solid fa-database"></i></div>
                <h3>—</h3>
                <p>Storage Usage</p>
            </div>
            <div class="stat-card">
                <div class="stat-icon stat-orange"><i class="fa-solid fa-shield-halved"></i></div>
                <h3>Active</h3>
                <p>Account Status</p>
            </div>
        </div>

        <div class="bottom-grid">
            <div class="panel">
                <h3>Quick Actions</h3>
                <a href="{{ route('create_folder') }}" class="quick-link">
                    <i class="fa-solid fa-folder-plus"></i> Upload New Folder
                </a>
                <a href="{{ url('/my_folder') }}" class="quick-link">
                    <i class="fa-solid fa-folder-open"></i> Browse My Folders
                </a>
            </div>
            <div class="panel">
                <h3>Account Status</h3>
                <p style="font-size: 14px; color: var(--text-muted); line-height: 1.6;">
                    Your account is fully synchronized with our cloud network.
                </p>
            </div>
        </div>
    </main>
</div>

</body>
</html>