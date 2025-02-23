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
        
            Schema::create('products', function (Blueprint $table) {
                $table->id(); // Product ID
                $table->string('name'); // Product Name
                $table->text('description'); // Product Description
                $table->decimal('price', 8, 2); // Price of the Product
                $table->integer('quantity')->default(0); // Quantity in Stock
                $table->string('image')->nullable(); // Product Image
                $table->foreignId('category_id')->constrained()->onDelete('cascade'); // Add this line
                $table->string('sku')->unique()->nullable(); // SKU for the product
                $table->boolean('is_active')->default(true); // Whether the product is active or not
                $table->timestamps(); // Created and Updated timestamps
                    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
