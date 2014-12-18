<?php

class GradeController extends \BaseController {

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
	 *
	 * @return Response
	 */
	public function create()
	{
        // GET LIST OF STUDENTS:
        try {
            $students = User::where('Teacher','=', '0')
            ->get();
        }
        catch(exception $e) {
            return Redirect::intended()
                ->with('flash_message', $e->getMessage());
        }
        return View::make('grade_create')
            ->with('students', $students);
	}


	/**
	 * STORE a newly created grade in grades table.
     * OR
	 * UPDATE a modified grade
	 * @return Response
	 */
	public function store($id = null)
	{
        # VALIDATION
        # Step 1) Define the rules
        if ($id == null) {  // THIS IS A NEW ENTRY
            $rules = array(
                'date'=>'date|date_format:Y-m-d|after:2014-01-01',
                'grade' => 'required|numeric|between:0,100',
                'student' => 'required',
            );
        }
        else { // THIS IS AN UPDATE, STUDENT'S NAME IS NOT REQUIRED
            $rules = array(
                'date'=>'date|date_format:Y-m-d|after:2014-01-01',
                'grade' => 'required|numeric|between:0,100',
            );
        }

		# Step 2
		$validator = Validator::make(Input::all(), $rules);

        # Step 3
		if($validator->fails()) {
			return Redirect::to('/grade/create')
				->with('flash_message', 'Entering grades failed; please fix the errors listed below.')
				->withInput()
				->withErrors($validator);
		}

        # OBJECT ENTRY
        $grade = new Grade;
		$grade->date = Input::get('date');
		$grade->grade = Input::get('grade');
        if ($id == null) {  // THIS IS A NEW ENTRY (student_id is not part of update)
            $grade->student_id = Input::get('student');
        }
        
        # INSERT OR UPDATE DATABASE    
    		try {
            if ($id == null) {  // THIS IS A NEW ENTRY
                $grade->save();
            }
            else 
            {                   // THIS IS AN UPDATE
                DB::table('grades')
                ->where('id', $id)
                ->update(array(
                    'date' => $grade->date,
                    'grade' => $grade->grade));
            }
		}
		catch (Exception $e) {
            return Redirect::intended()
                ->withInput()
				->with('flash_message', 'Entering grades failed; please try again.');
        }
        
        return Redirect::intended()
            ->withInput()
            ->with('flash_message', "Grade has been entered successfully!");
    
    }


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        // IF USE IS A TEACHER 
        // SHOW LIST OF STUDENTS AND THEIR GRADES
        if(Auth::user()->Teacher == 1) {
            try {
            $liststudents= User::where('teacher','=','0')
                ->get(array('id', 'firstname', 'lastname'));
            }
            catch(exception $e) {
                return Redirect::intended()
                    ->with('flash_message', $e->getMessage());
            }

            try {
            $listgrades= Grade::all();
            }
            catch(exception $e) {
                return Redirect::intended()
                    ->with('flash_message', $e->getMessage());
            }
            return View::make('grade_show')
                ->with('liststudents', $liststudents)
                ->with('listgrades', $listgrades);
        }
        
        // IF USER IS A STUDENT 
        // SHOW HIS/HER GRADES
        else {
            try {
            $listgrades= Grade::where('student_id','=', Auth::user()->id)
                ->get();
            }
            catch(exception $e) {
                return Redirect::intended()
                    ->with('flash_message', $e->getMessage());
            }
        
            return View::make('grade_show')
                ->with('listgrades', $listgrades);
        }

	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        try {
            $studentgrade = Grade::where('id','=', $id)
            ->first();
        }
        catch(exception $e) {
            return Redirect::intended()
                ->with('flash_message', $e->getMessage());
        }
        
        try {
            $students = User::where('Teacher','=', '0')
                ->get();
        }
        catch(exception $e) {
            return Redirect::intended()
                ->with('flash_message', $e->getMessage());
        }
        
        return View::make('grade_edit')
    		->with('studentgrade', $studentgrade)
    		->with('students', $students);
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
            DB::table('grades')
                ->where('id', $id)
                ->delete();
        }
	    catch(exception $e) {
	        return Redirect::to('/grade/show')
                ->with('flash_message', 'Could not delete this grade.');
	    }
        
        return Redirect::to('/grade/show')
            ->with('flash_message', 'Grade successfuly deleted.');
	}
}