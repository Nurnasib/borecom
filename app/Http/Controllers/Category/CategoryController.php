<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use AWS\CRT\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    private $directory;
    private $image;
    private $imageName;
    private $imageUrl;
    public function __construct()
    {
        $this->middleware('auth:web');
    }
    public function categoryList()
    {
        $categories = Category::all();
        return view('category.list', ['categories'=>$categories]);
    }
    public function addCategory()
    {
        return view('category.add');
    }
    public function editCategory($id)
    {
        $category = Category::where('id',$id)->first();
        return view('category.editCategory',['category'=>$category]);
    }
    public function updateCategory(Request $request,$id)
    {
        $val = request()->validate([
            'url' => 'required|unique:categories,url,'.$id,
        ]);
        $category = Category::where('id',$id)->first();
        if($request->has('photo'))
        {
            if(Storage::disk('s3')->exists($category->photo)) {
                Storage::disk('s3')->delete($category->photo);
            }
            $this->imageUrl = $this->getImageUrl($request);
        }
        else
        {
            $this->imageUrl = $category->photo;
        }
        $category->purposeId = $request->purposeId;
        $category->category = $request->category;
        $category->url = $request->url;
        $category->description = $request->description;
        $category->photo = $this->imageUrl;
        $category->metaTitle = $request->metaTitle;
        $category->metaSubTitle = $request->metaSubTitle;
        $category->metaDescription = $request->metaDescription;
        $category->metaKeywords = $request->metaKeywords;
        $category->save();
        return redirect('/all-category')->with('message','Category Updated Successfully');
    }
    public function deleteCategory($id)
    {
        $category = Category::where('id',$id)->first();
        if(Storage::disk('s3')->exists($category->photo)) {
            Storage::disk('s3')->delete($category->photo);
        }
        $category->delete();
        return redirect('/all-category')->with('message','Category Deleted Successfully');
    }
    public function getImageUrl($request)
    {
        $this->image = $request->file('photo');
        $this->imageName = time() . $this->image->getClientOriginalName();
        $path = '/audition/video/';
        Storage::disk('s3')->put($path.$this->imageName, file_get_contents($request->photo));
        return $path.$this->imageName;
    }
    public function createCategory(Request $request)
    {
        $val = request()->validate([
            'url' => 'required|unique:categories'
        ]);
        if ($val){
            $category = new Category();
            if($request->has('photo'))
            {
                $this->imageUrl = $this->getImageUrl($request);
            }
            else
            {
                $this->imageUrl = null;
            }
            $category->purposeId = $request->purposeId;
            $category->category = $request->category;
            $category->url = $request->url;
            $category->description = $request->description;
            $category->photo = $this->imageUrl;
            $category->metaTitle = $request->metaTitle;
            $category->metaSubTitle = $request->metaSubTitle;
            $category->metaDescription = $request->metaDescription;
            $category->metaKeywords = $request->metaKeywords;
            $category->save();
            return redirect('/all-category')->with('message','New category Created Successfully');
        }else{
            return response()->json('Url Must be Unique!');
        }

//        return response()->json($request->url);

    }
    public function searchUrl(Request $request)
    {
        if (is_null($request->searchText)){
            return response()->json(2);
        }else{
            $found=Category::where('url',$request->searchText)->first();
            if (is_null($found)){
                return response()->json(0);
            }else{
                return response()->json(1);
            }
        }
    }
}
