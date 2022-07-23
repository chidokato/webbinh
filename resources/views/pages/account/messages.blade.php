@extends('layout.index')

@section('title')  @endsection
@section('description')  @endsection
@section('keywords')  @endsection
@section('robots')  @endsection
@section('url')  @endsection

@section('content')

@include('layout.header_page')

<div class="form-sign profile" style="background: url(images/slider/notgeneric_bg3.jpg);">
	<div class="form">
		<div class="accordion text-left">
			<a href="check_messages/{{Auth::User()->id}}"><button type="button" class="btn btn-xs mr-3"><i class="icon-check"> </i> Đã đọc tất cả</button></a>
			<a href="delall_messages/{{Auth::User()->id}}" onclick="dell()" ><button type="button" class="btn btn-xs btn-pinterest"><i class="icon-trash-2"></i> Xóa tất cả</button></a>
			<hr>
			@if(count($messages) > 0)
				@foreach($messages as $val)
				<div id="messages" class="ac-item {{ $val->status == 'acctive' ? '' : 'acctive' }} ">
					<input type="hidden" name="id" id="id" value="{{$val->id}}" />
					<h5 class="ac-title">{{$val->name}}</h5>
					<div class="ac-content" style="display: none;">
						{!! $val->content !!}
						<div class="text-right">
							<span><i class="icon-calendar"></i> {{date('d/m/Y',strtotime($val->created_at))}}</span>
							<button id="del_messages" type="button" class="btn btn-xs btn-pinterest ml-3"><i class="icon-trash-2"></i>Xóa</button>
						</div>
					</div>
				</div>
				@endforeach
				@else
				<p>Bạn không có thông báo nào !</p>
			@endif
		</div>
	</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
  	$('h5.ac-title').click(function(e){
	  	$(this).parent().removeClass('acctive');
	  	var id = $(this).parents('#messages').find('input[id="id"]').val();
	  	$.ajax({
            url:  'update_status_messages/'+id, type: 'GET', cache: false, data: {},
        });
	});

	$('button#del_messages').click(function(e){
	  	var id = $(this).parents('#messages').find('input[id="id"]').val();
	  	$.ajax({
            url:  'del_messages/'+id, type: 'GET', cache: false, data: {},
        });
 		$(this).parents('#messages').hide();
	});

	function dell() {alert("Bạn có chắc muốn xóa bản ghi!");}
});



</script>
@endsection