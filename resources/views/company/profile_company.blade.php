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
<img src="{{ asset('images/' . $company->company_image) }}" alt="HTML5 Icon" style="width:128px;height:128px;">
<h5> {{ $company->company_description }} </h5>

<h3> Company Address </h3>
<h5> {{ $company->companycontacts->company_address }} </h5>

<label for="">Map</label>

                    
<div id="map-canvas"></div>

<h3> Company Phone </h3>
<h5> {{ $company->companycontacts->company_phone }} </h5>

<br>
<h3> Company Fax </h3>
<h5> {{ $company->companycontacts->company_fax }} </h5>

<br>
<h3> Company Email </h3>
<h5> {{ $company->companycontacts->company_email }} </h5>

<br>
<h3> Company Website </h3>
<h5> {{ $company->companycontacts->company_website }} </h5>
</div>

    <div class="row">
        <div id="comment-form">
          {{ Form::open(['route' => 'comments.store', $company->company_id, 'method' => 'POST']) }}
            <div class="row">
              <div class="col-md-12">
                {{ Form::label('comment', "Comment:") }}
                {{ Form::textarea('comment', null, ['class' => 'form-control']) }}

                {{ Form::submit('Add Comment', ['class' => 'btn btn-success btn-block', 'style' => 'margin-top:15px;'])}}
          {{ Form::close() }}
        </div>
    </div>
</div>

<br>

    <div id="disqus_thread"></div>
    <script>

    /**
    *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
    *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
    /*
    var disqus_config = function () {
    this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
    this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
    };
    */
    (function() { // DON'T EDIT BELOW THIS LINE
    var d = document, s = d.createElement('script');
    s.src = '//localhost-8000-5.disqus.com/embed.js';
    s.setAttribute('data-timestamp', +new Date());
    (d.head || d.body).appendChild(s);
    })();
    </script>
    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>







@endsection
	

@section('scripts')

<script>

var map = new google.maps.Map(document.getElementById('map-canvas'),{
    center:{
      lat: {{ $company->companycontacts->company_lat }},
          lng: {{ $company->companycontacts->company_lng }}
    },
    zoom:15
  });
  var marker = new google.maps.Marker({
    position: {
      lat: {{ $company->companycontacts->company_lat }},
          lng: {{ $company->companycontacts->company_lng }}
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