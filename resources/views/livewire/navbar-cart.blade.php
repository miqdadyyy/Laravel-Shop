<div class="dropdown-menu dropdown-list dropdown-menu-right">
    <div class="dropdown-header">Notifications
        <div class="float-right">
            <a href="#" wire:click="clearCart">Clear Cart</a>
        </div>
    </div>
    <div class="dropdown-list-content dropdown-list-icons">
        @foreach($cart->details as $detail)
            <a href="#" class="dropdown-item dropdown-item-unread">
                <div class="dropdown-item-icon bg-primary text-white">
                    <i class="fas fa-code"></i>
                </div>
                <div class="dropdown-item-desc">
                    {{ $detail->product->name }} ({{ $detail->quantity }})

                    <div class="time text-primary">{{ $detail->updated_at->diffForHumans() }}</div>
                </div>

            </a>
        @endforeach
    </div>
    <div class="dropdown-footer text-center">
        <a href="{{ route('cart.index') }}">View All <i class="fas fa-chevron-right"></i></a>
    </div>
</div>
