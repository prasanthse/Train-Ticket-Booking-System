<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Me Login</title>
    <link rel="stylesheet" href="login.css">
  </head>

  <body>
    <form class="box" action="Authentication.php" method="post" id="loginForm" name="loginForm">
      <h1>Welcome to BookMe</h1>
      <input type="text" id="username" name="username" placeholder="Username" required>
      <input type="password" id="password" name="password" placeholder="Password" required>
      <input type="submit" value="Login">
    </form>
   </body>
</html>