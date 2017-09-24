<?php

namespace App\Http\Controllers;

use App\Lession;
use App\Mail\SendMyEmail;
use App\Notifications\LessionUpdatedNotification;
use App\Notifications\LessonPublished;
use App\Notifications\SubscriptionCanceled;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class NewInFiveThree extends Controller
{
    public function queryBuilder()
    {
        $users = DB::table('users')->get()->first(function ($user) {
            return $user->email == 'selvesan.malakar@gmail.com';
        });

        //$users is a collection class object
        dd($users);

        //If you don't want the collection
        //$users = DB::table('users')->get()->all();


    }

    public function cacheHelper()
    {
        echo 'Cache users vote for 60 minutes<br>';
        cache(['user.1.votes' => [1, 2, 3]], 60);
        cache()->put('foo', 'bar', 60);
        echo "<br>";
        echo cache()->get('foo') . '<br>';

        echo '<hr>';
        //Config
        dd(config()->get('app'));
        //Same as above
        Config::get('app');
    }

    public function vueConnection()
    {
        return 'vue';
    }

    public function pagination()
    {
        return view('pagination', ['users' => User::paginate(1)]);
    }


    public function mailables()
    {
        //Nice Wrapper for sending mail.
        //Old Method
        $data = [];
//        Mail::send('view', [], function () use ($data) {
//
//        });

        //New Method.
        //php artisan make:mail SendMyEmail >> will generate class in app/Mail folder
        //Used the mailtrap for development purpose.
        //set the send in config/mail.php

        Mail::to('selvesan.malakar@gmail.com')->send(new SendMyEmail('selvesan'));
    }


    public function loopVariable()
    {

        return view('loop', ['users' => User::all()]);
    }

    public function closures()
    {
        //php artisan inspire
    }


    public function toggle()
    {
        //this gives us the ability to add or
        // detach an item in the pivot table if it does not
        // exists already or if it does exists remove it
        $user = User::first();
        $post = Post::first();
        //This was the way to do it.
        //$user->favourite()->attach($post);
        //return $user->favourite;
        //$user->favourite()->detach($post);

        //Removing all the records;
        //$user->fresh()->favourite;

        //Not you can do is
        $user->favourite()->toggle($post);
        //return $user;
    }


    public function notification()
    {
        //php artisan make:notification LessonPublished
        //Notify a user that a lession was created.
        $user = User::first();
        $lession = Lession::first();
        $user->notify(new LessonPublished($lession));
    }

    public function notificationDatabase()
    {
        //Will send the notification details
        //php artisan notifications:table to create the notification database schema

        //Login using the id for testing purpose.
        Auth::loginUsingId(1);

        $auth = Auth::user();
        //Since we have set the channel to database in the via function of the SubscriptionCanceled Class
        //This will call to toArray Function not the toMail.
        //If the class have toDatabase function this will call toDatabase function.
        $auth->notify(new SubscriptionCanceled());
        //Notifying the authenticated user that their subscription has been cancelled.
    }

    public function lesionUpdated()
    {
        $lesion = Lession::first();
        Auth::loginUsingId(1);
        $auth = Auth::user();
        $auth->notify(new LessionUpdatedNotification($lesion));

    }


    public function passport()
    {
        
    }
}
