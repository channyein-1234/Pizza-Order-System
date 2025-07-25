<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;



class AdminController extends Controller
{
    //direct login page
    public function loginPage(){
        return view('login');
    }

    //direct register page
    public function registerPage(){
        return view('register');
    }


    //direct dashboard
    public function dashboard(){
        if(Auth::user()->role == 'admin'){
            return redirect()->route('category#list');
        }
        else{
            return redirect()->route('user#home');
        }
    }

    //change password page
    public function changePasswordPage(){
        return view('admin.account.changePassword');
    }

    //change password
    public function changePassword(Request $request){
        /*
        facts to change password
        1.all fields must be filled
        2.new password and confirm password length must be greater than 6
        3.new password and confirm password must be the same
        4.old password must be same with db old password
        */
        $this->passwordValidationCheck($request);
        $currentUserId = Auth::user()->id;
        $user = User::select('password')->where('id',$currentUserId)->first();
        $dbHashValue=$user->password;

        //Hash::check(plaintext, authenticate hashed value)
        if(Hash::check($request->oldPassword,$dbHashValue)){
            User::where('id',$currentUserId)->update([
                'password'=>Hash::make($request->newPassword),
            ]);
            Auth::logout();   // automatic logout
            return redirect()->route('category#list')->with(['changeSuccess'=>'Password Changed...']);
        }
        return back()->with(['notMatch'=>'The old password does not match.']);
    }

    //direct acc details page
    public function details(){
        return view('admin.account.details');
    }

    //direct acc edit page
    public function edit(){
        return view('admin.account.edit');

    }

    //acc update
    public function update($id,Request $request){
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
        return redirect()->route('admin#details')->with(['updateSuccess'=>'Admin Account Updated...']);
    }

    //admin list
    public function list(){
        $admin=User::when(request('key'),function($query){
            $query->orWhere('name','like','%'.request('key').'%')
                    ->orWhere('email','like','%'.request('key').'%')
                    ->orWhere('gender','like','%'.request('key').'%')
                    ->orWhere('phone_number','like','%'.request('key').'%')
                    ->orWhere('address','like','%'.request('key').'%');
                })
                ->where('role','admin')->paginate(3);
        $admin->appends(request()->all());

        return view('admin.account.list',compact('admin'));
    }

    //admin acc delete
    public function delete($id){
        User::where('id',$id)->delete();
        return back()->with(['deletesuccess'=>' Admin Account Successfully deleted']);
    }

    //change Role page
    public function changeRole($id){
        $account=User::where('id',$id)->first();
        return view('admin.account.changeRole',compact('account'));
    }

    //change role
    public function change($id,Request $request){
        $data=$this->requestUserData($request);
        User::where('id',$id)->update($data);
        return redirect()->route('admin#list');


    }

    //private function

    //request user data
    private function requestUserData($request){
        return [
            'role'=>$request->role,
        ];
    }

     // password validation check
     private function passwordValidationCheck($request){
        Validator::make($request->all(),
        [
            'oldPassword'=>'required|min:6|max:10',
            'newPassword'=>'required|min:6|max:10',
            'confirmPassword'=>'required|min:6|max:10|same:newPassword'
        ])->validate();
     }

     //get user data
     private function getUserData($request){
        return [
            'name'=>$request->name,
            'email'=>$request->email,
            'gender'=>$request->gender,
            'phone_number'=>$request->phone_number,
            'address'=>$request->address,
            'updated_at'=>Carbon::now(),
        ];
     }

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

}

