<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class EmployeeController extends Controller
{

    public function index()
    {
       $employees = User::role('Employee')
    ->with('manager')
    ->latest()
    ->paginate(10);

        return view('admin.employees.index', compact('employees'));
    }



    public function create()
    {

        $managers = User::role('Manager')->get();

        return view('admin.employees.create', compact('managers'));

    }




    public function store(Request $request)
    {

    //  dd($request->all());



        $request->validate([

            'name'=>'required|string|max:255',

            'email'=>'required|email|unique:users,email',

            'password'=>'required|min:8',


            'phone'=>'nullable|string|max:20',

            'department'=>'required|string',

            'designation'=>'required|string',

            'salary'=>'required|numeric',

            'gender'=>'nullable|string',

            'joining_date'=>'nullable|date',

            'address'=>'nullable|string',


            'manager_id'=>'nullable|exists:users,id',


            'photo'=>'nullable|image|mimes:jpg,jpeg,png|max:2048',


            'nid_number'=>'nullable|string',

            'nid_front'=>'nullable|image|mimes:jpg,jpeg,png|max:2048',

            'nid_back'=>'nullable|image|mimes:jpg,jpeg,png|max:2048',

        ]);





        // Employee Photo Upload

        $photo = null;


        if($request->hasFile('photo')){


            $photo = time().'_photo.'.$request->photo->extension();


            $request->photo->move(
                public_path('uploads/employees'),
                $photo
            );

        }





        // NID Front Upload

        $nid_front = null;


        if($request->hasFile('nid_front')){


            $nid_front = time().'_nid_front.'.$request->nid_front->extension();


            $request->nid_front->move(
                public_path('uploads/employees/nid'),
                $nid_front
            );

        }





        // NID Back Upload

        $nid_back = null;


        if($request->hasFile('nid_back')){


            $nid_back = time().'_nid_back.'.$request->nid_back->extension();


            $request->nid_back->move(
                public_path('uploads/employees/nid'),
                $nid_back
            );

        }





        $employee = User::create([


            'name'=>$request->name,

            'email'=>$request->email,

            'password'=>Hash::make($request->password),


            'phone'=>$request->phone,

            'department'=>$request->department,

            'designation'=>$request->designation,

            'salary'=>$request->salary,

            'gender'=>$request->gender,

            'joining_date'=>$request->joining_date,

            'address'=>$request->address,


            'photo'=>$photo,


            'manager_id'=>$request->manager_id,


            'nid_number'=>$request->nid_number,

            'nid_front'=>$nid_front,

            'nid_back'=>$nid_back,


            'verification_status'=>'pending',


        ]);





        $employee->assignRole('Employee');





        return redirect()
            ->route('admin.employees.index')
            ->with('success','Employee created successfully');

    }






    public function show($id)
    {

        $employee = User::findOrFail($id);


        return view(
            'admin.employees.show',
            compact('employee')
        );

    }






    public function edit($id)
    {

        $employee = User::findOrFail($id);


        $managers = User::role('Manager')->get();


        return view(
            'admin.employees.edit',
            compact('employee','managers')
        );

    }







    public function update(Request $request,$id)
    {

        $employee = User::findOrFail($id);



        $request->validate([

            'name'=>'required',

            'email'=>'required|email|unique:users,email,'.$id,


            'salary'=>'nullable|numeric',


            'photo'=>'nullable|image|mimes:jpg,jpeg,png|max:2048',

        ]);





        $photo = $employee->photo;



        if($request->hasFile('photo')){


            if($employee->photo &&
            file_exists(public_path('uploads/employees/'.$employee->photo))){

                unlink(
                    public_path('uploads/employees/'.$employee->photo)
                );

            }



            $photo = time().'_photo.'.$request->photo->extension();



            $request->photo->move(
                public_path('uploads/employees'),
                $photo
            );


        }






        $employee->update([


            'name'=>$request->name,

            'email'=>$request->email,


            'phone'=>$request->phone,


            'department'=>$request->department,


            'designation'=>$request->designation,


            'salary'=>$request->salary,


            'gender'=>$request->gender,


            'joining_date'=>$request->joining_date,


            'address'=>$request->address,


            'manager_id'=>$request->manager_id,


            'photo'=>$photo,


        ]);





        return redirect()
        ->route('admin.employees.index')
        ->with('success','Employee Updated Successfully');


    }


    public function status($id, $status)
{
    $employee = User::findOrFail($id);


    if(!in_array($status, ['pending','verified','rejected'])){

        abort(404);

    }


    $employee->update([
        'verification_status'=>$status
    ]);


    return redirect()
        ->route('admin.employees.index')
        ->with('success','Employee status updated successfully');

}






    public function destroy($id)
    {


        $employee = User::findOrFail($id);



        if($employee->photo &&
        file_exists(public_path('uploads/employees/'.$employee->photo))){

            unlink(
                public_path('uploads/employees/'.$employee->photo)
            );

        }




        $employee->delete();



        return redirect()
        ->route('admin.employees.index')
        ->with('success','Employee Deleted Successfully');


    }



}