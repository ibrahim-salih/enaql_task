<table class="table" id="datatable">
    <thead>
        <tr>
            <th>#</th>
           @foreach($columns as $column)
                <th>{{ __('admin.' . $column) }}</th>
           @endforeach
        </tr>
    </thead>
</table>