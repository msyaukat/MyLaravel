@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $user->name }}'s Profile</div>
                <div class="panel-body"></div>
                <!-- profile picture -->

                <img src="">
                {!! Form::open(array('route' => 'profile.store', 'files' => true)) !!}

                    {{ Form::label('profile_picture', 'upload profile picture') }}
                    {{ Form::file('profile_picture') }}

                    {{ Form::submit('Upload Picture', ['class' => 'btn btn-success btn-block']) }}

                {!! Form::close() !!}

                <h1>{{ $user->name }}</h1>
                <h2>{{ $user->email }}</h2>
                <h3>{{ $user->phone_number }}</h3>
                {!!  Html::linkRoute('profile.edit', 'Edit', array($user->id), array('class' =>'btn btn-primary btn-block')) !!}
                	
                	

@endsection