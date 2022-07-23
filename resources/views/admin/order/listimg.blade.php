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
        var pid = {{$pid}}
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
        var pid = {{$pid}}
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