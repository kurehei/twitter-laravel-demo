@if (count($errors))
  <ul class="alert alert-danger" role="danger">
    @foreach ( $errors->all() as $error)
      <!--- bldadeは基本　{{--  --}}--->
      <li class="ml-4">{{ $error  }}</li>
    @endforeach
  </ul>
@endif
