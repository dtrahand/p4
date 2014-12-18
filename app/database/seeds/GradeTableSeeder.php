<?php
class GradeTableSeeder extends Seeder {
	public function run() {
		# Clear the tables to a blank slate
		DB::statement('SET FOREIGN_KEY_CHECKS=0'); # Disable FK constraints so that all rows can be deleted, even if there's an associated FK
		DB::statement('TRUNCATE grades');

        ##########
        # Grades #
        ##########
        # Peter, Grade #1
		$petergrade1 = new Grade;
		$petergrade1->id = '1';
		$petergrade1->student_id = '2';
		$petergrade1->date = '2014-01-01';
		$petergrade1->grade = '99';
		$petergrade1->save();
        # Peter, Grade #2
		$petergrade2 = new Grade;
		$petergrade2->id = '4';
		$petergrade2->student_id = '2';
		$petergrade2->date = '2014-06-21';
		$petergrade2->grade = '80';
		$petergrade2->save();
        # Peter, Grade #3
		$petergrade3 = new Grade;
		$petergrade3->id = '7';
		$petergrade3->student_id = '2';
		$petergrade3->date = '2014-11-15';
		$petergrade3->grade = '89';
		$petergrade3->save();
        
        # lucie, Grade #1
		$luciegrade1 = new Grade;
		$luciegrade1->id = '2';
		$luciegrade1->student_id = '3';
		$luciegrade1->date = '2014-01-01';
		$luciegrade1->grade = '69';
		$luciegrade1->save();
        # lucie, Grade #2
		$luciegrade2 = new Grade;
		$luciegrade2->id = '5';
		$luciegrade2->student_id = '3';
		$luciegrade2->date = '2014-06-21';
		$luciegrade2->grade = '82';
		$luciegrade2->save();
        # lucie, Grade #3
		$luciegrade3 = new Grade;
		$luciegrade3->id = '8';
		$luciegrade3->student_id = '3';
		$luciegrade3->date = '2014-11-15';
		$luciegrade3->grade = '69';
		$luciegrade3->save();
        
        # vicky, Grade #1
		$vickygrade1 = new Grade;
		$vickygrade1->id = '3';
		$vickygrade1->student_id = '4';
		$vickygrade1->date = '2014-01-01';
		$vickygrade1->grade = '60';
		$vickygrade1->save();
        # vicky, Grade #2
		$vickygrade2 = new Grade;
		$vickygrade2->id = '6';
		$vickygrade2->student_id = '4';
		$vickygrade2->date = '2014-06-21';
		$vickygrade2->grade = '89';
		$vickygrade2->save();
        # vicky, Grade #3
		$vickygrade3 = new Grade;
		$vickygrade3->id = '9';
		$vickygrade3->student_id = '4';
		$vickygrade3->date = '2014-11-15';
		$vickygrade3->grade = '96';
		$vickygrade3->save();
	}
}