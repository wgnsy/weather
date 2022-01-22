
<div class="p-3 pe-2 ps-2 d-flex align-items-center w-100" style="min-height:200px;background-image:url('/vendor/weather/img/bg.jpg');background-size:cover;">
<div class="text-white container-fluid h-80 d-flex align-items-center rounded" style="background-color: rgba(255, 255, 255, .15);
  
backdrop-filter: blur(10px);">
  <div class="row">
    <div class="col-md-2 col-12 d-flex align-items-center justify-content-center">
      <div class="text-uppercase text-center" style="font-weight: 300;">
        <img src="{{ asset('vendor\weather\img\\'.$weather['icon'].'.svg') }}" class="w-75"/>
      {{ $weather['weather'] }}
      </div>
    </div>
    <div class="col-md-7 col-12">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12 text-center text-md-start">
              <span class="display-6">{{ $weather['name'] }}</span>
            </div>
            <div class="col-md-4 col-12">
              <div class="display-5">{{ $weather['temp'] }}&#x2103;</div>
            </div>
            <div class="col-md-8 col-12 pe-3" style="font-size:0.8rem">
              {{ __('weather::weather.temp_feel', [], $lang) }}: {{ $weather['temp_feel'] }}&#x2103;<br>
              <hr>
              {{ __('weather::weather.temp_min', [], $lang) }}: {{ $weather['temp_min'] }}&#x2103;<br>
              <hr>
              {{ __('weather::weather.temp_max', [], $lang) }}: {{ $weather['temp_max'] }}&#x2103;<br>
              <hr>
              {{ __('weather::weather.pressure', [], $lang) }}: {{ $weather['pressure'] }} HPa
            </div>
          </div>
        </div>

    </div>
    <div class="col-md-3 col-12 p-3 p-md-0 d-none d-md-block">
      <div class="w-50 h-100 float-start d-flex justify-content-center align-items-center">
        <div class="text-center w-75">
          <img src="{{ asset('vendor/weather/img/humidity.svg') }}" class="w-50"/>
          <br>{{ $weather['humidity'] }} %<br>
          <img src="{{ asset('vendor/weather/img/03d.svg') }}" class="w-50"/><br>
          {{ $weather['clouds'] }} %
        </div>
      </div>
      <div class="h-100 w-50 position-relative float-start d-flex align-items-center justify-content-center">
        @php
            if($weather['temp'] < 0){
              if($weather['temp'] <= -10)$opacity = 1;
              else
              $opacity = abs($weather['temp'])*0.2;

              $norm_opacity = 0.2;
            }else {
              $opacity = 0; 
              $norm_opacity = 1;
            }     
        @endphp
        <img src="{{ asset('vendor\weather\img\thermometer.svg') }}" class="w-50" style="float:left;opacity:{{ $norm_opacity }}"/>
        <img src="{{ asset('vendor\weather\img\thermometer-cold.svg') }}" class="w-50 termometr position-absolute" style="opacity:{{ $opacity }}"/>
      </div>
      
    </div>
  </div>
</div>
</div>

<style>
hr{
  margin:0.1rem !important;
}
</style>

