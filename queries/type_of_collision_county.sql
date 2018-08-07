/*
There are a few records with type I and J in the TYPE_OF_COLLISION field and these are not in the reference document
*/
select
	(select col_type from collision_type where coded_type = `collision`.`TYPE_OF_COLLISION`) as `Type of Collision`
	, count(*) as `Crashes`
	, sum(`NUMBER_INJURED`) as `Injuries`
	, sum(`COUNT_SEVERE_INJ`) as `Severe Injuries` 
	, sum(`NUMBER_KILLED`) as `Deaths`
from
	`collision`
where
	`CNTY_LOC` = '37'-- San Diego County
group by
	`TYPE_OF_COLLISION`

