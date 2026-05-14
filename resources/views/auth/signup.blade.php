<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sign Up | ENVED</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html,
        body {
            height: 100%;
            overflow: hidden;
            /* Remove scrolling */
            font-family: "Poppins", sans-serif;
        }

        .signup-wrapper {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .signup-container {
            width: 100%;
            max-width: 480px;
            padding: 40px 35px;
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            animation: fadeInUp 0.6s ease;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .signup-title {
            text-align: center;
            font-weight: 700;
            color: #0a8a33;
            margin-bottom: 25px;
            letter-spacing: 1px;
        }

        .form-label {
            font-weight: 600;
            color: #333;
        }

        .form-control {
            border-radius: 10px;
            border: 1px solid #d3d3d3;
            padding: 10px 14px;
        }

        .form-control:focus {
            border-color: #0a8a33;
            box-shadow: 0 0 0 0.15rem rgba(15, 115, 30, 0.25);
        }

        .btn-primary {
            background-color: #0a8a33;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            padding: 10px 0;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #3fae49;
            box-shadow: 0 4px 12px rgba(15, 115, 30, 0.3);
        }

        .text-center a {
            color: #0a8a33;
            text-decoration: none;
            font-weight: 500;
        }

        .text-center a:hover {
            text-decoration: underline;
        }

        .alert {
            border-radius: 8px;
        }

        .env-logo {
            display: block;
            margin: 0 auto 15px;
            width: 110px;
        }

        @media (max-width: 576px) {
            .signup-container {
                margin: 0 15px;
                padding: 30px 25px;
            }
        }
    </style>
</head>

<body>

    <div class="signup-wrapper">
        <div class="signup-container">
            <img src="{{ asset('images/logo.png') }}" alt="ENVED Logo" class="env-logo">

            <h2 class="signup-title">Create Your Account</h2>

            {{-- Error Messages --}}
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            {{-- Success Message --}}
            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <form action="{{ route('signup.post') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control"
                        required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="form-control" required>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Sign Up</button>
                </div>

                <div class="mt-3 text-center">
                    Already have an account? <a href="{{ route('login') }}">Log in</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>