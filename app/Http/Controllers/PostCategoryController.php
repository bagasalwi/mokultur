<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use App\PostCategory;
use App\Sidebar;

class PostCategoryController extends Controller
{
    public $menu_id = 'Post Category';

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index(){
        //sidebar
        $data['title'] = $this->menu_id;
        $data['sidebar'] = Sidebar::where('role_id', 2)->get(); 
        
        $data['postcategory'] = PostCategory::get();
        //url
        $data['url_create'] = 'post-category/create';
        $data['url_update'] = 'post-category/update';
        $data['url_delete'] = 'post-category/delete';

        return view('back.postcategory.postcategory_list', $data);
    }

    public function create(){
        //sidebar
        $data['title'] = $this->menu_id;
        $data['sidebar'] = Sidebar::where('role_id', 2)->get();
        $data['state'] = 'create';

        $fields = [
            (object) [
                'id' => 0,
                'name' => '',
                'description' => '',         
                'created_at' => '',
                'updated_at' => '',
            ]
        ];

        $data['fields'] = collect($fields);
        
        return view('back.postcategory.postcategory_form', $data);
    }

    public function update($id){
        //sidebar
        $data['title'] = $this->menu_id;
        $data['sidebar'] = Sidebar::where('role_id', 2)->get();
        $data['state'] = 'update';

        $data['fields'] = PostCategory::where('id', $id)->get();

        return view('back.postcategory.postcategory_form', $data);
    }

    public function save(Request $request){

        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
        ]);

        if($request->state == 'create'){
            PostCategory::create([
                'name' => $request->name,
                'description' => $request->description,
            ]);
        }else if($request->state == 'update'){
            PostCategory::where('id', $request->id)->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);
        }
        
        return redirect('post-category');
    }

    public function delete($id){
        PostCategory::where('id', $id)->delete();
    }
}
