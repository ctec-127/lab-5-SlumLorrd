<?php
// login.php
session_start();
$pageTitle = 'Login';
require 'inc/header.inc.php';
require 'inc/db_connect.inc.php';
?>

<div class="container mt-3">
    <div class="row">
        <div class="col-12 col-md-5">
            <h1>Login</h1>


            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $email = $_POST['email'];
                $password = hash('sha512', $_POST['password']);

                // $sql = "SELECT * FROM user WHERE email='$email' AND password='$password'";
                $sql = "SELECT * FROM user WHERE email=:email AND password=:password";

                $stmt = $db->prepare($sql);
                $stmt->execute(["email" => $email, "password" => $password]);

                if ($stmt->rowCount() == 1) {
                    $_SESSION['loggedin'] = 1;
                    $_SESSION['email'] = $email;
                    $row = $stmt->fetch();
                    $_SESSION['first_name'] = $row->first_name;
                    header('location: home.php');
                } else {
                    echo '<div class="alert alert-warning" role="alert">';
                    echo 'We are sorry but that email and password did not work. Please try again';
                    echo '</div>';
                }
            }
            ?>

            <form action="login.php" method="POST">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <span id="showPassword" onclick="showPassword()">Show Password</span>
                    <input type="password" class="form-control" name="password" id="password" required>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>
            <a href="register.php">Register</a>
        </div> <!-- closing col -->
    </div> <!-- closing row -->
</div> <!-- closing container div -->


<script src="js/script.js"></script>