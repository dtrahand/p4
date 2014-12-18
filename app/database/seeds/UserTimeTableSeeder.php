<?php
class UserTimeTableSeeder extends Seeder {
	public function run() {
		# Clear the tables to a blank slate
		DB::statement('SET FOREIGN_KEY_CHECKS=0'); # Disable FK constraints so that all rows can be deleted, even if there's an associated FK
		DB::statement('TRUNCATE times');
		DB::statement('TRUNCATE users');

        #########
        # Users #
        #########
        # Teacher
		$laura = new User;
		$laura->id = '1';
		$laura->email = 'laura@gmail.com';
		$laura->Firstname = 'Laura';
		$laura->Lastname = 'Villa';
		$laura->password = Hash::make('pianos');
		$laura->Teacher = '1';
		$laura->save();

        # Student 1
		$peter = new User;
		$peter->id = '2';
		$peter->email = 'peter@gmail.com';
		$peter->Firstname = 'Peter';
		$peter->Lastname = 'Brown';
		$peter->password = Hash::make('pianos');
		$peter->Teacher = '0';
		$peter->save();
        
        # Student 2
		$lucie = new User;
		$lucie->id = '3';
		$lucie->email = 'lucie@gmail.com';
		$lucie->Firstname = 'Lucie';
		$lucie->Lastname = 'Dupont';
		$lucie->password = Hash::make('pianos');
		$lucie->Teacher = '0';
		$lucie->save();

        # Student 3
		$vicky = new User;
		$vicky->id = '4';
		$vicky->email = 'vicky@gmail.com';
		$vicky->Firstname = 'Vicky';
		$vicky->Lastname = 'Barnes';
		$vicky->password = Hash::make('pianos');
		$vicky->Teacher = '0';
		$vicky->save();

        #########
        # Times #
        #########
        # Times for Teacher1 - ID = 1
        #############################
        $timeteacher1 = new Time;
		$timeteacher1->id = '1';
		$timeteacher1->user_id = '1';
		$timeteacher1->teacher_id = '';
		$timeteacher1->Day = 'Tuesday';
		$timeteacher1->Start = '10:00:00';
		$timeteacher1->End = '17:00:00';
		$timeteacher1->save();
        
        $timeteacher2 = new Time;
		$timeteacher2->id = '2';
		$timeteacher2->user_id = '1';
		$timeteacher2->teacher_id = '';
		$timeteacher2->Day = 'Wednesday';
		$timeteacher2->Start = '10:00:00';
		$timeteacher2->End = '17:00:00';
		$timeteacher2->save();
        
        # Times for User1 - ID = 2
        ##########################
        $timestudent3 = new Time;
		$timestudent3->id = '3';
		$timestudent3->user_id = '2';
		$timestudent3->teacher_id = '1';
		$timestudent3->Day = 'Tuesday';
		$timestudent3->Start = '11:00:00';
		$timestudent3->End = '13:00:00';
		$timestudent3->save();
        
        $timestudent4 = new Time;
		$timestudent4->id = '4';
		$timestudent4->user_id = '2';
		$timestudent4->teacher_id = '1';
		$timestudent4->Day = 'Wednesday';
		$timestudent4->Start = '14:00:00';
		$timestudent4->End = '17:00:00';
		$timestudent4->save();
        
        # Times for User2 - ID = 3
        ##########################
        $timestudent5 = new Time;
		$timestudent5->id = '5';
		$timestudent5->user_id = '3';
		$timestudent5->teacher_id = '1';
		$timestudent5->Day = 'Tuesday';
		$timestudent5->Start = '16:00:00';
		$timestudent5->End = '17:00:00';
        $timestudent5->save();
        
        $timestudent6 = new Time;
		$timestudent6->id = '6';
		$timestudent6->user_id = '3';
		$timestudent6->teacher_id = '1';
		$timestudent6->Day = 'Wednesday';
		$timestudent6->Start = '10:00:00';
		$timestudent6->End = '11:00:00';
		$timestudent6->save();
        
        $timestudent7 = new Time;
		$timestudent7->id = '7';
		$timestudent7->user_id = '3';
		$timestudent7->teacher_id = '1';
		$timestudent7->Day = 'Wednesday';
		$timestudent7->Start = '13:00:00';
		$timestudent7->End = '16:00:00';
		$timestudent7->save();
        
        # Times for User3 - ID = 4
        ##########################
        $timestudent5 = new Time;
		$timestudent5->id = '8';
		$timestudent5->user_id = '4';
		$timestudent5->teacher_id = '1';
		$timestudent5->Day = 'Tuesday';
		$timestudent5->Start = '10:00:00';
		$timestudent5->End = '12:00:00';
        $timestudent5->save();
        
        $timestudent6 = new Time;
		$timestudent6->id = '9';
		$timestudent6->user_id = '4';
		$timestudent6->teacher_id = '1';
		$timestudent6->Day = 'Wednesday';
		$timestudent6->Start = '10:00:00';
		$timestudent6->End = '13:00:00';
		$timestudent6->save();
        
        $timestudent7 = new Time;
		$timestudent7->id = '10';
		$timestudent7->user_id = '4';
		$timestudent7->teacher_id = '1';
		$timestudent7->Day = 'Wednesday';
		$timestudent7->Start = '15:00:00';
		$timestudent7->End = '16:00:00';
		$timestudent7->save();
	}
}