<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKeywordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keywords', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->bigInteger('adGroupId');
            $table->bigInteger('campaignId');
            $table->string('keywordText');
            $table->string('matchType');
            $table->string('state');
            $table->integer('bid');
            $table->string('suggestBid');
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
        Schema::dropIfExists('keywords');
    }
}
