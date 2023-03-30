@extends('layouts.log')

@section('content')
<form method="POST" action="{{ route('login') }}" class="pt-3">
  @csrf
  <h1>Login Form</h1>
  <div class="form-group">
    <input type="email" name="email" class="form-control" id="email" placeholder="Email">
  </div>
  <div class="form-group">
    <input type="password" name="password" class="form-control" id="password" placeholder="Password">
  </div>
  <div class="mt-3">
    <button type="submit" class="btn-block btn-info font-weight-medium auth-form-btn">SIGN IN</button>
  </div>
  <div class="my-2 d-flex justify-content-between align-items-center">
    <div class="form-check">
      <label class="form-check-label text-muted">
        <input type="checkbox" class="form-check-input">
        Keep me signed in
      </label>
    </div>
    <a href="#" class="auth-link text-black">Forgot password?</a>
  </div>

  <div class="clearfix"></div>

  <div class="separator">
    <p class="change_link">New to site?
      <a href="{{ route('register') }}" class="to_register"> Create Account </a>
    </p>

    <div class="clearfix"></div>
    <br />

    <div>
      <h1><i class="fa fa-paw"></i> Gundam Store</h1>
      <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 4 template. Privacy and Terms</p>
    </div>
  </div>
</form>
@endsection
