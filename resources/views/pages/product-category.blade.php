@extends('layouts.app')

@section('title', 'Homepage')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Ecommerce </h1>
        </div>

        <div class="section-body">
            <h2 class="section-title">{{ $category ? $category->name : 'Product List' }}</h2>
            <p class="section-lead">If you not buy something on my website, i'll delete your minecraft account</p>
            <div class="row">
                @foreach($products as $product)
                    <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                        <article class="article article-style-b">
                            <div class="article-header">
                                <div class="article-image" data-background="{{ $product->thumbnail }}" style="background-image: url({{ $product->thumbnail }});">
                                </div>
                                <div class="article-badge">
                                    <div class="article-badge-item bg-primary"><i class="fa fa-dollar-sign"></i> {{ $product->price }}</div>
                                </div>
                            </div>
                            <div class="article-details">
                                <div class="article-title">
                                    <h2><a href="{{ route('homepage.product-detail', $product) }}">{{ $product->name }}</a></h2>
                                </div>
                                <p>{{ \Illuminate\Support\Str::limit($product->description, 100) }}</p>
                                <div class="article-cta">
                                    <button class="btn btn-success btn--add-product" id="add-to-cart-btn" data-id="{{ $product->id }}">
                                        <i class="fa fa-cart-plus"></i>
                                    </button>
                                    <a href="{{ route('homepage.product-detail', $product) }}" class="btn btn-primary">Detail</a>
                                </div>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
            {{ $products->links() }}
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
