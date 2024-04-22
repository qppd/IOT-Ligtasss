<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Image;

use App\Models\User;

class AdminStudentController extends Controller
{
    function fetchStudents()
    {

        $students = User::select(
            'users.id',
            'users.user_id AS student_id',
            'users.photo', 
            'users.firstname',
            'users.middlename',
            'users.surname',
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
            ->where('users.role', 3)
            ->get();

        return view('admin/student', ['students' => $students]);
    }

    function addStudent(Request $request)
    {
        $validation = [
            'student_id' => 'required|min:6|max:255',
            'surname' => 'required|min:2|max:255',
            'firstname' => 'required|min:2|max:255',
            'middlename' => 'required|min:2|max:255',
            'email' => 'required|email:rfc,dns',
            'contact' => 'required|min:11|max:11',
            'photo' => 'required|image|max:2048',
        ];

        $request->validate($validation);

        $photo = $request->file('photo');
        $photo_name = uniqid() . '.' . $photo->getClientOriginalExtension();
        
        $thumbnail = Image::make($photo)->save('C:/xampp/htdocs/iot/storage/app/public/images/students/' . $photo_name);

        $student = new User;
        $student->role = 3; 
        $student->user_id = $request->student_id;
        $student->surname = $request->surname;
        $student->firstname = $request->firstname;
        $student->middlename = $request->middlename;
        $student->email = $request->email;
        $student->contact = $request->contact;
        $student->password = Hash::make($request->student_id);
        $student->photo = $photo_name;

        $isSaved = $student->save();
        if ($isSaved) {
            return redirect()->back()->with('success', 'Student has been added successfully!');
        } else {
            return redirect()->back()->withErrors([
                'message' => 'Student add failed! Try again!',
            ]);
        }
    }

    function editStudent(Request $request)
    {
        $validation = [
            'id' => 'required',
            'student_id' => 'required|min:6|max:255',
            'surname' => 'required|min:2|max:255',
            'firstname' => 'required|min:2|max:255',
            'middlename' => 'required|min:2|max:255',
            'email' => 'required|email:rfc,dns',
            'contact' => 'required|min:11|max:11',
            'status' => 'required',
        ];

        $request->validate($validation);


        $student = User::find($request->id);
        $student->user_id = $request->student_id;
        $student->surname = $request->surname;
        $student->firstname = $request->firstname;
        $student->middlename = $request->middlename;
        $student->contact = $request->contact;
        $student->email = $request->email;
        $student->status = $request->status;

        if (!$student) {
            return redirect()->back()->withErrors([
                'message' => 'Student not found! Try again!',
            ]);
        }
        $isSaved = $student->save();

        if ($isSaved) {
            return redirect()->back()->with(
                'success',
                'Student information has been updated successfully!'
            );
        } else {
            return redirect()->back()->withErrors([
                'message' => 'Student update failed! Try again later!',
            ]);
        }



    }


    function deleteStudent($id)
    {
        $student = User::find($id);

        // if (!$employee) {
        //     return redirect()->back()->withErrors([
        //         'message' => 'Employee not found! Try again!',
        //     ]);
        // }

        $isDeleted = $student->delete();
        if ($isDeleted) {
            return redirect()->back()->with('success', 'Student has been deleted successfully!');
        } else {
            return redirect()->back()->withErrors([
                'message' => 'Student delete failed! Try again!',
            ]);
        }
    }

    function addFace(Request $request)
    {
        $validation = [
            'student_no' => 'required',
            'photos.*' => 'image|mimes:jpeg,png,gif|max:2048',
        ];

        if (!$request->hasFile('photos')) {
            return redirect()->back()->withErrors([
                'message' => 'Add face failed! Student face photos is required for face recognition.',
            ]);
        }

        $photo_counter = 0;

        if ($request->hasFile('photos')) {
            $student_no = $request->student_no;
            $targetDirectory = 'storage/images/users/' . $student_no . '/';

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

                if (!$saveResult) {
                    // Handle the error, e.g., log it or return a response
                    //return response()->json(['error' => 'Failed to save the image.']);
                    return redirect()->back()->withErrors([
                                'message' => 'Add face failed! Try again!',
                            ]);
                }
            }
        }

        return redirect('/admin/students')
                 ->with('success', 'Adding face successful!');


    }
}
