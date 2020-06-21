@if (Auth::id() != $user->id)
  @if (Auth::user()->is_following($user->id))
    {!! Form::open(['route' => ['users.unfollow', $user->id], 'method' => 'delete']) !!}
    {!! Form::submit('アンフォロー', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
  @else
    {!! Form::open(['route' => ['users.follow', $user->id], 'method' => 'post']) !!}
      {!! Form::submit('フォロー', ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
  @endif
@endif
