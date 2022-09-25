<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyPredictions extends Model
{
    use HasFactory;

    const data_format = 'Y-m-d';
//    protected $fillable = [
//        'horoscope_id',
//        'prediction_id',
//        'Data',
//    ];
    protected $guarded = [];

    public function prediction() {
        return $this->belongsTo(Prediction::class);
    }

    public static function get_link_prediction(int $datetime, int $horoscope_id) {
        $date = date(self::data_format, $datetime);

        $daily_predictions = DailyPredictions::where('Date', $date)->get();
        $daily_prediction = $daily_predictions->firstWhere('horoscope_id', $horoscope_id);

        if (is_null($daily_prediction)) {
            $used_prediction_id = $daily_predictions->map(function($item) {
                return $item['prediction_id'];
            });
            $prediction = Prediction::whereNotIn('id', $used_prediction_id)
                ->inRandomOrder()
                ->first();

            $daily_prediction = DailyPredictions::create([
                'horoscope_id' => $horoscope_id,
                'prediction_id' => $prediction->id,
                'Date' => $date,
            ]);
        }
        return $daily_prediction;
    }
}
