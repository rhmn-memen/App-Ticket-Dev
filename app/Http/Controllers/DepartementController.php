<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class DepartementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departement = Departement::orderBy('name')->get();
        return view('server.departement.index', compact('departement'));
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
        $this->validate($request, [
            'name' => 'required'
        ]);

        Departement::updateOrCreate(
            [
                'id' => $request->id
            ],
            [
                'name' => $request->name,
                'status' => $request->status
            ]
        );

        if ($request->id) {
            return redirect()->route('departement.index')->with('success', 'Success Update Departement!');
        } else {
            return redirect()->route('departement.index')->with('success', 'Success Add Departement!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Departement  $departement
     * @return \Illuminate\Http\Response
     */
    public function show(Departement $departement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Departement  $departement
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $departement = Departement::find($id);
        return view('server.departement.edit', compact('departement'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Departement  $departement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Departement $departement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Departement  $departement
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Departement::find($id)->delete();
        return redirect()->back()->with('success', 'Success Delete Departement!');
    }
}
