<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // clear permission cache
        app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

        $this->updatePermissions();

        $role = Role::create(['name' => 'Super Admin', 'guard_name' => 'admin']);

        $admin = Admin::find(1);
        $admin->assignRole($role);
        $admin = Admin::find(2);
        $admin->assignRole($role);
    }

    private function updatePermissions()
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
    }
}
