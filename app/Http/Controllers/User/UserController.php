<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Contact;


use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //direct admin/user/ list page
    public function userlist(){
        $users = User::where('role','user')->paginate(3);
        return view('admin.user.list', compact('users'));
    }

    // change user role admin/user/list
    public function userChangeRole(Request $request)
{
    $updateRole = [
        'role' => $request->role,

    ];

    User::where('id', $request->userId)->update($updateRole);
}




    //user home page
    public function home(){
        $pizza=Product::orderBy('created_at','desc')->get();
        $category=Category::get();
        $cart = Cart::where('user_id', Auth::user()->id)->get();
        $history = Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('pizza','category','cart','history'));
    }

    //change password page
    public function changePasswordPage(){
        return view('user.password.change');
    }


    //change password
    public function changePassword(Request $request){
         $this->passwordValidationCheck($request);
        $currentUserId = Auth::user()->id;
        $user = User::select('password')->where('id',$currentUserId)->first();
        $dbHashValue=$user->password;

        //Hash::check(plaintext, authenticate hashed value)
        if(Hash::check($request->oldPassword,$dbHashValue)){
            User::where('id',$currentUserId)->update([
                'password'=>Hash::make($request->newPassword),
            ]);
            // Auth::logout();   // automatic logout
            return redirect()->route('category#list')->with(['changeSuccess'=>'Password Changed...']);
        }
        return back()->with(['notMatch'=>'The old password does not match.']);
    }

    // direct user contact
    public function contact(){
        return view('user.contact.contact');
    }

    // user account change page
    public function accountChangePage(){
        return view('user.profile.account');
    }

      //direct admin/contact/ message list
    public function userMessageList(){
        $message=Contact::paginate(7);
        return view('admin.contact.messageList',compact('message'));
    }


    //account change
    public function accountChange($id,Request $request){
         $this->accountValidationCheck($request);
        $data=$this->getUserData($request);

        //for img
        if($request->hasFile('image')){
            //old img name / check=>delete/ store
            $dbimage = User::where('id',$id)->first();
            $dbimage= $dbimage->image;

            if($dbimage != null){
                Storage::delete('public/'.$dbimage);
            }

            $filename = uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$filename);
            $data['image']=$filename;


        }
        User::where('id',$id)->update($data);
        return back()->with(['updateSuccess'=>'Admin Account Updated...']);
    }


    //filter

    public function filter($categoryId){
        $pizza=Product::where('category_id',$categoryId)->orderBy('created_at','desc')->get();
        $category=Category::get();
        $cart = Cart::where('user_id', Auth::user()->id)->get();
        $history = Order::where('user_id',Auth::user()->id)->get();

        return view('user.main.home',compact('pizza','category','cart','history'));

    }



    // direct pizza details
    public function pizzaDetails($id){
        $pizza = Product::where('id',$id)->first();
        $pizzaList = Product::all();
        // dd($pizza,$pizzaList);
        return view('user.main.details',compact('pizza','pizzaList'));
    }

    //cart list
    public function cartList(){
    $cartList = Cart::select('carts.*', 'products.name as pizza_name','products.image as product_image', 'products.price as pizza_price')
        ->leftJoin('products', 'products.id', '=', 'carts.product_id')
        ->where('carts.user_id', Auth::user()->id)
        ->get();

    $totalPrice = 0;
    foreach ($cartList as $c) {
        $totalPrice += $c->pizza_price * $c->quantity;
    }

    return view('user.main.cart', compact('cartList', 'totalPrice'));
    }

    // direct history page
    public function history(){
        $order = Order::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->paginate(5);
        return view('user.main.history',compact('order'));

    }

    //delete user
    public function deleteUser($id){
        User::where('id',$id)->delete();
        return redirect()->route('admin#userList');
    }

    // user details
    public function editUser($id){
        $userAcc= User::where('id',$id)->first();
        return view('admin.user.edit',compact('userAcc'));

    }

    //update user info
    public function updateUser($id,Request $request){
        $updateAcc= $this->getUserData($request);
         User::where('id',$id)->update($updateAcc);
         $users = User::where('role','user')->paginate(3);
         return view('admin.user.list',compact('users'));
    }




    //private function
     // acc validation check
     private function accountValidationCheck($request){
        Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required',
            'gender'=>'required',
            'phone_number'=>'required',
            'image'=>'mimes:png,jpg,jpeg,webp|file',
            'address'=>'required',
        ])->validate();
     }

      //private function

     // password validation check
     private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'oldPassword'=>'required|min:6|max:10',
            'newPassword'=>'required|min:6|max:10',
            'confirmPassword'=>'required|min:6|max:10|same:newPassword'
        ])->validate();

    }

         //get user data
     private function getUserData($request){
        return [
            'id'=>$request->id,
            'name'=>$request->name,
            'email'=>$request->email,
            'gender'=>$request->gender,
            'phone_number'=>$request->phone_number,
            'address'=>$request->address,
            'role'=>$request->role,
            'updated_at'=>Carbon::now(),
        ];
     }
 }
