@extends('admin.layout.index')

@section('product') class="current-page" @endsection

@section('content')
<form action="admin/product/edit/{{$product->id}}" method="POST" enctype="multipart/form-data">
<input type="hidden" name="_token" value="{{csrf_token()}}" />
<div class="top_nav" >
	<div class="nav_menu" id="top_nav">
		<h3><button type="submit" class="btn btn-success">SAVE</button></h3>
	</div>
</div>
<div class="right_col" role="main" style="padding-top: 80px">
	@include('admin.errors.alerts')
	<div class="row">
		<div class="col-md-9 col-sm-9 col-xs-9">
			<div class="x_panel">
				<div class="x_title">
					<h2>Add Product <small></small></h2>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					<div class="row">
						<div class="col-md-12">
		                    <label>Name</label>
                            <input value="{{$product->name}}" name='name' type="text" placeholder="Name ..." class="form-control ">
		                </div>
		                
			        	<div class="col-md-12">
				            <label>Content</label>
		            		<textarea name="content" class="form-control ckeditor">{{$product->content}}</textarea>
			        	</div>
	              	</div>
				</div>
			</div>
			<div class="x_panel">
				<div class="x_title">
					<h2> SEO option</h2>
					<ul class="nav navbar-right panel_toolbox">
						<li><a class="collapse-link">Click <i class="fa fa-chevron-down"></i></a></li>
					</ul>
					<div class="clearfix"></div>
				</div>
				<div class="x_content" style="display: none;">
					<div class="row">
						<div class="col-md-12">
		                    <label>Title</label>
                            <input value="{{$product->title}}" name='title' type="text" placeholder="Name ..." class="form-control ">
		                </div>
		                <div class="col-md-12">
		                    <label>Description</label>
                            <input value="{{$product->description}}" name='description' type="text" placeholder="Description ..." class="form-control">
		                </div>
		                <div class="col-md-12">
		                    <label>keywords</label>
                            <input value="{{$product->keywords}}" name='keywords' type="text" placeholder="keywords ..." class="form-control">
		                </div>
		                <div class="col-md-6">
		                    <label>Robots</label>
                            <select name='robot' class="form-control">
								<option <?php if($product->robot == 'index, follow'){echo "selected";} ?> value="index, follow">index, follow</option>
								<option <?php if($product->robot == 'noindex, nofollow'){echo "selected";} ?> value="noindex, nofollow">noindex, nofollow</option>
						  	</select>
		                </div>
	              	</div>
				</div>
			</div>
		</div>

		<div class="col-md-3 col-sm-3 col-xs-3">
			<div class="x_panel">
				<div class="x_content">
					<div class="row">
		                <div class="col-md-12">
		                    <label>Category</label>
                            <select name='cat' class="form-control">
                            	@foreach($category as $cat)
								<option <?php if($cat->id == $product->cat_id){echo "selected";} ?> value="{{$cat->id}}">{{$cat->name}}</option>
								@endforeach
						  	</select>
		                </div>
		                <div class="col-md-12">
		                    <label>Code</label>
                            <input value="{{$product->code}}" name='code' type="text" placeholder="Code ..." class="form-control">
		                </div>
		                <div class="col-md-12">
		                    <label>Quantity</label>
                            <input value="{{$product->quantity}}" name='quantity' type="number" placeholder="Quantity ..." class="form-control">
		                </div> 
	              	</div>
				</div>
			</div>
			<div class="x_panel">
				<div class="x_content">
					<div class="row">
		                <div class="col-md-12">
		                    <label>Price</label>
                            <input value="{{$product->price}}" name='price' type="text" placeholder="Price ..." class="form-control giatien">
		                </div>
		                <div class="col-md-12">
		                    <label> <input <?php if($product->old_price > 0){echo "checked";} ?> id="saleof" type="checkbox"> Sale of</label>
                            <input value="{{$product->old_price}}" id="price_old" name='old_price' type="text" placeholder="Sale of ..." class="form-control giatien1">
		                </div>
	              	</div>
				</div>
			</div>
		</div>

		<div class="col-md-3 col-sm-3 col-xs-3">
			<div class="x_panel">
				<div class="x_content">
					<div class="row">
		                <div class="col-md-12">
							<div class="file-upload">
								<button class="btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Add Image</button>
								<div class="image-upload-wrap">
									<input name="img" class="file-upload-input" type='file' onchange="readURL(this);" accept="image/*" />
								</div>
								<div class="file-upload-content" style="display: block;">
									<img class="file-upload-image" src="data/product/thumbnail/{{$product->img}}" />
								</div>
							</div>
			        	</div>
	              	</div>
				</div>
			</div>
			<div class="x_panel">
				<div class="row">
					<div class="col-md-12">
			            <label>Images</label>
	            		<div id="select-img">
	            			<div class="row">
            					<div class="col-md-9"><input onclick="BrowseServer();" type="text" placeholder="Click here" name="img" id="image" class="form-control"></div>
        						<div class="col-md-2"><button id="addimg" class="btn" type="button">ADD</button></div>
	            			</div>
	            			<div class="row box-img" id="scroll">
	            				@foreach($product_images as $product_image)
								<div class="col-md-6" id="product_image">
									<input type="hidden" name="id_img" value="{{$product_image->id}}" />
									<img src="{{$product_image->img}}">
									<button type="button" id="del"><i class="fa fa-trash-o"></i></button>
									<!-- <button type="button" id="edit">Edit</button> -->
								</div>
								@endforeach
	            			</div>
	            		</div>
		        	</div>
				</div>
			</div>
		</div>
	</div>
</div>
</form>


<script src="http://code.jquery.com/jquery-latest.js"></script>
<script>
$(document).ready(function(){
    $("input#saleof").click(function(){
        $("#price_old").toggleClass("display");
    });
});
</script>
<!-- add img -->
<script>
$(document).ready(function(){
    $("button#addimg").click(function(){
        var img = $(this).parents('#select-img').find('input[name="img"]').val();
        var pid = {{$product->id}}
        if (img == '') { alert('select iamges'); return false; };
        // alert(pid);
        $.ajax({
	        url:  'admin/ajax/addimg/'+pid,
	        type: 'GET',
	        cache: false,
	        data: {"pid":pid,"img":img},
	        success: function(data){
	            $('#select-img').html(data);
	        }
	    });
    });
});
</script>
<!-- add img -->
<!-- del img -->
<script>
$(document).ready(function(){
    $("button#del").click(function(){
        var id_img = $(this).parents('#product_image').find('input[name="id_img"]').val();
        var pid = {{$product->id}}
        // alert(id_img);
        $.ajax({
	        url:  'admin/ajax/delimg/'+id_img,
	        type: 'GET',
	        cache: false,
	        data: {"pid":pid, "id_img":id_img},
	        success: function(data){
	            $('#select-img').html(data);
	        }
	    });
    });
});
</script>
<!-- del img -->
<!-- edit img -->

<!-- edit img -->


<style type="text/css">
	@if($product->old_price > 0)
	#price_old{display: block;}
	.display{display: none !important;}
	@else
	#price_old{display: none;}
	.display{display: block !important;}
	@endif
	#product_image img{ width:100%; height: 70px; margin-bottom: 15px; position: relative; object-fit: cover;}
	#product_image #del{     position: absolute;
    top: 0;
    left: 10px;
    color: #fff;
    background-color: red;
    border: none;
    border-radius: 0px 0px 8px; }
	#product_image #edit{ position: absolute; top: 0; right: 5px; }
	.box-img{ max-height: 500px; overflow: auto;}
</style>

@endsection