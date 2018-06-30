<?php

namespace App\Http\Controllers;

use App\Models\Bots;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;

class BotsManagementController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $user_id = Auth::user()->id;

        $bots = Bots::where('user_id', $user_id)->orderBy('id', 'asc')->get();
        return View('botsmanagement.show-bots', compact('bots', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('botsmanagement.add-bots');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $bots = Bots::create([
            'page_name' => $request->input('page_name'),
            'page_key_id' => $request->input('page_key_id'),
            'token' => $request->input('token'),
            'greeting_text' => $request->input('greeting_text'),
            'user_id' => $user_id = Auth::user()->id
        ]);

        $bots->save();
        return redirect('bots')->with('success', trans('cess'));
        //return redirect('bots/' . $bots->id)->with('success', trans('bots.createSuccess'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        echo 'ok';
        die();
        $bots = Bots::find($id);
        $users = User::all();
        $botsUsers = [];

        foreach ($users as $user) {
            if ($user->profile && $user->profile->theme_id === $bots->id) {
                $botsUsers[] = $user;
            }
        }

        $data = [
            'theme' => $bots,
            'themeUsers' => $botsUsers,
        ];

        return view('botsmanagement.show-theme')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bots = Bots::find($id);
        $users = User::all();
        $botsUsers = [];

        foreach ($users as $user) {
            if ($user->profile && $user->profile->theme_id === $bots->id) {
                $botsUsers[] = $user;
            }
        }

        $data = [
            'theme' => $bots,
            'themeUsers' => $botsUsers,
        ];

        return view('botsmanagement.edit-theme')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $bots = Bots::find($id);


        $input = Input::only('page_name', 'page_key_id', 'token', 'greeting_text');

        $validator = Validator::make($input, Bots::rules($id));

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $bots->fill($input)->save();

        return redirect('bots/' . $bots->id)->with('success', trans('Success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $default = Bots::findOrFail(1);
        $bots = Bots::findOrFail($id);

        if ($bots->id != $default->id) {
            $bots->delete();

            return redirect('bots')->with('success', trans('Delete Bot Success'));
        }

        return back()->with('error', trans('Delete Bot Success'));
    }
}