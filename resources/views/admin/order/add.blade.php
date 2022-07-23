@extends('admin.layout.index')

@section('product') class="current-page" @endsection

@section('content')
<form action="admin/product/add" method="POST" enctype="multipart/form-data">
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
                            <input required name='name' type="text" placeholder="Name ..." class="form-control ">
		                </div>
			        	<div class="col-md-12">
				            <label>Content</label>
		            		<textarea name="content" class="form-control ckeditor"></textarea>
			        	</div>
	              	</div>
				</div>
			</div>
			<div class="x_panel">
				<div class="x_title">
					<h2>SEO option</h2>
					<ul class="nav navbar-right panel_toolbox">
						<li><a class="collapse-link">Click <i class="fa fa-chevron-down"></i></a></li>
					</ul>
					<div class="clearfix"></div>
				</div>
				<div class="x_content" style="display: none;">
					<div class="row">
						<div class="col-md-12">
		                    <label>Title</label>
                            <input name='title' type="text" placeholder="Name ..." class="form-control ">
		                </div>
		                <div class="col-md-12">
		                    <label>Description</label>
                            <input name='description' type="text" placeholder="Description ..." class="form-control">
		                </div>
		                <div class="col-md-12">
		                    <label>keywords</label>
                            <input name='keywords' type="text" placeholder="keywords ..." class="form-control">
		                </div>
		                <div class="col-md-6">
		                    <label>Robots</label>
                            <select name='robot' class="form-control">
								<option value="index, follow">index, follow</option>
								<option value="noindex, nofollow">noindex, nofollow</option>
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
                            <select required name='cat' class="form-control">
                            	<option value="">-- Select --</option>
                            	<?php addeditcat ($category,0,$str='',old('parent')); ?>
						  	</select>
		                </div>
		                
		                <div class="col-md-12">
		                    <label>Code</label>
                            <input name='code' type="text" placeholder="Code ..." class="form-control">
		                </div>
		                <div class="col-md-12">
		                    <label>Quantity</label>
                            <input name='quantity' type="number" placeholder="Quantity ..." class="form-control">
		                </div>
	              	</div>
				</div>
			</div>
			<div class="x_panel">
				<div class="x_content">
					<div class="row">
		                <div class="col-md-12">
		                    <label>Price</label>
                            <input name='price' type="text" placeholder="Price ..." class="form-control giatien">
		                </div>
		                <div class="col-md-12">
		                    <label><input id="saleof" type="checkbox"> Sale of</label>
                            <input id="price_old" name='old_price' type="text" placeholder="Sale of ..." class="form-control giatien1">
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
								<div class="file-upload-content">
									<img class="file-upload-image" src="#" />
								</div>
							</div>
			        	</div>
	              	</div>
				</div>
			</div>
		</div>
	</div>
</div>
</form>
<style type="text/css">
	#price_old{display: none;}
	.display{display: block !important;}
</style>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script>
$(document).ready(function(){
    $("input#saleof").click(function(){
        $("#price_old").toggleClass("display");
    });
});
</script>
@endsection

@section('function')
<?php 
	function addeditcat ($data, $parent=0, $str='',$select=0)
	{
		foreach ($data as $value) {
			if ($value['parent'] == $parent) {
				if($select != 0 && $value['id'] == $select )
				{ ?>
					<option value="<?php echo $value['id']; ?>" selected> <?php echo $str.$value['name']; ?> </option>
				<?php } else { ?>
					<option value="<?php echo $value['id']; ?>" > <?php echo $str.$value['name']; ?> </option>
				<?php }
				
				addeditcat ($data, $value['id'], $str.'__',$select);
			}
		}
	}
?>
@endsection