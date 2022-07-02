<table id="mainTable" class="table table-striped">
    <thead>
        <tr>
            <th>Photo</th>
            <th>Product</th>
            <th>Unit Price</th>
            <th>Quantity</th>
            <th>Total</th>
            <th><box-icon name='trash-alt'></box-icon></th>
        </tr>
    </thead>
    <tbody>
       @foreach (Cart::instance('shopping')->content() as $item)
       <tr>
        <th><img src="{{ $item->model->photo }}" alt="{{ $item->model->title }}" style="height:50px; width:80px"></th>
        <th><a href="{{ route('product.detail', $item->model->slug) }}">{{ $item->name }}</a></th>
        <th>${{ number_format($item->price,2) }}</th>
        <th>
            <div class="quantity">
                <input type="number" data-id="{{ $item->rowId }}" class="qty-text" name="quantity" id="qty-input-{{ $item->rowId }}" step="1" min="1" max="99" value="{{ $item->qty }}">
                <input type="hidden" data-id="{{ $item->rowId }}" data-product-quantity="{{ $item->model->stock }}" id="update-cart-{{ $item->rowId }}">
            </div>
        </th>
        <th>${{ number_format($item->subtotal(),2) }}</th>
        <th><box-icon name='x' data-id="{{ $item->rowId }}" class="cart_delete"></box-icon></th>
    </tr>
       @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th><strong>Total</strong></th>
            <th></th>
            <th></th>
            <th>{{ Cart::instance('shopping')->count() }}</th>
            <th>
                @if (session()->has('coupon'))
                    @if (session('coupon')['value'] > number_format(Cart::subtotal()))
                        <span>$0</span>
                    @else
                        <span>${{ filter_var(Cart::subtotal(), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) - session('coupon')['value'] }}</span>
                    @endif
                @else
                    <span>${{ number_format(Cart::subtotal(), 2) }}</span>
                @endif
</th>
            <th><box-icon name='trash-alt'></box-icon></th>
        </tr>
    </tfoot>
</table>