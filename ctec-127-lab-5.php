<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Lab No. 5 - Temp. Converter</title>
</head>

<body>
    <?php require 'inc/tempConvert.inc.php'; ?>
    <!-- Form starts here -->
    <h1>Temperature Converter</h1>
    <h4>CTEC 127 - PHP with SQL 1</h4>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
        <div class="group">
            <label for="temp">Temperature</label>
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
            <label for="convertedtemp">Converted Temperature</label>
            <input type="text" value="<?php echo $convertedTemp ?>" name="convertedtemp" size="14" maxlength="7" id="convertedtemp" readonly>
            <!-- 2nd part of making the selects sticky. -->
            <select name="conversionunit">
                <option value="--Select--">--Select--</option>
                <option value="celsius" <?php if ($conversionUnit == "celsius") echo ' selected="selected"'; ?>>Celsius</option>
                <option value="fahrenheit" <?php if ($conversionUnit == "fahrenheit") echo ' selected="selected"'; ?>>Fahrenheit</option>
                <option value="kelvin" <?php if ($conversionUnit == "kelvin") echo ' selected="selected"'; ?>>Kelvin</option>
            </select>
        </div>
        <input type="submit" value="Convert" />
    </form>
</body>

</html>