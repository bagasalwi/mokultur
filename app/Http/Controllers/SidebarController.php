<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use Auth;
Use DB;
use App\Sidebar;

class SidebarController extends Controller
{
    public $menu_id = 'Sidebar';

    public function __construct()
    {
        $this->middleware(['auth']);
    }
    
    public function index(){

        //sidebar
        $data['title'] = $this->menu_id;
        $data['sidebar'] = Sidebar::where('role_id', 2)->get(); 
        
        $data['sidebar_array'] = Sidebar::get(); 
        //url
        $data['url_create'] = 'sidebar/create';
        $data['url_update'] = 'sidebar/update';
        $data['url_delete'] = 'sidebar/delete';

        return view('back.sidebar.sidebar_list',$data);
    }

    public function create(){
        //sidebar
        $data['title'] = $this->menu_id;
        $data['sidebar'] = Sidebar::where('role_id', 2)->get();
        $data['roles'] = DB::table('roles')->get();
        $data['state'] = 'create';

        $fields = [
            (object) [
                'id' => 0,
                'role_id' => 0,
                'name' => '',
                'url' => '',
                'icon' => '',                
                'created_at' => '',
                'updated_at' => '',
            ]
        ];

        $data['fields'] = collect($fields);
        
        return view('back.sidebar.sidebar_form', $data);
    }

    public function update($id){
        //sidebar
        $data['title'] = $this->menu_id;
        $data['sidebar'] = Sidebar::where('role_id', 2)->get();
        $data['state'] = 'update';

        $data['roles'] = DB::table('roles')->get();
        $data['fields'] = Sidebar::where('id', $id)->get();

        return view('back.sidebar.sidebar_form', $data);
    }

    public function save(Request $request){

        $this->validate($request, [
            'name' => 'required',
            'icon' => 'required',
            'url' => 'required',
        ]);

        if($request->state == 'create'){
            Sidebar::create([
                'name' => $request->name,
                'icon' => $request->icon,
                'url' => $request->url,
                'role_id' => $request->role_id,
                'created_at' => Carbon::now(),
                'updated_at' => NULL,
            ]);
        }else if($request->state == 'update'){
            Sidebar::where('id', $request->id)->update([
                'name' => $request->name,
                'icon' => $request->icon,
                'url' => $request->url,
                'role_id' => $request->role_id,
                'updated_at' => Carbon::now(),
            ]);
        }
        
        return redirect('sidebar');
    }

    public function delete($id){
        Sidebar::where('id', $id)->delete();
    }
}
