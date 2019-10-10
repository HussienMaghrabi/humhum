<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->double('vat')->default(0);
            $table->longText('about_ar')->nullable();
            $table->longText('about_en')->nullable();
            $table->longText('privacy_ar')->nullable();
            $table->longText('privacy_en')->nullable();
            $table->longText('term_ar')->nullable();
            $table->longText('term_en')->nullable();
            $table->longText('how_to_sell_ar')->nullable();
            $table->longText('how_to_sell_en')->nullable();
            $table->longText('term_sale_ar')->nullable();
            $table->longText('term_sale_en')->nullable();
            $table->longText('sell_policy_ar')->nullable();
            $table->longText('sell_policy_en')->nullable();
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
        Schema::dropIfExists('settings');
    }
}
