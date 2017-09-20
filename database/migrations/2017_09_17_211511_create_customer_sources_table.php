<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerSourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_source', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id', false, true);
            $table->integer('source_id', false, true);
            $table->timestamps();

            $table->unique(['customer_id', 'source_id']);
            $table->index(['source_id', 'customer_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_sources');
    }
}
