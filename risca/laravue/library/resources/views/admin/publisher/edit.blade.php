@extends('layouts.admin')
@section('header', 'Publisher')

@section('content')
<div class="row">
	<div class="col-md-6">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Edit Publisher</h3>
			</div>

			<form action="{{ url('publishers/'.$publisher->id) }}" method="post">
				@csrf
				{{ method_field('PUT') }}
				<div class="card-body">
					<div class="form-group">
						<label>Name</label>
						<input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Name" required="" value="{{ $publisher->name }}">
						@error('name')
							<div class="invalid-feedback">
								{{ $message }}
							</div>
						@enderror
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter Email" required="" value="{{ $publisher->email }}">
						@error('email')
							<div class="invalid-feedback">
								{{ $message }}
							</div>
						@enderror
					</div>		
					<div class="form-group">
						<label>Phone</label>
						<input type="number" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" placeholder="Enter Phone" required="" value="{{ $publisher->phone_number }}">
						@error('phone-number')
							<div class="invalid-feedback">
								{{ $message }}
							</div>
						@enderror
					</div>
					<div class="form-group">
						<label>Address</label>
						<input type="text" name="address" class="form-control @error('address') is-invalid @enderror" placeholder="Enter Address" required="" value="{{ $publisher->address }}">
						@error('address')
							<div class="invalid-feedback">
								{{ $message }}
							</div>
						@enderror
					</div>					
				</div>

					<div class="card-footer">
						<button type="submit" class="btn btn-primary">Submit</button>
					</div>
			</form>
		</div>
	</div>
</div>
@endsection