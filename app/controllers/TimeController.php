<?php

class TimeController extends \BaseController {

    public function __construct() {
		# Make sure BaseController construct gets called
		parent::__construct();
		# Only logged in users are allowed here
		$this->beforeFilter('auth');
	}
    /**
	* Special method that gets triggered if the user enters a URL for a method that does not exist
	*
	* @return String
	*/
	public function missingMethod($parameters = array()) {
		return 'Method "'.$parameters[0].'" not found';
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * @return Response
	 */
	public function create()
	{
         // User checked in is a STUDENT
         // ****************************
        if (Auth::user()->Teacher == 0) {
            // Fetch Name of Teacher:
            // ----------------------
            try {
                $teacherinfos = User::where('teacher','=','1')
                ->get(array('id', 'firstname', 'lastname'));
            }
            catch(exception $e) {
                $errormessage = "Error fetching teacherinfo:<br>".$e->getMessage();
                return Redirect::intended()
                  ->with('flash_message', $errormessage);
//                    ->with('flash_message', "Error fetching teacherinfo");
            }
            
            // Fetch Days&Hours when Sudent is available:
            // ------------------------------------------
            try {
                $studenttimes = Time::where('user_id','=', Auth::user()->id)
                ->get();
            }
            catch(exception $e) {
                return Redirect::intended()
                    ->with('flash_message', $e->getMessage());
            }

        }
         // User checked in is a TEACHER
         // ****************************
        else {
            $teacherinfos = Auth::user(); 
            $studenttimes="studenttimes is empty bc I am a teacher";
        }

        // Request common to both TEACHER + STUDENT
        // ****************************************
		try {
            $teachertimes = Time::where('user_id','=', '1')
                ->get();
		}
		catch(exception $e) {
            $errormessage = "Teacher schedule not found:<br>" . $e->getMessage();
            return Redirect::intended()
                ->with('teacherinfos', $teacherinfos)
                ->with('flash_message', $errormessage);
//                ->with('flash_message', 'Teacher schedule not found');
		}
        
            return View::make('time_create')
                ->with('teacherinfos', $teacherinfos)
                ->with('studenttimes', $studenttimes)
                ->with('teachertimes', $teachertimes);
       }

	/**
	 * Store a newly created resource in storage.
	 * @return Response POST create
	 */
	public function store()
	{
		# Step 1) Define the rules
		$rules = array(
			'MondayStart' => 'required', # Must be >= teacher s start time
			'MondayEnd' => 'required',  #Must be <= teacher s start time AND Must be greater than MondayStart
		);

		# Step 2
		$validator = Validator::make(Input::all(), $rules);

        # Step 3
		if($validator->fails()) {
			return Redirect::to('/time/create')
				->with('flash_message', 'Entering available times failed; please fix the errors listed below.')
				->withInput()
				->withErrors($validator);
		}

        // Check that the Start time is prior to End time:
        if (Input::get('MondayStart') >= Input::get('MondayEnd')) {
            $customRules = "<br>Start time must be before End time.<br>";
//            return Redirect::to('/time/create')
            return Redirect::to('/time/create')
				->with('flash_message', 'Entering available times failed; please fix the errors listed below.')
				->withInput()
				->withErrors($customRules);
        }

		$time = new Time;
		$time->user_id = Auth::user()->id;
		$time->teacher_id = 1;
//		$time->teacher_id = $teacherinfos->id;
		$time->MondayStart = Input::get('MondayStart');
		$time->MondayEnd = Input::get('MondayEnd');
		try {
			$time->save();
		}
		catch (Exception $e) {
			return Redirect::to('/time/create')
//				->with('flash_message', 'Entering available times failed; please try again.');
				->with('flash_message', $e->getMessage());
        }
        return Redirect::to('/time/create')
            ->withInput()
            ->with('flash_message', "Your hours have been entered successfully!");
    }

	/**
	 * Display the specified resource.
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
