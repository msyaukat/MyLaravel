<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MainCategory extends Model
{
    protected $table = 'categories';

    public function company()
    {

    	return $this->belongsToMany('App\Company', 'companycategorieslink', 'company_id', 'main_cat_id');

    }

}

