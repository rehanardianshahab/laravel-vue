@extends('layouts.reg')

@section('content')
<form method="POST" action="{{ route('register') }}" class="pt-3">
  @csrf
  <h1>Create Account</h1>
  {{-- Name --}}
  <div>
    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Name" required="" />
    @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
  </div>

  {{-- Admin --}}
  <div class="row">
    <div class="col-md-6">
      <label for="">Are you an admin?</label>
      <div class="form-group row">
        <div class="radio col-md-6">
          <label>
            <input type="radio" class="flat @error('is_admin') is-invalid @enderror" name="is_admin" value="1" required>
            Admin
          </label>
        </div>

        <div class="radio col-md-6">
          <label>
            <input type="radio" class="flat @error('is_admin') is-invalid @enderror" name="is_admin" value="0">
            Member
          </label>
        </div>
        @error('is_admin')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
      </div>
    </div>

    {{-- Gender --}}
    <div class="col-md-6">
      <label for="">Select Gender</label>
      <div class="form-group row">
        <div class="radio col-md-6">
          <label>
            <input type="radio" class="flat @error('gender') is-invalid @enderror" name="gender" value="male" required>
            Male
          </label>
        </div>

        <div class="radio col-md-6">
          <label>
            <input type="radio" class="flat @error('gender') is-invalid @enderror" name="gender" value="female">
            Female
          </label>
        </div>
      </div>
      @error('gender')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
    </div>
  </div>

  {{-- Email --}}
  <div>
    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" required="" />
    @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
  </div>

  {{-- Address --}}
  <div class="mb-3">
    <textarea name="address" class="form-control @error('address') is-invalid @enderror" id="address" placeholder="Address" required></textarea>
    @error('address')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
  </div>

  {{-- Phone Number --}}
  <div>
    <input type="text" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number" placeholder="Phone Number" required>
    @error('phone_number')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
  </div>

  {{-- Password --}}
  <div>
    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" required="" />
    @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
  </div>

  {{-- Password Confirm --}}
  <div>
    <input id="password-confirm" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
    @error('password_confirmation')
      <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
      </span>
    @enderror
  </div>

  <div>
    <button type="submit" class="btn-block btn-info font-weight-medium auth-form-btn">Submit</button>
  </div>

  <div class="clearfix"></div>

  <div class="separator">
    <p class="change_link">Already a member ?
      <a href="{{ route('login') }}" class="to_register"> Log in </a>
    </p>

    <div class="clearfix"></div>
    <br />

    <div>
      <h1><i class="fa fa-paw"></i> Gundam Store</h1>
      <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 4 template. Privacy and Terms</p>
    </div>
  </div>
  </div>
</form>
@endsection
