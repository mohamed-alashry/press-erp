<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    /**
     * Display login page.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogin()
    {
        return view('sections.auth.login');
    }

    /**
     * Login admin.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request)
    {
        if (auth()->guard('admin')->check()) {
            return redirect()->route('admin.dashboard.home');
        } else {
            $credentials = $request->validate([
                'name' => 'required|min:2',
                'password' => 'required|min:6',
            ]);

            $credentials['status'] = 1;
            if (auth()->guard('admin')->attempt($credentials)) {
                return redirect()->route('admin.dashboard.home');
            } else {
                request()->flash();
                if (auth()->guard('admin')->validate([
                    'name' => request('name'), 'password' => request('password'), 'status' => '0'
                ])) {
                    return back()->with('status_danger', __('lang.inactiveAccount'));
                }
                return back()->with('status_danger', __('lang.wrongCredentials'));
            }
        }
    }

    /**
     * Logout user.
     *
     * @return Response
     */
    public function logout()
    {
        auth()->guard('admin')->logout();

        return back();
    }
}
