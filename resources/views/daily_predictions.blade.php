@extends('layers.html')

@section('title', 'Daily Predictions')

@section('main-content')
<div class="container py-2">
    <form action="">
        <label for="date">Date</label>
        <input name="date" id="date" type="date" value="{{ $date }}">
        @error('date')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <input type="submit">
    </form>
</div>

<div class="circle">
@foreach($horoscopes as $horoscope)
    <div class="circle_div" data-id="{{ $horoscope->id }}">
        <img height="50" src="{{ asset("img/" . $horoscope->title) . ".png" }}" alt="">
        {{$horoscope->title}}
        <div class="prediction hidden">

        @if($daily_predictions->firstWhere('horoscope_id', $horoscope->id))
            {{ $daily_predictions->firstWhere('horoscope_id', $horoscope->id)
                ->prediction->text }}
        @endif
        </div>
    </div>
@endforeach
</div>
@endsection
