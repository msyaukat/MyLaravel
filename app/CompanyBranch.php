<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyBranch extends Model
{
    protected $table = 'companybranches';

    protected $primaryKey = 'company_branch_id';


    public function company()
    {
    	return $this->belongsTo('App\Company', 'company_id', 'company_branch_id');
    }
}
