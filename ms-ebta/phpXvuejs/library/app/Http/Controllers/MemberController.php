<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
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
    
    public function api()
    {
        $member = Member::all();
        $datatable = datatables()->of($member)
                    ->addColumn('dibuat', function($memb) {
                        return tanggal($memb->created_at);
                    })
                    ->addColumn('jenisKelamin', [
                        'P' => 'wanita',
                        'L' => 'pria'
                    ])->addIndexColumn();

        return  $datatable->make(true);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function apiTrash()
    {
        $member = Member::onlyTrashed();
        $datatable = datatables()->of($member)->addIndexColumn();

        return  $datatable->make(true);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        return view('admin/member/index', compact('user'));
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
        $this->validate($request, [
            'name' => ['required','min:5','max:20'],
            'phone_number' => ['required','numeric'],
            'gender' => ['required'],
            'address' => ['required'],
            'email' => ['required','email', 'unique:members']
        ]);
        // return $request;
        // save data ke database
        $member= new Member;
        $member->name = $request->name;
        $member->gender = $request->gender;
        $member->phone_number = $request->phone_number;
        $member->address = $request->address;
        $member->email = $request->email;

        $member->save();
        // redirect
        // redirect('members')->with('success', 'Data berhasil ditambahkan');
        // return redirect('members')->with('success', 'Data berhasil ditambahkan');
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
        //
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
        // validasi required laravel
        if ($request->email === $member->email) {
            $this->validate($request, [
                'name' => ['required','min:5','max:20'],
                'phone_number' => ['required','numeric'],
                'address' => ['required'],
            ]);
        } else {
            $this->validate($request, [
                'name' => ['required','min:5','max:20'],
                'phone_number' => ['required','numeric'],
                'address' => ['required'],
                'email' => ['required','email', 'unique:members']
            ]);
        }

        // update data
        $member->update($request->all()); // perlu menambahkan fillable atau guarded di model
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        return view('.admin.member.trash');
    }

    public function restore()
    {
        Member::onlyTrashed()
        ->where('id', $_GET['id'])
        ->restore();
    }

    public function restoreAll()
    {
        Member::onlyTrashed()->restore();
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Publisher  $publisher
     * @return \Illuminate\Http\Response
     */
    public function delete()
    {
        Member::onlyTrashed()->where('id', $_GET['id'])->firstOrFail()->forceDelete();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Publisher  $publisher
     * @return \Illuminate\Http\Response
     */
    public function deleteAll()
    {
        Member::onlyTrashed()->forceDelete();
    }
}
