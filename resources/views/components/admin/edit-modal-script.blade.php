<script>
    $(document).on('click' , '.edit_btn' , function(){
        let EditRoute = $(this).data('edit');
        $.ajax({
            'method':"GET",
            'url' : EditRoute,
            success : function(response){
                $('#update_form').find('input[name="name"]').val(response);
            }
        });
        let UpdateRoute = $(this).data('update');
        $('#update_form').attr('action' , UpdateRoute);

    });
    $(document).on('submit','#update_form' , function(e){
        e.preventDefault();
        $.ajax({
            method:"POST",
            url: $('#update_form').attr('action'),
            data:{
                '_token' : '{{ csrf_token() }}',
                '_method' : 'PUT',
                'name' : $('#update_form').find('input[name="name"]').val()
            },
            success : function(response){
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

</script>