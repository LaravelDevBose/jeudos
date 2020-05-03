<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Services\ResponseHandler;
use App\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoriesController extends Controller
{
    use ResponseHandler;

    public function categories()
    {
        $categories = Category::all();
        return view('pages.backend.categories', get_defined_vars());
    }

    public function storeCategories(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'color' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:3062'
        ]);
        $response = $this->validatorResponseHandler($validator);
        if ($response !== true) return $response;
        $category = Category::updateOrcreate(
            [
                'id' => $request->category_id
            ],
            [
                'name' => $request->name,
                'color' => $request->color,
            ]);
        if ($request->file('image') ) {
            $file = $request->file('image');
            $imageName = $request->name.$file->getClientOriginalName();
            $imagePath = 'images/categories/' . $imageName;
            $file->move(public_path('images/categories'), $imageName);
            $category->image_url = $imagePath;
            $category->update();
        }
        return $this->successResponseHandler('Category uploaded successfully');
    }

    public function getCategory($id){
        $category = Category::find($id);
        return response()->json([
            'status' => 'success',
            'message' => 'Category found',
            'data' => $category
        ],200);
    }

    public function subCategory($id){
        $id = decrypt($id);
        $category = Category::find($id);
        $subCategories = SubCategory::where('category_id',$id)->orderBy('id','desc')->get();
        return view('pages.backend.sub-category', get_defined_vars());
    }

    public function storeSubCategory(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
        ]);
        $response = $this->validatorResponseHandler($validator);
        if ($response !== true) return $response;
        SubCategory::updateOrcreate(
            [
                'id' => $request->sub_category_id
            ],
            [
                'category_id' => $request->category_id,
                'name' => $request->name,
            ]);
        return $this->successResponseHandler('Sub category uploaded successfully');
    }

    public function getSubCategory($id){
        $subCategory = SubCategory::find($id);
        return response()->json([
            'status' => 'success',
            'message' => 'Sub Category found',
            'data' => $subCategory
        ],200);
    }

    public function getSubCategories($category_id){
        $subCategories = SubCategory::where('category_id',$category_id)->get();
        return response()->json([
            'status' => 'success',
            'message' => 'Sub Categories found',
            'data' => $subCategories
        ],200);
    }
}
