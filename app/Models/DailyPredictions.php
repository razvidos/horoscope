<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
            if ($daily_predictions->count() === 0) {
                $used_prediction_id = [0];
            } else {
                $used_prediction_id = $daily_predictions->map(function($item) {
                    return $item['prediction_id'];
                });
            }

            $prediction = DB::table('predictions')
                ->select('predictions.*')
                ->leftJoin('daily_predictions', 'predictions.id', '=', 'daily_predictions.prediction_id', 'left outer')
                ->whereNotIn('predictions.id', $used_prediction_id)
                ->where(function($query) use ($horoscope_id) {
                    $query->where('daily_predictions.horoscope_id', '!=', $horoscope_id)
                        ->orWhereNull('daily_predictions.horoscope_id');
                })
                ->groupBy('predictions.id')
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
