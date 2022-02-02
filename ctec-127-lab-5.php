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

    <?php
    // function to calculate converted temperature
    function convertTemp($temp, $unit1, $unit2)
    {
        // conversion formulas
        // Celsius to Fahrenheit = T(°C) × 9/5 + 32
        // Celsius to Kelvin = T(°C) + 273.15
        // Fahrenheit to Celsius = (T(°F) - 32) × 5/9
        // Fahrenheit to Kelvin = (T(°F) + 459.67)× 5/9
        // Kelvin to Fahrenheit = T(K) × 9/5 - 459.67
        // Kelvin to Celsius = T(K) - 273.15
        // You need to develop the logic to convert the temperature based on the selections and input made

        // Decision logic to convert the temperature using formulas. I also used the parameters
        // we set in the function above in this logic.
        if ($temp == null) {
            $convertedTemp = null;
        } else if ($unit1 == "celsius" and $unit2 == "fahrenheit") {
            $convertedTemp = $temp * 9 / 5 + 32;
        } else if ($unit1 == "celsius" and $unit2 == "kelvin") {
            $convertedTemp = $temp + 273.15;
        } else if ($unit1 == "celsius" and $unit2 == "celsius") {
            $convertedTemp = $temp;
        } else if ($unit1 == "fahrenheit" and $unit2 == "celsius") {
            $convertedTemp = 5 / 9 * ($temp - 32);
        } else if ($unit1 == "fahrenheit" and $unit2 == "kelvin") {
            $convertedTemp = 5 / 9 * ($temp + 459.67);
        } else if ($unit1 == "fahrenheit" and $unit2 == "fahrenheit") {
            $convertedTemp = $temp;
        } else if ($unit1 == "kelvin" and $unit2 == "fahrenheit") {
            $convertedTemp = $temp * 9 / 5 - 459.67;
        } else if ($unit1 == "kelvin" and $unit2 == "celsius") {
            $convertedTemp = $temp - 273.15;
        } else if ($unit1 == "kelvin" and $unit2 == "kelvin") {
            $convertedTemp = $temp;
        }

        return $convertedTemp;
    } // end function

    // Logic to check for POST and grab data from $_POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Store the original temp and units in variables
        // You can then use these variables to help you make the form sticky
        // then call the convertTemp() function
        // Once you have the converted temperature you can place PHP within the converttemp field using PHP
        // I coded the sticky code for the originaltemp field for you

        $originalTemperature = $_POST['originaltemp'];
        $originalUnit = $_POST['originalunit'];
        $conversionUnit = $_POST['conversionunit'];
        $convertedTemp = convertTemp($originalTemperature, $originalUnit, $conversionUnit);

        // Created an empty error bucket to fill if fields are left blank
        $error_bucket = [];
        // Decision logic to let the user know they have to fill in the fields.
        if (!empty($originalTemperature)) {
        } else {
            array_push($error_bucket, "Please add a temperature to be converted.");
        }
        if ($originalUnit != "--Select--") {
        } else {
            array_push($error_bucket, "Please select a temperature scale to be converted.");
        }
        if ($conversionUnit != "--Select--") {
        } else {
            array_push($error_bucket, "Please select the desired temperature scale to be converted to.");
        }
        // created a for loop to display errors if there are any.
        if (count($error_bucket) > 0) {
            echo "<p><em>* These fields must be filled in.</em></p>";
            echo "<ul>";
            for ($i = 0; $i < count($error_bucket); $i++) {
                echo "<li>" . $error_bucket[$i] . "</li>";
            }
            echo "</ul>";
        }
    } // end if

    // Making the selects sticky
    if (isset($_POST['originalunit'])) {
        $originalUnit = $_POST['originalunit'];
    } else {
        $originalUnit = '';
    }
    if (isset($_POST['conversionunit'])) {
        $conversionUnit = $_POST['conversionunit'];
    } else {
        $conversionUnit = '';
    }
    ?>
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