@extends('layouts.app')

@section('title', 'Invoice Detail')

@section('content')
    <section class="section">
        <div class="section-body">
            <div class="invoice">
                <div class="invoice-print">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="invoice-title">
                                <h2>Invoice</h2>
                                <div class="invoice-number">#{{ $order->invoice }}</div>
                            </div>
                            <hr>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="section-title">Order Summary</div>
                            <p class="section-lead">All items here cannot be deleted.</p>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-md">
                                    <tr>
                                        <th data-width="40">#</th>
                                        <th>Item</th>
                                        <th class="text-center">Price</th>
                                        <th class="text-center">Quantity</th>
                                        <th class="text-right">Totals</th>
                                    </tr>
                                    @foreach($order->details as $index => $item)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $item->product->name }}</td>
                                            <td class="text-center">${{ $item->price }}</td>
                                            <td class="text-center">{{ $item->quantity }}</td>
                                            <td class="text-right">${{ $item->subtotal }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                            <div class="row mt-4">
                                <div class="col-lg-8">
                                    <div class="section-title">Payment Method</div>
                                    <p class="section-lead">Payment method you using is {{ $order->payment_method }}</p>

                                </div>
                                <div class="col-lg-4 text-right">
                                    <hr class="mt-2 mb-2">
                                    <div class="invoice-detail-item">
                                        <div class="invoice-detail-name">Total</div>
                                        <div class="invoice-detail-value invoice-detail-value-lg">
                                            ${{ $order->total }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="text-md-right">
                    @if($order->stripe_receipt_url)
                        <a href="{{ $order->stripe_receipt_url }}" class="btn btn-warning btn-icon icon-left"><i
                                class="fas fa-print"></i> Print</a>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="{{ asset('js/modules/datatables.min.js') }}"></script>
    <script src="{{ asset('js/modules/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#transaction-datatable').dataTable({
                serverSide: true,
                ajax: '{{ route('member.datatable.transaction') }}',
                columns: [
                    {name: 'id', data: 'DT_RowIndex'},
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
