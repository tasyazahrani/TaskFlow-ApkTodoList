<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Todo List</title>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>
<body>
    <div class="container">
        <div class="auth-form">
            <div class="form-header">
                <h2>Create Account</h2>
                <p>Join us today</p>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="registerName">Full Name</label>
                    <input type="text" name="name" id="registerName" placeholder="Abdullah Afnan" required value="{{ old('name') }}">
                </div>
                
                <div class="form-group">
                    <label for="registerEmail">Email</label>
                    <input type="email" name="email" id="registerEmail" placeholder="youremail@example.com" required value="{{ old('email') }}">
                </div>

                <div class="form-group">
                    <label for="registerMobile">Mobile</label>
                    <input type="tel" name="mobile" id="registerMobile" placeholder="08473589556" required value="{{ old('mobile') }}">
                </div>

                <div class="form-group">
                    <label for="registerPassword">Password</label>
                    <input type="password" name="password" id="registerPassword" placeholder="••••••••" required>
                </div>

                <div class="form-group">
                    <label for="registerPasswordConfirmation">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="registerPasswordConfirmation" placeholder="••••••••" required>
                </div>
                
                <button type="submit" class="btn btn-primary">Register</button>
            </form>
            
            <div class="switch-form">
                Already have an account? <a href="{{ route('login') }}">Sign in</a>
            </div>
        </div>
    </div>
</body>
</html>
