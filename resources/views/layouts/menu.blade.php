<li class="{{ Request::is('buys*') ? 'active' : '' }}">
    <a href="{{ route('buys.index') }}"><i class="fa fa-edit"></i><span>Buys</span></a>
</li>

<li class="{{ Request::is('products*') ? 'active' : '' }}">
    <a href="{{ route('products.index') }}"><i class="fa fa-edit"></i><span>Products</span></a>
</li>

