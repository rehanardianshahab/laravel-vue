@extends('layouts.admin')
@section('header', 'Author')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<a href="{{ url('authors/create') }}" class="btn btn-sm btn-primary pull-right">Create New Author</a>
			</div>
			 
				<div class="card-body">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th style="width: 10px">#</th>
								<th class="text-center">Name</th>
								<th class="text-center">Email</th>
								<th class="text-center">Phone</th>
								<th class="text-center">Address</th>
								<th class="text-center">Book Totals</th>
								<th class="text-center">Created At</th>							
								<th class="text-center">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($authors as $key => $author)
							<tr>
								<td>{{ $key+1 }}</td>
								<td>{{ $author->name }}</td>
								<td>{{ $author->email }}</td>
								<td>{{ $author->phone_number }}</td>
								<td>{{ $author->address }}</td>
								<td class="text-center">{{ count($author->books) }}</td>			
								<td class="text-center">{{ date('H:i:s - d M Y', strtotime($author->created_at)) }}</td>
								<td class="text-center">
									<a href="{{ url('authors/'.$author->id.'/edit') }}" class="btn btn-warning btn-sm">Edit</a>
									<form action="{{ url('authors', ['id' => $author->id]) }}" method="post">
										<input class="btn btn-danger btn-sm" type="submit" value="Delete" onclick="return confirm('Are you sure?')">
										@method('delete')
										@csrf
									</form>
								</td>
							</tr>
							@endforeach	
						</tbody>
					</table>
				</div>
		</div>
	</div>
</div>
@endsection