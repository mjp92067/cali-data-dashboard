<?php
function mysqli_get_obj() {
    $mysqli = new mysqli(
        '127.0.0.1',
        'cali-accidents',
        'WreckItRalph2018',
        'cali-accidents-2013-2017'
    );
    
    return $mysqli;
}

/*
Revisit these county/city methods as we are changing the selector from just city to county,
then filtered city so some of these functions are going to be deprecated.

I'm not going to pretend to care too much b/c I'm hoping to build a better mouse trap and delete
this whole project at some point

robh71 AKA "The wise one"
*/
function city_list() {
    $mysqli = mysqli_get_obj();

    $query = "select cnty_city_loc, concat(county, ' ', city) as city from county_city";

    $result = $mysqli->query( $query );

    $obj_array = array();

    while ( $obj = $result->fetch_object() ) {
        $obj_array[] = $obj;
    }

    $mysqli->close();

    return $obj_array;
}

function get_city( $cnty_city_loc ) {
    $mysqli = mysqli_get_obj();

    $query = "select * from county_city where cnty_city_loc = '$cnty_city_loc'";

    $result = $mysqli->query( $query );

    $obj_array = array();

    $obj = $result->fetch_object();

    $mysqli->close();

    return $obj;    
}

function county_list() {
    $mysqli = mysqli_get_obj();

    $query = "select cnty_loc, county from county_city group by cnty_loc, county order by county";

    $result = $mysqli->query( $query );

    $obj_array = array();

    while ( $obj = $result->fetch_object() ) {
        $obj_array[] = $obj;
    }

    $mysqli->close();

    return $obj_array;
}



/* county and city methods above this are prob not used. TODO AUDIT -- robh71 */
function get_county( $cnty_loc ) {
    $mysqli = mysqli_get_obj();

    $query = "select cnty_loc, county from county_city where cnty_loc = '$cnty_loc' limit 1";

    $result = $mysqli->query( $query );

    $obj_array = array();

    $obj = $result->fetch_object();

    $mysqli->close();

    return $obj;    
}

function get_county_list() {
    $mysqli = mysqli_get_obj();

    $query = 'select cnty_loc, county from county_city group by county order by county';

    $result = $mysqli->query( $query );

    $obj_array = array();

    while ( $obj = $result->fetch_object() ) {
        $obj_array[] = $obj;
    }

    $mysqli->close();

    return $obj_array;    
}

function get_city_list() {
    /* This method include the cnty_loc for filtering purposes on the client side */
    $mysqli = mysqli_get_obj();

    $query = 'select cnty_city_loc, city, cnty_loc from county_city order by city';

    $result = $mysqli->query( $query );

    $obj_array = array();

    while ( $obj = $result->fetch_object() ) {
        $obj_array[] = $obj;
    }

    $mysqli->close();

    return $obj_array;    
}

function alcohol_involved( $cnty_city_loc ) {
    $mysqli = mysqli_get_obj();

    $query = <<<EOT
        select
	        `ALCOHOL_INVOLVED` as `Alcohol Involved`
            , count(*) as `Crashes`
            , sum(`NUMBER_INJURED`) as `Injuries`
            , sum(`COUNT_SEVERE_INJ`) as `Severe Injuries` 
            , sum(`NUMBER_KILLED`) as `Deaths`
        from
            collision
        where
            cnty_city_loc = '$cnty_city_loc'
        group by
            `ALCOHOL_INVOLVED`
EOT;

    $result = $mysqli->query( $query );

    $obj_array = array();

    while ( $obj = $result->fetch_object() ) {
        $obj_array[] = $obj;
    }

    $mysqli->close();

    return $obj_array;
}

