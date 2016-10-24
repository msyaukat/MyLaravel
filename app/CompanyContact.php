<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyContact extends Model
{
    protected $table = 'companyContact';

    public function company()
    {
    	return $this->belongsTo('App\Company', 'company_id');
    }
}
