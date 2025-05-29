<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Todo List</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <div class="container">
        <div class="auth-form">
            <div class="form-header">
                <h2>Welcome Back</h2>
                <p>Sign in to your account</p>
            </div>

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="loginMobile">Mobile</label>
                    <input type="tel" name="mobile" id="loginMobile" placeholder="08473589556" required>
                </div>
                
                <div class="form-group">
                    <label for="loginPassword">Password</label>
                    <input type="password" name="password" id="loginPassword" placeholder="••••••••" required>
                </div>
                
                <div class="form-footer">
                    <a href="#" id="forgotPassword">Forgot Password?</a>
                </div>
                
                <button type="submit" class="btn btn-primary">Log In</button>
            </form>
            
            <div class="switch-form">
                Don't have an account? <a href="{{ route('register') }}">Sign up</a>
            </div>
        </div>
    </div>
</body>
</html>
