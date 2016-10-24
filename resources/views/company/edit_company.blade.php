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

{!! Form::model($companycontact, ['route' => ['company.update', $company->id]])  !!}
	
	{{ Form::label('company_name', 'Name of Your Business:') }}
	{{ Form::text('company_name', null, ["class" => 'form-control input-lg']) }}

	<br>

	{{ Form::label('company_description', 'Company Description:') }}
	{{ Form::textarea('company_description', null, ["class" => 'form-control input-lg'])}}

	<br>

	{{ Form::label('company_address', 'Company Address:') }}
	{{ Form::textarea('company_address', null, ["class" => 'form-control input-lg']) }}


</div>
   </div>
	</div>
{!! Form::close() !!}

@endsection