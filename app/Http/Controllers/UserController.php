<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;
use App\User;
use App\Role;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Only authenticated users may access to the pages of this controller
        $this->middleware('auth');
    }

    /**
     * Display a the profile page. Accessible to any authenticated user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function profile(Request $request)
    {
        $user = Auth::user();
        return view('users.profile', ['user' => $user]);
    }

    /**
     * Display a listing of the users.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(Auth::user()->role_id == 2){
            return "Unauthorise page";
        } else {
            $users = User::with('roles')->get();
            return view('pages.listUser', ['users' => $users]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // $request->user()->authorizeRoles(['Administrator']);
        $roles = Role::all();
        if(Auth::user()->role_id == 2){
            return redirect('users');
        } else {
            return view('pages.createUser', ['roles' => $roles]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->user()->authorizeRoles(['Administrator']);
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'firstname'  => 'required',
            'lastname'  => 'required',
            'email' => 'email',
            'password' => 'required|min:6',
            'verify' =>  'required_with:password|same:password|min:6'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the validation of fields

        // store the new user and attach roles to it
        $user = new User;
        $user->firstname = Input::get('firstname');
        $user->lastname = Input::get('lastname');
        $user->email = Input::get('email');
        $user->role_id = Input::get('role');
        $user->password = bcrypt(Input::get('password'));

        $user->save();

        // redirect
        Session::flash('message.level', 'success');
        Session::flash('message.content', __('The user was successfully created'));
        return Redirect::to('users');

    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $request->user()->authorizeRoles(['Administrator']);
        $user = User::findOrFail($id);
        $user->roleIds = $user->roles->pluck('id')->toArray();
        $roles = Role::all();
        return view('users.show', ['user' => $user, 'roles' => $roles]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        // $request->user()->authorizeRoles(['Administrator']);
        $user = User::find($id);
        if(Auth::user()->role_id == 2){
            return redirect('users');
        } else {
            $roles = Role::all();
            return view('pages.editUser', ['user' => $user, 'roles' => $roles]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $request->user()->authorizeRoles(['Administrator']);
        // validate
        $rules = array(
            'firstname'  => 'required',
            'lastname'  => 'required',
            'email' => 'required|email',
            'roles' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the validation of fields
        if ($validator->fails()) {
            return Redirect::to('users/' . $id .  '/edit')
                ->withErrors($validator);
        } else {
            // update user and synchronize the roles
            $user = User::find($id);
            $user->firstname = Input::get('firstname');
            $user->lastname = Input::get('lastname');
            $user->email = Input::get('email');
            $user->role_id = Input::get('roles');
            $user->save();
            // $user->roles()->sync(Input::get('roles'));

            // redirect
            Session::flash('message.level', 'success');
            Session::flash('message.content', __('The user was successfully updated'));
            return Redirect::to('users');
        }
    }

    /**
     * Remove the specified resource from storage.
     * This method is called by Ajax
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        // $request->user()->authorizeRoles(['Administrator']);
        if(Auth::user()->role_id == 2){
            return redirect('users');
        } else {
            $user = User::findOrFail($id);
            $user->delete();
            return redirect()->route('users.index');
        }

    }

    /**.
     * Export the list of users into Excel
     *
     * @return \Illuminate\Http\Response
     */
    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
}

