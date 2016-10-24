<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyContact extends Model
{
    protected $table = 'companyContact';
    protected $primaryKey = 'company_id';


    public function company()
    {
    	return $this->belongsTo('App\Company', 'company_id');
    }
}
