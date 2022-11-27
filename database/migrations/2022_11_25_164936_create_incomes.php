<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incomes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('accounts_id');
            $table->decimal('deposit_value');
            $table->string('status', 10)->default(\Illuminate\Support\Facades\Config::get('constants.INCOMES_STATUS.PENDING'));
            $table->text('deposit_voucher_path');
            $table->timestamps();

            $table->foreign('accounts_id')->references('id')->on('accounts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('incomes');
    }
};
