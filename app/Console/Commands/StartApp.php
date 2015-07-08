<?php
namespace VirtualProject\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use VirtualProject\User;
use VirtualProject\Services\Registrar;
use Kodeine\Acl\Models\Eloquent\Role;
use Kodeine\Acl\Models\Eloquent\Permission;

class StartApp extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'start:app';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start app command for insert sample data into database.';

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
        /*
         * Create roles sample data in database
         */
        $data = array(
            array(
                'name' => '管理者',
                'slug' => 'admin',
                'description' => 'Manage administration privileges'
            ),
            array(
                'name' => 'BOSS',
                'slug' => 'boss',
                'description' => 'Manage BOSS privileges'
            ),
            array(
                'name' => '従業員',
                'slug' => 'employ',
                'description' => 'Manage Employment privileges'
            )
        );
        
        foreach ($data as $i => $item)
        {
        	// Check exits role in db
            $record = Role::where('slug', '=', $item['slug'])->first();
            if (! $record)
            {
                $role = new Role();
                $role->name        = $item['name'];
                $role->slug        = $item['slug'];
                $role->description = $item['description'];
                $role->save();
            }
        }
        
        $this->info('Insert sample data into database completed!');
        
        /* Create sample user admin */
        $email    = 'admin@localhost';
        $name     = $email;
        $password = 'SxRVYMtn';
        $role     = 'admin';
        
        $password = ($password) ? bcrypt($password) : '';
        $data = [
            'email'    => $email,
            'name'     => $name,
            'password' => $password,
            'password_confirmation' => $password
        ];
        
        $registrar = new Registrar();
        $validator = $registrar->validator($data);
        
        if (! $validator->fails())
        {
            $user = User::create($data);
            $user->name         = '管理 太郎';
            $user->kana         = 'カンリ タロウ';
            $user->telephone_no = '090-1234-5678';
            $user->birthday     = \Carbon::create(1980, 1, 1);
            $user->note         = "EDU EMS デフォルトアカウントです。\nこのアカウントは常に存在します。";
            $user->updated_at   = \Carbon::create(2015, 1, 4, 11, 12, 13);
            $user->created_at   = \Carbon::create(2015, 1, 4, 11, 12, 13);
            $user->save();
        }
        else
        {
            foreach ($validator->messages()->all() as $message)
            {
                $this->error($message);
            }
            exit();
        }
        
        // Add role for current user
        $record = Role::where('slug', '=', $role)->first();
        if ($record)
        {
            $user->assignRole($record->slug);
        }
        
        $this->info('Insert sample admin account into database completed!');
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array();
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array();
    }
}
