@extends('layouts.app')

@section('title', $product->name)

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ $product->name }}</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <img src="{{ $product->thumbnail }}" alt="" class="w-100">
                        </div>
                        <div class="col-9">
                            {{ $product->description }}
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <b>Price : {{ $product->price }}</b>
                    <button class="btn btn-success float-right btn--add-product" data-id="{{ $product->id }}"><i class="fa fa-cart-plus"></i> Add to cart</button>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function(){
            $('.btn--add-product').click(function(){
                Livewire.emit('add-item-to-cart', $(this).data('id'));
            })
        })
    </script>
@endpush
