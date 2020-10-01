<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CategoryServices;
use App\PostCategory;
use App\User;
use App\Sidebar;

class CategoryController extends Controller
{
    public function __construct(CategoryServices $categoryService)
    {
        $this->categoryService = $categoryService;
        $this->middleware(['auth']);
    }

    public function category(){
        $data['title'] = 'Post Category';
        $data['sidebar'] = Sidebar::where('role_id', 2)->get(); 
        
        $data['postcategory'] = PostCategory::get();

        $data['url_create'] = 'admin/category/create';        
        $data['url_delete'] = 'admin/category/delete';

        return view('back.category_list', $data);
    }
    
    public function category_create(Request $request){
        $data['title'] = 'Post Category';
        $data['sidebar'] = Sidebar::where('role_id', 2)->get(); 
        
        $fields = [
            (object) [
                'id' => 0,
                'name' => '',
                'slug' => '',
                'description' => '',
                'banner' => '',
            ]
        ];

        $data['fields'] = collect($fields);

        $data['state'] = 'create';  
        $data['url'] = 'admin/category/create';  
        
        return view('back.category_form', $data);
    }
    
    public function category_update($id){
        $data['title'] = 'Post Category';
        $data['sidebar'] = Sidebar::where('role_id', 2)->get(); 
        
        $data['fields'] = PostCategory::where('id',$id)->get();

        $data['state'] = 'update';  
        $data['url'] = 'admin/category/update';    
        
        return view('back.category_form', $data);
    }

    public function category_store(Request $request){

        if($request->state == 'create'){
            $this->validate($request, [
                'name' => 'required',
                'description' => 'required',
                'banner' => 'file|image|mimes:jpeg,png,jpg|required'
            ]);

            $this->categoryService->create($request->all(),$request->file('banner'));
        }else{
            $cat = $this->categoryService->find($request->id);

            $this->validate($request, [
                'name' => 'required',
                'slug' => 'unique:post_categories,slug,'. $cat->id,
                'description' => 'required',
                'banner' => 'file|image|mimes:jpeg,png,jpg|required'
            ]);

            $this->categoryService->update($request->id,$request->all(),$request->file('banner'));
        }

        return redirect()->route('category');
    }

    public function category_delete($id){
        $this->categoryService->delete($id);
    }
}
