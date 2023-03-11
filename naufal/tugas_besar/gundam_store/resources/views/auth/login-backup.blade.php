@extends('layouts.log')

@section('content')
<div class="row w-100 mx-0">
    <div class="col-lg-4 mx-auto">
      <div class="auth-form-light text-left py-5 px-4 px-sm-5">
        <div class="brand-logo">
          <img src="{{ asset('assets/images/logo.svg') }}" alt="logo">
        </div>
        <h4>Hello! let's get started</h4>
        <h6 class="font-weight-light">Sign in to continue.</h6>
        <form method="POST" action="{{ route('login') }}" class="pt-3">
          @csrf
          <div class="form-group">
            <input type="email" name="email" class="form-control form-control-lg" id="email" placeholder="Email">
          </div>
          <div class="form-group">
            <input type="password" name="password" class="form-control form-control-lg" id="password" placeholder="Password">
          </div>
          <div class="mt-3">
            <button type="submit" class="btn-block btn-info btn-lg font-weight-medium auth-form-btn">SIGN IN</button>
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
          <div class="text-center mt-4 font-weight-light">
            Don't have an account? <a href="{{ route('register') }}" class="text-primary">Create</a>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
