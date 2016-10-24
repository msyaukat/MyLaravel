@extends('layouts.app')



@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Company Profile</div>
                <div class="panel-body"></div>

<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA0Bu6drHLCQKrrkyMGjPrUweA0NsPZFto&libraries=places" type="text/javascript"></script>   



<h1> {{ $company->company_name }} </h1>
<h5> {{ $company->company_description }} </h5>

<h3> Company Address </h3>
<br>
<h5> {{ $companycontact->company_address }} </h5>

<label for="">Map</label>

                    
<div id="map-canvas"></div>
</div>

  
</div>



@endsection
	

@section('scripts')

<script>

var map = new google.maps.Map(document.getElementById('map-canvas'),{
    center:{
      lat: {{ $companycontact->company_lat }},
          lng: {{ $companycontact->company_lng }}
    },
    zoom:15
  });
  var marker = new google.maps.Marker({
    position: {
      lat: {{ $companycontact->company_lat }},
          lng: {{ $companycontact->company_lng }}
    },
    map: map,
    draggable: true
  });
  

  google.maps.event.addListener(marker,'position_changed',function(){
    var lat = marker.getPosition().lat();
    var lng = marker.getPosition().lng();
    $('#lat').val(lat);
    $('#lng').val(lng);
  });



</script>

<style>
#map-canvas{
width: 350px;
height: 250px;
           }
</style>

@endsection