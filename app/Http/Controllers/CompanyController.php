<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Company;

use App\MainCategory;

use App\SubCategory;

use App\CompanyCategoriesLink;

use App\CompanyContact;

use App\CompanyBranch;

use Image;

class CompanyController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = MainCategory::all();
        
       
        return view('company/create_company')->with('categories', $categories);


         
    }

    public function myformAjax($id)
    {
        $subcategories = SubCategory::all()
                    ->where("main_cat_id",$id)
                    ->lists("name","sub_cat_id");
        return json_encode($subcategories);
    }


    /**
     * Store a newly created resource in storage. addd
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
                'company_name' => 'required|max:255',
                'category' => 'required|max:255',
                'company_description'  => 'required',
                'user_id' => 'required',
                'main_cat_id' => 'required'|'integer',

            ));  

        $company = new Company;
        $company->company_name = $request->company_name;
        $company->company_description = $request->company_description;
        $company->user_id = $request->user_id;



        //save company images
        if ($request->hasFile('company_image')) {
            $image = $request->file('company_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/' . $filename);
            Image::make($image)->resize(800, 400)->save($location);

            $company->company_image = $filename;
        }

        $company->save(); 
        $main_cat_id= $company->company_id;

        //kena attach

        // $company = Company::find($main_cat_id);
        // $company->categories()->attach($main_cat_id); 

        //(tak reti)return redirect()->url('/home');
        $cat=$request->category;

            foreach ($cat as $v1){
            $subcat = new CompanyCategoriesLink;
            $subcat->company_id = $main_cat_id;
            $subcat->sub_cat_id = $v1;
            $subcat->save(); 
        }

        //company contact

        $contact = new CompanyContact;
        $contact->company_id = $company->company_id;
        $contact->company_address = $request->company_address;
        $contact->company_lat = $request->lat;
        $contact->company_lng = $request->lng;

        $contact->save();

        //company branch
        $companybranch = new CompanyBranch;
        $companybranch->company_id =$company->company_id;
        $companybranch->company_branch_name =$request->company_branch_name;
        $companybranch->company_branch_address = $request->company_branch_address;

        $companybranch->save();        

        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = Company::find($id);
        $companycontacts = Company::find($id)->companycontacts;
            foreach ($companycontacts as $companycontact);

        return view('company/profile_company')->with('company', $company)->with('companycontact', $companycontact);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::find($id);  

        $companycontacts = Company::find($id)->companycontacts;

        //$companycontacts = $company->companycontacts;  

        //$companycontacts = Company::find($id)->companycontacts;

        //  $company->companycontacts();

        //$companycontacts = $company->companycontacts;

        //$company = CompanyContact::with('company')->find($id);

            //foreach ($companycontacts as $companycontact);
        //$company = CompanyContact::with(company);

            return view('company.edit_company', compact('company'))->with('company', $company)->with('companycontacts', $companycontacts);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
