@extends('layouts.app')

@section('title', 'Homepage')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Ecommerce </h1>
        </div>

        <div class="section-body">
            <h2 class="section-title">Product Category</h2>
            <p class="section-lead">If you not buy something on my website, i'll delete your minecraft account</p>
            <div class="row">
                @foreach($product_categories as $category)
                    <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                        <article class="article">
                            <div class="article-header">
                                <div class="article-image" data-background="https://picsum.photos/200"
                                     style="background-image: url(https://picsum.photos/200);">
                                </div>
                                <div class="article-title">
                                    <h2><a href="#">{{ $category->name }}</a></h2>
                                </div>
                            </div>
                            <div class="article-details">
                                <p>Duis aute irure dolor in reprehenderit in voluptate velit esse
                                    cillum dolore eu fugiat nulla pariatur. </p>
                                <div class="article-cta">
                                    <a href="{{ route('homepage.product-list', $category) }}" class="btn btn-primary">Show Product</a>
                                </div>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
