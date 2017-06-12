[![](https://scdn.rapidapi.com/RapidAPI_banner.png)](https://rapidapi.com/package/Darksky/functions?utm_source=RapidAPIGitHub_DarkskyFunctions&utm_medium=button&utm_content=RapidAPI_GitHub)
# Darksky Package
The Dark Sky Company specializes in weather forecasting and visualization.
* Domain: [https://darksky.net](https://darksky.net)
* Credentials: apiKey

## How to get credentials: 
1. Register and go to [account](https://darksky.net/dev/account)
 

## Custom datatypes: 
 |Datatype|Description|Example
 |--------|-----------|----------
 |Datepicker|String which includes date and time|```2016-05-28 00:00:00```
 |Map|String which includes latitude and longitude coma separated|```50.37, 26.56```
 |List|Simple array|```["123", "sample"]``` 
 |Select|String with predefined values|```sample```
 |Array|Array of objects|```[{"Second name":"123","Age":"12","Photo":"sdf","Draft":"sdfsdf"},{"name":"adi","Second name":"bla","Age":"4","Photo":"asfserwe","Draft":"sdfsdf"}] ```
 
## Darksky.getForecastRequest
A Forecast Request returns the current weather conditions, a minute-by-minute forecast for the next hour (where available), an hour-by-hour forecast for the next 48 hours, and a day-by-day forecast for the next week.

| Field      | Type       | Description
|------------|------------|----------
| apiKey     | credentials| Your Dark Sky secret key. (Your secret key must be kept secret; in particular, do not embed it in JavaScript source code that you transmit to clients.)
| coordinates| Map        | Location
| exclude    | List       | Exclude some number of data blocks from the API response. This is useful for reducing latency and saving cache space. The value blocks should be a comma-delimeted list (without spaces) of any of the following: currently, minutely, hourly, daily, alerts, flags
| hourly     | Boolean    | When present, return hour-by-hour data for the next 168 hours, instead of the next 48.
| units      | Select     | Return weather conditions in the requested units. [units] should be one of the following: auto, ca, uk2, us, si
| lang       | String     | Return summary properties in the desired language. (Note that units in the summary will be set according to the units parameter, so be sure to set both parameters appropriately.). See at https://darksky.net/dev/docs/forecast for details

## Darksky.getTimeMachineRequest
A Time Machine Request returns the observed (in the past) or forecasted (in the future) hour-by-hour weather and daily weather conditions for a particular date.

| Field      | Type       | Description
|------------|------------|----------
| apiKey     | credentials| Your Dark Sky secret key. (Your secret key must be kept secret; in particular, do not embed it in JavaScript source code that you transmit to clients.)
| coordinates| Map        | Location
| time       | DatePicker | A Time Machine Request returns the observed (in the past) or forecasted (in the future) hour-by-hour weather and daily weather conditions for a particular date. Example: `2017-01-01 12:13:15`
| exclude    | List       | Exclude some number of data blocks from the API response. This is useful for reducing latency and saving cache space. Any of the following: currently, minutely, hourly, daily, alerts, flags
| hourly     | Boolean    | When present, return hour-by-hour data for the next 168 hours, instead of the next 48.
| units      | Select     | Return weather conditions in the requested units. [units] should be one of the following: auto, ca, uk2, us, si
| lang       | String     | Return summary properties in the desired language. (Note that units in the summary will be set according to the units parameter, so be sure to set both parameters appropriately.). See at https://darksky.net/dev/docs/forecast for details

