<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create sources table
        Schema::create('sources', function (Blueprint $table) {
            $table->increments('id');
            $table->char('name', 255);
            $table->timestamps();
        });

        // Add source id to names
        Schema::table('names', function (Blueprint $table) {
            $table->integer('source_id', false, true);
            $table->index('source_id');
        });

        // Add source id to emails
        Schema::table('emails', function (Blueprint $table) {
            $table->integer('source_id', false, true);
            $table->index('source_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sources');
    }
}
