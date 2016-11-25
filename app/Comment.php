<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    protected $primaryKey = 'comment_id';


   

    public function company()
    {
    	return $this->belongsTo('App\Company', 'company_id');
    }

}
