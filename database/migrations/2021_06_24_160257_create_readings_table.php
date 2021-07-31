<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReadingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('readings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('beneficiaries_id')->unsigned();
            $table->string('month');
            $table->decimal('previous_reading');
            $table->decimal('current_reading');
            $table->decimal('monthly_use');
            $table->decimal('price_kilo');
            $table->decimal('minimum');
            $table->decimal('monthly_draw');
            $table->decimal('amount_required');
            $table->bigInteger('reader_employee_id')->unsigned();

            $table->timestamps();

            $table->unique(['beneficiaries_id','month']);
            $table->foreign('beneficiaries_id')->references('id')->on('beneficiaries');
            $table->foreign('reader_employee_id')->references('id')->on('employees');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('readings');
    }
}
