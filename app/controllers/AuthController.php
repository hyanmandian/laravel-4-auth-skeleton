<?php

class AuthController extends BaseController {

	public function login() {
		
		return View::make('auth.index');

	}

	public function check() {

		$labels = array(
			'email' => 'E-mail',
	    	'password' => 'Password',
		);

		$rules = array(
            'email' => 'required|email',
	    	'password' => 'required',
		);

        $validator = Validator::make(Input::all(), $rules, array(), $labels);

		if($validator->fails()) {
			return Response::json(array(
    			'errors' => $validator->getMessageBag()->toArray(),
            ), 400); 
		}

	    $remember = Input::get('remember') ? Input::get('remember') : FALSE;

	    try{

		    $user = Sentry::authenticate(array(
	        	'email'    => Input::get('email'),
		        'password' => Input::get('password'),
		    ), $remember);

		    return Response::json(array(
				'redirect' => route('user'),
				'timeout' => 1000,
	        ), 200); 

	    } catch(Cartalyst\Sentry\Users\WrongPasswordException $e) {

	    	$errorMessage = 'Wrong password, try again.';

	    } catch(Cartalyst\Sentry\Users\UserNotFoundException $e) {

	    	$errorMessage = 'User was not found.';
	    }

		return Response::json(array(
			'errorMessage' => $errorMessage,
    	), 400); 

	}

	public function logout() {
		
		Sentry::logout();

		return Redirect::to('/');

	}

}
