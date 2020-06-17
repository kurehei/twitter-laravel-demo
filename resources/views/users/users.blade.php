@if (count($users) > 0)
  <ul class="list-unstyled">
    @foreach ( $users as $user)
      <li class="media">
      <img  class="mr-2 rounded" src="{{ Gravatar::src($user->email, 50)}}" alt="">
      <div class="media-body">
        <div>
          {{ $user->name }}
        </div>
        <div>

        </div>
      </div>
      </li>
    @endforeach
  </ul>
@endif
