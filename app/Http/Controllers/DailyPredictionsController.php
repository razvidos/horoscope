<?php

namespace App\Http\Controllers;

use App\Models\DailyPredictions;
use Illuminate\Contracts\Foundation\Application as ApplicationAlias;
use Illuminate\Contracts\View\Factory as FactoryAlias;
use Illuminate\Contracts\View\View as ViewAlias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DailyPredictionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return ApplicationAlias|FactoryAlias|ViewAlias
     */
    public function index(Request $request)
    {
        $validated = $request->validate([
            'date' => 'nullable|date_format:Y-m-d',
        ]);

        $date = array_key_exists('date', $validated) ? $validated['date'] : date("Y-m-d");
        $horoscopes = DB::table('horoscopes')
            ->get(['id', 'title']);
        $daily_predictions = DailyPredictions::with('prediction')
            ->where('Date', $date)
            ->get();

        return view('daily_predictions')->with(compact(
            'daily_predictions',
            'horoscopes',
            'date',
        ));
    }
}
