<div class="card">
  <div class="card-header">
    {{ $user->name }}
  </div>
  <div class="card-body">
      <img class="rounded img-fluid" src="{{ Gravatar::src($user->email, 500) }}" alt="">
  </div>
</div>
@include('user_follow.follow_button', ['user' => $user])
