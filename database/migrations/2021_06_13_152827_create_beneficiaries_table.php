<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatebeneficiariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beneficiaries', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->integer('phone');
            $table->string('place')->nullable();
            $table->bigInteger('type_id')->unsigned()->nullable();
            $table->bigInteger('status_id')->unsigned();
            $table->decimal('price_kilo');
            $table->decimal('minimum');
            $table->date('registration_dt');
            $table->date('expiry_dt')->nullable()->default(null);
            $table->timestamps();
            $table->foreign('type_id')->references('id')->on('constants');
            $table->foreign('status_id')->references('id')->on('constants');
            $table->decimal('balance')->default(0);
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Beneficiaries');
    }
}
