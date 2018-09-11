create table rptOverall
select
	cc.cnty_loc
	, cc.county
	, cc.cnty_city_loc
	, cc.city
	, count(c.case_id) as `Crashes`
	, coalesce(sum(c.`NUMBER_INJURED`), 0) as `Injuries`
	, coalesce(sum(c.`COUNT_SEVERE_INJ`), 0) as `Severe Injuries` 
	, coalesce(sum(c.`NUMBER_KILLED`), 0) as `Deaths`
	, sum(case c.`PEDESTRIAN_ACCIDENT` when 'Y' then 1 else 0 end) as `Pedestrian Crashes`
	, coalesce(sum(c.`COUNT_PED_INJURED`), 0) as `Pedestrian Injuries` 
	, coalesce(sum(c.`COUNT_PED_KILLED`), 0) as `Pedestrian Deaths` 
	, sum(case c.`BICYCLE_ACCIDENT` when 'Y' then 1 else 0 end) as `Bicycle Crashes`
	, coalesce(sum(c.`COUNT_BICYCLIST_INJURED`), 0) as `Bicycle Injuries` 
	, coalesce(sum(c.`COUNT_BICYCLIST_KILLED`), 0) as `Bicycle Deaths` 
	, sum(case c.`MOTORCYCLE_ACCIDENT` when 'Y' then 1 else 0 end) as `Motorcycle Crashes`
	, coalesce(sum(c.`COUNT_MC_INJURED`), 0) as `Motorcycle Injuries` 
	, coalesce(sum(c.`COUNT_MC_KILLED`), 0) as `Motorcycle Deaths` 
	, sum(case c.`TRUCK_ACCIDENT` when 'Y' then 1 else 0 end) as `Truck Crashes`
	, sum(case c.`TRUCK_ACCIDENT` when 'Y' then c.`NUMBER_INJURED` else 0 end) as `Truck Injuries`
	, sum(case c.`TRUCK_ACCIDENT` when 'Y' then c.`NUMBER_KILLED` else 0 end) as `Truck Deaths`
from
	county_city cc
		left outer join
			collision c
				on
					c.cnty_city_loc = cc.cnty_city_loc
group by
	cc.county
	, cc.city
order by
	cc.county
	, cc.city
