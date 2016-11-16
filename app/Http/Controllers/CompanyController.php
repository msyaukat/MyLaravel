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

use Storage;

use Auth;

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
                'main_cat_id' => 'required'|'integer',

            ));  

        $company = new Company;
        $company->company_name = $request->company_name;
        $company->company_description = $request->company_description;
        $company->user_id = Auth::user()->id;



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

        //company contact (phone number problem)

        $contact = new CompanyContact;
        $contact->company_id = $company->company_id;
        $contact->company_address = $request->company_address;
        $contact->company_lat = $request->lat;
        $contact->company_lng = $request->lng;
        $contact->company_phone = $request->company_phone;
        $contact->company_email = $request->company_email;
        $contact->company_fax = $request->company_fax;
        $contact->company_website = $request->company_website;

        $contact->save();       

        

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
        $company = Company::with('companycontacts')->where('company_id', $id)->first();


        return view('company/profile_company')->with('company', $company)->with('companycontacts')->with('slug');
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
             
        //$company->load('companycontacts'); // this works
        $company = Company::with('companycontacts')->where('company_id', $id)->first();



        //$companybranch = CompanyBranch::find($id); //tak lepas maybe letak dalam controller lain.

        //$company = Company::with('companybranches')->where('company_id', $id)->first();
            //foreach ($company->companybranches as $companybranch);

        //$company = Company::with('companybranches')->with(where('company_id', $id)->first();
        //DD($company);   

       

            //return $company->load('companycontacts'); // works for display..

           return view('company/edit_company')->with('company', $company)->with('companycontacts');//->with('companybranches', $companybranch);//, $companycontact);

            //return view('company/edit_company', compact('company'));
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
        $company = Company::find($id);

        $company = Company::with('companycontacts')->where('company_id', $id)->first();
        
        $company->company_name = $request->input('company_name');
        // company logo/image
        if ($request->hasFile('company_image')) {
            $image = $request->file('company_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/' . $filename);
            Image::make($image)->resize(800, 400)->save($location);
            //delete old filename
            $oldFilename = $company->company_image;


            $company->company_image = $filename;

            Storage::delete($oldFilename);
        }

         
        $company->company_description = $request->input('company_description');
        
        $company->companycontacts->company_address = $request->input('company_address');        
        $company->companycontacts->company_lat = $request->input('lat');
        $company->companycontacts->company_lng = $request->input('lng');
        $company->companycontacts->company_phone = $request->input('company_phone');
        $company->companycontacts->company_fax = $request->input('company_fax');
        $company->companycontacts->company_email = $request->input('company_email');
        $company->companycontacts->company_website = $request->input('company_website');

        $company->save();
        $company->companycontacts->save();
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
