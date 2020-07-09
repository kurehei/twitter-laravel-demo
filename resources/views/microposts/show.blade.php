@extends('layouts.app')
@section('content')
<div class="row">
  <aside>
    <div class="card" style="width: 400px">
      <div class="card-header">
        <div class="text-center">
          {{ $micropost->user->name}}
        </div>

      </div>
      <div class="card-body" style="height: 350px; font-size: 30px">
        <div>
          {{ $micropost->content }}
        </div>
      </div>
      <div class="card-footer" style="height: 60px">
        <!--- いいねボタンの設置--->
          @if($like)
          <!--- いいねをはずず--->
            {!! Form::model($micropost,['route' => ['likes.destroy', $micropost->id, $like->id], 'method' => 'delete']) !!}
              <button type="submit" class="unLikeBtn"><i class="fas fa-heart"></i>いいねを外す{{ $micropost->likes_count }}</button>
            {!! Form::close() !!}
          @else
          <!--- いいねをする--->
            {!! Form::model($micropost,['route' => ['likes.store', 'micropostId' => $micropost->id], 'method' => 'post']) !!}
              <button type="submit" class="likeButton">
                <i class="far fa-heart"></i>
                いいね</button>{{ $micropost->likes_count }}
          　{!! Form::close() !!}
          @endif
      </div>
    </div>
  </aside>
  <div class="side-bar">
    {!! Form::open(['route' => ['comments.store', 'micropostId' => $micropost->id], 'method' => 'post']) !!}
      <div class="form-group">
        {!! Form::text('content', old('content'),['class' => 'form-control']) !!}

      </div>
      {!! Form::submit('コメントする', ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
    <ul class="list-unstyled">

    </ul>
  </div>
</div>
@endsection
