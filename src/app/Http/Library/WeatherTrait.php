<?php

namespace Prrwebcreate\Weather\app\Http\Library;
use DateTime;
use Illuminate\Support\Facades\Http;
use Prrwebcreate\Weather\app\Models\Weather;
use Carbon\Carbon;

trait WeatherTrait {
    public function getWeather($city,$lang){
        if(count(Weather::where('name',$city)->get()) > 0){
            $updated_at = Weather::where('name',$city)->first()->updated_at;
            $todayDate = Carbon::now();//->format('Y-m-d H:i:m');
            $diff_in_hours = $todayDate->diffInHours($updated_at);
            if($diff_in_hours >= config('weather.reload_interval')){
                Weather::where('name',$city)->first()->update($this->getWeatherDetails($city,$lang));
            }
            
        }else{
            $output = $this->getWeatherDetails($city,$lang);
            Weather::create($output);
        }
       $weather = Weather::where('name',$city)->first();
       return $weather;
    }
    public function getWeatherDetails($city,$lang){
        define('BASE_URL', 'https://api.openweathermap.org/data/2.5/weather?q='.$city.'&lang='.$lang.'&appid='.config('weather.api_key'));
        $response = Http::get(BASE_URL);
        $array = $response->json();

            $tsunrise = $array['sys']['sunrise'];
            $tsunset = $array['sys']['sunset'];
            $name = $array['name'];
            $weather = $array['weather'][0];
            $temp = intval($array['main']['temp']-273.15);
            $temp_min = intval($array['main']['temp_min']-273.15);
            $temp_max = intval($array['main']['temp_max']-273.15);
            $temp_feel = intval($array['main']['feels_like']-273.15);
            $pressure = $array['main']['pressure'];
            $humidity = $array['main']['humidity'];
            $clouds = $array['clouds']['all'];

            $sunrise = new DateTime('@' . $tsunrise);
            $sunrise->setTimezone(new \DateTimeZone('Europe/Warsaw'));
            $sunrise = $sunrise->format('Y-m-d H:i:s');

            $sunset = new DateTime('@' . $tsunset);
            $sunset->setTimezone(new \DateTimeZone('Europe/Warsaw'));
            $sunset = $sunset->format('Y-m-d H:i:s');
            $output = [
            'sunrise'   =>  $sunrise,
            'sunset'    =>  $sunset,
            'weather'   =>  $weather['description'],
            'icon'      =>  $weather['icon'],
            'temp'      =>  $temp,
            'temp_min'  =>  $temp_min,
            'temp_max'  =>  $temp_max,
            'temp_feel' =>  $temp_feel,
            'pressure'  =>  $pressure,
            'humidity'  =>  $humidity,
            'clouds'    =>  $clouds,
            'name'      =>  $name
            ];
            return $output;
    }
}