function alcohol_involved_county( $cnty_loc ) {
    $mysqli = mysqli_get_obj();

    $query = <<<EOT
        select
	        `ALCOHOL_INVOLVED` as `Alcohol Involved`
            , count(*) as `Crashes`
            , sum(`NUMBER_INJURED`) as `Injuries`
            , sum(`COUNT_SEVERE_INJ`) as `Severe Injuries` 
            , sum(`NUMBER_KILLED`) as `Deaths`
        from
            collision
        where
        cnty_loc = '$cnty_loc'
        group by
            `ALCOHOL_INVOLVED`
EOT;

    $result = $mysqli->query( $query );

    $obj_array = array();

    while ( $obj = $result->fetch_object() ) {
        $obj_array[] = $obj;
    }

    $mysqli->close();

    return $obj_array;
}

function by_hour( $cnty_city_loc ) {
    $mysqli = mysqli_get_obj();

    $query = <<<EOT
        select
            `COLLISION_HOUR` as `Hour`
            , count(*) as `Crashes`
            , sum(`NUMBER_INJURED`) as `Injuries`
            , sum(`COUNT_SEVERE_INJ`) as `Severe Injuries` 
            , sum(`NUMBER_KILLED`) as `Deaths`
        from
            `collision`
        where
            `CNTY_CITY_LOC` = '$cnty_city_loc'
        group by
            `COLLISION_HOUR`
EOT;

    $result = $mysqli->query( $query );

    $obj_array = array();

    while ( $obj = $result->fetch_object() ) {
        $obj_array[] = $obj;
    }

    $mysqli->close();

    return $obj_array;
}

function by_hour_county( $cnty_loc ) {
    $mysqli = mysqli_get_obj();

    $query = <<<EOT
        select
            `COLLISION_HOUR` as `Hour`
            , count(*) as `Crashes`
            , sum(`NUMBER_INJURED`) as `Injuries`
            , sum(`COUNT_SEVERE_INJ`) as `Severe Injuries` 
            , sum(`NUMBER_KILLED`) as `Deaths`
        from
            `collision`
        where
            `CNTY_LOC` = '$cnty_loc'
        group by
            `COLLISION_HOUR`
EOT;

    $result = $mysqli->query( $query );

    $obj_array = array();

    while ( $obj = $result->fetch_object() ) {
        $obj_array[] = $obj;
    }

    $mysqli->close();

    return $obj_array;
}

function crashes_by_year( $cnty_city_loc ) {
    $mysqli = mysqli_get_obj();

    $query = <<<EOT
        select
            `ACCIDENT_YEAR` as `Year`
            , count(*) as `Crashes`
            , sum(`NUMBER_INJURED`) as `Injuries`
            , sum(`COUNT_SEVERE_INJ`) as `Severe Injuries` 
            , sum(`NUMBER_KILLED`) as `Deaths`
        from
            collision
        where
            `CNTY_CITY_LOC` = '$cnty_city_loc'
        group by
            `ACCIDENT_YEAR`
        order by
            `ACCIDENT_YEAR`
EOT;

    $result = $mysqli->query( $query );

    $obj_array = array();

    while ( $obj = $result->fetch_object() ) {
        $obj_array[] = $obj;
    }

    $mysqli->close();

    return $obj_array;
}

function crashes_by_year_county( $cnty_loc ) {
    $mysqli = mysqli_get_obj();

    $query = <<<EOT
        select
            `ACCIDENT_YEAR` as `Year`
            , count(*) as `Crashes`
            , sum(`NUMBER_INJURED`) as `Injuries`
            , sum(`COUNT_SEVERE_INJ`) as `Severe Injuries` 
            , sum(`NUMBER_KILLED`) as `Deaths`
        from
            collision
        where
            `CNTY_LOC` = '$cnty_loc'
        group by
            `ACCIDENT_YEAR`
        order by
            `ACCIDENT_YEAR`
EOT;

    $result = $mysqli->query( $query );

    $obj_array = array();

    while ( $obj = $result->fetch_object() ) {
        $obj_array[] = $obj;
    }

    $mysqli->close();

    return $obj_array;
}

