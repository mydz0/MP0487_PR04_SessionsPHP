<!-- page2.php -->
<?php
session_start(); // Resume the session
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Store the user input in the session
    $_SESSION['name'] = $_POST['name'];//create data sesion
    $_SESSION['pw'] = $_POST['pw'];//create password
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>With Sessions</title>
</head>

<body>
    <?php
    if (isset($_SESSION['name'])) {//if name is stored in session
        $name = $_SESSION['name'];//reads the session
        $_SESSION['name'] = "ferran";//update 
        echo "<h1>Welcome back, $name!</h1>";//it shows inside the html
        // remove all session variables (log out)
        session_unset();

        // destroy the session (log out)
        session_destroy();
    } else {
        echo "<h1>No session data found!</h1>";
    }
    ?>
</body>

</html>