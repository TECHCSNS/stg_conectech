@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">プロフィール編集</div>

                <div class="panel-body panel-back">
                    {!! Form::open(array('url' => isset($profile) ? url('/profile/'.Auth::user()->username) : url('/profile'), 'files'=>true, 'class'=>'form-horizontal')) !!}
                    <!--<form class="form-horizontal" role="form" method="POST" action="{{ isset($profile) ? url('/profile/'.Auth::user()->id) : url('/profile') }}">-->
                        {{ isset($profile) ? Form::hidden('_method', 'PUT') : '' }}
                        
                        <div class="form-group">
                            {!! Form::label('username', null, ['class' => 'col-md-4 control-label']) !!}
                            
                            <div class="col-md-6">
                                {!! Form::text('username', Auth::user()->username, ['class' => 'form-control',  'readonly']) !!}
                                
                            </div>
                        </div>
                        
                        <div class="form-group">
                            {!! Form::label('email', null, ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('email', Auth::user()->email, ['class' => 'form-control',  'readonly']) !!}
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('img') ? ' has-error' : '' }}">
                            {!! Form::label('img[必須]', null, ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::file('img', null, ['class' => 'form-control']) !!}
                                @if ($errors->has('img'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('img') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                            {!! Form::label('first_name[必須]', null, ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('first_name', isset($profile) ? $profile->first_name : old('first_name'), ['class' => 'form-control', 'placeholder' => 'first_name']) !!}
                                @if ($errors->has('first_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('first_kana') ? ' has-error' : '' }}">
                            {!! Form::label('first_kana', null, ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('first_kana', isset($profile) ? $profile->first_kana : old('first_kana'), ['class' => 'form-control', 'placeholder' => 'first_kana']) !!}
                                @if ($errors->has('first_kana'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('first_kana') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('middle_name') ? ' has-error' : '' }}">
                            {!! Form::label('middle_name', null, ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('middle_name', isset($profile) ? $profile->middle_name : old('middle_name'), ['class' => 'form-control', 'placeholder' => 'middle_name']) !!}
                                @if ($errors->has('middle_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('middle_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('middle_kana') ? ' has-error' : '' }}">
                            {!! Form::label('middle_kana', null, ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('middle_kana', isset($profile) ? $profile->middle_kana : old('middle_kana'), ['class' => 'form-control', 'placeholder' => 'middle_kana']) !!}
                                @if ($errors->has('middle_kana'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('middle_kana') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                            {!! Form::label('last_name[必須]', null, ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('last_name', isset($profile) ? $profile->last_name : old('last_name'), ['class' => 'form-control', 'placeholder' => 'last_name']) !!}
                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('last_kana') ? ' has-error' : '' }}">
                            {!! Form::label('last_kana', null, ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('last_kana', isset($profile) ? $profile->last_kana : old('last_kana'), ['class' => 'form-control', 'placeholder' => 'last_kana']) !!}
                                @if ($errors->has('last_kana'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_kana') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('birth') ? ' has-error' : '' }}">
                            {!! Form::label('birth[必須]', null, ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::date('birth', isset($profile) ? $profile->birth->format('Y-m-d') : '2000-01-01', ['class' => 'form-control', 'placeholder' => 'birth']) !!}
                                @if ($errors->has('birth'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('birth') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group {{ $errors->has('sex') ? ' has-error' : '' }}">
                            <div class="col-md-6 col-md-push-4">
                                <label class="form-check-inline">
                                    {{ Form::radio('sex', 0, (isset($profile) ? ($profile->sex === 0 ? true : false) : false), ['class' => 'form-check-input']) }}
                                    Man
                                </label>
                                
                                <label class="form-check-inline">
                                    {{ Form::radio('sex', 1, (isset($profile) ? ($profile->sex === 1 ? true : false) : false), ['class' => 'form-check-input']) }}
                                    Woman
                                </label>
                                @if ($errors->has('sex'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('sex') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('major') ? ' has-error' : '' }}">
                            {!! Form::label('major[必須]', null, ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('major', isset($profile) ? $profile->major : old('major'), ['class' => 'form-control', 'placeholder' => 'major']) !!}
                                @if ($errors->has('major'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('major') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('born_place') ? ' has-error' : '' }}">
                            {!! Form::label('born_place[必須]', null, ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('born_place', isset($profile) ? $profile->born_place : old('born_place'), ['class' => 'form-control', 'placeholder' => 'born_place']) !!}
                                @if ($errors->has('born_place'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('born_place') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                       
                        <div class="form-group{{ $errors->has('about_me') ? ' has-error' : '' }}">
                            <label for="about_me" class="col-md-4  control-label">about_me</label>
                            <div class="col-md-6">
                                <textarea class="form-control vresize" id="about_me" name="about_me" placeholder="about_me" cols="6" rows="3">{{ isset($profile) ? $profile->about_me : old('about_me') }}</textarea>
                            </div>
                            @if ($errors->has('about_me'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('about_me') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('hobby') ? ' has-error' : '' }}">
                            <label for="hobby" class="col-md-4  control-label">hobby</label>
                            <div class="col-md-6">
                                <textarea class="form-control vresize" id="hobby" name="hobby" placeholder="hobby" cols="6" rows="3">{{ isset($profile) ? $profile->hobby : old('hobby') }}</textarea>
                            </div>
                            @if ($errors->has('hobby'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('hobby') }}</strong>
                                </span>
                            @endif
                        </div>
                        
                        <div class="form-group{{ $errors->has('technic') ? ' has-error' : '' }}">
                            <label for="technic" class="col-md-4  control-label">technic</label>
                            <div class="col-md-6">
                                <textarea class="form-control vresize" id="technic" name="technic" placeholder="technic" cols="6" rows="3">{{ isset($profile) ? $profile->technic : old('technic') }}</textarea>
                            </div>
                            @if ($errors->has('technic'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('technic') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('specialty') ? ' has-error' : '' }}">
                            <label for="specialty" class="col-md-4  control-label">specialty</label>
                            <div class="col-md-6">
                                <textarea class="form-control vresize" id="specialty" name="specialty" placeholder="specialty" cols="6" rows="3">{{ isset($profile) ? $profile->specialty : old('specialty') }}</textarea>
                            </div>
                            @if ($errors->has('specialty'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('specialty') }}</strong>
                                </span>
                            @endif
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Submit</button>
                    {{Form::close()}}
                </div>
            </div> <!-- .panel -->

        </div>
    </div>
</div>
@endsection
