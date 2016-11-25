<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
        protected $table = 'companies';
        protected $primaryKey = 'company_id';

         public function getRouteKeyName()
        {
                return 'company_id';
        }

        public function users()
        {
        	return $this->belongsToMany('App\User', 'id', 'user_id');
        }

        public function categories()
        {
        	return $this->belongsToMany('App\MainCategory', 'companycategorieslink', 'main_cat_id', 'company_id');
        }

        public function companycontacts()
        {
                return $this->hasOne('App\CompanyContact', 'company_id', 'company_id');
        }

        public function companybranches()
        {
                return $this->hasMany('App\CompanyBranch', 'company_branch_id', 'company_id');
        }

        public function comments()
        {
                return $this->hasMany('App\Comment', 'company_id', 'comment_id');
        }

}
