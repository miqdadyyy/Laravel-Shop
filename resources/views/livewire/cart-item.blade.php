<div class="card">
    <div class="card-body">
        <div class="row">
            @foreach($cart->details as $item)
                <div class="col-12 mb-5 author-box">
                    <div class="author-box-left">
                        <img alt="image" src="{{ $item->product->thumbnail }}" class="author-box-picture">
                        <div class="clearfix"></div>
                    </div>
                    <div class="author-box-details">
                        <div class="author-box-name">
                            <a href="{{ route('homepage.product-detail', $item->product) }}">{{ $item->product->name }}</a>
                            <div class="float-right">
                                <button class="btn btn-icon btn-sm btn-danger mr-2" wire:click="substractQuantity({{ $item->product->id }})"><i class="fas fa-minus"></i></button>
                                {{ $item->quantity }}
                                <button class="btn btn-icon btn-sm btn-success ml-2" wire:click="addQuantity({{ $item->product->id }})"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                        <div class="author-box-job">{{ $item->product->category->name }}</div>
                        <div class="author-box-description">
                            <p>{{ \Illuminate\Support\Str::limit($item->product->description, 100) }}</p>
                        </div>

                        <div class="w-100 d-sm-none"></div>
                        <b>Subtotal : ${{ $item->subtotal }}</b>
                        <div class="float-right mt-sm-0 mt-3">
                            <button wire:click="deleteFromCart({{ $item->product->id }})" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</button>
                            <a href="{{ route('homepage.product-detail', $item->product) }}" class="btn btn-primary">Detail Product <i class="fas fa-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
                <hr>
            @endforeach
        </div>
    </div>
    <div class="card-footer">
        <h4>Total : ${{ $cart->total }}</h4>
    </div>
</div>
