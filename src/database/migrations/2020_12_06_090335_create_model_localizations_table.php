<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelLocalizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('model_localizations', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('lang_id');
            $table->foreign('lang_id')->references('id')->on('model_localization_languages')->onDelete('cascade');

            $table->string("modelable_type");
            $table->string("modelable_id");

            $table->longText("data");

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
        Schema::dropIfExists('model_localizations');
    }
}
