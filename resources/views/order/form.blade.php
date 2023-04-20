<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="container">
        @if (!Route::has('login'))
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center">
            <label> Login/ Register and Please Enter your delivery address to place your order</label>
        </div>
        @endif
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
                            @foreach ($cart as $data)
                            <?php $total+=$data['price']; ?>
                            {{-- {{$data}} --}}
                            <tr>
                                <td>{{$data['name']}}</td>
                                <td>{{$data['sku']}}</td>
                                <td>{{$data['description']}}</td>
                                <td>{{$data['price']}}</td>
                            </tr>
                            @endforeach

                            <tr>
                                <td colspan="3">Total</td>
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
        </div>
            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
                    <form action="{{ route('order.save')}}"  method="POST" enctype="multipart/form-data">
                        <input type="hidden" class="form-control" name="_token" value="{{csrf_token()}}" >
                        <input type="hidden" class="form-control" name="price" value="<?php echo $total ?>" >
                        {{-- <div class="mb-3 row">
                        <input type="text" class="form-control" name="first_name" value="" placeholder="Enter First Name">
                        </div>
                        <div class="mb-3 row">
                        <input type="text" class="form-control" name="last_name" value="" placeholder="Enter Last Name">
                        </div> --}}
                        <div class="mb-3 row">
                            <textarea name="delivery_address" value="" class="form-control" placeholder="Enter delivery address"></textarea>
                        </div>
                        <div class="mb-3 row">
                        <button class="btn btn-success" type="submit">Place Order</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
