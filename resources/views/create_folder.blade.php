<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Folder - CloudBox</title>
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

        .page-header { margin-bottom: 28px; }
        .page-header h1 { font-size: 26px; font-weight: 700; }
        .page-header p { color: var(--text-muted); font-size: 14px; }

        .upload-card {
            background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius-lg);
            padding: 40px; max-width: 720px; margin: 0 auto; box-shadow: 0 4px 20px rgba(0,0,0,0.03);
        }
        .upload-card h2 { font-size: 20px; text-align: center; margin-bottom: 6px; }
        .upload-card p.subtitle { text-align: center; color: var(--text-muted); font-size: 14px; margin-bottom: 28px; }

        .drop-zone {
            border: 2px dashed #a5b4fc; background: #f5f3ff; border-radius: var(--radius-lg);
            padding: 40px 20px; text-align: center; cursor: pointer; transition: 0.2s;
        }
        .drop-zone:hover { border-color: var(--primary); background: #eef2ff; }
        .drop-zone i { font-size: 40px; color: var(--primary); margin-bottom: 16px; }
        .drop-zone h3 { font-size: 16px; font-weight: 600; margin-bottom: 4px; }
        .drop-zone p { font-size: 13px; color: var(--text-muted); margin-bottom: 16px; }

        input[type="file"] { margin: 0 auto; font-size: 13px; color: var(--text-muted); }

        .btn-submit {
            width: 100%; padding: 14px; background: var(--primary); color: white; border: none;
            border-radius: var(--radius-md); font-size: 15px; font-weight: 600; cursor: pointer;
            margin-top: 24px; transition: 0.2s;
        }
        .btn-submit:hover { background: #4338ca; }
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
            <a href="/my_folder">
                <i class="fa-solid fa-folder"></i> <span>My Folders</span>
            </a>
            <a href="/create_folder" class="active">
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
            <h1>Upload Directory</h1>
            <p>Sync complete directory structure to cloud storage.</p>
        </div>

        <div class="upload-card">
            <h2>Select Local Folder</h2>
            <p class="subtitle">Choose a folder containing files and subfolders to preserve hierarchy.</p>

            <form action="" method="post" enctype="multipart/form-data">
                @csrf

                <div class="drop-zone">
                    <i class="fa-solid fa-folder-open"></i>
                    <h3>Select your folder</h3>
                    <p>All nested files and subfolders will be included automatically.</p>

                    <input type="file" name="folder[]" id="folder" webkitdirectory multiple>
                    <div id="path"></div>
                </div>

                <input type="submit" value="Start Upload Process" class="btn-submit">
            </form>
        </div>
    </main>
</div>

<script>
    document.getElementById("folder").addEventListener("change", function(){
        let container = document.getElementById("path");
        container.innerHTML = '';
        Array.from(this.files).forEach(file => {
            let input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'paths[]';
            input.value = file.webkitRelativePath;
            container.appendChild(input);
        });
    });
</script>

</body>
</html>