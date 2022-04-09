<?php

namespace App\Http\Controllers;
use App\Models\product;
use App\Models\cart;
use App\Models\order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class productcontroller extends Controller
{
    public function login()
    {
        $data=product::all();
        return view('product', ['products'=>$data]);
    }
    public function detail($id)
    {
        $data= product::find($id);
        return view('detail', ['trade'=>$data]);
    }
    public function search(Request $request)
    {
        $data=product::where('name', 'like', "%".$request->input('query')."%")->get();
        return view('search', ['product'=>$data]);
    }
    public function addToCart(Request $request)
    {
        if ($request->session()->has('user')) {
            $cart = new cart();
            $cart->user_id=$request->session()->get('user')['id'];
            $cart->product_id=$request->product_id;
            $cart->save();
            return redirect("/");
        } else {
            return redirect("/login");
        }
    }

    public static function cartItem()
    {
        $userId= Session::get('user')['id'];
        return cart::where('user_id', $userId)->count();
    }
    public function cartList()
    {
        $userId= Session::get('user')['id'];
        $products= DB::table('cart')
        ->join('products', 'cart.product_id', '=', 'products.id')
        ->where('user_id', $userId)
        ->SELECT('products.*', 'cart.id as cart_id')
        ->get();
        return view('cartlist', ['products'=>$products]);
    }
    static function removeCart($id)
    { 
        cart::destroy($id);
        return redirect('cartlist');
    }
   public function ordernow()
    {
        $userId= Session::get('user')['id'];
       $total =$products= DB::table('cart')
        ->join('products', 'cart.product_id', '=', 'products.id')
        ->where('user_id', $userId)
        ->sum('products.price');
        return view('ordernow', ['total'=>$total]);    
    }
    function orderplace(Request $request)
    {
       $userId= Session::get('user')['id'];
       $allCart=cart::where('user_id',$userId)->get();
    foreach($allCart as  $cart)
    {
       $order=new Order();
       $order->product_id=$cart['product_id'];
       $order->user_id=$cart['user_id'];
       $order->status='Pending';
       $order->payment_method=$request->payment;
       $order->payment_status="Pending";
       $order->address=$request->address;
       $order->save();
       $allCart=cart::where('user_id',$userId)->delete();
    }
    return redirect('/');
    }
    function myorders()
    {
         $userId= Session::get('user')['id'];
       $orders= $products= DB::table('orders')
        ->join('products', 'orders.product_id', '=', 'products.id')
        ->where('orders.user_id', $userId)
        ->get();
        return view('myorder', ['orders'=>$orders]); 
    }
}
