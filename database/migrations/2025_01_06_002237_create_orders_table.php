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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->integer('quantity')->default(1)->nullable();
            $table->decimal('price', 8, 2)->nullable(); 
            $table->integer('points')->default(0)->nullable(); 
            $table->decimal('discount', 8, 2)->default(0);
            $table->decimal('transportation_cost', 8, 2)->default(0); 
            $table->decimal('final_price', 8, 2)->nullable();
            $table->decimal('total_price', 10, 2)->nullable(); 
            $table->string('status')->nullable()->default('pending'); // Remove the `after()` clause
            $table->string('payment_method')->nullable();
            $table->text('address')->nullable();
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
