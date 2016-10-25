<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
        protected $table = 'companies';
        protected $primaryKey = 'company_id';

        public function users()
        {
        	return $this->belongsTo('App\User', 'id', 'user_id');
        }

        public function categories()
        {
        	return $this->belongsToMany('App\MainCategory', 'companycategorieslink', 'main_cat_id', 'company_id');
        }

        public function companycontacts()
        {
                return $this->hasOne('App\CompanyContact', 'company_id', 'company_id');
        }


}
