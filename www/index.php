<?php
require 'db.php';

$cities = city_list();
?>
<html lang="en">
<head>
<meta charset="utf-8">
    <title>Cali Accident 2013-2017 Reports</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <form action="report.php" method="get">
        <table>
            <tr>
                <td>
                    City:
                </td>
                <td>
                    <select name="cnty_city_loc">
                        <?php foreach ( $cities as $city ): ?>
                        <option value="<?php echo $city->cnty_city_loc; ?>"><?php echo $city->city; ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    Report:
                </td>
                <td>
                    <select name="report">
                        <option value="overall">Overall Totals</option>
                        <option value="by_hour">Total crashes by hour</option>
                        <option value="type_of_collision">Type of collision</option>
                        <option value="crashes_by_year_and_month">Total Crashes by Year by Month</option>
                        <option value="crashes_by_year">Crashes by year</option>
                        <option value="alcohol">Alcohol Involved</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    &nbsp;
                </td>
                <td>
                    <input type="submit">
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
