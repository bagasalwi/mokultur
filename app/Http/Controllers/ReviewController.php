<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ReviewServices;
use App\User;
use App\Review;
use App\Tag;
use App\Sidebar;
use File, DB, Auth, Image;
use Carbon\Carbon;

use App\Rules\ContainBadWords;

class ReviewController extends Controller
{
    public function __construct(ReviewServices $reviewService)
    {
        $this->reviewService = $reviewService;
        $this->middleware(['auth']);
    }

    public function index(){
        $data['title'] = 'My Reviews';
        $data['user'] = Auth::user();
        $data['review_count'] = $this->reviewService->userReviewCount();

        $data['review'] = $this->reviewService->allReviewUser(5);

        $data['url_create'] = 'review/create';
        $data['url_update'] = 'review/update';
        $data['url_delete'] = 'review/delete';

        return view('front.review.review_list', $data);
    }

    public function create(Request $request)
    {
        $data['user'] = Auth::user();
        $data['sidebar'] = Sidebar::where('role_id', 1)->get();

        $data['fields'] = new Review;
        
        $data['state'] = 'create';

        return view('front.review.review_form', $data);
    }

    public function update($slug){
        $review = Review::where('slug',$slug)->first();

        if($review->user_id == auth()->user()->id){
            $data['state'] = 'update';
            $data['fields'] = $this->reviewService->find($review->id);

            $data['review_genre'] = $review->tagNames();

            return view('front.review.review_form', $data);
        }else{
            return redirect()->route('review.create');
        }
    }

    public function save(Request $request){
        // dd($request->post());

        if($request->state == 'create'){
            $this->validate($request, [
                'review_name' => ['required', new ContainBadWords],
                'review_image' => 'file|image|mimes:jpeg,png,jpg|required',
                'review_synopsis' => 'required',
                'review_releasedate' => 'required',
                'title' => ['required', new ContainBadWords],
                'slug' => 'unique:reviews,slug',
                'content' => 'required',
                'score' => 'required',
                'status' => 'required',
            ]);

            $review = $this->reviewService->create($request->all(), $request->file('review_image'));

            return redirect('review')->with('success', 'Review baru berhasil dibuat!');
        }else if($request->state == 'update'){
            $this->validate($request, [
                'review_name' => ['required', new ContainBadWords],
                'review_image' => 'file|image|mimes:jpeg,png,jpg',
                'review_synopsis' => 'required',
                'review_releasedate' => 'required',
                'title' => ['required', new ContainBadWords],
                'slug' => 'unique:reviews,slug,' . $request->id,
                'content' => 'required',
                'score' => 'required',
                'status' => 'required',
            ]);

            // $review_image = "";

            $review = $this->reviewService->update($request->all(), $request->file('review_image'));

            return redirect('review')->with('success', 'Review baru berhasil diupdate!');
        }
    }

    public function delete($id){
        $this->reviewService->delete($id);
    }
}
