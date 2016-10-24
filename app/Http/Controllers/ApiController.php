<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\Response;

use Illuminate\Support\Facades\Input;

use App\SubCategory;

class ApiController extends Controller
{
	public function categoryDropDownData($id)
	{

   $cat_id = $id;


   $subcategories = SubCategory::where('main_cat_id', '=', $cat_id)
                  ->orderBy('name', 'asc')
                  ->get();

   return Response::json($subcategories);


	}    

}
