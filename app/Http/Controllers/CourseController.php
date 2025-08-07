<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    

    public function CourseManagement(){

        try {

            $data = Course::where('isActive', 1)->get();

            return view('course.courseManagement',compact('data'));
        } catch (Exception $e) {
            app(ErrorLogController::class)->ShowError($e);
            return redirect()->back()->with('error', 'Something went wrong. Please try again');
        }

    }


    public function AddCourse(Request $request)
    {

        try {

            $course_id = Str::random(7);

            if (Course::where('course_id', '=', $course_id)->exists()) {
                $course_id = Str::random(7);
            }

            if (Course::where('course_name', $request->course_name)
            ->where('isActive', 1)
            ->exists()) {
                return redirect()->back()->with('error', 'Course Name Already Exists');
            }
            $data = new Course();

            $data->course_id = $course_id;
            $data->course_name = $request->course_name;

            $data->isActive = 1;
            $data->save();


            return redirect()->back()->with('message', 'Course Added Successfully');
        } catch (Exception $e) {
            app(ErrorLogController::class)->ShowError($e);
            return redirect()->back()->with('error', 'Something went wrong. Please try again');
        }
    }

    public function EditCourse(Request $request)
    {

        try {

            if (Course::where('course_name', $request->course_name)
            ->where('isActive', 1)
            ->where('course_id', '!=', $request->course_id)
            ->exists()) {
                return redirect()->back()->with('error', 'Course Name Already Exists');
            }

            Course::where(['course_id' => $request->course_id])->update([
                'course_name' => $request->course_name,
            ]);


            return redirect()->back()->with('message', 'Course Edited Successfully');
        } catch (Exception $e) {
            app(ErrorLogController::class)->ShowError($e);
            return redirect()->back()->with('error', 'Something went wrong. Please try again');
        }
    }

    public function DeleteCourse($course_id)
    {


        try {


            Course::where(['course_id' => $course_id])->update([
                'isActive' => 0,
            ]);


            return redirect()->back()->with('message', 'Course Deleted Successfully');
        } catch (Exception $e) {
            app(ErrorLogController::class)->ShowError($e);
            return redirect()->back()->with('error', 'Something went wrong. Please try again');
        }
    }
}
