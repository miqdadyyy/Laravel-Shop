<div class="card">
    <div class="card-header">
        <h4>Products</h4>
        <a href="{{ route('admin.product.create') }}" class="btn btn-primary ml-4">Add Product</a>
    </div>
    <div class="card-body">
        <div class="">
            <table class="table table-striped" id="product-datatable">
                <thead>
                <tr>
                    <th class="text-center">
                        #
                    </th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Ordered</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    <form action="" method="post" id="delete-product-form">
        @csrf
        @method('DELETE')
    </form>
</div>

@push('scripts')
    <script src="{{ asset('js/modules/datatables.min.js') }}"></script>
    <script src="{{ asset('js/modules/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            var t = $('#product-datatable').dataTable({
                serverSide: true,
                ajax: '{{ $datatableApiUrl }}',
                columns: [
                    {name: 'id', data: 'DT_RowIndex'},
                    {name: 'name', data: 'name'},
                    {name: 'category.name', data: 'category.name'},
                    {name: 'price', data: '_price'},
                    {name: 'stock', data: '_stock'},
                    {name: 'order_details_count', data: '_order_count', searchable: false},
                    {name: '_action', data: '_action', sortable: false, searchable: false},
                ]
            })

            $('#product-datatable').on('click', '.btn--delete', function(){
                $.ajax($(this).data('url'), {
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    }
                });

                t.ajax.reload();
            })
        });
    </script>
@endpush

