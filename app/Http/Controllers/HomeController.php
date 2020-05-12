<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use DB;

class HomeController extends Controller
{
    
    public function __construct()
    {
        // $this->middleware(['auth']);
    }

    
    public function index(Request $request)
    {        
        $data['title'] = 'Home';
        $data['post_latest'] = Post::where('status', 'P')->orderBy('created_at', 'desc')->take(3)->get();

        return view('front.home', $data);
    }

    public function contact()
    {        
        $data['title'] = 'Contact';        

        return view('front.home.contact', $data);
    }

    public function contact_submit(Request $request)
    {        
        $data['title'] = 'Contact'; 

        DB::table('saran')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'description' => $request->description,
        ]);

        return redirect('contact')->with('success', 'Terima kasih Saran & Kritik anda sangat membantu !');
    }
}
