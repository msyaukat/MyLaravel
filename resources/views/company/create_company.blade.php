<?php
use App\SubCategory;


?>
@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Company Profile</div>
                <div class="panel-body"></div>

                @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA0Bu6drHLCQKrrkyMGjPrUweA0NsPZFto&libraries=places" type="text/javascript"></script>       

                {!! Form::open(array('route' => 'company.store', 'files' => true)) !!}

                	
                    {!! Form::hidden('user_id', Auth::user()->id, ["class" => 'form-control input-lg']) !!}

                    
                	{{ Form::label('company_name', 'Name of Your Business:') }}
                    {{ Form::text('company_name', null, ["class" => 'form-control input-lg']) }}
                   

                    {{ Form::label('company_description', 'Company Description:') }}
                    {{ Form::textarea('company_description', null, ["class" => 'form-control input-lg', 'size' => '20x5']) }}

                    

                    {{ Form::label('company_address', 'Company Address:') }}<br>
                    {{ Form::textarea('company_address', null, ['size' => '35x8']) }}

                    <br>
                    {{ Form::label('company_GPS', 'Insert Location:')}}
                    <div class="form-group">
                    <label for="">Map</label>
                    <input type="text" id="searchmap">
                    <style>
                    #map-canvas{
                    width: 350px;
                    height: 250px;
                                }
                    </style>
                    
                    <div id="map-canvas"></div>
                    </div>

                    <div class="form-group">
                    <label for="">Lat</label>
                    <input type="text" class="form-control input-sm" name="lat" id="lat">
                    </div>

                    <div class="form-group">
                    <label for="">Lng</label>
                    <input type="text" class="form-control input-sm" name="lng" id="lng">
                    </div>
                    
                    <br>
                    <?php $list=$categories?>
                    {{ Form::label('category', 'Company Category:') }}
                        <select name='category[]' class='form-control' id='category' multiple="">
                            <?php foreach ($categories as $cat){?>
                                    <optgroup label="<?php echo $cat->category_name?>">
                                        <?php
                                             $subcategories = SubCategory::all()->where("main_cat_id",$cat->main_cat_id);
                                            foreach ($subcategories as $subcat){
                                        ?>
                                        <option value="<?php echo $subcat->sub_cat_id?>"> <?php echo $subcat->name?></option>
                                        <?php }?>
                                    </optgroup>
                            <?php }?>
                        </select>

                    <?php $list = array('' => 'Please select' );?>


                    {{ Form::label('company_phone', 'Company\'s Phone Number:') }}
                    {{ Form::text('company_phone', null, ["class" => 'form-control input-lg']) }}

                    {{ Form::label('company_fax', 'Company\'s Fax:') }}
                    {{ Form::text('company_fax', null, ["class" => 'form-control input-lg']) }}

                    {{ Form::label('company_email', 'Company\'s Email:') }}
                    {{ Form::text('company_email', null, ["class" => 'form-control input-lg']) }}

                    {{ Form::label('company_website', 'Company\'s Website:') }}
                    {{ Form::text('company_website', null, ["class" => 'form-control input-lg']) }}
                       
                    {{ Form::label('subcategory', 'Sub Categories:') }}
                        {{ Form::select('subcategory',$list, null, array('class' => 'form-control','id'=>'subcategory'))}} 
                    
                    {{ Form::label('company_image', 'Company Logo:') }} 
                    {{ Form::file('company_image') }}

                    <br>


                                      
                    {{ Form::submit('Create Business', ['class' => 'btn btn-success btn-block']) }}
                
                    {!! Form::close() !!} 



@endsection 

            

   @section('scripts')

<script>

$( document ).ready(function() {
    
      $('#category').select2();
});


$( "#category" ).change(function() {
  
    var main_cat_id = $(this).val();

    $.get('/api/category-dropdown/'+ main_cat_id, function(data){

           //success data
           $('#subcategory').empty();

           $('#subcategory').append('<option value=""> Please choose one</option>');

           $.each(data, function(index, subcatObj){

               $('#subcategory').append('<option value="' + subcatObj.sub_cat_id+'">'
               + subcatObj.name + '</option>');


           });



       });

});

</script>

<script>

var map = new google.maps.Map(document.getElementById('map-canvas'),{
    center:{
      lat: 27.72,
          lng: 85.36
    },
    zoom:15
  });
  var marker = new google.maps.Marker({
    position: {
      lat: 27.72,
          lng: 85.36
    },
    map: map,
    draggable: true
  });
  var searchBox = new google.maps.places.SearchBox(document.getElementById('searchmap'));
  google.maps.event.addListener(searchBox,'places_changed',function(){
    var places = searchBox.getPlaces();
    var bounds = new google.maps.LatLngBounds();
    var i, place;
    for(i=0; place=places[i];i++){
        bounds.extend(place.geometry.location);
        marker.setPosition(place.geometry.location); //set marker position new...
      }
      map.fitBounds(bounds);
      map.setZoom(15);
  });
  google.maps.event.addListener(marker,'position_changed',function(){
    var lat = marker.getPosition().lat();
    var lng = marker.getPosition().lng();
    $('#lat').val(lat);
    $('#lng').val(lng);
  });



</script>



    @endsection
                    
                    

