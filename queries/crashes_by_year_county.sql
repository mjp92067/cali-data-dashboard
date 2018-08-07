select
	`ACCIDENT_YEAR` as `Year`
	, count(*) as `Crashes`
	, sum(`NUMBER_INJURED`) as `Injuries`
	, sum(`COUNT_SEVERE_INJ`) as `Severe Injuries` 
	, sum(`NUMBER_KILLED`) as `Deaths`
from
	collision
where
	`CNTY_LOC` = '37'-- San Diego County
group by
	`ACCIDENT_YEAR`
order by
	`ACCIDENT_YEAR`
