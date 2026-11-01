<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - CloudBox</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
        <link rel="stylesheet" href="//resources/css/style.css">

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', system-ui, sans-serif; }
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 100%);
            padding: 20px;
        }
        .card {
            background: #ffffff;
            width: 100%;
            max-width: 440px;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }
        .brand-header { text-align: center; margin-bottom: 28px; }
        .brand-icon {
            width: 54px; height: 54px;
            background: linear-gradient(135deg, #6366f1, #4f46e5);
            color: #fff; border-radius: 14px;
            display: inline-flex; align-items: center; justify-content: center;
            font-size: 24px; margin-bottom: 12px;
            box-shadow: 0 8px 16px rgba(79, 70, 229, 0.3);
        }
        .brand-header h2 { font-size: 24px; color: #0f172a; font-weight: 700; }
        .brand-header p { font-size: 14px; color: #64748b; margin-top: 4px; }
        .form-group { margin-bottom: 18px; }
        .form-group label { display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 8px; }
        .input-wrapper { position: relative; }
        .input-wrapper i { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #94a3b8; }
        .input-wrapper input {
            width: 100%;
            padding: 12px 14px 12px 42px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            font-size: 14px;
            outline: none;
            transition: all 0.2s;
        }
        .input-wrapper input:focus { border-color: #4f46e5; box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1); }
        .error { color: #ef4444; font-size: 12px; margin-top: 6px; }
        .btn-submit {
            width: 100%; padding: 13px;
            background: #4f46e5; color: white;
            border: none; border-radius: 10px;
            font-size: 15px; font-weight: 600;
            cursor: pointer; transition: all 0.2s;
            margin-top: 10px;
        }
        .btn-submit:hover { background: #4338ca; box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3); }
        .footer-link { text-align: center; margin-top: 24px; font-size: 14px; color: #64748b; }
        .footer-link a { color: #4f46e5; font-weight: 600; text-decoration: none; }
        .footer-link a:hover { text-decoration: underline; }
    </style>
</head>
<body>

    <div class="card">
        <div class="brand-header">
            <div class="brand-icon"><i class="fa-solid fa-user-plus"></i></div>
            <h2>Create Account</h2>
            <p>Get started with free cloud storage</p>
        </div>

        <form action="" method="post">
            @csrf

            <div class="form-group">
                <label>Full Name</label>
                <div class="input-wrapper">
                    <i class="fa-regular fa-user"></i>
                    <input type="text" name="name" placeholder="John Doe" value="{{ old('name') }}">
                </div>
                @error('name')
                    <p class="error">{{$message}}</p>
                @enderror
            </div>

            <div class="form-group">
                <label>Email Address</label>
                <div class="input-wrapper">
                    <i class="fa-regular fa-envelope"></i>
                    <input type="email" name="email" placeholder="name@example.com" value="{{ old('email') }}">
                </div>
                @error('email')
                    <p class="error">{{$message}}</p>
                @enderror
            </div>

            <div class="form-group">
                <label>Password</label>
                <div class="input-wrapper">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" name="password" placeholder="••••••••">
                </div>
                @error('password')
                    <p class="error">{{$message}}</p>
                @enderror
            </div>

            <input type="submit" value="Create Account" class="btn-submit">

            <p class="footer-link">
                Already have an account? <a href="login">Login</a>
            </p>
        </form>
    </div>

</body>
</html>