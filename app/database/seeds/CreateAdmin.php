<?php

class CreateAdmin extends Seeder {

    public function run() {
    	
    	DB::table('users')->delete();

    	$user = Sentry::createUser(array(
	        'email'     => 'admin@admin.com',
	        'password'  => 'admin',
	        'activated' => TRUE,
	    ));

    	$this->command->info('Admin account successfully created!');
    	$this->command->info('Email: admin@admin.com');
    	$this->command->info('Password: admin');

    }

}