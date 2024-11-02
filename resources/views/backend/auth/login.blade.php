<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/backend/css/loginstyle.css">
</head>
<body>
    <div class="container">
        <div class="login-box">
            <!-- Logo placed here -->
            <img src="meherabmain.png" alt="Logo" class="logo">
            <h2>Login</h2>
            <form action="{{ route('admin.postLogin') }}" method="POST">
                @csrf
                <div class="input-box">
                    <input type="email" name="email" required>
                    <label>Email</label>
                </div>
                <div class="input-box">
                    <input type="password" name="password" required>
                    <label>Password</label>
                </div>
                <div class="forgot-pass">
                    <a href="#">Forgot your password?</a>
                </div>
                <button type="submit" class="btn">Login</button>
            </form>
        </div>
    </div>

    <script>
        // Generate 50 span elements with different --i values
        const container = document.querySelector('.container');
        for (let i = 0; i < 50; i++) {
            const span = document.createElement('span');
            span.style.setProperty('--i', i);
            container.appendChild(span);
        }
    </script>
</body>

<style>
.logo {
    display: block;
    margin: 0 auto 20px; /* Centers the logo and adds space below */
    width: 250px; /* Adjust width as needed */
    height: auto;
}

</style>
</html>
