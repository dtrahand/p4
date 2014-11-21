<?php
class UserController extends BaseController {
	/**
	*
	*/
	public function __construct() {
        $this->beforeFilter('guest', array('only' => array('getLogin','getSignup')));
    }
    /**
	* Show the new user signup form
	* @return View
	*/
	public function getSignup() {
        if (Auth::check()) {
            // The user is logged in...
            return Redirect::intended('/signup')->with('flash_message', 'You are already signed in. Please Log out first');
//            return Redirect::to('/signup')
//            <a href='/logout'>Log out first</a>
        }
        else {
		      return View::make('signup');
        }
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
				->with('flash_message', 'Sign up failed; please try again.')
				->withInput();
		}
		# Log in
		Auth::login($user);
		return Redirect::to('/')->with('flash_message', 'Welcome to Foobooks!');
	}
	/**
	* Display the login form
	* @return View
	*/
	public function getLogin() {
		return View::make('login');
	}
	/**
	* Process the login form
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
		return Redirect::to('login');
	}
	/**
	* Logout
	* @return Redirect
	*/
	public function getLogout() {
		# Log out
		Auth::logout();
		# Send them to the homepage
		return Redirect::to('/login');
	}
}