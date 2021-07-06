<li class="{{ (request()->is('home')) ? 'active' : '' }}">
    <a href="{!! route('home') !!}"><i class="fa fa-tachometer"></i> <span class="nav-label">Dashboard</span></a>
</li>

@if(auth()->user()->hasRole('loan-provider'))


<li class="{{ (request()->is('products*')) ? 'active' : '' }}">
    <a href="#"><i class="fa fa-bank"></i> <span class="nav-label">Loan Products</span><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level collapse">
        <li class="{{ (request()->is('products')) ? 'active' : '' }}"><a href="{!! route('products.index') !!}">List</a></li>
        <li class="{{ (request()->is('products/create')) ? 'active' : '' }}"><a href="{!! route('products.create') !!}">Create</a></li>
    </ul>
</li>


@endif

@if(auth()->user()->hasRole('farmer'))

    <li class="{{ (request()->is('loan/product/list')) ? 'active' : '' }}">
        <a href="{!! route('loan-product-list') !!}"><i class="fa fa-list"></i> <span class="nav-label">Loan Products</span></a>
    </li>

    <li class="{{ (request()->is('loan')) ? 'active' : '' }}">
        <a href="{!! route('loan-product-list') !!}"><i class="fa fa-money"></i> <span class="nav-label">Loans</span></a>
    </li>

{{--    <li class="{{ (request()->is('products*')) ? 'active' : '' }}">--}}
{{--        <a href="#"><i class="fa fa-bank"></i> <span class="nav-label">Loan Selector</span><span class="fa arrow"></span></a>--}}
{{--        <ul class="nav nav-second-level collapse">--}}
{{--            <li class="{{ (request()->is('products')) ? 'active' : '' }}"><a href="{!! route('products.index') !!}">List</a></li>--}}
{{--            <li class="{{ (request()->is('products/create')) ? 'active' : '' }}"><a href="{!! route('products.create') !!}">Create</a></li>--}}
{{--        </ul>--}}
{{--    </li>--}}

@endif
