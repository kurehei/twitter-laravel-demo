@if(count($users > 0))
  <ul class="list-unstyled">
    @foreach ( $users as $user)
      <li class="media">
      <img  class="mr-2 rounded" src="{{ Gravatar::src($user->email, 50)}}" alt="">
      <div>
        {{ $user->name }}
      </div>
      <div>
        {!! link_to_Route('users.show', 'プロフィールへ', ['id' => $user->id]) !!}
      </div>
      </li>
    @endforeach
  </ul>
@else
  <script>
    document.write("ユーザーが存在していません");
  </script>
@endif
