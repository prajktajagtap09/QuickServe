<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Food;
use App\Models\Order;
use App\Models\Book;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function my_home()
    {
        $data = Food::all();
        return view('home.index',compact('data'));
    }
    public function index()
    {
                if(Auth::id())
                {
                    $usertype = Auth::user()->usertype;

                     
                    if($usertype=='user')
                    {
                        $data = Food::all();
                        return view('home.index',compact('data'));
                    }
                    else{

                    $all_users = User::where('usertype','=','user')->count();

                    $all_food = Food::count();
                    
                    $all_order = Order::count();

                    $all_delivered = Order::where('delivery_status','=','delivered')-> count();

                        return view('admin.index',compact('all_users','all_food','all_order','all_delivered'));
                    }
                }
    }


    public function cart_add(Request $request, $id)
    {
             if(Auth::id())
                {
                    $food = Food::find($id);

                    $cart_title = $food->title;
                    $cart_detail = $food->detail;
                    $cart_price = Str::remove('$',$food->price);
                    $cart_image = $food->image;

                    $data = new Cart();

                    $data->title = $cart_title;
                    $data->detail = $cart_detail;
                    $data->price = $cart_price * $request->qty;
                    $data->image = $cart_image;
                    $data->quantity = $request->qty;

                    // $data->userid = Auth()->user()->id;
                    $data->userid = Auth::id();



                    $data->save();
                    return redirect()->back()->with('message','Food added to cart successfully...!');
                   
                }
                else{
                    return redirect("login");
                }
    }

    public function my_cart()
    {
        // $user_id = Auth()->user()->id();
        $user_id = Auth::id();
        $data = Cart::where('userid', '=',$user_id)->get();
        return view('home.my_cart',compact('data'));
    }

    // public function delete_cart($id)
    // {
    //     $data = Cart::find($id);

    //     $data->delete();
    //     return redirect()->back();
    // }

    public function delete_cart($id)
{
    $data = Cart::find($id);

    $data->delete();

    return redirect()->back()->with('message', 'Item removed from cart successfully!');
}
public function order_confirm(Request $request)
{
    // $user_id = Auth()->user()->id;

   $user_id = Auth::id();

    $cart = Cart::where("userid","=" ,$user_id)->get();
        
    foreach($cart as $cart)
        {
            $order = new Order();
            $order->name = $request->name;
            $order->email = $request->email;
            $order->phone = $request->phone;
            $order->address = $request->address;
            $order->title = $cart->title;
            $order->quantity = $cart->quantity;
            $order->price = $cart->price;
            $order->image = $cart->image;
            $order->save();

            $data = Cart::find($cart->id);
            $data->delete();
        }
        return redirect()->back()->with('msg','Your order is Placed Successfully..!');
}

public function book_table(Request $request)
{
    $data = new Book();

    $data->phone  = $request->phone;
    $data->guest  = $request->no_guest;
    $data->time  = $request->time;
    $data->date   = $request->date;
    $data->save();
    return redirect()->back()->with('message','Your table has been booked successfully!');
    
}
}
