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
            $table->id();
            $table->integer('category_id');
            $table->integer('subCategory_id');
            $table->integer('user_id');
            $table->string('product_name',100);
            $table->float('product_price',8,2);
            $table->integer('product_quantity');
            $table->text('product_short_description');
            $table->longText('product_long_discription');
            $table->integer('product_alert_quantity');
            $table->string('product_photo',50);
            $table->timestamps();
             $table->softDeletes();
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
