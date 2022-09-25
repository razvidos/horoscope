<?php


use App\Models\Horoscope;
use App\Models\Prediction;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_predictions', function (Blueprint $table) {
            $table->foreignIdFor(Horoscope::class, 'horoscope_id');
            $table->foreignIdFor(Prediction::class, 'prediction_id');
            $table->date('Date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('daily_predictions');
    }
};
