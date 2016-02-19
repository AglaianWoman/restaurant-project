<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		// $this->call('UserTableSeeder');
	}

}
/*
class AdministratorTableSeeder extends Seeder {

	public function run()
	{
		//DB::table('users')->delete();

		Administrator::create(array('first_name'=>"paul",'last_name'=>'rodriguez',
				'username'=>'pauldrodriguez',
				'email' => 'paul.d.rodriguez@outlook.com',
				'password'=>Hash::make('paulrod1790')
		));
	}

}*
