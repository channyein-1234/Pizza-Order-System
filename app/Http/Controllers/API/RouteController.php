<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RouteController extends Controller
{
   // product list
   public function productList(){
    $products = Product::get();
    return response()->json($products,200);
   }
    //category list
   public function categoryList(){
    $category = Category::get();
    return response()->json($category,200);
   }
   // create category
   public function createCategory(Request $request){
    $data = [
        'name'=>$request->name,
        'created_at'=> Carbon::now(),
        'updated_at'=> Carbon::now()
    ];
    $response = Category::create($data);
    return response()->json($response,200);
   }

   //create contact
   public function createContact(Request $request){
    $data = $this->getContactData($request);
    Contact::create($data);
    $contact =Contact::get();
    return response()->json($contact,200);
   }
   // delete category

   public function deleteCategory( Request $request){
    $data = Category:: where('id',$request->category_id)->first();

    if(isset($data)){
        Category:: where('id',$request->category_id)->delete();
        return response()->json(['status'=>true, 'message'=>'delete success'],200);
    }
    return response()->json(['status'=>false, 'message'=>'There is no category with that ID.'],200);
   }

   // category details
   public function categoryDetails(Request $request){
    $data = Category:: where('id',$request->category_id)->first();

    if(isset($data)){
        return response()->json(['status'=>true, 'category'=> $data], 200);
    }
    return response()->json(['status'=>false, 'category'=>'There is no category with that ID.'],200);
   }

   //update category
   public function updateCategory(Request $request){
    $categoryId= $request->category_id;
    $dbSource = Category::where('id',$categoryId)->first();

    if(isset($dbSource)){
        $data = $this->getCategoryData($request);
        Category::where('id',$categoryId)->update($data);
        $response = Category::where('id',$categoryId)->first();
        return response()->json(['status'=>true, 'message'=>' Update success'],200);
    }
    return response()->json(['status'=>false, 'message'=>'There is no category with that ID.'],200);
   }


    // private function
   private function getContactData($request){
    return [
        'name'=>$request->name,
        'email'=>$request->email,
        'message'=>$request->message,
        'created_at'=>Carbon::now(),
        'updated_at'=>Carbon::now(),

    ];
   }

   private function getCategoryData($request){
    return [
        'name' => $request->category_name,
        'updated_at'=> Carbon::now(),

    ];
   }
}
