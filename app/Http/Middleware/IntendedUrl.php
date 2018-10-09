<?php namespace App\Http\Middleware;

use Closure;
use Request;
use Session;

class IntendedUrl {

    /**
     * This loads saved POST input data and changes the method to POST if a visitor tried to access a page
     * but was blocked via an auth filter. Auth filter saves data via the Redirect::guest() and after
     * login it needs to be repopulated to simulate a POST.
     *
     * GET requests also may pass through here. I am less certain if it is required for them but shouldn't hurt
     * and may help load any input data.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Check to see if we were redirected to this page with the Redirect::intended().
        //      We extended the class to track when the redirect occurs so we know to reload additional request data
        if (Session::has('intended.load')) {
            // intended.load could be set without these being set if we were redirected to the default page
            //      if either exists, both should exist but checking separately to be safe
            if (Session::has('intended.method')) {
                Request::setMethod(Session::get('intended.method'));
            }
            if (Session::has('intended.input')) {
                Request::replace(Session::get('intended.input'));
            }
            // Erase all session keys created to track the intended request
            Session::forget('intended');

            // Laravel 5.2+ uses separate global and route middlewares. Dispatch altered request as the route type changed. *Credit to Munsio in answer below
            return \Route::dispatch($request);
        }

        return $next($request);
    }

}