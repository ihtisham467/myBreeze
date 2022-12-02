<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index() {
        if(!auth()->user()->can('Update App Setting ')) {
            abort(403);
        }

        $setting = Setting::firstOrFail();
        return inertia('Setting/Index', compact('setting'));
    }
    
    public function update(Request $request) {
        if(!auth()->user()->can('Update App Setting ')) {
            abort(403);
        }
        
        $this->validate($request, [
            'app_name' => 'required',
        ]);

        $setting = Setting::firstOrFail();
        Setting::where('id', $setting->id)->update([
            'app_name' => $request->app_name,
        ]);

        return back()->with('successMsg', 'Setting Updated Successfully!');
    }
}
