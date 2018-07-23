select
	`ALCOHOL_INVOLVED` as `Alcohol Involved`
	, count(*) as `Crashes`
	, sum(`NUMBER_INJURED`) as `Injuries`
	, sum(`COUNT_SEVERE_INJ`) as `Severe Injuries` 
	, sum(`NUMBER_KILLED`) as `Deaths`
from
	collision
where
	cnty_city_loc = '3711' -- San Diego
group by
	`ALCOHOL_INVOLVED`



