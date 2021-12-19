<?php

namespace App\Providers;

use App\Policies\PostPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */

    //  using $policies table
    //  just go to your controller and replace $this->autorize(post.update,$post) with $this->autorize(update,$post)
    protected $policies = [
        'App\Models\Post' => 'App\Policies\PostPolicy',
        'App\Models\User' => 'App\Policies\UserPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // method 1
        // Gate::define('post.edit','App\Policies\PostPolicy@edit');
        // Gate::define('post.delete','App\Policies\PostPolicy@delete');
        // Gate::define('post.update', 'App\Policies\PostPolicy@update');


        // shourt method using resources
        // Gate::resource('post',PostPolicy::class);


        Gate::before(function($user,$ability){
            if($user->is_admin && in_array($ability,['update'])){
                return true;
            }
        });

        // call it in secret route in web.php
        Gate::define('page.secret',function($user){
            return $user->is_admin;
        });
        
        // using just AuthServicerovider
        // Gate::define('post.update',function($user,$post){
        //       return $user->id==$post->user_id;
        // });

        // Gate::define('post.edit', function ($user, $post) {
        //     return $user->id == $post->user_id;
        // });
        // Gate::define('post.delete', function ($user, $post) {
        //     return $user->id == $post->user_id;
        // });

       
        //
    }
}
