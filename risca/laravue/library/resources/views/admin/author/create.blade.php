@extends('layouts.admin')
@section('header', 'Author')

@section('content')
<div class="row">
	<div class="col-md-6">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Create New Author</h3>
			</div>

			<form action="{{ url('authors') }}" method="post">
				@csrf
				<div class="card-body">
					<div class="form-group">
						<label>Name</label>
						<input type="text" name="name" class="form-control" placeholder="Enter Name" >
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="email" name="email" class="form-control" placeholder="Enter Email" >
					</div>
					<div class="form-group">
						<label>Phone</label>
						<input type="number" name="phone_number" class="form-control" placeholder="Enter Phone" >
					</div>	
					<div class="form-group">
						<label>Address</label>
						<input type="text" name="address" class="form-control" placeholder="Enter Address" >
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