<div class="col-md-6 form-group">
    <label>Kênh bán hàng</label>
    <select required name="ch_id" class="form-control  select2">
        @foreach($channel as $val)
    	<option value="{{$val->id}}">{{$val->name}}</option>
    	@endforeach
    </select>
</div>
<div class="col-md-6 form-group">
    <label>Ngày bán hàng</label>
    <input name="date" type="date" value="{{ date('Y-m-d') }}" class="form-control " />
</div>