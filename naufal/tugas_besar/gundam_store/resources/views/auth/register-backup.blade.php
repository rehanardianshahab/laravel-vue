@extends('layouts.reg')

@section('content')
<div class="content-wrapper d-flex align-items-center auth px-0">
    <div class="row w-100 mx-0">
      <div class="col-lg-4 mx-auto">
        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
          <div class="brand-logo">
            <img src="{{ asset('assets/images/logo.svg') }}" alt="logo">
          </div>
          <h4>New here?</h4>
          <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>

          <form method="POST" action="{{ route('register') }}" class="pt-3">
            @csrf
            <div class="form-group">
              <input type="text" name="name" class="form-control form-control-lg @error('name') is-invalid @enderror" id="name" placeholder="Name" required>
              @error('name')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Are you an admin?</label>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input @error('is_admin') is-invalid @enderror" name="is_admin" value="1" required>
                      Admin
                    </label>
                  </div>
    
                  <div class="form-check">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input @error('is_admin') is-invalid @enderror" name="is_admin" value="0">
                      Member
                    </label>
                  </div>
                </div>
                @error('is_admin')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Select Gender</label>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input @error('gender') is-invalid @enderror" name="gender" value="male" required>
                      Male
                    </label>
                  </div>
    
                  <div class="form-check">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input @error('gender') is-invalid @enderror" name="gender" value="female">
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

            <div class="form-group">
              <input type="email" name="email" class="form-control form-control-lg @error('email') is-invalid @enderror" id="email" placeholder="Email">
              @error('email')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>

            <div class="form-group">
              <textarea name="address" class="form-control @error('address') is-invalid @enderror" id="address" rows="4" placeholder="Address" required></textarea>
              @error('address')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>

            <div class="form-group">
              <input type="text" name="phone_number" class="form-control form-control-lg @error('phone_number') is-invalid @enderror" id="phone_number" placeholder="Phone Number" required>
              @error('phone_number')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>

            <div class="form-group">
              <input type="password" name="password" class="form-control form-control-lg @error('password') is-invalid @enderror" id="password" placeholder="Password" required>
              @error('password')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>

            <div class="form-group">
              <input id="password-confirm" type="password" class="form-control form-control-lg @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
              @error('password_confirmation')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>

            <div class="mb-4">
              <div class="form-check">
                <label class="form-check-label text-muted">
                  <input type="checkbox" class="form-check-input">
                  I agree to all Terms & Conditions
                </label>
              </div>
            </div>

            <div class="mt-3">
              <button type="submit" class="btn btn-block btn-info btn-lg font-weight-medium auth-form-btn">SIGN UP</button>
            </div>
            <div class="text-center mt-4 font-weight-light">
              Already have an account? <a href="{{ route('login') }}" class="text-primary">Login</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
