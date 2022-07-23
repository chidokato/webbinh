<div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
<form id="add_section" action="admin/product/add_section" method="POST" enctype="multipart/form-data">
<input type="hidden" name="_token" value="{{csrf_token()}}" />
<input type="hidden" name="articles_id" value="{{ isset($data) ? $data->id : '' }}" />
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content" id="data_add_section">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Thêm</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<div class="row" >
<div class="col-md-1">
<div class="form-group">
<label>Stt</label>
<input name="number" type="text" class="form-control" >
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label>Tab</label>
<input name="tab_section" type="text" class="form-control" >
</div>
</div>
<div class="col-md-8">
<div class="form-group">
<label>Tiêu đề</label>
<input name="heading" type="text" class="form-control" >
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<label>Content</label>
<textarea class="form-control ckeditor" id="ckeditor"></textarea>
</div>
</div>
<div class="col-md-8">
<div class="form-group">
<label>Hình ảnh</label>
<input name="img[]" multiple type="file" class="form-control">
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label>Cách hiển thị</label>
<select class="form-control">
<option>adasd</option>
<option>adasd</option>
<option>adasd</option>
</select>
</div>
</div>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
<button id="save_section" type="submit" class="btn btn-primary">Save</button>
</div>
</div>
</div>
</form>
</div>


<div class="modal fade" id="add_category" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
<form action="" method="POST" >
	<input type="hidden" name="_token" value="{{csrf_token()}}" />
	<div class="modal-dialog " role="document">
		<div class="modal-content" id="data_add_section">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Thêm</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row" >
					<div class="col-md-12">
						<div class="form-group">
							<label>Tên danh mục</label>
							<input name="heading" type="text" class="form-control" >
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button id="save_section" type="submit" class="btn btn-primary">Save</button>
			</div>
		</div>
	</div>
</form>
</div>