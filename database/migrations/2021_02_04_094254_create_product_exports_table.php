<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductExportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_exports', function (Blueprint $table) {
            $table->bigIncrements('id');
			// $table->integer('product_quantity')->default(0);
			$table->integer('products_type');
			$table->integer('products_id');
			$table->integer('product_category_id');
			$table->boolean('is_feature')->default(0);
            $table->boolean('products_status')->default(1);
            $table->decimal('products_price', 15);
            $table->integer('tax_class_id')->default(1);
            $table->integer('products_min_order')->default(1);
            $table->integer('products_max_stock')->nullable();
            $table->string('products_weight', 191)->nullable();
            $table->string('products_weight_unit', 191)->nullable();
            $table->string('products_model', 191);
			$table->text('image_id')->nullable();
			$table->text('products_video_link')->nullable();
            $table->string('products_name_1', 64);
            $table->string('products_url_1', 100)->nullable();
			$table->text('products_description_1')->nullable();
			$table->string('products_name_2', 64);
			$table->string('products_url_2', 100)->nullable();
			$table->text('products_description_2')->nullable();
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
        Schema::dropIfExists('product_exports');
    }
}
