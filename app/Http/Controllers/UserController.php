<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $current_user = Auth::user();
        $permissions_check = $current_user->hasAnyPermission(['all']);

        if ($permissions_check) {
            $user = User::where('id', $id)
                ->with('permissions')->first();
            $permissions = Permission::all();

            if ($user) {
                return Inertia::render('Permissions/Edit', [
                    'user' => $user,
                    'permissions' => $permissions
                ]);
            } else {
                abort(404);
            }
        } else {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        dd($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $current_user = Auth::user();
        $permissions_check = $current_user->hasAnyPermission(['all']);

        if ($permissions_check) {
            $user = User::find($id);
            if ($user) {
                $user->delete();

                return Redirect::back()
                    ->with('success', 'Item deleted');
            } else {
                abort(404);
            }
        } else {
            abort(403);
        }
    }
}
