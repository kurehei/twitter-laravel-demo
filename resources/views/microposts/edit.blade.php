@extends('layouts.app')
@section('content')
  <div class="row">
    {!! Form::model($micropost, ['route' => ['microposts.update', 'id' => $micropost->id],'method' => 'put']) !!}
      {!! Form::textarea('content', null,['class' => 'form-control', 'rows' => '2']) !!}
      {!! Form::submit('送信', ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
  </div>
@endsection
