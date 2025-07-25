<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;



use Illuminate\Http\Request;
use PDO;

class ProductController extends Controller
{
    //product list
    public function list(){
        $pizzas=Product::select('products.*','categories.name as category_name')
       ->when(request('key'), function($query){
            $query->where('products.name','like','%'.request('key').'%');  // need to specifically describe which table which field
        })
        ->leftJoin('categories','products.category_id','categories.id')
        ->orderBy('products.created_at', 'desc')   // here the same
        ->paginate(3);
        // dd($pizzas->toArray());
    $pizzas->appends(request()->all());
    return view('admin.products.pizzaList',compact('pizzas'));
    }

    // direct createPage
    public function createPage(){
        $categories= Category::select('id','name')->get();
        return view('admin.products.create',compact('categories'));
    }

    //products create
    public function create(Request $request){
        $this->productValidationCheck($request,'create');
        $data=$this->requestProductInfo($request);


            $filename= uniqid().$request->file('pizzaImage')->getClientOriginalName();
            $request->file('pizzaImage')->storeAs('public',$filename);
            $data['image']=$filename;
        Product::create($data);
        return redirect()->route('products#list');
    }

    //products delete
    public function delete($id){
        Product::where('id',$id)->delete();
        return redirect()->route('products#list')->with(['deleteSuccess'=>'Successfully Deleted.']);

    }

    //products edit
    public function edit($id){
        $pizza = Product::select('products.*','categories.name as category_name')
        ->leftJoin('categories','products.category_id','categories.id')
        ->where('products.id',$id)->first();
        return view('admin.products.edit',compact('pizza'));

    }

    // product update page
    public function updatePage($id){
        $pizza= Product::where('id',$id)->first();
        $category=Category::get();
        return view('admin.products.update',compact('pizza','category'));
    }

    //update product
    public function update(Request $request){
        $this->productValidationCheck($request,'update');
        $data= $this->requestProductInfo($request);

        if($request->hasFile('pizzaImage')){
            $oldImageName =Product::where('id',$request->pizzaId)->first();
            $oldImageName=$oldImageName->image;

            if($oldImageName !=null){
                Storage::delete('public/'.$oldImageName);
            }

            $filename = uniqid().$request->file('pizzaImage')->getClientOriginalName();
            $request->file('pizzaImage')->storeAs('public',$filename);
            $data['image'] = $filename;
        }

        Product::where('id',$request->pizzaId)->update($data);
        return redirect()->route('products#list');

    }


    //private function

    //check product validation
    private function productValidationCheck($request,$action){
        $validationRules=[
            'pizzaName'=>'required|min:5|unique:products,name,'.$request->pizzaId,
            'pizzaCategory'=>'required',
            'pizzaDescription'=>'required|min:10',
            // 'waitingTime'=>'required',
            'pizzaPrice'=>'required',

        ];
        $validationRules['pizzaImage'] = $action =='create' ? 'required|mimes:png,jpg,jpeg,webp|file':'mimes:png,jpg,jpeg|file';
        Validator::make($request->all(),$validationRules)->validate();
    }

    //request product Info
    private function requestProductInfo($request){
        return [
            'category_id'=>$request->pizzaCategory,
            'name'=>$request->pizzaName,
            'description'=>$request->pizzaDescription,
            // 'waitingTime'=>$request->waitingTime,
            'price'=>$request->pizzaPrice,
        ];

    }

}
