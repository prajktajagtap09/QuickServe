<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;
use App\Models\Book;
use App\Models\Order;

class AdminController extends Controller
{
    public function food_add()
    {
        return view('admin.food_add');
    }

    public function upload_food(Request $request)
    {
        $data  = new food;
        $data->title = $request->title;

        $data->detail = $request->details;

        $data->price = $request->price;

        $image = $request->img;

        $filename=time().'.'.$image->getClientOriginalExtension();
        $request->img->move('food_img',$filename);
        $data->image = $filename;

        $data->save();
        return redirect()->back();

    }

    public function food_view()
    {
        $data = Food::All();
        return view('admin.food_show',compact('data'));
    }

    public function delete_food($id)
    {
             $data = Food::find($id);
             $data->delete();
             return redirect()->back();
    }

    public function update_food($id)
    {
        $food = Food::find($id);
        return view('admin.update_food',compact('food'));
    }

    public function edit_food(Request $request,$id)
    {
        $data = Food::find($id);
        $data->title = $request->title;
        $data->detail = $request->detail;
        $data->price = $request->price;

        $image =$request->image;

        if($image)
            {
                $imagename=time().'.'.$image->getClientOriginalExtension();
                $request->image->move('food_img',$imagename);
                $data->image = $imagename;
            }

        $data->save();
        return redirect('food_view');
    }

    public function food_orders()
    {
      $data = Order::all();

    return view('admin.food_orders',compact('data'));
    }

    public function on_the_way($id)
    {
            $data = Order::find($id);
            $data->delivery_status = "On the Way";
            $data->save();
            return redirect()->back();
    }


    public function delivered($id)
    {
        $data = Order::find($id);
        $data->delivery_status ="Delivered";
        $data->save();
        return redirect()->back();
    }
    public function cancel($id)
    {
        $data = Order::find($id);
        $data->delivery_status ="Canceled";
        $data->save();
        return redirect()->back();
    }

    public function book_table_list()
    {
        $data = Book::all();
        return view('admin.book_table_list',compact('data'));
    }
}
