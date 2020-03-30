@extends('theme.admin.layouts.login')

@section('content')
<div class="middle-box text-center loginscreen animated fadeInDown">
  <div>
    <div>
      <h1 class="logo-name">ET+</h1>
    </div>
    <h3>Welcome to YES CMS</h3>

    <p>Login in. To see it in action.</p>
    <form class="m-t" method="POST" role="form" action="{{ route('admin.login') }}">
      @csrf
      <div class="form-group">
        <input type="email" class="form-control" placeholder="Email" name="email" required="">
      </div>
      <div class="form-group">
        <input type="password" class="form-control" placeholder="Password" name="password" required="">
      </div>
      <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
    </form>
    <p class="m-t"> <small>YES CMS &copy; 2020</small> </p>
  </div>
</div>
@stop