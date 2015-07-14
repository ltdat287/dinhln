<?php namespace VirtualProject\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use VirtualProject\User as Users;
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
	protected $description = 'faker:user {boss_id} {--limit=}';

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
        $limit = $this->option('limit');

        // Validate input values of boss_id
        $valids = Validator::make(array(
        	'boss_id' => $boss_id,
        	'limit' => $limit
        ), array(
        	'boss_id' => 'required|numeric',
        	'limit' => 'required|numeric'
        ));

        if ($valids->fails()) {
        	foreach($valids->messages()->all() as $msg){
        		$this->error($msg);
        	}

        	return $this->error('You need set values.');
        } else {
        	if ($this->confirm('Do you want add user used Faker? [y/n]')) {
        		// Insert data faker for users.
        		$faker = Faker::create();
     			for ($i = 0; $i < $limit; $i++) {
	                $user = new Users;
	                $user->name         = $faker->name;
	                $user->email        = $faker->email;
	                $user->meta_pass    = $faker->numberBetween($min = 10000000, $max = 90000000);
	                $user->password     = bcrypt($user->meta_pass);
	                $user->kana 	    = $faker->name;
	                $user->telephone_no = $faker->phoneNumber;
	                $user->birthday	    = $faker->date($format = 'Y-m-d', $max = 'now');
	                $user->note         = $faker->text;
	                $user->boss_id      = $boss_id;
	                $user->updated_at   = $faker->dateTime($max = 'now');
	            	$user->created_at   = $faker->dateTime($max = $user->updated_at);
	            	$user->save();

		            $this->info('Inserted ' . $i . ' records for user to database with boss_id:' . $boss_id);

	                //check boss_id and set role for user
	                if ($user->boss_id) 
	                {
	                	$user->assignRole('employ');
	                	$this->info('Add role for user to Employment');
	                } else{
		                // $boss = $user->where('id', '=', $user->boss_id)->first();
		                // // dd($boss);
		                // if (!isset($boss)) 
		                // {
		                // 	$this->error('This boss has die!');
		                // 	$user->assignRole('employ');
		                // 	$this->info('Add role for this user to Employment');
		                // } else {
		                // $slug_boss = $boss->getFirstRole();
		                // 	if ($slug_boss->slug == 'employ') 
		                // 	{
		                // 		$user->assignRole('employ');
	                	// 		$this->info('Add role for user to Employment');
		                // 		$boss->assignRole('boss');
		                // 		$this->info('Add role for user to Boss with boss_id:' . $boss_id);
		                // 	}
		                // }
		            }
          		}

				// Draw table into console.
	            $headers = ['id', 'name', 'email', 'password', 'boss_id'];
	            $content = Users::all(['id', 'name', 'email', 'meta_pass', 'boss_id'])->toArray();
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
			['limit', null, InputOption::VALUE_OPTIONAL, 'Amount of user if you want add.', null],
		];
	}

}
