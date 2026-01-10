<?php
// Initialize variables
$name = $email = "";
$errors = [];
$success = false;

// Sanitize function
function sanitize($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Form submission check
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Collect inputs
    $name = $_POST["name"] ?? "";
    $email = $_POST["email"] ?? "";
    $password = $_POST["password"] ?? "";
    $confirm_password = $_POST["confirm_password"] ?? "";
   
    if (empty($name) || empty($email) || empty($password) || empty($confirm_password))
         {
        $errors[] = "All fields are required.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors[] = "Invalid email format";
    }

    if ($password !== $confirm_password){
        $errors[] = "Password do not match.";
    }

    if(empty($errors)){
        $success = true;
        $name = sanitize($name);
        $email = sanitize($email);
    }
   
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Registration</title>
    <link rel="stylesheet" href="register.css">
</head>
<body>

<div class="container">
    <h2>User Registration Form</h2>

    <?php if (!empty($errors)): ?>
        <div class="error-box">
            <?php foreach ($errors as $error): ?>
                <p><?= $error ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="success-box">
            <h3>Registration Successful!</h3>
            <p><strong>Name:</strong> <?= $name ?></p>
            <p><strong>Email:</strong> <?= $email ?></p>
        </div>
    <?php else: ?>
        <form method="POST" action="">
            <label>Name</label>
            <input type="text" name="name" value="<?= htmlspecialchars($name) ?>">

            <label>Email</label>
            <input type="text" name="email" value="<?= htmlspecialchars($email) ?>">

            <label>Password</label>
            <input type="password" name="password">

            <label>Confirm Password</label>
            <input type="password" name="confirm_password">

            <button type="submit">Register</button>
        </form>
    <?php endif; ?>
</div>

</body>
</html>
