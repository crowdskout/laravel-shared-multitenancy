<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        die();
        Schema::create('customer_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id', false, true);
            $table->integer('user_id', false, true);
            $table->timestamps();

            $table->index('customer_id');
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_users');
    }
}
