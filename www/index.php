<?php
require 'db.php';

$cities = city_list();
?>
<html lang="en">
<head>
<meta charset="utf-8">
    <title>Cali Accident 2013-2017 Reports</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css?family=Merriweather:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Merriweather" rel="stylesheet">
</head>
<body>
    <h1>California Crash Data: 2013-2017</h1>
    <form action="report.php" method="get">
        <h3>City:</h3>
                
                    <select name="cnty_city_loc">
                        <?php foreach ( $cities as $city ): ?>
                        <option value="<?php echo $city->cnty_city_loc; ?>"><?php echo $city->city; ?></option>
                        <?php endforeach; ?>
                    </select>
        <h3>Report:</h3>
                
                    <select name="report">
                        <option value="overall">Overall Totals</option>
                        <option value="by_hour">Total crashes by hour</option>
                        <option value="type_of_collision">Type of collision</option>
                        <option value="crashes_by_year_and_month">Total Crashes by Year by Month</option>
                        <option value="crashes_by_year">Crashes by year</option>
                        <option value="alcohol">Alcohol Involved</option>
                    </select>
                <br>
                    <input type="submit" class="submit">
                
    </form>
</body>
</html>
