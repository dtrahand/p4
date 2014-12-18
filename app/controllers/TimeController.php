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
        // Request common to both TEACHER + STUDENT
        // ****************************************
        // Fetch Days&Hours when User is available:
        // ------------------------------------------
        try {
            $usertimes = Time::where('user_id','=', Auth::user()->id)
            ->get();
        }
        catch(exception $e) {
            return Redirect::intended()
                ->with('flash_message', $e->getMessage());
        }
        
         // User checked in is a TEACHER
         // ****************************
        if (Auth::user()->Teacher == 1) {
            return View::make('time_create')
                ->with('usertimes', $usertimes);
            
        }
        else // User checked in is a STUDENT
        {    // ****************************
            
            // Fetch Name of Student's  Teacher:
            // ---------------------------------
            try {
                // For now there is only one teacher...
                $teacherinfos = User::where('teacher','=','1')
                ->get(array('id', 'firstname', 'lastname'));
            }
            catch(exception $e) {
                $errormessage = "Error fetching teacherinfo:<br>".$e->getMessage();
                return Redirect::intended()
                  ->with('flash_message', $errormessage);
//                    ->with('flash_message', "Error fetching teacherinfo");
            }
            // For now there is only one teacher...
            foreach($teacherinfos as $teacherinfo) {
                $teacherID = $teacherinfo->id;
            }
            // Fetch available days and times of Teacher:
            // ------------------------------------------
            try {
            $teachertimes = Time::where('user_id','=', $teacherID)
                ->get();
            }
            catch(exception $e) {
                $errormessage = "Teacher schedule not found:<br>" . $e->getMessage();
                return Redirect::intended()
                    ->with('teacherinfos', $teacherinfos)
                    ->with('flash_message', $errormessage);
            //      ->with('flash_message', 'Teacher schedule not found');
		  }

            // Store the Teacher id for later
            Session::put('teacherID', $teacherID);

            return View::make('time_create')
                ->with('teacherinfos', $teacherinfos)
                ->with('usertimes', $usertimes)
                ->with('teachertimes', $teachertimes);
        }
       }

	/**
	 * Store a newly created time in storage.
	 * Update a modified time
	 * @return Response POST create or POST edit
	 */
	public function store($id = null)
	{
		# Step 1) Define the rules
		$rules = array(
			'Day' => 'required',
			'Start' => 'required', # Must be >= teacher s start time
			'End' => 'required',  #Must be <= teacher s start time AND Must be greater than Start
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
        // CUSTOM VALIDATIONS:
        // *******************
        // Check that the Start time is prior to End time:
        if (Input::get('Start') >= Input::get('End')) {
            $customRules = "<br>Start time must be before End time.<br>";
            return Redirect::to('/time/create')
				->with('flash_message', 'Entering available times failed; please fix the errors listed below.')
				->withInput()
				->withErrors($customRules);
        }
            
        // Check that the student's hours are within the teachers' range of available time:
        if (Auth::user()->Teacher == 0) {
//            $teachertimes = Session::get('teachertimes');
            
            $Timecheck = Time::checkhours(Input::get('Day'), Input::get('Start'), Input::get('End'));
                
            if ($Timecheck == 0) {
                return Redirect::to('/time/create')
                ->withInput()
                ->with('flash_message', "Your hours do not match your teacher's hours. Please try again");
            }
        }

		$time = new Time;
		$time->user_id = Auth::user()->id;
		$time->Day = Input::get('Day');
		$time->Start = Input::get('Start');
		$time->End = Input::get('End');
        if (Auth::user()->Teacher == 1) {
            $time->teacher_id = Auth::user()->id;
        }
        else {
            $time->teacher_id = Session::get('teacherID');
        }
        
        # INSERT OR UPDATE DATABASE    
		try {
            if ($id == null) {  // THIS IS A NEW ENTRY
                $time->save();
            }
            else 
            {                   // THIS IS AN UPDATE
                DB::table('times')
                ->where('id', $id)
                ->update(array(
                    'Day' => $time->Day,
                    'Start' => $time->Start,
                    'End' => $time->End));
            }
		}
		catch (Exception $e) {
			return Redirect::to('/time/create')
                ->withInput()
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
    # View list of students
        try {
        $liststudents= User::where('teacher','=','0')
            ->get(array('id', 'firstname', 'lastname'));
        }
        catch(exception $e) {
            return Redirect::intended()
                ->with('flash_message', $e->getMessage());
        }
        
        try {
            $listtimes= Time::all();
        }
        catch(exception $e) {
            return Redirect::intended()
                ->with('flash_message', $e->getMessage());
        }

        return View::make('time_show')
            ->with('liststudents', $liststudents)
            ->with('listtimes', $listtimes);
	}


	/**
	 * Show the form for editing the specified resource.
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        try {
            $usertime = Time::where('id','=', $id)
            ->first();
        }
        catch(exception $e) {
            return Redirect::intended()
                ->with('flash_message', $e->getMessage());
        }
        
        return View::make('time_edit')
    		->with('usertime', $usertime);
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
		try {
            DB::table('times')
                ->where('id', $id)
                ->delete();
        }
	    catch(exception $e) {
            return Redirect::intended()
                ->with('flash_message', 'Could not delete time schedule.');
	    }
        
        return Redirect::intended()
           ->with('flash_message', 'Time schedule deleted.');
    }
}