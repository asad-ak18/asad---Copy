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
        Schema::create('productdetail_faqs', function (Blueprint $table) {
            $table->id();
            $table->text('product_detail_fq');
            $table->longText('product_detail_faq_ans');
            $table->text('product_detail_faq_quss');
            $table->longText('product_detail_faq_anss');
            $table->text('product_detail_faq_qusss');
            $table->longText('product_detail_faq_ansss');
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
        Schema::dropIfExists('productdetail_faqs');
    }
};
