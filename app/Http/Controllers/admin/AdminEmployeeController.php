<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Image;

use App\Models\User;

class AdminEmployeeController extends Controller
{
    function fetchEmployees()
    {

        $employees = User::select(
            'users.id',
            'users.user_id AS employee_id',
            'users.photo', 
            'users.surname',
            'users.firstname',
            'users.middlename',
            DB::raw('CONCAT(users.surname, ", ", users.firstname, " ", users.middlename) as name'),
            'users.email',
            'users.contact',
            'users.status as stat_no',
            DB::raw('(CASE
                WHEN users.status = 0 THEN "Inactive"
                WHEN users.status = 1 THEN "Active"
                ELSE "Unknown" END) as status'),
            'users.photo'
        )
            //->join('table', 'tables.id', '=', 'users.id')
            ->whereIn('users.role', [1, 2])
            ->get();

        return view('admin/employee', ['employees' => $employees]);
    }


    function addEmployee(Request $request)
    {
        $validation = [
            'employee_id' => 'required|min:6|max:255',
            'surname' => 'required|min:2|max:255',
            'firstname' => 'required|min:2|max:255',
            'middlename' => 'required|min:2|max:255',
            'email' => 'required|email:rfc,dns',
            'contact' => 'required|min:11|max:11',
            'photo' => 'required|image',
        ];

        $request->validate($validation);

        $photo = $request->file('photo');
        $photo_name = uniqid() . '.' . $photo->getClientOriginalExtension();
        
        $thumbnail = Image::make($photo)->save('C:/xampp/htdocs/iot/storage/app/public/images/employees/' . $photo_name);

        $employee = new User;
        $employee->role = 1; 
        $employee->user_id = $request->employee_id;
        $employee->surname = $request->surname;
        $employee->firstname = $request->firstname;
        $employee->middlename = $request->middlename;
        $employee->email = $request->email;
        $employee->contact = $request->contact;
        $employee->password = Hash::make('admin');
        $employee->photo = $photo_name;

        $isSaved = $employee->save();
        if ($isSaved) {
            return redirect()->back()->with('success', 'Employee has been added successfully!');
        } else {
            return redirect()->back()->withErrors([
                'message' => 'Employee add failed! Try again!',
            ]);
        }
    }

    function editEmployee(Request $request)
    {
        $validation = [
            'id' => 'required',
            'employee_id' => 'required|min:6|max:255',
            'surname' => 'required|min:2|max:255',
            'firstname' => 'required|min:2|max:255',
            'middlename' => 'required|min:2|max:255',
            'email' => 'required|email:rfc,dns',
            'contact' => 'required|min:11|max:11',
            'status' => 'required',
        ];

        $request->validate($validation);


        $employee = User::find($request->id);
        $employee->user_id = $request->employee_id;
        $employee->surname = $request->surname;
        $employee->firstname = $request->firstname;
        $employee->middlename = $request->middlename;
        $employee->contact = $request->contact;
        $employee->email = $request->email;
        $employee->status = $request->status;

        if (!$employee) {
            return redirect()->back()->withErrors([
                'message' => 'Employee not found! Try again!',
            ]);
        }
        $isSaved = $employee->save();

        if ($isSaved) {
            return redirect()->back()->with(
                'success',
                'Proffesor information has been updated successfully!'
            );
        } else {
            return redirect()->back()->withErrors([
                'message' => 'Professor update failed! Try again later!',
            ]);
        }



    }


    function deleteEmployee($id)
    {
        $employee = User::find($id);

        // if (!$employee) {
        //     return redirect()->back()->withErrors([
        //         'message' => 'Employee not found! Try again!',
        //     ]);
        // }

        $isDeleted = $employee->delete();
        if ($isDeleted) {
            return redirect()->back()->with('success', 'Employee has been deleted successfully!');
        } else {
            return redirect()->back()->withErrors([
                'message' => 'Employee delete failed! Try again!',
            ]);
        }
    }

    function addFace(Request $request)
    {
        $validation = [
            'employee_no' => 'required',
            'photos.*' => 'image|mimes:jpeg,png,gif|max:2048',
        ];

        if (!$request->hasFile('photos')) {
            return redirect()->back()->withErrors([
                'message' => 'Add face failed! Employee face photos is required for face recognition.',
            ]);
        }

        $photo_counter = 0;

        if ($request->hasFile('photos')) {
            $employee_no = $request->employee_no;
            $targetDirectory = 'storage/images/users/' . $employee_no . '/';

            // Check if the target directory exists, and create it if it doesn't
            if (!is_dir($targetDirectory)) {
                if (!mkdir($targetDirectory, 0755, true)) {
                    // Directory creation failed, handle the error
                    return response()->json(['error' => 'Failed to create the directory.']);
                }
            }

            foreach ($request->file('photos') as $photo) {
                $photo_counter++;

                $photo_name = $photo_counter . '.' . $photo->getClientOriginalExtension();

                //$photo_name = encrypt($photo_name);

                // Specify the full path to save the image
                $pathToSave = $targetDirectory . '/' . $photo_name;

                // Check for errors during image save
                $saveResult = Image::make($photo)->save($pathToSave);

                //dd($saveResult);

                if (!$saveResult) {
                    // Handle the error, e.g., log it or return a response
                    //return response()->json(['error' => 'Failed to save the image.']);
                    return redirect()->back()->withErrors([
                                'message' => 'Add face failed! Try again!',
                            ]);
                }
            }
        }

        return redirect('/admin/employees')
                 ->with('success', 'Adding face successful!');

    }
}
