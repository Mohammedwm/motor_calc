<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('beneficiaries_id')->unsigned();
            $table->string('month');
            $table->decimal('monthly_use');
            $table->decimal('amount_previous');
            $table->decimal('amount_required');
            $table->decimal('payment_value');
            $table->decimal('discount');
            $table->decimal('the_rest');
            $table->bigInteger('collector_employee_id')->unsigned();

            $table->timestamps();

            $table->foreign('beneficiaries_id')->references('id')->on('beneficiaries');
            $table->foreign('collector_employee_id')->references('id')->on('employees');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
