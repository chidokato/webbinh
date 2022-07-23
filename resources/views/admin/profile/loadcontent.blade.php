@foreach($tacvu as $val)
<tr>
	<td></td>
	<td>@if(isset($val->duan->name)) {{$val->duan->name}} @else <span style="color: red">Trống</span> @endif</td>
	<td>@if(isset($val->chinhanh->name)) {{$val->chinhanh->name}} @else <span style="color: red">Trống</span> @endif</td>
	<td>@if(isset($val->kenh->name)) {{$val->kenh->name}} @else <span style="color: red">Trống</span> @endif</td>
	<td>@if(isset($val->nhacungcap->name)) {{$val->nhacungcap->name}} @else <span style="color: red">Trống</span> @endif</td>
	<td <?php if($val->price != $val->price1) {echo "style='color: red'";} ?> >{{ number_format($val->price) }}đ</td>
	<td <?php if($val->price != $val->price1) {echo "style='color: red'";} ?> >{{ number_format($val->price1) }}đ</td>
	<td class='suagia'>
		<input type="hidden" name="bc" value="{{$val->bc_id}}" />
		<input type="hidden" name="cn" value="{{$val->cn_id}}" />
		<input type="hidden" name="da" value="{{$val->da_id}}" />
		<input type="hidden" name="kc" value="{{$val->kc_id}}" />
		<input type="hidden" name="tv_id" value="{{$val->id}}" />
		<input type="hidden" name="p_old" value="{{$val->price2}}" />
		<input id="clickupdate" style="width: 100px" type="number" name="price" value="{{$val->price2}}">
		@if($val->price2 != 0) <i style="color: #1abb9c" class="fa fa-check"></i> @endif
	</td>
	<td>{{$val->name}}</td>
	<td>{{$val->ngaybatdau}}</td>
	<td>{{$val->ngayketthuc}}</td>
	<td class="text-center">{{$val->date}}</td>
</tr>
@endforeach



<script src="http://code.jquery.com/jquery-latest.js"></script>
<script>
$(document).ready(function(){
    $("input#clickupdate").blur(function(){
    	// alert('ok');
        var bc = $(this).parents('.suagia').find('input[name="bc"]').val();
        var cn = $(this).parents('.suagia').find('input[name="cn"]').val();
        var da = $(this).parents('.suagia').find('input[name="da"]').val();
        var kc = $(this).parents('.suagia').find('input[name="kc"]').val();
        var tv_id = $(this).parents('.suagia').find('input[name="tv_id"]').val();
        var p_old = $(this).parents('.suagia').find('input[name="p_old"]').val();
        var price = $(this).parents('.suagia').find('input[name="price"]').val(); if(price == ''){ price = 0 }
    	// alert(price);
        $.ajax({
            url:  'admin/profile/update/'+tv_id,
            type: 'GET',
            cache: false,
            data: {
            	"bc":bc,
            	"cn":cn,
            	"da":da,
            	"kc":kc,
            	"p_old":p_old,
            	"price":price
            },
            success: function(data){
                $('#content').html(data);
            }
        });
    });
});
</script>