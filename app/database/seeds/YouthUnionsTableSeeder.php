<?php

// Composer: "fzaninotto/faker": "v1.3.0"
//use Faker\Factory as Faker;

class YouthUnionsTableSeeder extends Seeder {

	public function run()
	{
//		$faker = Faker::create();

//		foreach(range(1, 10) as $index)
//		{
			YouthUnion::create([
             'name'=> 'Tin Học K37'
			]);
            YouthUnion::create([
            'name'=> 'Hóa Học K37'
        ]);
            YouthUnion::create([
            'name'=> 'Hóa Dược K37'
        ]);

//		}
	}

}