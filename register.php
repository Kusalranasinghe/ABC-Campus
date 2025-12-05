<?php

include("database.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"] ) ?>" method="post" style="width: 400px;">

        <h2>Welcome to ABC Campus</h2>

        <label for="name">Name</label>
        <input type="text" id="name" name="name" placeholder="Enter your name :">

        <label for="nic">NIC</label>
        <input type="text" id="nic" name="nic" placeholder="Enter your nic :">

        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Enter your email :">

        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Enter your password :">


        <input type="submit" value="Register">
    </form>


</body>

</html>

<?php

if($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = filter_input(INPUT_POST,"name",FILTER_SANITIZE_SPECIAL_CHARS);
    $nic = filter_input(INPUT_POST,"nic",FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST,"email",FILTER_VALIDATE_EMAIL);
    $password = filter_input(INPUT_POST,"password",FILTER_SANITIZE_SPECIAL_CHARS);

    if(empty($name && $nic && $email && $password)){
        echo "Please enter all !";
    }
    else {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (name,nic,email,password) VALUES ('$name','$nic','$email','$hash')";

        mysqli_query($conn, $sql);
        header("Location:login.php");
    }
}

mysqli_close($conn);
?>