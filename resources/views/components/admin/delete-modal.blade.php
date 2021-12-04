<!-- Delete Modal-->
<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('admin.delete')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="fas fa-times-circle text-primary"></i>
                </button>
            </div>
            <form action="" method="post" action="" id="delete_form">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <div class="alert" role="alert">
                        <div class="alert-text">{{__('admin.delete_modal')}}</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary font-weight-bold" data-dismiss="modal">{{__('admin.close')}}</button>
                    <button type="submit" class="btn btn-danger font-weight-bold">{{__('admin.confirm')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>