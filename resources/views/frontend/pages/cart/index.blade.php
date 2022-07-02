@extends('frontend.layouts.master')

@section('content')
    <div class="body">
        <div class="table-responsive" id="cart_list">
            @include('frontend.layouts._cart-lists')
        </div>
    </div>
    <div class="cart-total-area">
        <h5>Cart total</h5>
        <table>
            <tbody>
                <tr>
                    <td>Sub Total:</td>
                    <td>${{ Cart::subtotal(),2 }}</td>
                </tr>
                <tr>
                    <td>Save Amount:</td>
                    <td>$@if (Session::has('coupon'))
                            {{ number_format(Session::get('coupon')['value']) }}
                        @else
                            <span>0</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Total:</td>
                    @if (Session::has('coupon'))
                    <td>${{ filter_var(Cart::subtotal(), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION)-Session::get('coupon')['value'] }}</td>
                    @else
                    <td>${{ Cart::subtotal() }}</td>
                    @endif
                </tr>
            </tbody>
        </table>
    </div>
    <div class="coupon-form">
        <form action="{{ route('coupon.add') }}" id="coupon-form" method="POST" autocomplete="off">
            @csrf
            <input type="text" class="form-control" name="code" placeholder="Enter the coupon">
            <button type="submit" class="btn btn-primary coupon-btn">Apply Coupon</button>
        </form>
    </div>
    <div class="checkout_box">
        <a href="{{ route('checkout1') }}" class="btn btn-primary">Proceed to Checkout</a>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).on('click', '.coupon-btn', function(e) {
            e.preventDefault();
            var code = $('input[name=code]').val();
            $('.coupon-btn').html("<i class='bx bx-loader-circle bx-spin' ></i> Applying");
            $('#coupon-form').submit();
        })
    </script>
    <script>
        $(document).on('click', '.cart_delete', function(e) {
            e.preventDefault();
            var cart_id = $(this).data('id');
            var token = "{{ csrf_token() }}";
            var path = "{{ route('cart.delete') }}";

            $.ajax({
                url: path,
                type: "POST",
                dataType: "JSON",
                data: {
                    cart_id: cart_id,
                    _token: token,
                },
                success: function(data) {
                    $('body #header-ajax').html(data['header']);
                    $('body #cart_counter').html(data['cart_count']);
                    $('body #cart_list').html(data['cart_list']);


                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 1000,
                        timerProgressBar: true,

                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'success',
                        title: data['message'],
                        color: '#716add',
                        background: '#000',

                    })
                },
                error: function(err) {
                    console.log(err);
                }
            });
        });
    </script>

    <script>
        $(document).on('click', '.qty-text', function() {
            var id = $(this).data('id');
            var spinner = $(this),
                input = spinner.closest("div.quantity").find('input[type="number"]');

            if (input.val() == 1) {
                return false;
            }
            if (input.val() != 1) {
                var newVal = parseFloat(input.val());
                $('#qty-input-' + id).val(newVal);
            }

            var productQuantity = $('#update-cart-' + id).data('product-quantity');
            update_cart(id, productQuantity)


        })

        function update_cart(id, productQuantity) {
            var rowId = id;
            var product_qty = $('#qty-input-' + rowId).val();
            var token = "{{ csrf_token() }}";
            var path = "{{ route('cart.update') }}";

            $.ajax({
                url: path,
                type: "POST",
                dataType: 'JSON',
                data: {
                    _token: token,
                    product_qty: product_qty,
                    rowId: rowId,
                    productQuantity: productQuantity,
                },
                success: function(data) {
                    if (data['status']) {
                        $('body #header-ajax').html(data['header']);
                        $('body #cart-counter').html(data['cart_count']);
                        $('body #cart_list').html(data['cart_list']);
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 1000,
                            timerProgressBar: true,

                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon: 'success',
                            title: data['message'],
                            color: '#716add',
                            background: '#000',
                        })
                    } else {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 1000,
                            timerProgressBar: true,

                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon: 'error',
                            title: data['message'],
                            color: '#716add',
                            background: '#000',

                        })
                    }
                }
            })
        }
    </script>
@endsection
