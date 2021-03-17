<?php

namespace App\Http\Controllers\Frontpanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GenshinController extends Controller
{
    private $characters = "characters";
    private $domains = "domains";
    private $elements = "elements";
    private $materials = "materials";
    private $nations = "nations";
    private $weapons = "weapons";
    
    public function __construct()
    {
        $this->data = public_path() . '/assets/genshin/data/';
    }

    public function index(Request $request){
        // $path = public_path() . '\assets\genshin\data\characters\ganyu\en.json';
        
        if($request->type){
            $path = $this->data . $request->type;
            if($request->character_name){
                $path = $this->data . $request->type . '/' . $request->character_name . '/en.json';
            }
        }
        
        if (!file_exists($path)) {
            return "no data";
        }else{
            $json = json_decode(file_get_contents($path), true); 
            return($json);
        }

        // $dir          = public_path() . '\assets\genshin\data'; //path

        // $files = scandir($data);
    }

    public function characters($name = null){
        $path = $this->data . $this->characters;
        $list = scandir($path);

        // dd($list);

        if($name){
            $path = $this->data . $this->characters . '/' . $name . '/en.json';

            // dd($path);

            if (!file_exists($path)) {
                return "Fail name";
            }else{
                $json = json_decode(file_get_contents($path), true); 
                return($json);
            }
        }else{
            $data['arr'] = collect($list);
            $data['path'] =  $this->data . $this->characters;

            return view('front.genshin.character.list', $data);
        }

    }
}
