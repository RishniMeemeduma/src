<?php

namespace App\Http\Controllers\Sales;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\AddressValidationRequest;

class Order extends Controller
{
    public function placeOrder(Request $request)
    {
        $order = new \App\Models\Order();

        $cart = session()->get('cart');
        
        return view('order.form')
            ->with('cart', $cart);
    }

    public function saveOrder(AddressValidationRequest $request)
    {
        $order = new \App\Models\Order();
        
        $auth = Auth::user();
        $saveOrderItem = [];
        
        // save order
        $saveOrder= [
            'customer_id'=>$auth ? $auth['id'] : '',
            'delivery_address' => '"'.$request['delivery_address'].'"',
            'price'=> $request['price'],
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
        ];
        $orderId = $order->insertGetId($saveOrder);

        // save order items
        $orderItems = session()->get('cart');
        if($orderItems){
            foreach($orderItems as $item){
                $saveOrderItem[] = [
                    'order_id' => $orderId,
                    'product_id' => $item['id'],
                    'created_at'=>date('Y-m-d H:i:s'),
                    'updated_at'=>date('Y-m-d H:i:s'),
                ];
            }
            
            $orderItemsSave = new \App\Models\OrderProducts();
            $orderItemsSave->insert($saveOrderItem);
            
        }

        // return view('order.thanks')
        //     ->with('order', $order);
        return response()->json(['status'=>'success'], 200);
    }

    public function successPage()
    {
        session()->flash('cart');
        return view('order.thanks');
    }
}
