@extends('layouts.app')
@section('content')
<div class="text-center">
  <h1>ユーザー編集</h1>
</div>
<div class="row">
  <div class="col-sm-6 offset-sm-3">
    {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'put']) !!}
      <div class="form-group">
        {!! Form::label('name', '名前',['class' => 'text-center']) !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
      </div>
      <div class="text-center">
        {!! Form::submit('更新', ['class' => 'btn btn-primary']) !!}
      </div>
    {!! Form::close() !!}
  </div>
</div>
@endsection
