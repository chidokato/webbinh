<tr>
	<td><input class="form-control" placeholder="name" type="text" id='addname'></td>
	<td></td>
</tr>
@foreach($channel as $val)
<tr id='parent'>
	<td > <input name='name' value='{{$val->name}}' type='text' class="name form-control" id='name'> <input type="hidden" id="cn_id" value="{{$val->id}}" /> </td>
	<td><i id='del' class="fa fa-trash-o"></i></td> 
</tr>
@endforeach



<script>
// thêm kênh bán hàng
$(document).ready(function(){
    $("input#addname").blur(function(){
        var name = $(this).val();
        $.ajax({
            url:  'admin/ajax/addchannel/'+name,
            type: 'GET',
            cache: false,
            data: {
                "name":name,
            },
			success: function(data){
                $('#foreachchannel').html(data);
            }
        });
    });
});
// thêm kênh bán hàng

// sửa kênh bán hàng
$(document).ready(function(){
    $("input#name").blur(function(){
        var name = $(this).val();
        var id = $(this).parents('#parent').find('input[id="cn_id"]').val();
        //alert(id);
        $.ajax({
            url:  'admin/ajax/updatechannelname/'+id,
            type: 'GET',
            cache: false,
            data: {
                "name":name,
                "id":id
            },
			success: function(data){
                $('#listchannel').html(data);
            }
        });
    });
});
// sửa kênh bán hàng

// xóa kênh bán hàng
$(document).ready(function(){
    $("i#del").click(function(){
        var id = $(this).parents('#parent').find('input[id="cn_id"]').val();
        //alert(id);
        $.ajax({
            url:  'admin/ajax/delchannel/'+id,
            type: 'GET',
            cache: false,
            data: {
                "id":id
            },
			success: function(data){
                $('#foreachchannel').html(data);
            }
        });
    });
});
// xóa kênh bán hàng
</script>