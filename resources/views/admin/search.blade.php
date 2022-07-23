@foreach($articles as $val)
<div class="col-md-3">
    <a href=""> <img src="data/news/300/{{$val->img}}" alt=""> </a>
    <div class="info">
        <h2><a href="">banner</a></h2>
        <p>{{date('d/m/Y',strtotime($val->updated_at))}}</p>
    </div>
</div>
@endforeach

<script type="text/javascript">
    $(document).ready(function(){
        // $("input.button_submit").blur(function(){
        $("input.button_submit").click(function(){
            $.ajax({
                url:  'admin/dashboard/search',
                type: 'POST',
                cache: false,
                data: $('form').serialize(),
                success: function(data){
                    $('#data').html(data);
                }
            });
        });
    });
</script>