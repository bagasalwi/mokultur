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
}
