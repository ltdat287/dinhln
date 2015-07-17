<?php

namespace VirtualProject\Http\Controllers;

use VirtualProject\Http\Requests;
use VirtualProject\Http\Controllers\Controller;
use VirtualProject\Http\Requests\MemberAddFormRequest;
use VirtualProject\Http\Requests\MemberEditFormRequest;
use VirtualProject\Http\Requests\MemberSearchFormRequest;
use Kodeine\Acl\Models\Eloquent\Role;
use VirtualProject\User;
use Request;
use Redirect;
use Session;
use Input;
use Auth;
use VirtualProject\Helpers\MemberHelper;

class MemberController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Redirect to user detail if has employ role.
        if (MemberHelper::getCurrentUserRole() == 'employ')
        {
            $user = Auth::user();
            return redirect('/member/' . $user->id . '/detail');
        }
        
        // List user employ with non disable DESC </dg>;
        $users = User::getUsers();
        
        // Only listing employ of current user own
        if (MemberHelper::getCurrentUserRole() == 'boss')
        {
            $users->where('boss_id', '=', Auth::user()->id);
        }
        
        //max record display on page
        $users = $users->paginate(VP_LIMIT_PAGINATE);
        
        // Set data for view
        $data = array(
            'users'    => $users,
        );
        
        return view('members.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Clear user session.
        Session::forget('user');
        
        // Get roles
        $roles = Role::all();
        
        // Get bosses
        $bosses = User::getUsers()->role('boss')->get();
        
        // Get user session
        $user = Session::get('user');
        
        // Build data for views
        $data = array(
            'roles' => $roles,
            'bosses' => $bosses,
            'user' => $user
        );
        
        return view('members.add', $data);
    }

    /**
     * [POST] Show the member add confirm view.
     *
     * @param MemberAddFormRequest $request            
     * @return \Illuminate\View\$this
     */
    public function add_conf(MemberAddFormRequest $request)
    {
        // Get user data
        $data = self::_confirmUser($request);
        
        return view('members.add_conf', $data);
    }

    /**
     * [POST] Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        // Get user from session
        $user = Session::get('user');
        
        if (isset(Input::all()['back']) || empty($user)) {
            return Redirect::route('add');
        } else {
            $record = new User();
            $record = self::_saveUser($record, $user);
            
            // Clear session
            Session::forget('user');
            
            $message = self::_linkToDetail($record->id) . trans('labels.member_add_comp_message');
            $data = array(
                'label' => trans('labels.member_add_comp'),
                'message' => $message
	        );
	        
	        return view('members.common.member_comp', $data);
	    }
	}

	/**
	 * Show the member search view.
	 * 
	 * @param string $search_query
	 * @return \Illuminate\View\View
	 */
	public function search(MemberSearchFormRequest $request)
	{	

	    $users = null;
	    $arr_cons = $arr_vals = null;
	    $arr_define = array('name', 'email', 'kana', 'telephone_no');
	    
	    // Check roles checked
	    $user_ids = array();
	    $arr_checked = ['admin', 'boss', 'employ'];
	    foreach ($arr_checked as $checked)
	    {
	        if (Input::has($checked) && Input::get($checked) == 1)
	        {
	            $users = User::getUsers()->role($checked)->get();
	            foreach ($users as $user)
	            {
	                if (! in_array($user->id, $user_ids))
	                {
	                    $user_ids[] = $user->id;
	                }
	            }
	        }
	        
	    }
	    
	    //Check has value delete and decode JSON to ARRAY; 
    	if (Input::has('putValdel')) 
    	{
    		$Json2Array = json_decode(Input::get('putValdel'));
    		foreach ($Json2Array as $user_id) {
    			$role = User::where('id', '=', $user_id)->getFirstRole();
    			dd($role);
    			$user = User::where('id', '=', $user_id)->delete();
    		}
    	}

	    /*  */
	    foreach ($arr_define as $define)
	    {
	        if (Input::has($define))
	        {
	            $arr_cons[] = $define . ' = ?';
	            $arr_vals[] = Input::get($define);
	        }
	    }
	    
	    // Check conditions exists.
	    if ($arr_cons)
	    {
	        $cons = implode(' AND ', $arr_cons);
	    }
	    
	    // Get users with user ids.
	    $users = User::getUsers();
	    
	    // Only listing employ of current user own
	    if (MemberHelper::getCurrentUserRole() == 'boss')
	    {
	        $users->where('boss_id', '=', Auth::user()->id);
	    }
	    
	    if (count($user_ids))
	    {
	        $users = $users->whereIn('id', $user_ids);
	    }
	    
	    // Check exists search conditions.
	    if (count($arr_cons))
	    {
	        $users = $users->whereRaw($cons, $arr_vals);
	    }
	    
	    // Paginate users.
	    if (count($users))
	    {
	        $users = $users->paginate(VP_LIMIT_PAGINATE)->setPath('search');
	    }
	    
	    // Get role.
	    $roles = Role::all();
	    
	    // Build data for view.
	    $data = array(
	        'users' => $users,
	        'roles' => $roles
	    );
	    
	    return view('members.search', $data);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
	    // Clear user session.
	    Session::forget('user');
	    
	    $user = User::find($id);
	    
	    // Get role.
	    $role = $user->getFirstRole();
	    
	    // Get boss.
	    $boss = User::find($user->boss_id);
	    
	    // Prepare data for view.
	    $data = array (
	        'user' => $user,
	        'role' => $role,
	        'boss' => $boss,
	        'id'   => $id
	    );
	    
		return view('members.detail', $data);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
	    // Clear user session.
	    Session::forget('user');
	    
	    // Get roles
	    $roles = Role::all();
	    
	    // Get bosses
	    $bosses = User::role('boss')->get();
	    
	    // Get user from db
	    $user = User::find($id);
	    
	    // Get user session
	    if (Session::has('user'))
	    {
	        $user = Session::get('user');
	    } else {
	        Session::put('user', $user);
	    }
	    
	    // Prepare data for view.
	    $data = array(
	        'id'     => $id,
	        'roles'  => $roles,
	        'bosses' => $bosses,
	        'user'   => $user
	    );
	    
	    return view('members.edit', $data);
	}

	/**
	 * [POST] Process validation form edit member submit
	 * 
	 * @param integer $id
	 * @param MemberEditFormRequest $request
	 */
	public function edit_conf($id, MemberEditFormRequest $request)
	{
	    // Get user data
	    $data = self::_confirmUser($request);
	    
	    $data['id'] = $id;
	    
	    return view('members.edit_conf', $data);
	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
	    // Get user from session.
	    $user   = Session::get('user');
	    $record = User::find($id);
        if (! $record) {
            return Redirect::route('not_found');
        }
        $record = self::_saveUser($record, $user);
        
        // Clear session
        Session::forget('user');
        
        $message = self::_linkToDetail($record->id) . trans('labels.member_edit_comp_message');
        $data = array(
            'label'   => trans('labels.member_edit_comp'),
            'message' => $message
        );
        
        return view('members.common.member_comp', $data);
	}

	/**
	 * [POST] Delete user.
	 * 
	 * @param integer $id
	 * @return \Illuminate\View\View
	 */
	public function delete_conf($id)
	{
	    // Clear user session.
	    Session::forget('user');
	    
	    // Get user.
	    $user = User::find($id);
	    
	    // Get role.
	    $role = Role::where('slug', '=', $user->getFirstRole()->slug)->first();
	     
	    // Get boss.
	    $boss = User::find($user->boss_id);
	    
	    $errors = array();
	    // Check current role is BOSS and not same boss_id of user delete.
	    if (MemberHelper::getCurrentUserRole() == 'boss' && $user->boss_id != Auth::user()->id)
	    {
	        $errors[] = trans('valids.user_not_delete_boss');
	    }
	    
	    // Prepare data for view.
	    $data = array(
	        'id' => $id,
	        'user' => $user,
	        'role' => $role,
	        'boss' => $boss,
	        'errors' => $errors
	    );
	    
	    return view('members.delete_conf', $data);
	}
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
	    $record = User::find($id);
	    
	    // Destroy 
	    $record->disabled = true;
	    $record->save();
	    
        $data = array(
            'label' => trans('labels.member_delete_comp'),
            'message' => trans('labels.deleted')
        );
        
        return view('members.common.member_comp', $data);
	}

	/**
	 * Get link to member detail page.
	 * 
	 * @param string $userId
	 * @return string
	 */
	private static function _linkToDetail($userId = '')
	{
	    return html_entity_decode(trans('labels.id') . ': <a href="' . url('/member/' . $userId . '/detail') . '">' . $userId . '</a>');
	}

	/**
	 * prepare user data for confirm view.
	 * 
	 * @param object $request
	 * @return array
	 */
    private static function _confirmUser($request)
    {
        // Prepare cache data.
        $user = new \stdClass;
        $user->email              = $request->get('email');
        $user->email_confirmation = $request->get('email_confirmation');
        $user->name               = $request->get('name');
        $user->kana               = $request->get('kana');
        $user->password           = $request->get('password');
        $user->telephone_no       = $request->get('telephone_no');
        $user->birthday           = $request->get('birthday');
        $user->note               = ($request->get('note')) ? $request->get('note') : '';
        $user->use_role           = $request->get('use_role');

        if (MemberHelper::getCurrentUserRole() == 'boss')
        {
            $user->boss_id = MemberHelper::checkLogin()->id;
        }
        else
        {
            $user->boss_id = $request->get('boss_id');
        }
        
        // Get role.
        $role = Role::where('slug', '=', $user->use_role)->first();
        
        // Get boss.
        $boss = User::find($user->boss_id);
        
        // Set user from session.
        Session::put('user', $user);
        
        // Prepare data for view.
        $data = array (
            'user' => $user,
            'role' => $role,
            'boss' => $boss
        );
        
        return $data;
    }

    /**
     * Common function for save user.
     * 
     * @param object $record
     * @param object $user
     * @return object
     */
    private static function _saveUser(&$record, $user)
    {
        if (! $user) {
            return null;
        }
        
        // Build data.
        $record->email        = $user->email;
        $record->name         = $user->name;
        $record->kana         = $user->kana;
        $record->password     = bcrypt($user->password);
        $record->telephone_no = $user->telephone_no;
        $record->birthday     = $user->birthday;
        $record->note         = ($user->note) ? $user->note : '';
        if (MemberHelper::getCurrentUserRole() == 'boss')
        {
            $user->use_role = 'employ';
            $record->boss_id = MemberHelper::checkLogin()->id;
        }
        else
        {
            if ($user->use_role == 'employ') {
                $record->boss_id = (int) $user->boss_id;
            } else {
                $record->boss_id = 0;
            }
        }
        
        $record->save();
        
        // Add role for user.
        if (MemberHelper::getCurrentUserRole() != 'employ')
        {
            $record->assignRole($user->use_role);
        }
        
        return $record;
    }
}
