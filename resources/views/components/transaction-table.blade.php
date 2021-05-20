<div class="card">
    <div class="card-header">
        <h4>Transactions</h4>
    </div>
    <div class="card-body">
        <div class="">
            <table class="table table-striped" id="transaction-datatable">
                <thead>
                <tr>
                    <th class="text-center">
                        #
                    </th>
                    <th>User</th>
                    <th>Invoice</th>
                    <th>Payment Method</th>
                    <th>Status</th>
                    <th>Order At</th>
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
            $('#transaction-datatable').dataTable({
                serverSide: true,
                ajax: '{{ $datatableApiUrl }}',
                columns: [
                    {name: 'id', data: 'DT_RowIndex'},
                    {name: 'user.name', data: 'user.name'},
                    {name: 'invoice', data: 'invoice'},
                    {name: 'payment_method_code', data: '_payment'},
                    {name: 'paid_at', data: '_status'},
                    {name: 'created_at', data: 'order_at'},
                    {name: '_action', data: '_action', sortable: false, searchable: false},
                ]
            })
        });
    </script>
@endpush

