@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Profile</div>
                <div class="panel-body"></div>

                {!! Form::model($user, ['route' => ['profile.update', $user->id], 'method' => 'PUT']) !!}

                    {{ Form::text('name', null, ["class" => 'form-control input-lg']) }}
                   
                    {{ Form::text('phone_number', null, ["class" => 'form-control input-lg']) }}
                    

                

                
                    {{ Form::submit('Update', ['class' => 'btn btn-success btn-block']) }}
                
                {!! Form::close() !!}    
                    

@endsection