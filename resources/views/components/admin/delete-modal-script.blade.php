<script>

    $(document).on('click' , '.delete_btn' , function(){
        let route = $(this).data('route');
        $('#delete_form').attr('action' , route);
    });
    $(document).on('submit','#delete_form' , function(e){
        e.preventDefault();
        $.ajax({
            method:"DELETE",
            url: $('#delete_form').attr('action'),
            data:{
                '_token' : '{{ csrf_token() }}'
            },
            success : function(response){
                $('.modal').modal('hide');
                toastr.success(response);
                $('table').DataTable().ajax.reload();
            }
        })
    })

</script>