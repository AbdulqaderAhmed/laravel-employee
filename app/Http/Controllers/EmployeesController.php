<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employe = Employe::all();
        $message = 'All Employee List';

        return response()->json(['message' => $message, 'employee' => $employe]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'birth' => 'required|string',
            'gender' => 'required|string',
        ]);

        $employe = Employe::create($request->all());
        $message = 'employee successfuly created';

        return response()->json(['message' => $message, 'employee' => $employe]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employe = Employe::findorfail($id);

        return response()->json(['employee' => $employe]);
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
        $request->validate([
            'name' => 'required|string',
            'birth' => 'required|string',
            'gender' => 'required|string',
        ]);

        $employe = Employe::findorfail($id);
        $employe->update($request->all());
        $message = 'employee successfuly updated';

        return response()->json(['message' => $message, 'employee' => $employe]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employe = Employe::findorfail($id);
        $employe->delete();
        $message = 'employee successfully deleted';

        return response()->json(['message' => $message]);
    }
}
