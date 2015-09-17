<?php

class BaseController extends Controller {
    
    public function __construct() {
        $menus = \DB::table('menu')->where('parent_id',0)->where('publish','Y')->orderBy('order','asc')->get();
        foreach($menus as $mn){
            $mn->child = \DB::table('menu')->where('parent_id',$mn->id)->where('publish','Y')->orderBy('order','asc')->get();
        }
        View::share('menus', $menus);
        
        $username = \Session::get('onusername');
        if(isset($username) && $username != "" && $username != null){
            $user = Toddish\Verify\Models\User::where('username',\Session::get('onusername'))->first();
            View::share('onuser', $user);
            
            $emp = \DB::table('employees')->where('emp_no',$user->username)->first();
            View::share('onemp', $emp);
        }
        
        $constvals = \DB::table('constval')->get();
        $const = array();
        foreach($constvals as $dt){
            $const[$dt->name] = $dt->value;
        }
        View::share('const', $const);
    }

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

}
