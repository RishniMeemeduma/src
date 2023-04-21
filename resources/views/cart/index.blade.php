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

            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <div class="row flex justify-center pt-8 sm:justify-start sm:pt-0">
                    <table class="table">
                        <thead>
                            <th>Product name</th>
                            <th>SKU</th>
                            <th>Description</th>
                            <th>Price</th>

                        </thead>
                        <tbody>
                            <?php $total=0; ?>
                            @foreach ($cartItems as $cart)
                            <?php $total+=$cart['price']; ?>
                            {{-- {{$cart}} --}}
                            <tr>
                                <td>{{$cart['name']}}</td>
                                <td>{{$cart['sku']}}</td>
                                <td>{{$cart['description']}}</td>
                                <td>{{$cart['price']}}</td>
                            </tr>
                            @endforeach

                            <tr>
                                <td colspan="3" class="text-center">Total</td>
                                <td>
                                    @php
                                       echo  $total;

                                    @endphp
                                </td>
                            </tr>
                        </tbody>
                    </table>
                   
                </div>
            </div>
            <div>
                <a href="{{route('order.placeorder')}}" class="btn btn-success" >Place Order</a>
            </div>
        </div>
        <!-- bootstrap js -->
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>
