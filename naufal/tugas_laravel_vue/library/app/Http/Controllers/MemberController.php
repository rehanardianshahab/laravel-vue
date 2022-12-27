<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MemberController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.member.index');
    }

    public function api() {
        $members = Member::all();
        $datatables = datatables()->of($members)
                            ->addColumn('date', function($member) {
                                return convert_date($member->entry_date);
                            })->addIndexColumn();

        return $datatables->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.member.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'unique:members', 'max:255'],
            'gender' => ['required'],
            'phone_number' => ['required', 'unique:members', 'max:13'],
            'address' => ['required'],
            'email' => ['required', 'unique:members', 'max:255'],
            'role' => ['required'],
            'entry_date' => ['required'],
        ]);

        Member::create($request->all());

        return redirect('members');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member)
    {
        return view('admin.member.edit', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Member $member)
    {
        $this->validate($request, [
            'name' => ['required', Rule::unique('members')->ignore($member->id), 'max:255'],
            'address' => ['required'],
            'phone_number' => ['required', Rule::unique('members')->ignore($member->id), 'max:13'],
            'address' => ['required'],
            'email' => ['required', Rule::unique('members')->ignore($member->id), 'max:255'],
            'role' => ['required'],
            'entry_date' => ['required'],
        ]);

        $member->update($request->all());

        return redirect('members');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        $member->delete();
    }
}