function crashes_by_year_and_month( $cnty_city_loc ) {
    $mysqli = mysqli_get_obj();

    $query = <<<EOT
        select
            `ACCIDENT_YEAR` as `Year`
            , `COLLISION_MONTH_NAME` as `Month`
            , count(*) as `Crashes`
            , sum(`NUMBER_INJURED`) as `Injuries`
            , sum(`COUNT_SEVERE_INJ`) as `Severe Injuries` 
            , sum(`NUMBER_KILLED`) as `Deaths`
        from
            collision
        where
            `CNTY_CITY_LOC` = '$cnty_city_loc'
        group by
            `ACCIDENT_YEAR`
            , `COLLISION_MONTH_NAME`
        order by
            `ACCIDENT_YEAR`
            , `COLLISION_MONTH_NAME`
EOT;

    $result = $mysqli->query( $query );

    $obj_array = array();

    while ( $obj = $result->fetch_object() ) {
        $obj_array[] = $obj;
    }

    $mysqli->close();

    return $obj_array;
}

function crashes_by_year_and_month_county( $cnty_loc ) {
    $mysqli = mysqli_get_obj();

    $query = <<<EOT
        select
            `ACCIDENT_YEAR` as `Year`
            , `COLLISION_MONTH_NAME` as `Month`
            , count(*) as `Crashes`
            , sum(`NUMBER_INJURED`) as `Injuries`
            , sum(`COUNT_SEVERE_INJ`) as `Severe Injuries` 
            , sum(`NUMBER_KILLED`) as `Deaths`
        from
            collision
        where
            `CNTY_LOC` = '$cnty_loc'
        group by
            `ACCIDENT_YEAR`
            , `COLLISION_MONTH_NAME`
        order by
            `ACCIDENT_YEAR`
            , `COLLISION_MONTH_NAME`
EOT;

    $result = $mysqli->query( $query );

    $obj_array = array();

    while ( $obj = $result->fetch_object() ) {
        $obj_array[] = $obj;
    }

    $mysqli->close();

    return $obj_array;
}

function overall( $cnty_city_loc ) {
    $mysqli = mysqli_get_obj();

    $query = <<<EOT
        select
            count(*) as `Crashes`
            , sum(`NUMBER_INJURED`) as `Injuries`
            , sum(`COUNT_SEVERE_INJ`) as `Severe Injuries` 
            , sum(`NUMBER_KILLED`) as `Deaths`
            , sum(case `PEDESTRIAN_ACCIDENT` when 'Y' then 1 else 0 end) as `Pedestrian Crashes`
            , sum(`COUNT_PED_INJURED`) as `Pedestrian Injuries` 
            , sum(`COUNT_PED_KILLED`) as `Pedestrian Deaths` 
            , sum(case `BICYCLE_ACCIDENT` when 'Y' then 1 else 0 end) as `Bicycle Crashes`
            , sum(`COUNT_BICYCLIST_INJURED`) as `Bicycle Injuries` 
            , sum(`COUNT_BICYCLIST_KILLED`) as `Bicycle Deaths` 
            , sum(case `MOTORCYCLE_ACCIDENT` when 'Y' then 1 else 0 end) as `Motorcycle Crashes`
            , sum(`COUNT_MC_INJURED`) as `Motorcycle Injuries` 
            , sum(`COUNT_MC_KILLED`) as `Motorcycle Deaths` 
            , sum(case `TRUCK_ACCIDENT` when 'Y' then 1 else 0 end) as `Truck Crashes`
            , sum(case `TRUCK_ACCIDENT` when 'Y' then `NUMBER_INJURED` else 0 end) as `Truck Injuries`
            , sum(case `TRUCK_ACCIDENT` when 'Y' then `NUMBER_KILLED` else 0 end) as `Truck Deaths`
                from
            collision
        where
            `CNTY_CITY_LOC` = '$cnty_city_loc'
EOT;

    $result = $mysqli->query( $query );

    $obj_array = array();

    while ( $obj = $result->fetch_object() ) {
        $obj_array[] = $obj;
    }

    $mysqli->close();

    return $obj_array;
}

