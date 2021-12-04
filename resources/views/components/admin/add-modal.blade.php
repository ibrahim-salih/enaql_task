<!-- Modal -->
<div class="modal fade" id="AddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{ $title }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ $action }}" method="post" id="add_form">
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-2">
                        <label for="name">{{ __('admin.name') }}</label>
                    </div>
                    <div class="col-md-10">
                        <input type="text" name="name" id="name" class="form-control">
                    </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('admin.close') }}</button>
                <button type="submit" class="btn btn-primary">{{ __('admin.add') }}</button>
              </div>
        </form>
    
      </div>
    </div>
  </div>