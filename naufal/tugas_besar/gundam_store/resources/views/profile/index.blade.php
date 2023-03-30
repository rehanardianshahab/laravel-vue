@extends('master.master')

@section('header', 'PROFILE')

@section('css')

@endsection

@section('content')
<section>
    <div class="container py-5">
  
      <div class="row">
        <div class="col-lg-4">
          <div class="card mb-4">
            <div class="card-body text-center">
              <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar"
                class="rounded-circle img-fluid" style="width: 150px;">
              <h5 class="my-3">{{ Auth::user()->name }}</h5>
              <p class="text-muted mb-1">{{ Auth::user()->email }}</p>
              <p class="text-muted mb-4">{{ $member->address }}</p>
              <div class="d-flex justify-content-center mb-2">
                <a href="/profile/{{ Auth::user()->id }}/edit" class="btn btn-info">Edit Profile</a>
                <form action="{{ url('profile', ['id' => Auth::user()->id]) }}" method="POST">
                  <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete Account</button>
                  @csrf
                  @method('delete')
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-8">
          <div class="card mb-4">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Full Name</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">{{ Auth::user()->name }}</p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Email</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">{{ Auth::user()->email }}</p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Phone Number</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">{{ $member->phone_number }}</p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Gender</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">{{ $member->gender }}</p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Role</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">{{ $member->role }}</p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Address</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">{{ $member->address }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@section('js')

@endsection