function overall_county( $cnty_loc ) {
    $mysqli = mysqli_get_obj();

    $query = <<<EOT
        select
            count(*) as `Crashes`
            , sum(`NUMBER_INJURED`) as `Injuries`
            , sum(`COUNT_SEVERE_INJ`) as `Severe Injuries` 
            , sum(`NUMBER_KILLED`) as `Deaths`
            , sum(case `PEDESTRIAN_ACCIDENT` when 'Y' then 1 else 0 end) as `Pedestrian Crashes`
            , sum(`COUNT_PED_INJURED`) as `Pedestrian Injuries` 
            , sum(`COUNT_PED_KILLED`) as `Pedestrian Deaths` 
            , sum(case `BICYCLE_ACCIDENT` when 'Y' then 1 else 0 end) as `Bicycle Crashes`
            , sum(`COUNT_BICYCLIST_INJURED`) as `Bicycle Injuries` 
            , sum(`COUNT_BICYCLIST_KILLED`) as `Bicycle Deaths` 
            , sum(case `MOTORCYCLE_ACCIDENT` when 'Y' then 1 else 0 end) as `Motorcycle Crashes`
            , sum(`COUNT_MC_INJURED`) as `Motorcycle Injuries` 
            , sum(`COUNT_MC_KILLED`) as `Motorcycle Deaths` 
            , sum(case `TRUCK_ACCIDENT` when 'Y' then 1 else 0 end) as `Truck Crashes`
            , sum(case `TRUCK_ACCIDENT` when 'Y' then `NUMBER_INJURED` else 0 end) as `Truck Injuries`
            , sum(case `TRUCK_ACCIDENT` when 'Y' then `NUMBER_KILLED` else 0 end) as `Truck Deaths`
                from
            collision
        where
            `CNTY_LOC` = '$cnty_loc'
EOT;

    $result = $mysqli->query( $query );

    $obj_array = array();

    while ( $obj = $result->fetch_object() ) {
        $obj_array[] = $obj;
    }

    $mysqli->close();

    return $obj_array;
}

function type_of_collision( $cnty_city_loc ) {
    $mysqli = mysqli_get_obj();

    $query = <<<EOT
        select
            (select col_type from collision_type where coded_type = `collision`.`TYPE_OF_COLLISION`) as `Type of Collision`
            , count(*) as `Crashes`
            , sum(`NUMBER_INJURED`) as `Injuries`
            , sum(`COUNT_SEVERE_INJ`) as `Severe Injuries` 
            , sum(`NUMBER_KILLED`) as `Deaths`
        from
            `collision`
        where
            `CNTY_CITY_LOC` = '$cnty_city_loc'
        group by
            `TYPE_OF_COLLISION`
EOT;

    $result = $mysqli->query( $query );

    $obj_array = array();

    while ( $obj = $result->fetch_object() ) {
        $obj_array[] = $obj;
    }

    $mysqli->close();

    return $obj_array;
}

function type_of_collision_county( $cnty_loc ) {
    $mysqli = mysqli_get_obj();

    $query = <<<EOT
        select
            (select col_type from collision_type where coded_type = `collision`.`TYPE_OF_COLLISION`) as `Type of Collision`
            , count(*) as `Crashes`
            , sum(`NUMBER_INJURED`) as `Injuries`
            , sum(`COUNT_SEVERE_INJ`) as `Severe Injuries` 
            , sum(`NUMBER_KILLED`) as `Deaths`
        from
            `collision`
        where
            `CNTY_LOC` = '$cnty_loc'
        group by
            `TYPE_OF_COLLISION`
EOT;

    $result = $mysqli->query( $query );

    $obj_array = array();

    while ( $obj = $result->fetch_object() ) {
        $obj_array[] = $obj;
    }

    $mysqli->close();

    return $obj_array;
}
