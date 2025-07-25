<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ContactController extends Controller
{
    // user contact message
    public function userMessage(Request $request){

        $this->checkContactForm($request);
        $data = $this->getContactData($request);
        // dd($data);
        Contact::create($data);
        return back();
    }

    // get contact message data
    private function getContactData($request){
        return [
            'id'=>$request->userId,
            'name'=>$request->name,
            'email'=>$request->email,
            'message'=>$request->message,
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now(),
        ];
    }

    //check contact form data
   private function checkContactForm($request) {
    Validator::make($request->all(), [
        'name' => 'required',
        'email' => 'required',
        'message' => 'required',
    ])->validate();


}


}
