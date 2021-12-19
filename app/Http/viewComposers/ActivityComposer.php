<?php
namespace App\Http\viewComposers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class ActivityComposer{
 

    public function compose(View $view)
    {
        $mostPostsCommented = Cache::remember('mostPostsCommented', now()->addMinutes(10), function () {
            return Post::MostPostCommented()->take(5)->get();
        });

        $mostActiveUsers = Cache::remember('mostActiveUsers', now()->addMinutes(10), function () {
            return User::mostActiveUsers()->take(5)->get();
        });
        $activeUsersLastMonth = Cache::remember('activeUsersLastMonth', now()->addMinutes(10), function () {
            return User::UserActiveLastMonth()->take(5)->get();
        });

        $view->with([

             'mostCommentedPosts'=>$mostPostsCommented,
            'mostActiveUsers'=>$mostActiveUsers,
            'activeUsersLastMonth' => $activeUsersLastMonth,
        ]);
    }
}