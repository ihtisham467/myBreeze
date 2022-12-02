<?php

namespace App\Http\Middleware;

use App\Models\Setting;
use Illuminate\Http\Request;
use Inertia\Middleware;
use Spatie\Permission\Models\Permission;
use Tightenco\Ziggy\Ziggy;
use Illuminate\Support\Str;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';
    // public function rootView(Request $request)
    // {
    //     if(auth()->check()) {
    //         return 'admin';
    //     }
    //     else {
    //         return 'app';
    //     }
    // }

    /**
     * Determine the current asset version.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed[]
     */
    public function share(Request $request)
    {
        $permissionsArray = [];
        if(auth()->check()) {
            $permissions = Permission::pluck('name');
            foreach($permissions as $permission) {
                $name = Str::lower(str_replace(' ', '_', $permission));
                $permissionsArray[$name] = auth()->user()->can($permission);
            }
        }
        $setting = Setting::firstOrFail();
        return array_merge(parent::share($request), [
            'auth' => [
                'user' => $request->user(),
            ],
            'ziggy' => function () use ($request) {
                return array_merge((new Ziggy)->toArray(), [
                    'location' => $request->url(),
                ]);
            },
            'flash' => [
                'successMsg' => session('successMsg'),
                'errorMsg' => session('errorMsg'),
                'reloadPageOnce' => session('reloadPageOnce'),
            ],
            'setting' => [
                'app_name' => $setting->app_name,
            ],
            'role' => $request->user() ? auth()->user()->roles[0]->name : null,
            'permissions' => $permissionsArray,
        ]);
    }
}
