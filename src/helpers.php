<?php

use Illuminate\Support\Facades\Http;


if(! function_exists('weather_view')){
	function weather_view($view)
	{
			$defaultTheme = 'weather::';
				$theme = config('view_namespace');
			if(is_null($theme)){
				$theme = $defaultTheme;
			}
			$returnView = $theme.$view;
				if(!view()->exists($returnView)){
					$returnView = $defaultTheme.$view;
				}
			return $returnView;
				
	}
}
if (! function_exists('renderWeather')) {

    function renderWeather($city,$lang)
    {
            $array = \Weather::getWeather($city,$lang);
            $view = view(weather_view('widget'))->with('weather',$array)->with('lang',$lang)->render();
			return $view;
    }
}
