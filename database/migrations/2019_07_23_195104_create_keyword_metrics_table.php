<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKeywordMetricsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keyword_metrics', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cost');
            $table->integer('sales');
            $table->integer('clicks');
            $table->integer('impressions');
            $table->integer('orders');
            $table->date('date_opt');
            $table->bigInteger('keyword_id');
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
        Schema::dropIfExists('keyword_metrics');
    }
}
