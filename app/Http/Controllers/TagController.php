<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\Sidebar;
use Auth;
use Carbon\Carbon;

class TagController extends Controller
{
    public $menu_id = 'Tag';

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index(){
        //sidebar
        $data['title'] = $this->menu_id;
        $data['sidebar'] = Sidebar::where('role_id', 2)->get(); 
        
        $data['tag'] = Tag::get();
        //url
        $data['url_create'] = 'tag/create';
        $data['url_delete'] = 'tag/delete';

        return view('back.tag.tag_list', $data);
    }

    public function create(Request $request){
        $this->validate($request, [
            'name' => 'required',
        ]);

        Tag::create([
            'name' => $request->name
        ]);
        
        return redirect('tag')->with('success', 'Tag baru berhasil ditambahkan!');
    }

    public function delete($id){
        Tag::where('id', $id)->delete();
    }

}
