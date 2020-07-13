@extends('backtemplate')
@section('content')
<div class="row">
	<div class="col-md-12">
		<div id="add">
			<h1>Add Category </h1>
			<form action="{{route('item.store')}}" method="post" enctype="multipart/form-data">
				@csrf
				<div class="row form-group">
					<div class="col-md-3 ">
						<label>item Name</label>
					</div>
					<div class="col-md-5">
						<input type="name" name="name" class="form-control">
					</div>
					
				</div>
				<div class="row  form-group">
					<div class="col-md-3 ">
						<label>item price</label>
					</div>
					<div class="col-md-5">
						<input type="name" name="price" class="form-control">
					</div>
					
				</div>
				
				<div class="row  form-group">
					<div class="col-md-3 ">
						<label>Category</label>
					</div>
					<div class="col-md-5">
						<select name="category_id"  class="form-control">
							<option>Choose Category</option>
							@foreach($categories as $category)
							<option value="{{$category->id}}">{{$category->name}}</option>
							@endforeach
						</select>
					</div>
					
				</div>

				<div class="row  form-group">
					<div class="col-md-3 ">
						<label>Brand</label>
					</div>
					<div class="col-md-5">
						<select name="brand_id"  class="form-control">
							<option>Choose brand</option>
							@foreach($brands as $brand)
							<option value="{{$brand->id}}">{{$brand->name}}</option>
							@endforeach
						</select>
					</div>
					
				</div>

				<div class="row  form-group">
					<div class="col-md-3 ">
						<label>Brand</label>
					</div>
					<div class="col-md-5">
						<input type="file" name="image" class="form-control">
					</div>
					
				</div>

				<div class="offset-7 col-md-3">
					<input type="submit" value="ADD" class="btn btn-info">
				</div>
				
			</form>
		</div>
		<div id="edit">
			<h1>Edit Category </h1>
			<form action="{{route('item.update',1)}}" method="post" enctype="multipart/form-data">
				@csrf
				@method('PUT')
				<input type="hidden" name="id" id="id">
				<div class="row form-group">
					<div class="col-md-3 ">
						<label>item Name</label>
					</div>
					<div class="col-md-5">
						<input type="name" name="name" class="form-control" id="item_name">
					</div>
					
				</div>
				<div class="row  form-group">
					<div class="col-md-3 ">
						<label>item price</label>
					</div>
					<div class="col-md-5">
						<input type="name" name="price" class="form-control" id="item_price">
					</div>
					
				</div>
				
				<div class="row  form-group">
					<div class="col-md-3 ">
						<label>Category</label>
					</div>
					<div class="col-md-5">
						<select name="category_id"  class="form-control">
							<option>Choose Category</option>
							@foreach($categories as $category)
							<option value="{{$category->id}}">{{$category->name}}</option>
							@endforeach
						</select>
					</div>
					
				</div>

				<div class="row  form-group">
					<div class="col-md-3 ">
						<label>Brand</label>
					</div>
					<div class="col-md-5">
						<select name="brand_id"  class="form-control">
							<option>Choose brand</option>
							@foreach($brands as $brand)
							<option value="{{$brand->id}}">{{$brand->name}}</option>
							@endforeach
						</select>
					</div>
					
				</div>

				<div class="row  form-group">
					<div class="col-md-3 ">
						<label>Brand</label>
					</div>
					<div class="col-md-5">
						<input type="file" name="image" class="form-control" >
					</div>
					<div class="col-md-4">
						<input type="hidden" name="oldimg" id="oldimg">
						<img src="" class="img-fluid" id="image" width="210" height="200">
					</div>
					
				</div>

				<div class="offset-7 col-md-3">
					<input type="submit" value="ADD" class="btn btn-info">
				</div>
				
			</form>
		</div>
		

	<div class="col-md-8 offset-2 mt-5">

		<table class="table table-dark table-sm">
			<tr>
				<th>NO.</th>
				<th>Item Name</th>
				<th>Brand </th>
				<th>Category</th>
				<th colspan="2">Action</th>
			</tr>
			@foreach($items as $item)
			<tr>
				<td>{{$item->id}}</td>
				<td>{{$item->item_name}}</td>
				<td>{{$item->brand->name}}</td>
				<td>{{$item->category->name}}</td>
				<td>
				 	<a href="javascript:void(0)" class="btn btn-secondary editItem"  data-id="{{$item->id}}">Edit</a>
				</td>
				<td> 	
	                    <form action="{{route('item.destroy',$item->id)}}" method="post">
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


@section('script')
<script type="text/javascript">
	$(document).ready(function(){
		$('#add').show();
		$('#edit').hide();

		$.ajaxSetup({
        headers:{
          'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
      });
		$('.editItem').click(function(){
			var id = $(this).data('id');
			alert(id);
			 $.get('/item/show/',{id,id},function(response){
			 	var item = response.item;
			 	var category = response.category;
			 	var brand = response.brand;
			 	var item_name = item.item_name;
			 	var item_price = item.item_price;
			 	var image = item.image;
			 	var id = item.id;
			 	$('#id').val(id);
			 	$('#item_name').val(item_name);
			 	$('#item_price').val(item_price);
			 	$('#image').attr('src',image);
			 	$('#oldimg').val(image); 
			 })
			$('#add').hide();
			$('#edit').show(1000);
			
		})
	})
</script>

@endsection