<?php
// home.php
session_start();
$pageTitle = 'Home';
require 'inc/header.inc.php';
?>

<body>
    <?php require 'inc/tempConvert.inc.php'; ?>
    <!-- Form starts here -->
    <div class="container">
        <div class="row text-center">
            <div class="col-12">
                <h1 class="my-4">Temperature Converter</h1>
                <h3 class="my-2">Welcome</h3>
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                    <div class="group">
                        <label class="text-end" for="temp">Temperature</label>
                        <!-- You could have also used a Ternary on the line below -->
                        <input type="text" value="<?php if (isset($_POST['originaltemp'])) {
                                                        echo $_POST['originaltemp'];
                                                    }
                                                    ?>" name="originaltemp" size="14" maxlength="7" id="temp">
                        <!-- 2nd part of making the selects sticky. -->
                        <select name="originalunit">
                            <option value="--Select--">--Select--</option>
                            <option value="celsius" <?php if ($originalUnit == "celsius") echo ' selected="selected"'; ?>>Celsius</option>
                            <option value="fahrenheit" <?php if ($originalUnit == "fahrenheit") echo ' selected="selected"'; ?>>Fahrenheit</option>
                            <option value="kelvin" <?php if ($originalUnit == "kelvin") echo ' selected="selected"'; ?>>Kelvin</option>
                        </select>
                    </div>
                    <div class="group">
                        <label class="text-end" for="convertedtemp">Converted Temperature</label>
                        <input type="text" value="<?php echo $convertedTemp ?>" name="convertedtemp" size="14" maxlength="7" id="convertedtemp" readonly>
                        <!-- 2nd part of making the selects sticky. -->
                        <select name="conversionunit">
                            <option value="--Select--">--Select--</option>
                            <option value="celsius" <?php if ($conversionUnit == "celsius") echo ' selected="selected"'; ?>>Celsius</option>
                            <option value="fahrenheit" <?php if ($conversionUnit == "fahrenheit") echo ' selected="selected"'; ?>>Fahrenheit</option>
                            <option value="kelvin" <?php if ($conversionUnit == "kelvin") echo ' selected="selected"'; ?>>Kelvin</option>
                        </select>
                    </div>
                    <br>
                    <input class="btn btn-primary" type="submit" value="Convert" />
                </form>
                <br>
                <?php
                if (isset($_SESSION['loggedin'])) {
                    echo '<a href="logout.php" id="logout">Logout</a>&nbsp;';
                } else {
                    echo '<a href="login.php" id="login">Login</a>&nbsp;';
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>