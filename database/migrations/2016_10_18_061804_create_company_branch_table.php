<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyBranchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('CompanyBranches', function (Blueprint $table) {
            $table->integer('company_id');
            $table->increments('company_branch_id');
            $table->text('company_branch_name');
            $table->text('company_branch_address');
            $table->text('company_branch_lat');
            $table->text('company_branch_lng');
            $table->text('company_contact');
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
        Schema::drop('CompanyBranches');
    }
}
