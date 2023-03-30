@extends('master.master')

@section('header', 'EDIT PROFILE')

@section('css')

@endsection

@section('content')
<div class="container mt-3">
    <a href="{{ url('profile') }}" class="btn btn-sm btn-primary">Back to Profile</a>
	<div class="row justify-content-center">
		<div class="col-md-9">
		    <div class="card">
		        <div class="card-body">
		            <div class="row">
		                <div class="col-md-12">
		                    <h4>Your Profile</h4>
		                    <hr>
		                </div>
		            </div>
		            <div class="row">
		                <div class="col-md-12">
		                    <form action="{{ url('profile/'.Auth::user()->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                {{-- Name --}}
                                <div class="form-group row">
                                    <label for="name" class="col-4 col-form-label">Name*</label> 
                                    <div class="col-8">
                                    <input id="name" name="name" placeholder="Name" class="form-control here @error('name') is-invalid @enderror" required="required" type="text" value="{{ Auth::user()->name }}">
                                    @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    </div>
                                </div>

                                {{-- Email --}}
                                <div class="form-group row">
                                    <label for="email" class="col-4 col-form-label">Email*</label> 
                                    <div class="col-8">
                                    <input id="email" name="email" placeholder="Email" class="form-control here @error('email') is-invalid @enderror" required="required" type="text" value="{{ Auth::user()->email }}">
                                    @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    </div>
                                </div>

                                {{-- Address --}}
                                <div class="form-group row">
                                    <label for="address" class="col-4 col-form-label">Address*</label> 
                                    <div class="col-8">
                                        <textarea id="address" name="address" cols="40" rows="4" class="form-control @error('address') is-invalid @enderror">{{ $member->address }}</textarea>
                                        @error('address')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Phone Number --}}
                                <div class="form-group row">
                                    <label for="phone_number" class="col-4 col-form-label">Phone Number*</label> 
                                    <div class="col-8">
                                    
                                    <input id="phone_number" name="phone_number" placeholder="Phone Number" class="form-control here @error('phone_number') is-invalid @enderror" required="required" type="text" value="{{ $member->phone_number }}">
                                    
                                    @error('phone_number')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    </div>
                                </div>

                                {{-- Gender --}}
                                <div class="form-group row">
                                    <label for="gender" class="col-4 col-form-label">Gender*</label> 
                                    <div class="col-8">
                                    <select id="gender" name="gender" class="custom-select @error('gender') is-invalid @enderror">
                                        <option value="">--- Select Gender ---</option>
                                        <option value="male" {{ $member->gender == 'male' ? 'selected' : '' }}>Male</option>
                                        <option value="female" {{ $member->gender == 'female' ? 'selected' : '' }}>Female</option>
                                    </select>
                                    @error('gender')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    </div>
                                </div>

                                {{-- Role --}}
                                <div class="form-group row">
                                    <label for="role" class="col-4 col-form-label">Role*</label> 
                                    <div class="col-8">
                                    <input id="role" placeholder="Role" class="form-control here" required="required" value="{{ $member->role }}" type="text" disabled>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="offset-4 col-8">
                                    <button name="submit" type="submit" class="btn btn-primary">Update My Profile</button>
                                    </div>
                                </div>
                            </form>
		                </div>
		            </div>
		            
		        </div>
		    </div>
		</div>
	</div>
</div>
@endsection

@section('js')

@endsection