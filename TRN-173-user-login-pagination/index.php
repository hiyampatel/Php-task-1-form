<?php

    session_start();

    if (isset($_SESSION['uname']))
    {
        header("Location:pass.php?abc.com?q=4");
    }

    if (isset($_POST['submit']))
    {
        $_SESSION['uname'] = $_POST['uname'];
        $_SESSION['password'] = $_POST['password'];
        header("Location:pass.php?abc.com?q=4");

    }

?>
<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
</head>
<body>
    <h1>Login Page</h1>
    <form action="index.php" method="POST">
        Username : <input type="text" name="uname"><br><br>
        Password : <input type="password" name="password"><br><br>
        <input type="submit" name="submit">
    </form>
</body>
</html>
