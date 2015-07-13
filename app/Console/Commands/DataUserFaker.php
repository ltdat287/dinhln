<?php namespace VirtualProject\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use VirtualProject\User;
use Faker\Factory as Faker;
use Validator;

class DataUserFaker extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'faker:user';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'faker:user';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		//
		$boss_id = $this->argument('boss_id');
        $create = $this->option('create');

        //Validate input values of boss_id
        $valids = Validator::make(array(
        	'boss_id' => $boss_id,
        	'create' => $create
        ), array(
        	'boss_id' => 'required|numeric',
        	'create' => 'required|numeric'
        ));

        if ($valids->fails()){
        	foreach($valids->messages()->all() as $msg){
        		$this->error($msg);
        	}

        	return $this->error('You need set values.');
        } else{
        	if ($this->confirm('Do you want add user used Faker? [y/n]'))
        	{
        		$faker = Faker::create();
     			for ($i = 0; $i < $create; $i++){
                $user = new Users;
                $user->name        = $faker->name;
                $user->email       = $faker->email;
                $user->password    = $faker->password;
                $user->kana 	   = $faker->name;
                $user->telephone_no= $faker->phoneNumber;
                $user->birthday	   = $faker->date($format = 'Y-m-d', $max = 'now');
                $user->note        = $faker->text;
                $user->boss_id     = $boss_id;
                $user->updated_at   = \Carbon::create(2015, 1, 4, 11, 12, 13);
            	$user->created_at   = \Carbon::create(2015, 1, 4, 11, 12, 13);
                $user->save();

                $this->info('Inserted ' . $i . ' records for user to database with boss_id:'.$boss_id);
            	}
	            $headers = ['id','name','email','phone'];
	            $content = Users::all(['id', 'name','email','phone'])->toArray();
	            $this->table($headers, $content);

	            return $this->info('Inserted database successful!');   		
        	}

        	return $this->error('Errors insert database!');
        }
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return [
			['boss_id', InputArgument::REQUIRED, 'ID of boss user, default user has not boss.'],
		];
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return [
			['create', null, InputOption::VALUE_OPTIONAL, 'Amount of user if you want add.', null],
		];
	}

}
