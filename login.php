<?php
include("database.php");
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
    $password = $_POST["password"];

    if(empty($email) || empty($password)) {
        echo "All fields are required";
    } 
    else {

        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);

            if(password_verify($password, $user["password"])) {
                
                $_SESSION["user"] = $user["name"];

                header("Location: dashboard.php");
                exit();

            } else {
                echo "Invalid password";
            }

        } else {
            echo "No user found with this email";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" style="width: 400px;">

        <h2>User Login</h2>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Enter your email :">

        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Enter your password :">

        <input type="submit" value="Login">
    </form>
</body>

</html>
