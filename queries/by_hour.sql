/*
There are many records that have a collision time of 2500 so the hour will come up as 25.
*/
select
	`COLLISION_HOUR` as `Hour`
	, count(*) as `Crashes`
	, sum(`NUMBER_INJURED`) as `Injuries`
	, sum(`COUNT_SEVERE_INJ`) as `Severe Injuries` 
	, sum(`NUMBER_KILLED`) as `Deaths`
from
	`collision`
where
	`CNTY_CITY_LOC` = '3711' -- San Diego
group by
	`COLLISION_HOUR`
 