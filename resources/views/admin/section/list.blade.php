@extends('admin.layout.index')

@section('home') class="active" @endsection

@section('content')
<?php use App\images; ?>
<form action="admin/section/add" method="POST" enctype="multipart/form-data">
<input type="hidden" name="_token" value="{{csrf_token()}}" />
<input type="hidden" name="hid" value="{{$home['id']}}" />

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            <button type="submit" class="btn btn-primary btn-sm"><i class='fa fa-save'></i> SAVE</button>
        </h1>
    </div>
</div>
@include('admin.errors.alerts')
<!-- /.row -->

<div class="row">
    <div class="col-lg-9">
        <div class="panel panel-default">
            <div class="panel-heading">
                {{$home->heading1}}
            </div>
            <div class="panel-body">
                <div class="row">
					<div class="col-md-12">
	                    <label>Name</label>
                        <input name='name' type="text" placeholder="name ..." class="form-control" />
	                </div>
                    
              	</div>
			</div>
		</div>

		<div class="panel panel-default">
            <div class="panel-body">
                <textarea name="content" class="form-control" id="ckeditor"></textarea>
            </div>
        </div>
        

	</div>
	<div class="col-lg-3">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="row">
	                <div class="col-md-12">
						<div class="file-upload">
							<button class="btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Add Image</button>
							<div class="image-upload-wrap">
								<input name="img" class="file-upload-input" type='file' onchange="readURL(this);" accept="image/*" />
							</div>
							<div class="file-upload-content" style="display: block;">
								<img class="file-upload-image" src="" />
							</div>
						</div>
		        	</div>
              	</div>
			</div>
		</div>
        
        <!-- end add img -->
	</div>
</div>
</form>

<style type="text/css">
    #cke_1_contents {
        height: 200px !important;
    }
</style>


@endsection
