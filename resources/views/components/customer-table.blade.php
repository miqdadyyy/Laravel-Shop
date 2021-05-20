<div class="card">
    <div class="card-header">
        <h4>Customers</h4>
    </div>
    <div class="card-body">
        <div class="">
            <table class="table table-striped" id="customer-datatable">
                <thead>
                <tr>
                    <th class="text-center">
                        #
                    </th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Total Order</th>
                    <th>Joined at</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
    <script src="{{ asset('js/modules/datatables.min.js') }}"></script>
    <script src="{{ asset('js/modules/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#customer-datatable').dataTable({
                serverSide: true,
                ajax: '{{ $datatableApiUrl }}',
                columns: [
                    {name: 'id', data: 'DT_RowIndex'},
                    {name: 'name', data: 'name'},
                    {name: 'email', data: 'email'},
                    {data: 'orders_count', sortable: false, searchable: false},
                    {name: 'created_at', data: 'joined_at'},
                    {name: '_action', data: '_action', sortable: false, searchable: false},
                ]
            })
        });
    </script>
@endpush

