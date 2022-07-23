

<textarea class="form-control ckeditor" id="ckeditor"></textarea>


<script type="text/javascript">
	$('button#del_section').on('click', function(){
        var id = $(this).parents('#section_list').find('input[id="section_id"]').val();
        // alert(section_id);
        $.ajax({
            url:  'admin/ajax/del_section/'+id, type: 'GET', cache: false, data: {"id":id},
        });
        $(this).closest("#section_list").remove();
    });
</script>

