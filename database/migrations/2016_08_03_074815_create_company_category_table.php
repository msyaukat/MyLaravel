<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('CompanyCategoriesLink', function (Blueprint $table) {
            $table->integer('user_id');
            $table->integer('main_cat_id');
            $table->integer('sub_cat_id_1');
            $table->integer('sub_cat_id_2');
            $table->integer('sub_cat_id_3');
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
        Schema::drop('CompanyCategoriesLink');
    }
}
