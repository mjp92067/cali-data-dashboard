/*
Where do I get Truck Injuries and Truck Deaths?
*/
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
--	, Truck Injuries
--	, Truck Deaths
from
	collision
where
	cnty_city_loc = '3711' -- San Diego
