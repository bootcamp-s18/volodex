<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVcardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vcards', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_first');
            $table->string('name_middle')->nullable();
            $table->string('name_last');

            $table->string('organization_name')->nullable();
            $table->string('organization_title')->nullable();

            $table->string('phone_home')->nullable();
            $table->string('phone_work')->nullable();
            $table->string('phone_cell')->nullable();

            $table->string('address_work')->nullable();
            $table->string('address_home')->nullable();

            $table->string('email_personal')->nullable();
            $table->string('email_work')->nullable();

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
        Schema::dropIfExists('vcards');
    }
}
