select
	`ALCOHOL_INVOLVED` as `Alcohol Involved`
	, count(*) as `Crashes`
	, sum(`NUMBER_INJURED`) as `Injuries`
	, sum(`COUNT_SEVERE_INJ`) as `Severe Injuries` 
	, sum(`NUMBER_KILLED`) as `Deaths`
from
	collision
where
	cnty_loc = '37'-- San Diego County
group by
	`ALCOHOL_INVOLVED`
