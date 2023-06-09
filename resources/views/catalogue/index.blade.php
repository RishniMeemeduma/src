<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- bootstrap -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        
        <!-- jquery -->
    <script
    src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
    crossorigin="anonymous"
  ></script>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
            
        </style>
    </head>
    <body class="container">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 float-right">
                <a href="{{ route('cart.all')}}">
                    Cart Items : <b id="cart_count">0</b>
                </a>
            </div>
            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <div class="row flex justify-center pt-8 sm:justify-start sm:pt-0">

                    @foreach ($products as $product)
                    <div class="card mr-3 p-2" style="width: 18rem;">
                        <p>{{$product->sku}}</p>
                        <p>{{$product->description}}</p>
                        <p>{{$product->price}}</p>
                        <input class="qty" type="hidden" name="qty" value="1">
                            <label id="product_{{$product->id}}"></label>
                            <button type="submit" data-id="{{$product->id}}" data-sku="{{$product->sku}}" data-description="{{$product->description}}" data-name="{{$product->name}}" data-price="{{$product->price}}" class=" add_to_cart btn btn-success">Add To Cart</button>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 float-right">
                <a href="{{ route('cart.all')}}" class="btn btn-info">
                    Cart Page >>
                </a>
            </div>
        </div>
        <script>

            $(document).ready(function(){
                window.cart = <?php echo  !empty($cart) ? json_encode($cart): '[]' ?>;
                updateCart();

                $('.add_to_cart').on('click', function() {
                    var cart = window.cart || [];
                    var product_id = $(this).data('id');

                    cart.push({'id':product_id,'sku':$(this).data('sku'), 'description': $(this).data('description'), 'name':$(this).data('name'), 'price':$(this).data('price')});
                    window.cart = cart;

                    $.ajax(
                    {
                        url:'/cart/store',
                        type: 'POST',
                        data: {'_token': '{{csrf_token()}}', 'cart' : cart},
                        success: function(data) {
                            
                            $('#product_'+product_id).addClass('alert alert-success').css({'opacity': '1000', 'display':'block'}).html(data.message);
                            setTimeout(() => {
                                $('#product_'+product_id).fadeTo(1000, 0).slideUp(1000)
                            }, 2000);
                        }
                    });

                    updateCart();
                });
            });

            async function updateCart(){
                var count = 0;
                console.log(window.cart);
                window.cart.forEach(function (item, i) {
                    count ++
                });
  
                $("#cart_count").html(cart.length);
            }

        </script>
        <!-- bootstrap js -->
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>
