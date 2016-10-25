@extends('layouts.app')

@section('content')

@section('title', '| Edit Company')

<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Profile</div>
                <div class="panel-body"></div>
      
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA0Bu6drHLCQKrrkyMGjPrUweA0NsPZFto&libraries=places" type="text/javascript"></script>   

{!! Form::model($company, ['route' => ['company.update', $company->id]])  !!}
	
	{{ Form::label('company_name', 'Name of Your Business:') }}
	{{ Form::text('company_name', null, ["class" => 'form-control input-lg']) }}

	<br>

	{{ Form::label('company_description', 'Company Description:') }}
	{{ Form::textarea('company_description', null, ["class" => 'form-control input-lg'])}}

	<br>

	{{ Form::label('company_address', 'Company Address:') }}
	<textarea class="form-control input-lg" name="company_address" id="company_address"  cols="50" rows="10">{{$company->companycontacts->company_address}}</textarea>

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
    <input type="text" class="form-control input-sm" name="lat" id="lat" value="{{$company->companycontacts->company_lat}}">
    </div>

    <div class="form-group">
    <label for="">Lng</label>
    <input type="text" class="form-control input-sm" name="lng" id="lng" value="{{$company->companycontacts->company_lng}}">
    </div>

	
	


</div>
   </div>
	</div>
{!! Form::close() !!}

<script>

var map = new google.maps.Map(document.getElementById('map-canvas'),{
    center:{
      lat: {{$company->companycontacts->company_lat}},
          lng: {{$company->companycontacts->company_lng}}
    },
    zoom:15
  });
  var marker = new google.maps.Marker({
    position: {
      lat: {{$company->companycontacts->company_lat}},
          lng: {{$company->companycontacts->company_lng}}
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

