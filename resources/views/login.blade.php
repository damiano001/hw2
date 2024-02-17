<!DOCTYPE html>
<html>
<head>
    <title>Login Form</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1" >
</head>
<body>
    <h2>Welcome back</h2>
    <form method="post">
        @csrf
        <img style="height: 120px; width: 120px; margin-left: 35%;" src="https://st2.depositphotos.com/5142301/7567/v/950/depositphotos_75676827-stock-illustration-abstract-green-leaf-sphere-logo.jpg">
        <label>Username:</label>
        <input type="text" name="username" required>
        <br><br>
        <label>Password:</label>
        <input type="password" name="password" required>
        <br><br>
        <input type="submit" name="login" value="Login">
        <p>Don't have an account? <a href="{{ route('register') }}">Sign Up</a></p>
    </form>

    @if(isset($error))
        <div class="error">{{ $error }}</div>
    @endif

</body>
</html>
