<ul class="list-unstyled">
  @foreach ( $microposts as $micropost)
    <li class="media mb-3">
      <img class="mr-2 rounded" src="{{ Gravatar::src($micropost->user->email, 50) }}" alt="">
      <div class="media-body">
        <div>
          {!! link_to_route('users.show', $micropost->user->name, ['id' => $micropost->user->id]) !!}
        </div>
        <!--- nl2brは改行のメソッド--->
        <div>
          <p class="mb-0">{{ nl2br(e($micropost->content)) }}</p>
        </div>
        <div>
          @if (Auth::id() == $micropost->user_id)
            {!! Form::open(['route' => ['microposts.destroy', $micropost->id], 'method' => 'delete']) !!}
              {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
          @endif
          {!! link_to_route('microposts.edit', "編集", ['id' => $micropost->id], ['class' => 'btn btn-success']) !!}
        </div>
      </div>
    </li>
  @endforeach
</ul>
