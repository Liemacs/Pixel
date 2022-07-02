<table id="mainTable" class="table table-striped">
   

    @if (Cart::instance('wishlist')->count() > 0)
    <thead>
        <tr>
            <th>Photo</th>
            <th>Product</th>
            <th>Unit Price</th>
            <th>
                <box-icon name='trash-alt'></box-icon>
            </th>
            <th></th>
        </tr>
    </thead>
        <tbody>
            @foreach (Cart::instance('wishlist')->content() as $item)
                <tr>
                    <th><img src="{{ $item->model->photo }}" alt="{{ $item->model->title }}"
                            style="height:50px; width:80px"></th>
                    <th><a href="{{ route('product.detail', $item->model->slug) }}">{{ $item->name }}</a>
                    </th>
                    <th>${{ number_format($item->price, 2) }}</th>
                    
                    <th>
                        <i class='bx bx-x delete_wishlist' data-id="{{ $item->rowId }}"></i>
                    </th>
                    <th><a href="javascript:void(0);" data-id="{{ $item->rowId }}" class="move-to-cart btn btn-primary">ADD TO CART</a></th>
                </tr>
            @endforeach
        </tbody>
    @else
        <p>Wishlist is empty</p>
    @endif


</table>