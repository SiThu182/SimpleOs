@extends('backtemplate')
@section('content')
<div class="row">
	<div class="col-md-12">
		<h1>Category </h1>
		<form action="{{route('brand.store')}}" method="post" enctype="multipart/form-data">
			@csrf
			<div class="row mt-5">
				<div class="col-md-3 ">
				<label>Brand Name</label>
			</div>
			<div class="col-md-5">
				<input type="name" name="name" class="form-control">
			</div>
			<div class="col-md-3">
				<input type="submit" value="ADD">
			</div>
			</div>
			
		</form>
		
		

	<div class="col-md-8 offset-2 mt-5">

		<table class="table table-dark table-sm">
			<tr>
				<th>NO.</th>
				<th>Brand Name</th>
				<th>Action</th>
			</tr>
			@foreach($brands as $brand)
			<tr>
				<td>{{$brand->id}}</td>
				<td>{{$brand->name}}</td>
				 <td>
                      <form action="{{route('brand.destroy',$brand->id)}}" method="post">
                        @method('Delete')
                        @csrf
                        <input type="submit" name="btnsubmit" value="Delete" class="btn btn-danger">
                      </form>
                  </td>
			</tr>
			@endforeach
		</table>
	</div>
		
	</div>
	
</div>

@endsection