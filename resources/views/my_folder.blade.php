<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Folders - CloudBox</title>
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

        .folder-grid { display: flex; flex-direction: column; gap: 12px; }
        .folder-card {
            background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius-md);
            padding: 16px 20px; display: flex; align-items: center; justify-content: space-between;
            transition: all 0.2s;
        }
        .folder-card:hover { border-color: var(--primary); box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        .folder-meta { display: flex; align-items: center; gap: 16px; }
        .folder-icon {
            width: 44px; height: 44px; background: #fef3c7; color: #d97706;
            border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 20px;
        }
        .folder-details p { font-size: 15px; font-weight: 600; color: var(--text-dark); }
        .folder-details span { font-size: 12px; color: var(--text-muted); display: flex; align-items: center; gap: 4px; margin-top: 2px;}

        .btn-download {
            background: #eef2ff; color: var(--primary); text-decoration: none; padding: 10px 16px;
            border-radius: var(--radius-md); font-size: 13px; font-weight: 600; display: inline-flex;
            align-items: center; gap: 8px; transition: 0.2s;
        }
        .btn-download:hover { background: var(--primary); color: white; }

        .empty-state {
            background: var(--surface); border: 1px dashed var(--border); border-radius: var(--radius-lg);
            padding: 60px 20px; text-align: center; color: var(--text-muted);
        }
        .empty-state i { font-size: 48px; color: #cbd5e1; margin-bottom: 16px; }
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
            <a href="/index">
                <i class="fa-solid fa-house"></i> <span>Dashboard</span>
            </a>
            <a href="/my_folder" class="active">
                <i class="fa-solid fa-folder"></i> <span>My Folders</span>
            </a>
            <a href="/create_folder">
                <i class="fa-solid fa-cloud-arrow-up"></i> <span>Upload Folder</span>
            </a>
            <a href="#">
                <i class="fa-solid fa-clock-rotate-left"></i> <span>Recent Activity</span>
            </a>
            <a href="#">
                <i class="fa-solid fa-user"></i> <span>Profile</span>
            </a>
        </nav>
    </aside>

    <main class="main">
        <div class="topbar">
            <div class="search-box">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" placeholder="Search folders...">
            </div>
            <div class="user-badge">
                <i class="fa-solid fa-circle-user"></i>
                My CloudBox Account
            </div>
        </div>

        <div class="page-header">
            <div>
                <h1>My Uploaded Folders</h1>
                <p>Access and download all your folder archives.</p>
            </div>
            <a href="/create_folder" class="btn-upload">
                <i class="fa-solid fa-plus"></i> Upload New Folder
            </a>
        </div>

        <div class="folder-grid">
            @forelse($folders as $folder)
                <div class="folder-card">
                    <div class="folder-meta">
                        <div class="folder-icon">
                            <i class="fa-solid fa-folder"></i>
                        </div>
                        <div class="folder-details">
                            <p>{{$folder->folder_name}}</p>
                            <span><i class="fa-regular fa-clock"></i> Cloud Directory</span>
                        </div>
                    </div>
                    <a href="{{ route('folder_download', $folder->id) }}" class="btn-download">
                        <i class="fa-solid fa-download"></i> Download ZIP
                    </a>
                </div>
            @empty
                <div class="empty-state">
                    <i class="fa-regular fa-folder-open"></i>
                    <h3>No Folders Available</h3>
                    <p>Start uploading folders to view them here.</p>
                </div>
            @endforelse
        </div>
    </main>
</div>

</body>
</html>