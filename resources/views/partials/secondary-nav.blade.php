<div class="container">
    <ul class="navbar-nav">
        @if(Request::is('shop*'))
            <li class="nav-item">
                <a href="{{ route('homepage') }}" class="nav-link"><i class="far fa-heart"></i><span>Category List</span></a>
            </li>
            <li class="nav-item">
                <a href="{{ route('homepage.product-list') }}" class="nav-link"><i class="far fa-box"></i><span>Product List</span></a>
            </li>
        @else
            @role('admin')
            <li class="nav-item {{ Route::is('admin.transaction*') ? 'active' : '' }}">
                <a href="{{ route('admin.transaction.index') }}" class="nav-link"><i class="fa fa-dollar-sign"></i><span>Transactions</span></a>
            </li>
            <li class="nav-item {{ Route::is('admin.product*') ? 'active' : '' }}">
                <a href="{{ route('admin.product.index') }}" class="nav-link"><i class="fa fa-box"></i><span>Product</span></a>
            </li>
            <li class="nav-item {{ Route::is('admin.customer*') ? 'active' : '' }}">
                <a href="{{ route('admin.customer.index') }}" class="nav-link"><i class="fa fa-user"></i><span>Customers</span></a>
            </li>
            @elserole('member')
            <li class="nav-item {{ Route::is('member.transaction*') ? 'active' : '' }}">
                <a href="{{ route('member.transaction.index') }}" class="nav-link"><i class="far fa-heart"></i><span>My Transactions</span></a>
            </li>
            @endrole
        @endif
    </ul>
</div>
