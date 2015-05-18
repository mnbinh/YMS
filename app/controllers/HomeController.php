<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showWelcome()
	{
		return View::make('hello');
	}
    public function loginMail()
    {
        return View::make('home.login');
    }
    public function loginWithGoogle()
    {
        // get data from input
        $code = Input::get( 'code' );

        // get google service
        $googleService = OAuth::consumer( 'Google' );

        // check if code is valid

        // if code is provided get user data and sign in
        if ( !empty( $code ) ) {

            // This was a callback request from google, get the token
            $token = $googleService->requestAccessToken( $code );

            // Send a request with it

            $result = json_decode( $googleService->request( 'https://www.googleapis.com/oauth2/v1/userinfo' ), true );
//            dd($result);
            //Biến $result là thông tin chứng thực thu được

            $email = $result['email'];
            $picture = $result['picture'];
            $youth = YouthMember::where("email", $email);

            if($youth->count()){
                $user = $youth->first()->myAccount;
                if($user !=null){}
                else {
                    $repo = App::make('UserRepository');
                    $user = $repo->signup(array('email' => $email, 'username' => $youth->first()->student_id, 'password' => '123456', 'password_confirmation' => '123456'));
//                $user = User::firstOrCreate(array('email'=> $email ,  ))
                }


                Auth::login($user);
//                Session::put('permission' , array('union' ,'member'));
//                dd(Confide::user());
               return  Redirect::to('/');
            }else{


                return Redirect::to('users/login' )->with('error', 'Your google account is not available in our system');


            }


        }
        // if not ask for permission first
        else {
            // get googleService authorization
            $url = $googleService->getAuthorizationUri();

            // return to google login url
            return Redirect::to( (string)$url );
        }
    }

}
