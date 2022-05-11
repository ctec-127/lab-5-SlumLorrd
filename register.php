<?php
// register.php
$pageTitle = "Register";
require 'inc/header.inc.php';
require 'inc/db_connect.inc.php';
?>

<div class="container mt-3">
    <div class="row">
        <div class="col-12 col-md-5">
            <h1>Register</h1>

            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $email = $_POST['email'];
                $first_name = $_POST['first_name'];
                $last_name = $_POST['last_name'];
                $password = hash('sha512', $_POST['password']);

                $sql = "INSERT INTO user (email,first_name,last_name,password) ";
                $sql .= "VALUES (:email,:first_name,:last_name,:password)";

                $stmt = $db->prepare($sql);
                $stmt->execute(["email" => $email, "first_name" => $first_name, "last_name" => $last_name, "password" => $password]);

                if ($stmt->rowCount() == 0) {
                    //echo '<div>There was a problem registering your account</div>';
                    echo '<div class="alert alert-warning" role="alert">';
                    echo 'We are sorry but something did not work. Please try and register again.';
                    echo '</div>';
                } else {
                    header("Location: login.php");
                }
            }
            ?>


            <form action="register.php" method="POST">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="mb-3">
                    <label for="first_name" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" required>
                </div>
                <div class="mb-3">
                    <label for="last_name" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" required>
                </div>
                <button type="submit" class="btn btn-primary">Register</button>
            </form>
            <br>
            <a href="login.php">Login</a>
        </div> <!-- closing col -->
    </div> <!-- closing row -->
</div> <!-- closing container div -->