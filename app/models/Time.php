<?php
class Time extends Eloquent {
//    protected $table = 'times';
    
    public $timestamps = false;
  
    public function user(){
    return $this->hasMany('User');
  }
    
    
    	public static function checkhours($Day, $Start, $End)
	{
            $teacherID = Session::get('teacherID');

            // Fetch available days and times of Teacher:
            // ------------------------------------------            
            try {
            $teachertimes = Time::where('user_id','=', $teacherID)
                ->get();
            }
            catch(exception $e) {
                return Redirect::intended()
                  ->with('flash_message', 'Teacher schedule not found');
		  }
            
            
        $Timechoice_OK = 0;
        // Find out if this is a day when the teacher is available:
        foreach ($teachertimes as $teachertime) {
            if ($teachertime->Day == $Day) {
                // CHeck the start time
                if ($teachertime->Start < $Start) {
                // CHeck the end time
                    if ($teachertime->End > $End) {
                        $Timechoice_OK = 1;
                    }                
                }   
            }             
        }   
                        
        return($Timechoice_OK);
	}


}