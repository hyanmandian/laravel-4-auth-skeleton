<?php

class UserController extends BaseController {

	public function index() {
		
		$user = Sentry::getUser();

		return View::make('user.index')
				   ->with('user', $user);

	}

	public function create() {

		return View::make('user.create');

	}


	public function store() {

		$labels = array(
			'first_name' => 'First name',
	    	'last_name' => 'Last name',
	    	'email' => 'E-mail',
	    	'password' => 'Password',
	    	'password_confirmation' => 'Password confirmation',
		);

		$rules = array(
            'first_name' => 'required',
	    	'last_name' => 'required',
	    	'email' => 'required|email|unique:users',
	    	'password' => 'required',
	    	'password_confirmation' => 'required|same:password',
		);

        $validator = Validator::make(Input::all(), $rules, array(), $labels);

		if($validator->fails()) {
			return Response::json(array(
    			'errors' => $validator->getMessageBag()->toArray(),
            ), 400); 
		}

		$user = Sentry::createUser(array(
			'first_name' => Input::get('first_name'),
			'last_name' => Input::get('last_name'),
	        'email'     => Input::get('email'),
	        'password'  => Input::get('password'),
	        'activated' => TRUE,
	    ));

    	return Response::json(array(
			'redirect' => route('auth'),
			'timeout' => 1000,
        ), 200); 

	}


	public function show($id){

		$user = User::find($id);

		return View::make('user.index')
				   ->with('user', $user);

	}

	public function edit($id) {

		$user = User::find($id);

		return View::make('user.edit')
				   ->with('user', $user);
	
	}

	public function update($id) {

		$user = User::find($id);

		$labels = array(
			'first_name' => 'First name',
	    	'last_name' => 'Last name',
	    	'email' => 'E-mail',
	    	'password' => 'Password',
	    	'password_confirmation' => 'Password confirmation',
		);

		$rules = array(
            'first_name' => 'required',
	    	'last_name' => 'required',
		);

		if(Input::has('password')) {
			$rules = array_add($rules, 'password', 'required');
			$rules = array_add($rules, 'password_confirmation', 'required|same:password');
		}

		if(Input::has('email') &&  Input::get('email') !== $user->email) {
			$rules = array_add($rules, 'email', 'unique:users');
		}

        $validator = Validator::make(Input::all(), $rules, array(), $labels);

		if($validator->fails()) {
			return Response::json(array(
    			'errors' => $validator->getMessageBag()->toArray(),
            ), 400); 
		}

		$user->first_name = Input::get('first_name');
		$user->last_name = Input::get('first_name');
		$user->email = Input::get('first_name');

		if(Input::has('password')) {
			$user->password = Input::get('first_name');
		}

		$user->save();

    	return Response::json(array(
			'redirect' => route('auth'),
			'timeout' => 1000,
        ), 200); 

	}

	public function destroy($id) {

		$user = User::find($id);
		$user->delete();

		return Response::json(array(
			'redirect' => route('auth'),
			'timeout' => 1000,
        ), 200); 

	}


}
