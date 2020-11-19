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
}
