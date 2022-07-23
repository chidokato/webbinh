<?php $stt = count($product); ?>
	@foreach($product as $val)
	<tr class="img">
		<td class="text-center">{{$stt}}</td>
		<td class="img"><img src="data/product/thumbnail/{{$val->img}}"></td>
		<td>{{$val->name}}</td>
		<td>@if(isset($val->category->name)) {{$val->category->name}} @endif </td>
		<td class="text-center">
			<input id="status" name="status" <?php if($val->status == 'true'){echo "checked";} ?> type="checkbox"  />
		</td>
		<td>{{number_format($val->price)}}đ</td>
		<td>{{$val->date_up}} <i>({{$val->date}})</i></td>
		<td  class="text-center">
			<a href="admin/product/edit/{{$val->id}}">
				<i class="fa fa-pencil"></i> sửa
			</a> |
			<a onClick="javascript:return window.confirm('Bạn muốn xóa sản phẩm này?');" href="admin/product/delete/{{$val->id}}">
				<i class="fa fa-trash-o"></i> xóa
			</a>
		</td>
	</tr>
	<?php $stt = $stt-1; ?>
	@endforeach