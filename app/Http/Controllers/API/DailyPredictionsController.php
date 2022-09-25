<?php


namespace App\Http\Controllers\API;


use App\Models\DailyPredictions;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DailyPredictionsController
{
    public function getDailyPrediction(Request $request) {
//        dd(123);
        $validated = $request->validate([
            'date' => 'date_format:Y-m-d',
            'horoscope_id' => 'exists:horoscopes,id',
        ]);

        $daily_prediction = DailyPredictions::get_link_prediction(strtotime($validated['date']), $validated['horoscope_id']);

        return new JsonResponse(['prediction_text' => $daily_prediction->prediction->text]);
    }
}
