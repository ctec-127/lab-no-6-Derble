<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Lab No. 6 - Temp. Converter</title>
</head>

<body>

    <?php
    // function to calculate converted temperature
    function convertTemp($temp, $unit1, $unit2)
    {
        // conversion formulas
      
        $newTemp = "";

        if ($unit1 == "celsius" && $unit2 == "fahrenheit") {
            // Celsius to Fahrenheit = T(°C) × 9/5 + 32
            $newTemp .= ($temp * (9/5) + 32);
            return $newTemp;
        } else if ($unit1 == "celsius" && $unit2 == "kelvin") {
            // Celsius to Kelvin = T(°C) + 273.15
            $newTemp .= ($temp + 273.15);
            return $newTemp;
        } else if ($unit1 == "fahrenheit" && $unit2 == "celsius") {
            // Fahrenheit to Celsius = (T(°F) - 32) × 5/9
            $newTemp .= (($temp - 32) * (5/9));
            return $newTemp;
        } else if ($unit1 == "fahrenheit" && $unit2 == "kelvin") {
            // Fahrenheit to Kelvin = (T(°F) + 459.67)× 5/9
            $newTemp .= (($temp + 459.67) * (5/9));
            return $newTemp;
        } else if ($unit1 == "kelvin" && $unit2 == "fahrenheit") {
            // Kelvin to Fahrenheit = T(K) × 9/5 - 459.67
            $newTemp .= ($temp * (9/5) - 459.67);
            return $newTemp;
        } else if ($unit1 == "kelvin" && $unit2 == "celsius") {
            // Kelvin to Celsius = T(K) - 273.15
            $newTemp .= ($temp - 273.15);
            return $newTemp;
        } else if ($unit1 == "kelvin" && $unit2 == "kelvin" || $unit1 == "celsius" && $unit2 == "celsius" || $unit1 == "fahrenheit" && $unit2 == "fahrenheit") {
            $newTemp .= $temp;
            return $newTemp;
        }
    
        // You need to develop the logic to convert the temperature based on the selections and input made
        // logic added above

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
        //$convertedTemp = convertTemp($originalTemperature, $originalUnit, $conversionUnit);

        if (is_numeric($_POST['originaltemp']) && $originalUnit != "--Select--" && $conversionUnit != "--Select--") {
            $convertedTemp = convertTemp($originalTemperature, $originalUnit, $conversionUnit);
            //$newtemp is returned and stored in $convertedTemp
        } else {
            echo "<p style='color:red;'><strong>Unfortunately, we didn't receive all the info we needed. Please enter the original numeric temperature, original temperature unit, and the temperature unit that you would like to convert to.</strong></p>";
        }//sorry for the inline CSS. I tried to add it to the style sheet but couldn't get it to work for some reason. I'll continue to look at what I was doing wrong.

    } // end if
    
    ?>
    <!-- Form starts here -->
    <h1>Temperature Converter</h1>
    <h4>CTEC 127 - PHP with SQL 1</h4>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
        <div class="group">
            <label for="temp">Temperature</label>
            <input type="text" value="<?php if (isset($_POST['originaltemp'])) {
                                            echo $_POST['originaltemp'];
                                        }
                                        ?>" name="originaltemp" size="14" maxlength="7" id="temp">

            <select name="originalunit">
                <option value="--Select--">--Select--</option>
                <option value="celsius" <?php if(isset($originalUnit) && $originalUnit == "celsius") echo " selected='selected'"; ?>>Celsius</option>
                <option value="fahrenheit" <?= isset($originalUnit) && $originalUnit == "fahrenheit" ? " selected='selected'" : NULL;?>>Fahrenheit</option>
                <option value="kelvin" <?= isset($originalUnit) && $originalUnit == "kelvin" ? " selected='selected'" : NULL;?>>Kelvin</option>
            </select>
        </div>

        <div class="group">
            <label for="convertedtemp">Converted Temperature</label>
            <input type="text" value="<?php if (isset($convertedTemp)) {
                                            echo $convertedTemp;
                                        } 
                                        ?>" name="convertedtemp" size="14" maxlength="7" id="convertedtemp" readonly>

            <select name="conversionunit">
                <option value="--Select--">--Select--</option>
                <option value="celsius" <?= isset($conversionUnit) && $conversionUnit == "celsius" ? " selected='selected'" : NULL;?>>Celsius</option>
                <option value="fahrenheit" <?= isset($conversionUnit) && $conversionUnit == "fahrenheit" ? " selected='selected'" : NULL;?>>Fahrenheit</option>
                <option value="kelvin" <?= isset($conversionUnit) && $conversionUnit == "kelvin" ? " selected='selected'" : NULL;?>>Kelvin</option>
            </select>
        </div>
        <input type="submit" value="Convert" />
    </form>

</body>

</html>