<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\RoleRequest;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = Role::orderBy('id');

        // if this role is [super-admin], then redirect to 403
        $authId = auth()->id();
        if ($authId != 1) {
            $query->where('id', '!=', 1);
        }

        $roles = $query->paginate(env('PerPage'));

        return view('sections.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::where('guard_name', 'admin')->orderBy('position')->get();
        $allPermissions = $permissions->pluck('name')->toArray();
        $allPages = $permissions->unique('page')->pluck('page')->toArray();

        $defaultActions = ['view', 'create', 'update', 'delete'];
        $actions = $permissions->unique('action')->pluck('action')->toArray();
        $allActions = array_unique(array_merge($defaultActions, $actions));

        return view('sections.roles.create', compact('allPermissions', 'allPages', 'allActions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\RoleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $role = Role::create(['guard_name' => 'admin', 'name' => request('name')]);
        $role->syncPermissions(request('permissions'));

        return redirect()->route('admin.roles.index')->with('status', __('messages.createdDone'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \Spatie\Permission\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        // if this role is [super-admin], then redirect to 403
        // because this role [super_admin], just for NamaaIT User
        if ($role->id === 1 && auth()->user()->id !== 1) {
            return abort(403, $message = "you don't have permission to access this page");
        }

        $permissions = Permission::where('guard_name', 'admin')->orderBy('position')->get();
        $allPermissions = $permissions->pluck('name')->toArray();
        $allPages = $permissions->unique('page')->pluck('page')->toArray();

        $defaultActions = ['view', 'create', 'update', 'delete'];
        $actions = $permissions->unique('action')->pluck('action')->toArray();
        $allActions = array_unique(array_merge($defaultActions, $actions));

        return view('sections.roles.show', compact('role', 'allPermissions', 'allPages', 'allActions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Spatie\Permission\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        // if this role is [super-admin], then redirect to 403
        // because this role [super_admin], just for NamaaIT User
        if ($role->id === 1 && auth()->user()->id !== 1) {
            return abort(403, $message = "you don't have permission to access this page");
        }

        $permissions = Permission::where('guard_name', 'admin')->orderBy('position')->get();
        $allPermissions = $permissions->pluck('name')->toArray();
        $allPages = $permissions->unique('page')->pluck('page')->toArray();

        $defaultActions = ['view', 'create', 'update', 'delete'];
        $actions = $permissions->unique('action')->pluck('action')->toArray();
        $allActions = array_unique(array_merge($defaultActions, $actions));

        return view('sections.roles.edit', compact('role', 'allPermissions', 'allPages', 'allActions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\RoleRequest  $request
     * @param  \Spatie\Permission\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, Role $role)
    {
        // if this role is [super-admin], then redirect to 403
        // because this role [super_admin], just for NamaaIT User
        if ($role->id === 1 && auth()->user()->id !== 1) {
            return abort(403, $message = "you don't have permission to access this page");
        }

        $role->update(['guard_name' => 'admin', 'name' => request('name')]);
        $role->syncPermissions(request('permissions'));

        return redirect()->route('admin.roles.index')->with('status', __('messages.updatedDone'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Spatie\Permission\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        // if this role is [super-admin], then redirect to 403
        // because this role [super_admin], just for NamaaIT User
        if ($role->id === 1 && auth()->user()->id !== 1) {
            return abort(403, $message = "you don't have permission to access this page");
        }

        $role->delete();

        return back()->with('status', __('messages.deletedDone'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\RoleRequest  $request
     * @param  \Spatie\Permission\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function updatePermissions()
    {
        $routes = Route::getRoutes();
        $excludedRoutes = config('permission.excluded_routes');

        $allPermissions = Permission::where('guard_name', 'admin')->pluck('name')->toArray();

        $pagePermissionArr = [];
        $position = 0;
        $curPage = null;

        foreach ($routes as $route) {
            $prefix = '/admin';

            if (strpos($route->getPrefix(), $prefix) !== false) {

                $name = $route->getName();

                if (!in_array($name, $excludedRoutes)) {
                    $routeArr = explode('.', $name);
                    $page = $routeArr[1];
                    $action = $routeArr[2];

                    switch (true) {
                        case in_array($action, ['index', 'show']):
                            $permission = 'view';
                            break;

                        case in_array($action, ['create', 'store']):
                            $permission = 'create';
                            break;

                        case in_array($action, ['edit', 'update']):
                            $permission = 'update';
                            break;

                        case in_array($action, ['destroy']):
                            $permission = 'delete';
                            break;

                        default:
                            $permission = $action;
                            break;
                    }

                    if ($curPage != $page) {
                        $curPage = $page;
                        $position += 100;
                        $inc = $position;
                    }

                    $pagePermission = $permission . ' ' . $page;
                    if (!in_array($pagePermission, $pagePermissionArr)) {
                        $pagePermissionArr[] = $pagePermission;
                        $inc++;

                        if (!in_array($pagePermission, $allPermissions)) {
                            Permission::create([
                                'guard_name' => 'admin',
                                'name' => $pagePermission,
                                'page' => $page,
                                'action' => $permission,
                            ]);
                        }
                    }
                }
            }
        }

        return back()->with('status', __('messages.permissionsUpdated'));
    }
}
