<?php
require 'db.php';

$counties = get_county_list();
$cities = get_city_list();
?>
<html lang="en">
<head>
<meta charset="utf-8">
    <title>California Crash Data</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css?family=Merriweather:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Merriweather" rel="stylesheet">
    <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
    <script>
    var cities;
    $(function() {
        cities = <?php echo json_encode( $cities ); ?>;

        $('#cnty_loc').change(function() {
            if ($('#cnty_loc').val() != "") {
                $('#submit').prop('disabled', true);
                
                $("#cnty_city_loc option").each(
                    function() {
                        if ($(this).val() != "0")
                            $(this).remove();
                    }
                );

                cities_filtered = cities.filter(city => city.cnty_loc == $('#cnty_loc').val());

                $.each(cities_filtered, function (index, city) {
                    $('#cnty_city_loc').append($('<option>', { 
                        value: city.cnty_city_loc,
                        text : city.city 
                    }));
                });
                
                $('#submit').prop('disabled', false);
            }
            else {
                $('#submit').prop('disabled', true);
            }
        });
    });
    </script>
</head>
<body>
    <img src="images/logo.png" class="logo">

    <div id="mainbody">
        <h1>California Crash Data: 2013-2017</h1>
        <form action="report.php" method="get">
            <h4>County:</h4>
            <select id="cnty_loc" name="cnty_loc" class="homeselect">
                <option value=""></option>
                <?php foreach ( $counties as $county ): ?>
                <option value="<?php echo $county->cnty_loc; ?>"><?php echo $county->county ?></option>
                <?php endforeach; ?>
            </select>

            <h4>City:</h4>
            <select id="cnty_city_loc" name="cnty_city_loc" class="homeselect">
                <option value="0">ALL</option>
            </select>

            <h4>Report:</h4>
            <select name="report" class="homeselect">
                <option value="overall">Overall Totals</option>
                <option value="by_hour">Total crashes by hour</option>
                <option value="type_of_collision">Type of collision</option>
                <option value="crashes_by_year_and_month">Total Crashes by Year by Month</option>
                <option value="crashes_by_year">Crashes by year</option>
                <option value="alcohol">Alcohol Involved</option>
            </select>

            <br>
            <input id="submit" type="submit" class="submit" disabled>
        </form>
    </div>
</body>
</html>
