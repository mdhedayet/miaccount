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
        Schema::create('account_head_totals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('account_head_id');
            $table->decimal('total_amount', 10, 2)->default(0);
            $table->timestamps();

            $table->foreign('account_head_id')->references('id')->on('account_heads')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('account_head_totals');
    }
};
