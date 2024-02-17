<!DOCTYPE html>
<html>
<head>
  <title>Registration Form</title>
  <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
  <meta name="viewport" content="width=device-width, initial-scale=1" >
</head>
<body>
  <h2>Welcome</h2>
  <form method="post">
  @csrf
    <img style="height: 120px; width: 120px; margin-left: 35%;" src="https://st2.depositphotos.com/5142301/7567/v/950/depositphotos_75676827-stock-illustration-abstract-green-leaf-sphere-logo.jpg">
    <label>Username:</label>
    <input type="text" name="username" required>
    <br><br>
    <label>Email:</label>
    <input type="email" name="email" required>
    <br><br>
    <label>Password:</label>
    <input type="password" name="password" required>
    <br><br>
    <input type="submit" name="register" value="Register">
    <p>Already have an account? <a href="{{ route('login') }}">Login</a></p>
  </form>

  @if ($errors->any())
  <div class="error">{{ $errors->first() }}</div>
@elseif (session('success_msg'))
  <div class="success">{{ session('success_msg') }}</div>
@endif

</body>
</html>
