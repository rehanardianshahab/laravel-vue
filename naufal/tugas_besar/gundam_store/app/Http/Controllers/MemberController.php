<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
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
        return view('member.index');
    }

    public function api() {
        $members = Member::with('user');
        $datatables = datatables()->of($members)->addIndexColumn();

        return $datatables->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $this->validate($request, [
            'name' => ['required'],
            'is_admin' => ['required'],
            'address' => ['required'],
            'phone_number' => ['required'],
            'gender' => ['required']
        ]);

        $user = DB::table('users')
                    ->where('id', $id)
                    ->update([
                        'name' => $request['name'],
                        'is_admin' => $request['is_admin'],
                        'email' => $request['email']
                    ]);

        if($request['is_admin'] == '1') {
            $member = DB::table('members')
                        ->where('id', $id)
                        ->update([
                            'name' => $request['name'],
                            'address' => $request['address'],
                            'phone_number' => $request['phone_number'],
                            'gender' => $request['gender'],
                            'role' => 'admin'
                        ]);
        } else {
            $member = DB::table('members')
                        ->where('id', $id)
                        ->update([
                            'name' => $request['name'],
                            'address' => $request['address'],
                            'phone_number' => $request['phone_number'],
                            'gender' => $request['gender'],
                            'role' => 'member'
                        ]);
        }

        return redirect('members');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $users = User::find($id);
        $users->delete();

        return redirect('members');
    }
}
