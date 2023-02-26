<?php

namespace App\Http\Controllers;

use App\Models\MasterProject;
use App\Models\UserProject;
use Illuminate\Http\Request;

class MasterProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $project = MasterProject::orderBy('name')->get();
        return view('server.project.index', compact('project'));
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
            'name' => 'required',
            'deskripsi' => 'required'
        ]);

        MasterProject::updateOrCreate(
            [
                'id' => $request->id
            ],
            [
                'name' => $request->name,
                'deskripsi' => $request->deskripsi
            ]
        );

        if ($request->id) {
            return redirect()->route('category.index')->with('success', 'Success Update Master Project!');
        } else {
            return redirect()->back()->with('success', 'Success Add Master Project!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MasterProject  $masterProject
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = MasterProject::find($id);
        $user_project = UserProject::where('project_id', $id)->get();
        return view('server.project.details', compact('project','user_project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterProject  $masterProject
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterProject $masterProject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterProject  $masterProject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MasterProject $masterProject)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterProject  $masterProject
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        MasterProject::find($id)->delete();
        $user_project = UserProject::where('project_id', $id)->get();
        if (count($user_project) > 0) {
            foreach ($user_project as $data) {
                $data->delete();
            }
        }
        return redirect()->back()->with('success', 'Success Delete Project!');
    }

    public function addUser(Request $request)
    {
        $this->validate($request, [
            'usr_name' => 'required'
        ]);

        $user = \App\Models\User::where('username', $request->usr_name)->first();
        UserProject::updateOrCreate(
            [
                'id' => $request->id
            ],
            [
                'user_id' => $user->id,
                'project_id' => $request->project_id
            ]
        );
        return redirect()->back()->with('success', 'Success Add User on Project!');
    }

    public function destroyUser($id)
    {
        UserProject::find($id)->delete();
        return redirect()->back()->with('success', 'Success Delete Project!');
    }
}
