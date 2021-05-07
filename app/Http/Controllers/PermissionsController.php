<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class PermissionsController extends Controller
{
    public function index(){

        $user = Auth::user();
        $permissions_check = $user->hasAnyPermission(['all']);

        if ($permissions_check) {
            $users = User::with('permissions')->get();
            $permissions = Permission::all();

            return Inertia::render('Permissions/Index', [
                'users' => $users,
                'permissions' => $permissions
            ]);
        } else {
            abort(403);
        }
    }
}
