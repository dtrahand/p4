<?php

class UserController extends BaseController {
	/**
	*
	*/
	public function __construct() {
    
//    The following is saying "Do not let user go to Login or Signup pages if the user is already signed up"
    $this->beforeFilter('guest', array('only' => array('getLogin','getSignup')));
    }

    /**
	* Show the new user SIGNUP form
	* @return View
	*/
	public function getSignup() {
		return View::make('user_signup');
	}
    
    /**
	* Process the new user signup
	* @return Redirect
	*/
	public function postSignup() {
		# Step 1) Define the rules
		$rules = array(
			'email' => 'required|email|unique:users,email',
			'password' => 'required|min:6',
            'Firstname' => 'required',
            'Lastname' => 'required'
		);
		# Step 2)
		$validator = Validator::make(Input::all(), $rules);

        # Step 3
		if($validator->fails()) {
			return Redirect::to('/signup')
				->with('flash_message', 'Sign up failed; please fix the errors listed below.')
				->withInput()
				->withErrors($validator);
		}
		$user = new User;
		$user->email    = Input::get('email');
		$user->password = Hash::make(Input::get('password'));
		$user->Firstname = Input::get('Firstname');
		$user->Lastname  = Input::get('Lastname');
		$user->Teacher   = Input::get('Teacher');
		try {
			$user->save();
		}
		catch (Exception $e) {
			return Redirect::to('/signup')
				->with('flash_message', 'Sign up failed; please try again.');
		}
		# Log in
		Auth::login($user);
		return Redirect::to('/')->with('flash_message', 'Welcome Musician!');
	}
    
	/**
	* Display the GET LOGIN form
	* @return View
	*/
	public function getLogin() {
		return View::make('user_login');
	}
	/**
	* Process the POST LOGIN form
	* @return View
	*/
	public function postLogin() {
		$credentials = Input::only('email', 'password');
		if (Auth::attempt($credentials, $remember = true)) {
			return Redirect::intended('/')->with('flash_message', 'Welcome Back!');
		}
		else {
			return Redirect::to('/login')
				->with('flash_message', 'Log in failed; please try again.')
				->withInput();
		}
		return Redirect::to('/');
	}
    
	/**
	* Logout
	* @return Redirect
	*/
	public function getLogout() {
		# Log out
		Auth::logout();
		# Send them to the homepage
		return Redirect::to('/');
	}

    # View list of students
	public function getListstudents() {
        $liststudents= User::where('teacher','=','0')
            ->get(array('firstname', 'lastname'));

        return View::make('user_liststudents')
            ->with('liststudents', $liststudents);

	}
    
    
}