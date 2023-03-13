<?php

namespace App\Http\Controllers;

use App\Models\member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $member = Member::all();

        return datatables()
                ->of($member)
                ->addIndexColumn()
                ->addColumn('select_all', function ($item)
                {
                    return '<input type="checkbox" name="id_members[]" class="checking" value="'.$item->id.'">';
                })
                ->addColumn('code', function ($item)
                {
                    return '<span class="badge bg-warning text-dark">'.$item->code.'</span>';
                })
                ->addColumn('action', function ($member)
                {
                    return 
                    '<div class="btn-group d-flex justify-content-around rounded" role="group" aria-label="Basic example">'.
                        '<a href="#" id="a" data-idedit="'.$member->id.'" class="editData btn btn-xs btn-info btn-flat"><i class="bi bi-pencil-square"></i></a>'
                        .'<a href="#" data-iddelete="'.$member->id.'" class="deleteData btn btn-xs btn-danger btn-flat"><i class="bi bi-trash"></i></a>'
                    .'</div>';
                })->rawColumns(['action', 'code', 'select_all'])
                ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'address' => ['required'],
            'phone' => ['required', 'unique:members'],
        ]);

        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // get member data
        $code = Member::latest()->first();

        if ($code == null) {
            $code = 0;
        } else {
            $code = $code->id;
        }
        $request['code'] = 'MBR'.'.'.$request->member_id.'.'.add_nol((int)$code+1, 2);
        $request['phone'] = '0'.(string)$request->phone;
        //save to database
        $member = Member::create($request->all());

        //success save to database
        if($member) {

            return response()->json([
                'success' => true,
                'message' => 'Data $member berhasil di buat',
                'data'    => $member
            ], 201);

        }

        //failed save to database
        return response()->json([
            'success' => false,
            'message' => 'Data $member gagal di buat',
        ], 409);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $member = Member::select('*')->where('id', $id)->get();
        return datatables()
                ->of($member)->addColumn('telp', function ($item)
                {
                    return substr((string)$item->phone, 1);
                })->rawColumns(['telp'])->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(member $member)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //find post by ID
        $member = Member::findOrFail($request->id);

        $request['phone'] = '0'.(string)$request->phone;

        if ($request->phone == $member->phone) {
            
        } else {
            //set validation
            $validator = Validator::make($request->all(), [
                'phone' => ['required', 'unique:members'],
            ]);
            //response error validation
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
        }

        
        if($member) {
            //update to database
            $member = $member->update($request->all());

            return response()->json([
                'success' => true,
                'message' => 'member Updated',
                'data'    => $member  
            ], 200);

        }

        //data $member not found
        return response()->json([
            'success' => false,
            'message' => 'member Not Found',
        ], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(member $member)
    {
        $member->delete();

        return response()->json('Success delete data', 204);
    }

    public function deleteSelected(Request $request)
    {
        foreach ($request->id_members as $id) {
            $product = Member::find($id);
            $product->delete();
        }

        return response()->json('Success deleting data', 204);
    }
}
