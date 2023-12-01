<li class="nav-item p-2">
    <a class="nav-link  <?= $title == 'Dashboard' ? 'text-primary' : 'text-muted' ?>"
        href="{{ route('products.index') }}">
        <span class="nav-link-title">
            Dashboard
        </span>
    </a>
</li>

<li class="nav-item p-2">
    <a class="nav-link  <?= $title == 'Category' ? 'text-primary' : 'text-muted' ?>"
        href="{{ route('category.index') }}">
        <span class="nav-link-title">
            Category
        </span>
    </a>
</li>

<li class="nav-item p-2">
    <a class="nav-link <?= $title == 'Customer' ? 'text-primary' : 'text-muted' ?>"
        href="{{ route('customer.index') }}">
        <span class="nav-link-title">
            Customer
        </span>
    </a>
</li>

<li class="nav-item p-2">
    <a class="nav-link <?= $title == 'Order' ? 'text-primary' : 'text-muted' ?>"
        href="{{ route('order.index') }}">
        <span class="nav-link-title">
            Order 
        </span>
    </a>
</li>

<li class="nav-item p-2">
    <a class="nav-link <?= $title == 'Order Detail' ? 'text-primary' : 'text-muted' ?>"
        href="{{ route('orderdetail.index') }}">
        <span class="nav-link-title">
            Order Detail
        </span>
    </a>
</li>