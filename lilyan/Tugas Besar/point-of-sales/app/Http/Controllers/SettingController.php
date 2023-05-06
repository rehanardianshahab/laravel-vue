<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::all();

        return view('setting.index', compact('setting'));
    }

    public function create()
    {
        return view('setting.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Setting::create($request->all());
        $setting = new Setting();
        $setting->name_store = $request->name_store;
        $setting->phone_number = $request->phone_number;
        $setting->address = $request->address;
        $setting->discount = $request->discount;

        if ($request->hasFile('path_logo')) {
            $request->file('path_logo')->move('img/', $request->file('path_logo')->getClientOriginalName());
            $setting->path_logo = $request->file('path_logo')->getClientOriginalName();
        }

        $setting->save();
        // dd($setting);
        return redirect('settings');
    }

    public function edit($id)
    {
        $setting = Setting::findorfail($id);
        // return $setting;
        return view('setting.edit', compact('setting'));
    }

    public function update(Request $request, $id)
    {
        $ubah = Setting::findorfail($id);
        $awal = $ubah->path_logo;

        $setting = [
            'name_store' => $request['name_store'],
            'address' => $request['address'],
            'phone_number' => $request['phone_number'],
            'path_logo' => $awal ?? null,
            'discount' => $request['discount'],
        ];
        if($request->path_logo) {
            $request->path_logo->move(public_path().'/img', $awal);
        }
        
        $ubah->update($setting);

        return redirect('settings');
    }
    
}
