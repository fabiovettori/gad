<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Registry;
use App\Imports\RegistryImport;
use App\Exports\RegistryExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;

class RegistryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $registries = Registry::all();

        return Inertia::render('Registry/Index', [
            'registries' => $registries
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $permissions_check = $user->hasAnyPermission(['all', 'edit']);

        if ($permissions_check) {
            return Inertia::render('Registry/Create');
        } else {
            abort(403);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required|min:2|max:150',
            'address' => 'required|min:5|max:255',
            'postcode' => 'required|numeric|min:10000|max:99999',
            'city' => 'required|min:2|max:50',
            'district' => 'required|min:2|max:150',
            'region' => 'required|min:2|max:150',
            'email' => 'required|email|min:7|max:150|unique:App\Models\Registry,email'
        ]);

        $form_data = $request->all();
        $new_registry = new Registry();
        $new_registry->fill($form_data);
        $new_registry->save();

        return Redirect::route('registry.index')
                ->with('success', 'Item added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $registry = Registry::find($id);
        //
        // if ($registry) {
        //     return Inertia::render('Registry/Show', [
        //         'registry' => $registry
        //     ]);
        // } else {
        //     abort(404);
        // }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        $permissions_check = $user->hasAnyPermission(['all', 'edit']);

        if ($permissions_check) {
            $registry = Registry::find($id);

            if ($registry) {
                return Inertia::render('Registry/Edit', [
                    'registry' => $registry
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
        $validated = $request->validate([
            'company_name' => 'required|min:2|max:150',
            'address' => 'required|min:5|max:255',
            'postcode' => 'required|numeric|min:10000|max:99999',
            'city' => 'required|min:2|max:50',
            'district' => 'required|min:2|max:150',
            'region' => 'required|min:2|max:150',
            'email' => 'required|email|min:7|max:150|unique:App\Models\Registry,email,'.$id,
        ]);

        $form_data = $request->all();
        $registry = Registry::find($id)->update($form_data);

        return Redirect::route('registry.index')
                ->with('success', 'Item modified');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $user = Auth::user();
        $permissions_check = $user->hasAnyPermission(['all', 'edit']);

        if ($permissions_check) {
            $registry = Registry::find($id);
            if ($registry) {
                $registry->delete();

                return Redirect::back()
                    ->with('success', 'Item deleted');
            } else {
                abort(404);
            }
        } else {
            abort(403);
        }
    }

    public function import(Request $request)
    {
        $path = $request->file('registry_db');

        if ($path != null) {
            $import = new RegistryImport();
            $import->import($path);

            $errors = $import->errors();

            return Redirect::back()
                ->with('success', 'Items added');
        }
    }

    public function export()
    {
        return (new RegistryExport)->download('registry.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }
}
