<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.colVis.min.js"></script>

 <script>
    $(function() {
        var columns = [{data: 'DT_RowIndex', name:'DT_RowIndex', orderable: false, searchable: false}];
        @foreach($columns as $column)
            columns.push({
                data : "{{ $column }}",
                name : "{{ $column }}",
            })
        @endforeach
        $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            // responsive:true,
            dom: 'Bfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5',
                'colvis'
            ],
            @if(LaravelLocalization::getCurrentLocale() == 'ar')
            language: {
                "url": "{{asset('assets/plugins/datatable/Arabic.json')}}"
            },
            @endif
            ajax: '{{ $route }}',
            columns:columns
        });
    });
</script>


