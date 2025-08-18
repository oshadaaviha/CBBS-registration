<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Branch;
use App\Models\Course;
use App\Models\Batch;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class StudentController extends Controller
{

    public function storeStudent(Request $request)
    {
        $request->validate([
            'student_id'        => 'nullable|string',
            // accept either hidden `name` or first/last; we’ll build a final name below
            // 'name'              => 'nullable|string',
            'first_name'        => 'nullable|string',
            'last_name'         => 'nullable|string',

            'citizenship'       => 'required|string',
            'nic_number'        => 'required|string',
            'certificate_name'  => 'required|string',
            'gender'            => 'required|string',
            'contact_address'   => 'nullable|string',
            'permanent_address' => 'nullable|string',
            'email'             => 'nullable|email',
            'mobile'            => 'nullable|string',
            'whatsapp'          => 'nullable|string',

            // accept array or single value for course(s)
            'course_id'         => 'nullable',
            'course_id.*'       => 'nullable|exists:courses,course_id',

            'branch_id'         => 'nullable|exists:branches,branch_id',
            'batch_id'          => 'nullable|exists:batches,batch_id',
        ]);

        // Build full name even if JS didn't set the hidden input
        $fullName = $request->input('name');
        if (!$fullName) {
            $first = trim((string)$request->input('first_name', ''));
            $last  = trim((string)$request->input('last_name', ''));
            $fullName = trim($first . ' ' . $last);
        }

        // If your DB has a single `course_id` column, pick the first selected
        $courseId = $request->input('course_id');
        if (is_array($courseId)) {
            $courseId = $courseId[0] ?? null;   // QUICK FIX: store first selection
            // If you want true many-to-many later, move to a pivot table and store all.
        }

        Student::create([
            'student_id'        => $request->student_id,     // nullable OK
            'first_name'              => $request->first_name,
            'last_name'              => $request->last_name,
            'citizenship'       => $request->citizenship,
            'nic_number'        => $request->nic_number,
            'certificate_name'  => $request->certificate_name,
            'gender'            => $request->gender,
            'contact_address'   => $request->contact_address,
            'permanent_address' => $request->permanent_address,
            'email'             => $request->email,
            'mobile'            => $request->mobile,
            'whatsapp'          => $request->whatsapp,
            'course_id'         => $courseId,                // single value saved
            'branch_id'         => $request->branch_id,
            'batch_id'          => $request->batch_id,
            'status'            => 'registered',
            'isActive'          => 1,
        ]);

        return back()->with('success', 'Registration saved successfully!');
    }


    public function studentManagement()
    {
        $data = \App\Models\Student::select(
            'students.*',
            'branches.branch_name',
            'courses.course_name',
            'batches.batch_no'
        )
            ->leftJoin('branches', 'students.branch_id', '=', 'branches.branch_id')
            ->leftJoin('courses', 'students.course_id', '=', 'courses.course_id')
            ->leftJoin('batches', 'students.batch_id', '=', 'batches.batch_id')
            ->where('students.isActive', 1)
            ->get();

        $branch = \App\Models\Branch::where('isActive', 1)->get();
        $course = \App\Models\Course::where('isActive', 1)->get();
        $batch = \App\Models\Batch::where('isActive', 1)->get();

        return view('student.studentManagement', compact('data', 'branch', 'course', 'batch'));
    }

    public function updateIds(Request $request)
    {
        $validated = $request->validate([
            'record_id'  => 'required|integer|exists:students,id',
            'student_id' => 'required|string|max:255|unique:students,student_id,' . $request->record_id,
            'batch_id'   => 'required|exists:batches,batch_id',
            // optional if you let them change others from the same form:
            'first_name'               => 'nullable|string|max:255',
            'last_name'             => 'nullable|string|max:255',
            'nic_number'         => 'nullable|string|max:20',
            'email'              => 'nullable|email',
            'gender'             => 'nullable|string|max:20',
            'mobile'             => 'nullable|string|max:20',
            'whatsapp'           => 'nullable|string|max:20',
            'contact_address'    => 'nullable|string|max:500',
            'branch_id'          => 'nullable|exists:branches,branch_id',
            'course_id'          => 'nullable', // array if you use multi-course
        ]);

        $update = [
            'student_id'      => $validated['student_id'],
            'batch_id'        => $validated['batch_id'],
        ];

        // If you want to allow editing other fields from the same form:
        foreach (['first_name', 'last_name', 'nic_number', 'email', 'gender', 'mobile', 'whatsapp', 'contact_address', 'branch_id'] as $f) {
            if ($request->filled($f)) $update[$f] = $request->$f;
        }
        // If you kept single course_id:
        if ($request->filled('course_id')) $update['course_id'] = $request->course_id;

        \App\Models\Student::where('id', $validated['record_id'])->update($update);

        return back()->with('success', 'Student updated successfully.');
    }



    public function AddStudent(Request $request)
    {
        try {
            $request->validate([
                'first_name'       => 'required|string|max:255',
                'last_name'        => 'required|string|max:255',
                'email'            => 'required|email|max:255|unique:students,email',
                'nic_number'       => 'required|string|max:20',
                'mobile'           => 'required|digits:10',
                'whatsapp'         => 'required|digits:10',
                'contact_address'  => 'required|string|max:255',
                'branch_id'        => 'required',
                'course_id'        => 'required',
                'batch_id'         => 'required',
            ]);

            if (Student::where('student_id', $request->student_id)->exists()) {
                return back()->with('error', 'Student ID Already Exists');
            }

            Student::create([
                'student_id'       => $request->student_id,
                'first_name'       => $request->first_name,
                'last_name'        => $request->last_name,
                'nic_number'       => $request->nic_number,
                'email'            => $request->email,
                'gender'           => $request->gender,
                'mobile'           => $request->mobile,
                'whatsapp'         => $request->whatsapp,
                'contact_address'  => $request->contact_address,
                'branch_id'        => $request->branch_id,
                'course_id'        => $request->course_id,
                'batch_id'         => $request->batch_id,
                'status'           => 'registered',
                'isActive'         => 1,
            ]);

            return back()->with('message', 'Student Added Successfully');
        } catch (Exception $e) {
            app(ErrorLogController::class)->ShowError($e);
            return back()->with('error', 'Something went wrong. Please try again');
        }
    }


    // public function storeStudent(Request $request)
    // {
    //     $request->validate([
    //         'student_id' => 'required|string',
    //         'name' => 'required|string',
    //         'citizenship' => 'required|string',
    //         'nic_number' => 'required|string',
    //         'certificate_name' => 'required|string',
    //         'gender' => 'required|string',
    //         'contact_address' => 'nullable|string',
    //         'permanent_address' => 'nullable|string',
    //         'email' => 'nullable|email',
    //         'mobile' => 'nullable|string',
    //         'whatsapp' => 'nullable|string',
    //         'course_id' => 'required|integer',
    //         'branch_id' => 'required|integer',
    //         'batch_id' => 'required|integer',
    //     ]);

    //     Student::create([
    //         'student_id' => $request->student_id,
    //         'name' => $request->name,
    //         'citizenship' => $request->citizenship,
    //         'nic_number' => $request->nic_number,
    //         'certificate_name' => $request->certificate_name,
    //         'gender' => $request->gender,
    //         'contact_address' => $request->contact_address,
    //         'permanent_address' => $request->permanent_address,
    //         'email' => $request->email,
    //         'mobile' => $request->mobile,
    //         'whatsapp' => $request->whatsapp,
    //         'course_id' => $request->course_id,
    //         'branch_id' => $request->branch_id,
    //         'batch_id' => $request->batch_id,
    //         'status' => 'registered',
    //         'isActive' => 1,
    //     ]);

    //     return redirect()->back()->with('message', 'Student added successfully.');
    // }
    public function EditStudent(Request $request)
    {
        try {
            $request->validate([
                'id'              => 'required|integer|exists:students,id',
                'student_id'      => 'required|string|max:255|unique:students,student_id,' . $request->id,
                'first_name'      => 'required|string|max:255',
                'last_name'       => 'required|string|max:255',
                'nic_number'      => 'required|string|max:20',
                'email'           => 'nullable|email',
                'gender'          => 'nullable|string|max:20',
                'mobile'          => 'nullable|string|max:20',
                'whatsapp'        => 'nullable|string|max:20',
                'contact_address' => 'nullable|string|max:500',
                'branch_id'       => 'nullable|exists:branches,branch_id',
                'course_id'       => 'nullable',
                'batch_id'        => 'nullable|exists:batches,batch_id',
            ]);

            Student::where('id', $request->id)->update([
                'student_id'      => $request->student_id,
                'first_name'      => $request->first_name,
                'last_name'       => $request->last_name,
                'nic_number'      => $request->nic_number,
                'email'           => $request->email,
                'gender'          => $request->gender,
                'mobile'          => $request->mobile,
                'whatsapp'        => $request->whatsapp,
                'contact_address' => $request->contact_address,
                'branch_id'       => $request->branch_id,
                'course_id'       => is_array($request->course_id) ? ($request->course_id[0] ?? null) : $request->course_id,
                'batch_id'        => $request->batch_id,
            ]);

            return back()->with('message', 'Student Edited Successfully');
        } catch (Exception $e) {
            app(ErrorLogController::class)->ShowError($e);
            return back()->with('error', 'Something went wrong. Please try again');
        }
    }


    public function DeleteStudent($id)
    {


        try {


            Student::where(['id' => $id])->update([
                'isActive' => 0,
            ]);


            return redirect()->back()->with('message', 'Student Deleted Successfully');
        } catch (Exception $e) {
            app(ErrorLogController::class)->ShowError($e);
            return redirect()->back()->with('error', 'Something went wrong. Please try again');
        }
    }

    // SearchStudent
    public function SearchStudent(Request $request)
    {
        try {
            $search = $request->search;

            $data = Student::join('branches', 'students.branch_id', '=', 'branches.branch_id')
                ->join('courses', 'students.course_id', '=', 'courses.course_id')
                ->join('batches', 'students.batch_id', '=', 'batches.batch_id')
                ->select('students.*', 'branches.branch_name', 'courses.course_name', 'batches.batch_no', 'batches.graduation_date')
                ->where(function ($query) use ($search) {
                    $query->where('students.student_id', $search)
                        ->orWhere('students.nic', $search);
                })
                ->where('students.isActive', 1) // Apply isActive filter after OR condition
                ->where('status', 'certified')
                ->get();

            return view('home.search', compact('data'));
        } catch (Exception $e) {
            app(ErrorLogController::class)->ShowError($e);
            return redirect()->back()->with('error', 'Something went wrong. Please try again');
        }
    }

    // StudentDetails
    public function StudentDetails($student_id)
    {
        try {
            // Decode student ID
            $studentId = base64_decode($student_id);

            // Fetch student details
            $data = Student::join('branches', 'students.branch_id', '=', 'branches.branch_id')
                ->join('courses', 'students.course_id', '=', 'courses.course_id')
                ->join('batches', 'students.batch_id', '=', 'batches.batch_id')
                ->select('students.*', 'branches.branch_name', 'courses.course_name', 'batches.batch_no', 'batches.graduation_date')
                ->where('students.student_id', $studentId)
                ->where('students.isActive', 1)
                ->where('status', 'certified')
                ->get();
            // dd($data);


            return view('home.StudentDetails', compact('data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }


    public function getStudents(Request $request)
    {


        // Return Blade view for non-AJAX requests
        return view('certificate.FilterStudentDetails', compact('students', 'courses', 'branches', 'batches'));
    }

    public function publicForm()
    {
        $course = Course::where('isActive', 1)->get();
        $branch = Branch::where('isActive', 1)->get();
        $batch = Batch::where('isActive', 1)->get();

        // Return the same form but with certain fields hidden
        return view('student.studentRegistrationPublic', compact('course', 'branch', 'batch'));
    }


    // public function certificateload()
    // {
    //     return view('Layout.certificateload');
    // }

    public function certificateLoad(Request $request)
    {
        $studentIds = explode(',', $request->query('students'));

        // Update student status to "ongoing"
        Student::whereIn('student_id', $studentIds)->update(['status' => 'ongoing']);

        // Fetch students with joined data
        $students = Student::join('branches', 'students.branch_id', '=', 'branches.branch_id')
            ->join('courses', 'students.course_id', '=', 'courses.course_id')
            ->join('batches', 'students.batch_id', '=', 'batches.batch_id')
            ->select(
                'students.*',
                'branches.branch_name',
                'courses.course_name',
                'batches.batch_no',
                'batches.year_month',
                'batches.graduation_date',
                'branches.tvec_code'
            )
            ->whereIn('students.student_id', $studentIds)
            ->where('students.isActive', 1)
            ->where('status', 'ongoing')
            ->get()
            ->map(function ($student) {
                // Encode student_id to make it URL-safe
                $student->encoded_id = base64_encode($student->student_id);

                return $student;
            });


        // Load certificate images based on the course
        foreach ($students as $student) {

            if ($student->isFastTrack == 1) {
                if ($student->course_name === 'Basic Certificate for Barista') {
                    $student->barista_certificate = asset('assets/images/certificates/barista-fast-track.PNG');
                    $student->food_certificate = asset('assets/images/certificates/food-fast-track.PNG');
                    $courseName = $student->course_name;
                } elseif ($student->course_name === 'Basic Certificate for Bartender') {
                    $student->bartender_certificate = asset('assets/images/certificates/bartender-fast-track.PNG');
                    $student->food_certificate = asset('assets/images/certificates/food-fast-track.PNG');
                    $courseName = $student->course_name;
                }
            } else {
                if ($student->course_name === 'Basic Certificate for Barista') {
                    $student->barista_certificate = asset('assets/images/certificates/barista.PNG');
                    $student->food_certificate = asset('assets/images/certificates/food.PNG');
                    $courseName = $student->course_name;
                } elseif ($student->course_name === 'Basic Certificate for Bartender') {
                    $student->bartender_certificate = asset('assets/images/certificates/bartender.PNG');
                    $student->food_certificate = asset('assets/images/certificates/food.PNG');
                    $courseName = $student->course_name;
                }
            }
        }

        return view('certificate.certificateLoad', compact('students', 'courseName'));
    }


    public function ongoingStudentDetails()
    {
        try {

            $data = Student::join('branches', 'students.branch_id', '=', 'branches.branch_id')
                ->join('courses', 'students.course_id', '=', 'courses.course_id')
                ->join('batches', 'students.batch_id', '=', 'batches.batch_id')
                ->select('students.*', 'branches.branch_name', 'courses.course_name', 'batches.batch_no')
                ->where('students.isActive', 1)
                ->where('status', 'ongoing')
                ->get();

            $course = Course::where('isActive', 1)->get();

            $branch = Branch::where('isActive', 1)->get();

            $batch = Batch::where('isActive', 1)->get();


            return view('certificate.ongoingStudentDetails', compact('data', 'course', 'branch', 'batch'));
        } catch (Exception $e) {
            app(ErrorLogController::class)->ShowError($e);
            return redirect()->back()->with('error', 'Something went wrong. Please try again');
        }
    }

    public function certifiedStudentDetails()
    {
        try {

            $data = Student::join('branches', 'students.branch_id', '=', 'branches.branch_id')
                ->join('courses', 'students.course_id', '=', 'courses.course_id')
                ->join('batches', 'students.batch_id', '=', 'batches.batch_id')
                ->select('students.*', 'branches.branch_name', 'courses.course_name', 'batches.batch_no')
                ->where('students.isActive', 1)
                ->where('status', 'certified')
                ->get();

            $course = Course::where('isActive', 1)->get();

            $branch = Branch::where('isActive', 1)->get();

            $batch = Batch::where('isActive', 1)->get();


            return view('certificate.certifiedStudentDetails', compact('data', 'course', 'branch', 'batch'));
        } catch (Exception $e) {
            app(ErrorLogController::class)->ShowError($e);
            return redirect()->back()->with('error', 'Something went wrong. Please try again');
        }
    }

    // public function updateStatus(Request $request)
    // {
    //     $studentIds = $request->input('student_ids');

    //     if (empty($studentIds)) {
    //         return response()->json(['success' => false, 'message' => 'No students selected']);
    //     }

    //     // Update student status to "Ongoing"
    //     Student::whereIn('student_id', $studentIds)->update(['status' => 'ongoing']);

    //     return response()->json(['success' => true]);
    // }

    public function updateStatuscertified(Request $request)
    {
        $studentIds = $request->input('student_ids');

        if (empty($studentIds)) {
            return response()->json(['success' => false, 'message' => 'No students selected']);
        }

        // Update student status to "Ongoing"
        Student::whereIn('student_id', $studentIds)->update(['status' => 'certified']);

        return response()->json(['success' => true]);
    }

    public function updateStatusongoing(Request $request)
    {
        $studentIds = $request->input('student_ids');

        if (empty($studentIds)) {
            return response()->json(['success' => false, 'message' => 'No students selected']);
        }

        // Update student status to "Ongoing"
        Student::whereIn('student_id', $studentIds)->update(['status' => 'ongoing']);

        return response()->json(['success' => true]);
    }

    public function updateStatusbackregistered(Request $request)
    {
        $studentIds = $request->input('student_ids');

        if (empty($studentIds)) {
            return response()->json(['success' => false, 'message' => 'No students selected']);
        }

        // Update student status to "Ongoing"
        Student::whereIn('student_id', $studentIds)->update(['status' => 'registered']);

        return response()->json(['success' => true]);
    }
}
