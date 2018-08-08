<?php
require 'db.php';

$cnty_loc = $_GET['cnty_loc'];
$cnty_city_loc = $_GET['cnty_city_loc'];

$county = get_county( $cnty_loc );
if ( $cnty_city_loc == "0" ) {
    $city = new stdClass();
    $city->city = "All";
}
else {
    $city = get_city( $cnty_city_loc );
}

$report = $_GET['report'];

switch( $report ) {
    case 'overall':
        $rpt = "Overall Totals";
        $rpt_data = ( $cnty_city_loc == "0" ) ? overall_county( $cnty_loc ) : overall( $cnty_city_loc );
        break;
    case 'by_hour':
        $rpt = "Total crashes by hour";
        $rpt_data = ( $cnty_city_loc == "0" ) ? by_hour_county( $cnty_loc ) : by_hour( $cnty_city_loc );
       break;
    case 'type_of_collision':
        $rpt = "Type of collision";
        $rpt_data = ( $cnty_city_loc == "0" ) ? type_of_collision_county( $cnty_loc ) : type_of_collision( $cnty_city_loc );
        break;
    case 'crashes_by_year_and_month':
        $rpt = "Total Crashes by Year by Month";
        $rpt_data = ( $cnty_city_loc == "0" ) ? crashes_by_year_and_month_county( $cnty_loc ) : crashes_by_year_and_month( $cnty_city_loc );
        break;
    case 'crashes_by_year':
        $rpt = "Crashes by year";
        $rpt_data = ( $cnty_city_loc == "0" ) ? crashes_by_year_monthly( $cnty_loc ) : crashes_by_year( $cnty_city_loc );
        break;
    case 'alcohol':
        $rpt = "Alcohol Involved";
        $rpt_data = ( $cnty_city_loc == "0" ) ? alcohol_involved_monthly( $cnty_loc ) : alcohol_involved( $cnty_city_loc );
        break;
}
?>
<html lang="en">
<head>
<meta charset="utf-8">
    <title><?php echo $rpt ?> for <?php echo $city->city ?> in <?php echo $city->county ?></title>
    <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<a href="/cali-accidents"><img src="images/logo.png" class="logo"></a>
<div id="mainbody>">
<h1><?php echo $city->city ?> in <?php echo $county->county ?></h1>
<h3><?php echo $rpt ?></h3>
<br>
<?php
    $fields = array_keys( get_object_vars( $rpt_data[0] ) );
?>
<table id="myTable" border="1" cellpadding="4" cellspacing="4">
    <thead>
    <tr>
        <?php foreach( $fields as $field ): ?>
        <td>
            <?php echo $field; ?>
        </td>
        <?php endforeach; ?>
    </tr>
    </thead>
    <tbody>
    <?php foreach( $rpt_data as $row ): ?>
    <tr>
        <?php foreach( $fields as $field ): ?>
        <td>
            <?php echo $row->$field; ?>
        </td>
        <?php endforeach; ?>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</div>
<div id="home">
    <a href="/cali-accidents/">Return to home page</a>
</div>
<script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </script>
</body>
</html>
