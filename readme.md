**PASSPORT**

Laravel passport is a external package that makes the 0auth
painless.

    composer require laravel/passport
    

Now add the passport service provider to your app.php file

    Laravel\Passport\PassportServiceProvider::class,

Register the passport service provider in laravel package.
and then run the

    php artisan migrate
    
this will provide all the necessary table required for the oauth feature.


    php artisan passport:install
Now what does this is it generates a encryption key that lets passport securely create 
access tokens

Now add HasApiToken in your users model. Also add passport route to your auth service provider


    public function boot()
    {
        $this->registerPolicies();
        Passport::routes();
    }
Also switch the api guard in auth.php to passport from token
    

    

       
    

