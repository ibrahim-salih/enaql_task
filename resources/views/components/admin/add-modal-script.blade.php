<script>
    $(function(){
        $('#add_form').on('submit',function(e){
            e.preventDefault();
            var name = $(this).find('input[name="name"]').val();
            var action = $(this).attr('action');
            console.log(action);
            $.ajax({
                method:"POST",
                url : action,
                data:{
                    '_token' : '{{ csrf_token() }}',
                    'name' : name
                },
                success : function(response){
                    console.log(response);
                    $('.modal').modal('hide');
                    toastr.success(response);
                    $('table').DataTable().ajax.reload();
                },
                error: function (xhr) {
                    $.each(xhr.responseJSON.errors, function(key,value) {
                        toastr.error(value);
                    }); 
                },
            })
        })
    })
</script>