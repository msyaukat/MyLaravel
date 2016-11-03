@extends('layouts.app')

@section('content')

@section('title', '| Add Branches')

<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Add Branches</div>
                <div class="panel-body"></div>


{!! Form::open(array('route' => 'companybranch.store', 'files' => true)) !!}


	{{ Form::label('company_branch_name', 'Branch/Agent Name:') }}
    {{ Form::text('company_branch_name', null, ["class" => 'form-control input-lg']) }}





    {{ Form::submit('Create Business', ['class' => 'btn btn-success btn-block']) }}
                
{!! Form::close() !!}




@endsection
