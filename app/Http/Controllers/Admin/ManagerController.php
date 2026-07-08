<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ManagerController extends Controller
{

    public function index()
    {
       $managers = User::role('Manager')
->latest()
->paginate(10);

        return view('admin.managers.index', compact('managers'));
    }



    public function create()
    {
        return view('admin.managers.create');
    }




    public function store(Request $request)
    {

        $request->validate([

            'name' => 'required|string|max:255',

            'email' => 'required|email|unique:users,email',

            'password' => 'required|min:8',

            'phone' => 'nullable|string|max:20',

            'department' => 'required|string',

            'designation' => 'required|string',

            'salary' => 'required|numeric',

            'gender' => 'nullable|string',

            'joining_date' => 'nullable|date',

            'address' => 'nullable|string',

            'photo'=>'nullable|image|mimes:jpg,jpeg,png|max:2048',

        ]);



        // Photo Upload

        $photo = null;


        if($request->hasFile('photo')){

            $photo = time().'.'.$request->photo->extension();

            $request->photo->move(
                public_path('uploads/managers'),
                $photo
            );

        }




        $manager = User::create([


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


        ]);



        $manager->assignRole('Manager');



        return redirect()
        ->route('admin.managers.index')
        ->with('success','Manager created successfully');

    }





    public function show($id)
    {

        $manager = User::findOrFail($id);

        return view('admin.managers.show',compact('manager'));

    }





    public function edit($id)
    {

        $manager = User::findOrFail($id);

        return view('admin.managers.edit',compact('manager'));

    }





    public function update(Request $request,$id)
    {

        $manager = User::findOrFail($id);



        $request->validate([

            'name'=>'required',

            'email'=>'required|email|unique:users,email,'.$id,

            'salary'=>'nullable|numeric',

            'photo'=>'nullable|image|mimes:jpg,jpeg,png|max:2048',

        ]);





        $photo = $manager->photo;



        if($request->hasFile('photo')){


            // Delete old image

            if($manager->photo && file_exists(public_path('uploads/managers/'.$manager->photo))){

                unlink(public_path('uploads/managers/'.$manager->photo));

            }



            $photo = time().'.'.$request->photo->extension();


            $request->photo->move(
                public_path('uploads/managers'),
                $photo
            );


        }





        $manager->update([


            'name'=>$request->name,

            'email'=>$request->email,

            'phone'=>$request->phone,

            'department'=>$request->department,

            'designation'=>$request->designation,

            'salary'=>$request->salary,

            'gender'=>$request->gender,

            'joining_date'=>$request->joining_date,

            'address'=>$request->address,

            'photo'=>$photo,


        ]);




        return redirect()
        ->route('admin.managers.index')
        ->with('success','Manager Updated Successfully');


    }





    public function destroy($id)
    {

        $manager = User::findOrFail($id);


        if($manager->photo && file_exists(public_path('uploads/managers/'.$manager->photo))){

            unlink(public_path('uploads/managers/'.$manager->photo));

        }


        $manager->delete();



        return redirect()
        ->route('admin.managers.index')
        ->with('success','Manager Deleted Successfully');

    }

}
