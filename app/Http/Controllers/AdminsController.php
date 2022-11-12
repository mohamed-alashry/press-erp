<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use Spatie\Permission\Models\Role;
use App\Models\Admin;

class AdminsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = Admin::sorted();

        $authId = auth()->id();
        if ($authId != 1) {
            $query->where('id', '!=', 1);
        }

        $admins = $query->paginate(10);

        return view('sections.admins.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $query = Role::orderBy('id');
        $authId = auth()->id();
        if ($authId != 1) {
            $query->where('name', '!=', 'super_admin');
        }
        $roles = $query->get();

        return view('sections.admins.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\AdminRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminRequest $request)
    {
        $admin = Admin::create($request->all());
        $admin->syncRoles(request('roles'));

        return redirect()->route('admin.admins.index')->with('status', __('lang.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        return view('sections.admins.show', compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        $query = Role::orderBy('id');
        $authId = auth()->id();
        if ($authId != 1) {
            $query->where('name', '!=', 'super_admin');
        }
        $roles = $query->get();

        return view('sections.admins.edit', compact('admin', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\AdminRequest  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(AdminRequest $request, Admin $admin)
    {
        $admin->update($request->all());
        $admin->syncRoles(request('roles'));

        return redirect()->route('admin.admins.index')->with('status', __('lang.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        $admin->delete();

        return back()->with('status', __('lang.deleted'));
    }
}
