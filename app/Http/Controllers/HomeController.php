<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\PostCategory;
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
        $data['creation'] = Post::where('status', 'P')->orderBy('created_at', 'desc')->take(3)->get();
        $data['category'] = PostCategory::orderBy('created_at', 'desc')->take(6)->get();

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
