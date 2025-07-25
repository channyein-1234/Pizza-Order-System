<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderList;
use Carbon\Carbon;



class AjaxController extends Controller
{
    //pizza list to home
    public function pizzaList(Request $request){
        // logger($request->status);
        if($request->status == 'desc'){
            $pizza = Product::orderBy('created_at','desc')->get();
        }
        else{
            $pizza =Product::orderBy('created_at','asc')->get();
        }
        return response()->json($pizza,200);
    }

    // return pizza list to detail

    public function addToCart(Request $request){
        $data = $this->getOrderData($request);
        logger($data);
        Cart::create($data);
        $response = [
            'message'=>'Add to card complete',
            'status'=> 'success'
        ];
        return response()->json($response,200);

    }

    //order
    public function order(Request $request){
        foreach($request->all() as $item){
            $data= OrderList::create($item);
            $total =0;
            $total += $data->total;
        }

        // once ordered, delete from cart
        Cart::where('user_id',Auth::user()->id)->delete();

        // add to the user's  all time order table
        Order::create([
            'user_id'=>Auth::user()->id,
            'product_id'=>$data->product_id,
            'order_code'=> $data->order_code,
            'total_price'=>$total,

        ]);
        return response()->json([
            'status'=>'true',
            'message'=>'Order Complete',
        ],200);
    }

    //clear cart
    public function clearCart(){
        Cart::where('user_id', Auth::user()->id)->delete();
    }

    //clear current product
    public function clearCurrentProduct(Request $request){
        // logger($request->all());
        Cart::where('user_id', Auth::user()->id)->where('product_id',$request->productId)->where('id',$request->orderId )->delete();
    }

    // increase view count
    public function increaseViewCount(Request $request){
        $pizza = Product::where('id',$request->product_id)->first();
        $viewCount = [
            'view_count' =>$pizza->view_count + 1
        ];
        Product::where('id',$request->product_id)->update($viewCount);
    }

    // public function message(Request $request){
    //     logger($request->all());
    // }

     //private function
    private function getOrderData($request){
        return [
            'user_id'=>$request->userId,
            'product_id'=>$request->pizzaId,
            'quantity'=>$request->orderCount,
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now(),
        ];
    }


}
