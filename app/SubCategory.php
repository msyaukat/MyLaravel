<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $table = 'subcategories';

    public function user()
    {

    	//return $this->belongsToMany('App\User');

    }

    public function MainCategory()
    {

    	return $this->belongsToMany('MainCategory', 'companycategorieslink', 'sub_cat_id', 'main_cat_id');

    }
}
