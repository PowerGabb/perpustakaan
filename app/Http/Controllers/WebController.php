<?php

namespace App\Http\Controllers;

use App\Models\WebSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WebController extends Controller
{
    public function index()
    {

        $websites = WebSetting::first();
        return view('web-setting.index', compact('websites'));
    }

    public function update(Request $request, $id)
    {
        $website = WebSetting::find($id);

        if ($request->has('logo')) {
            if ($website->logo) {
                Storage::delete('public/logo/' . $website->logo);
            }

            $image = $request->file('logo');
            $imgname = 'logo' . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/logo', $imgname);
        } else {
            $imgname = $website->logo;
        }

        $website->update([
            'logo' => $imgname,
        ]);

        return redirect('/website');
    }
}
