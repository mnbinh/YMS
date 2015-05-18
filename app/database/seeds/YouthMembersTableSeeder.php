<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class YouthMembersTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 30) as $index)
		{
			YouthMember::create([
                'date_of_bird' => $faker->date(),
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'email' => $faker->email,
                'student_id'=> $faker->word ,
                'youth_union_id' => 1


			]);
		}
        foreach(range(1, 30) as $index)
        {
            YouthMember::create([
                'date_of_bird' => $faker->date(),
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'email' => $faker->email,
                'student_id'=> $faker->word ,
                'youth_union_id' => 2


            ]);
        }
	}

}