<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyContactTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companyContact', function (Blueprint $table) {
            $table->integer('company_id');
            $table->text('company_address');
            $table->text('company_gps');
            $table->integer('company_phone');
            $table->integer('company_fax');
            $table->text('company_email');
            $table->text('company_website');
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
        Schema::drop('companyContact');
    }
}
