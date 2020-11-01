<li class="{{ Request::is('*not*') ? 'active' : '' }}">
    <a href="{{ route('buys.not_delivered') }}"><i class="fa fa-edit"></i><span>Encomendas Pendentes</span></a>
</li>

<li class="{{ Request::is('*/delivered*') ? 'active' : '' }}">
    <a href="{{ route('buys.delivered') }}"><i class="fa fa-edit"></i><span>Encomendas Entregues</span></a>
</li>

<li class="{{ Request::is('products*') ? 'active' : '' }}">
    <a href="{{ route('products.index') }}"><i class="fa fa-edit"></i><span>Produtos</span></a>
</li>
