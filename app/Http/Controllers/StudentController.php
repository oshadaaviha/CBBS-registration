<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Branch;
use App\Models\Course;
use App\Models\Batch;
use App\Models\Enrollment;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Auth;


class StudentController extends Controller
{
    public function storeStudent(Request $request)
    {
        $validated = $request->validate([
            'student_id'        => 'nullable|string',
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
            'user_id' => ['nullable', 'integer', 'exists:users,id'],

            // global preferred_class (if you keep it)
            'preferred_class'   => ['nullable', Rule::in([
                'weekday class',
                'weekend class',
                'weekday or weekend class'
            ])],

            // per-course payload (from your Blade)
            'courses'                       => ['required', 'array'],
            'courses.*.selected'            => ['nullable', 'in:1'],
            'courses.*.track'               => ['nullable', Rule::in(['Normal', 'Fast'])],
            'courses.*.branch_id'           => ['nullable', 'string', 'exists:branches,branch_id'],
            'courses.*.batch_id'            => ['nullable', 'string', 'exists:batches,batch_id'], // add per-course batch if needed
            'courses.*.is_fast_track'       => ['nullable', 'boolean'],
            'courses.*.status'              => ['nullable', 'string'], // optional per-enrollment status
        ]);

        // Require at least one selected course
        $selectedCourses = collect($request->input('courses', []))
            ->filter(fn($c) => isset($c['selected']) && $c['selected'] == '1');

        if ($selectedCourses->isEmpty()) {
            return back()->withErrors(['courses' => 'Please select at least one course.'])->withInput();
        }

        return DB::transaction(function () use ($request, $selectedCourses) {
            // Create the student (DO NOT set course/branch/batch here anymore)
            $student = Student::create([
                'student_id'        => $request->student_id,
                'first_name'        => $request->first_name,
                'last_name'         => $request->last_name,
                'citizenship'       => $request->citizenship,
                'nic_number'        => $request->nic_number,
                'certificate_name'  => $request->certificate_name,
                'gender'            => $request->gender,
                'contact_address'   => $request->contact_address,
                'permanent_address' => $request->permanent_address,
                'email'             => $request->email,
                'mobile'            => $request->mobile,
                'whatsapp'          => $request->whatsapp,
                // 'course_id'         => $request->course_id,
                // 'branch_id'         => $request->branch_id,
                // 'batch_id'          => $request->batch_id,
                'status'            => 'registered',
                'isFastTrack'       => 0,
                'isActive'          => 1,
            ]);


            $preferredClass = $request->preferred_class;
            $userId = $request->input('user_id'); // may be null

            // Insert one enrollment per selected course
            foreach ($selectedCourses as $courseId => $c) {
                Enrollment::create([
                    'student_id'      => $student->id,
                    'course_id'       => (string) $courseId,
                    'branch_id'       => $c['branch_id'] ?? null,
                    'batch_id'        => $c['batch_id']  ?? null,
                    'track'           => $c['track']     ?? null,
                    'is_fast_track'   => isset($c['is_fast_track'])
                        ? (bool)$c['is_fast_track']
                        : ($c['track'] ?? '') === 'Fast',
                    'preferred_class' => $preferredClass,
                    'status'          => 'registered',
                    'user_id'         => $userId,
                ]);
            }


            return back()->with('success', 'Registration saved successfully!');
        });
    }

    public function pendingStudents()
    {

        $user = Auth::user();
        $pending = \App\Models\Enrollment::query()
            ->visibleTo($user)
            ->join('students', 'enrollments.student_id', '=', 'students.id')
            ->leftJoin('courses', 'enrollments.course_id', '=', 'courses.course_id')
            ->leftJoin('branches', 'enrollments.branch_id', '=', 'branches.branch_id')
            ->leftJoin('batches', 'enrollments.batch_id', '=', 'batches.batch_id')
            ->whereNull('enrollments.batch_id') // or any other pending condition
            ->orderByDesc('enrollments.created_at')
            ->select([
                'enrollments.id as enrollment_id',
                'enrollments.course_id',
                'enrollments.branch_id',
                'enrollments.batch_id',
                DB::raw("COALESCE(NULLIF(courses.course_name,''), enrollments.course_id) COLLATE utf8mb4_unicode_ci as course_label"),
                'students.id as student_pk',
                'students.student_id as public_student_id',
                'students.first_name',
                'students.last_name',
                'students.certificate_name',
                'students.citizenship',
                'students.nic_number',
                'students.gender',
                'students.mobile',
                'students.whatsapp',
                'students.email',
                'students.contact_address',
                'students.permanent_address',
                'enrollments.track',
                'enrollments.is_fast_track',
                'branches.branch_name',
                'batches.batch_no',
            ])

            ->get();

        $batch = Batch::where('isActive', 1)->orderBy('batch_no')->get();

        return view('student.pendingStudents', compact('pending', 'batch'));
    }

    public function studentManagement()
    {

        $user = Auth::user();

        $data = Enrollment::query()
            ->visibleTo($user)
            ->join('students as s', 'enrollments.student_id', '=', 's.id')
            ->leftJoin('branches as br', 'enrollments.branch_id', '=', 'br.branch_id')
            ->leftJoin('courses  as c',  'enrollments.course_id',  '=', 'c.course_id')
            ->leftJoin('batches  as ba', 'enrollments.batch_id',  '=', 'ba.batch_id')
            ->leftJoin('users as u', 'enrollments.user_id', '=', 'u.id')
            ->addSelect('u.name as shared_by_name')
            ->select([
                'enrollments.id as enrollment_id',
                'enrollments.course_id',
                'enrollments.branch_id',
                'enrollments.batch_id',
                'enrollments.track',
                'enrollments.is_fast_track',
                'enrollments.status as enrollment_status',

                's.id as student_pk',
                's.student_id as public_student_id',
                's.first_name',
                's.last_name',
                's.nic_number',
                's.email',
                's.gender',
                's.mobile',
                's.whatsapp',
                's.contact_address',
                's.status as student_status',

                DB::raw("COALESCE(c.course_name, enrollments.course_id) as course_label"),
                'br.branch_name',
                'ba.batch_no',
                DB::raw('u.name as shared_by_name'),
            ])
            ->where('s.isActive', 1)
            ->orderBy('course_label')
            ->orderBy('s.student_id')
            ->get();

        // map for edit hydration: student_pk => { course_id: {track, branch_id, batch_id} }
        $enrollmentsByStudent = $data->groupBy('student_pk')->map(function ($rows) {
            return $rows->keyBy('course_id')->map(function ($r) {
                return [
                    'track'     => $r->track ?: ($r->is_fast_track ? 'Fast' : 'Normal'),
                    'branch_id' => $r->branch_id,
                    'batch_id'  => $r->batch_id,
                ];
            });
        });

        // PENDING: no batch or blank-ish student_id
        $pending = Enrollment::query()
            ->visibleTo($user)
            ->join('students as s', 'enrollments.student_id', '=', 's.id')
            ->leftJoin('courses  as c',  function ($j) {
                $j->on(DB::raw("enrollments.course_id COLLATE utf8mb4_unicode_ci"),  '=', DB::raw("c.course_id COLLATE utf8mb4_unicode_ci"));
            })
            ->leftJoin('branches as br', function ($j) {
                $j->on(DB::raw("enrollments.branch_id COLLATE utf8mb4_unicode_ci"), '=', DB::raw("br.branch_id COLLATE utf8mb4_unicode_ci"));
            })
            ->leftJoin('batches  as ba', function ($j) {
                $j->on(DB::raw("enrollments.batch_id COLLATE utf8mb4_unicode_ci"),  '=', DB::raw("ba.batch_id COLLATE utf8mb4_unicode_ci"));
            })
            ->select([
                'enrollments.id as enrollment_id',
                'enrollments.course_id',
                'enrollments.branch_id',
                'enrollments.batch_id',
                DB::raw("COALESCE(c.course_name, enrollments.course_id) COLLATE utf8mb4_unicode_ci as course_label"),

                's.id as student_pk',
                's.student_id as public_student_id',
                's.first_name',
                's.last_name',
                's.mobile',
                's.whatsapp',
                's.email',

                'br.branch_name',
                'ba.batch_no',
            ])
            ->where('s.isActive', 1)
            ->where(function ($q) {
                $q->whereNull('enrollments.batch_id')                          // no batch
                    ->orWhereRaw("NULLIF(TRIM(s.student_id), '') IS NULL")       // NULL / '' / spaces
                    ->orWhereIn(DB::raw('LOWER(TRIM(s.student_id))'), ['0', 'n/a', 'na', '-']); // common placeholders
            })
            // ->when(!Auth::user()->hasAnyRole(['Admin', 'Director']), function ($q) {
            //     $q->where(function ($inner) {
            //         $inner->where('enrollments.user_id', Auth::id())
            //             ->orWhere('enrollments.branch_id', Auth::user()->branch_id); // if you store this on users
            //     });
            // })
            ->orderBy('course_label')
            ->orderBy('s.first_name')
            ->get();

        // OPTIONAL: full list by course (for “All students by course” table)
        $all = Enrollment::query()
            ->visibleTo($user)
            ->join('students as s', 'enrollments.student_id', '=', 's.id')
            ->leftJoin('courses  as c',  function ($j) {
                $j->on(DB::raw("enrollments.course_id COLLATE utf8mb4_unicode_ci"),  '=', DB::raw("c.course_id COLLATE utf8mb4_unicode_ci"));
            })
            ->leftJoin('branches as br', function ($j) {
                $j->on(DB::raw("enrollments.branch_id COLLATE utf8mb4_unicode_ci"), '=', DB::raw("br.branch_id COLLATE utf8mb4_unicode_ci"));
            })
            ->leftJoin('batches  as ba', function ($j) {
                $j->on(DB::raw("enrollments.batch_id COLLATE utf8mb4_unicode_ci"),  '=', DB::raw("ba.batch_id COLLATE utf8mb4_unicode_ci"));
            })
            ->select([
                'enrollments.id as enrollment_id',
                'enrollments.course_id',
                'enrollments.branch_id',
                'enrollments.batch_id',
                DB::raw("COALESCE(c.course_name, enrollments.course_id) COLLATE utf8mb4_unicode_ci as course_label"),
                's.id as student_pk',
                's.student_id as public_student_id',
                's.first_name',
                's.last_name',
                's.mobile',
                's.whatsapp',
                's.email',
                'br.branch_name',
                'ba.batch_no',
            ])
            ->where('s.isActive', 1)
            ->orderBy('course_label')
            ->orderBy('s.first_name')
            ->get();


        $branch = Branch::where('isActive', 1)->get();
        $course = Course::where('isActive', 1)->get();
        $batch  = Batch::where('isActive', 1)->get();



        return view('student.studentManagement', compact('data', 'branch', 'course', 'batch', 'enrollmentsByStudent', 'pending', 'all'));
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

    public function publicForm(Request $request)
    {
        $course = Course::where('isActive', 1)->get();
        $branch = Branch::where('isActive', 1)->get();
        $batch = Batch::where('isActive', 1)->get();


        $refId    = (int) $request->query('ref');   // e.g. ?ref=123
        $sharedBy = $refId ? \App\Models\User::find($refId) : null;


        // Return the same form but with certain fields hidden
        return view('student.studentRegistrationPublic', compact('course', 'branch', 'batch', 'sharedBy', 'refId', 'request'));
    }

    public function assignBatch(Request $request)
    {
        $validated = $request->validate([
            'enrollment_id' => ['required', 'exists:enrollments,id'],
            'batch_id'      => ['required', 'exists:batches,batch_id'],
            'student_id'    => ['nullable', 'string', 'max:255', 'unique:students,student_id'],
        ]);

        $enrollment = Enrollment::with('student')->findOrFail($validated['enrollment_id']);

        DB::transaction(function () use ($enrollment, $validated) {
            $enrollment->update(['batch_id' => $validated['batch_id']]);

            if (!empty($validated['student_id'])) {
                $enrollment->student->update(['student_id' => $validated['student_id']]);
            }
        });

        return back()->with('message', 'Student ID & batch assigned successfully.');
    }


    public function destroy($id)
    {
        Enrollment::whereKey($id)->delete();
        return back()->with('message', 'Enrollment removed.');
    }

    public function updateFull(Request $request, $id)
    {
        $validated = $request->validate([
            'student_id'      => 'required|string|max:255|unique:students,student_id,' . $id,
            'batch_id'        => 'required|exists:batches,batch_id',
            'first_name'     => 'nullable|string|max:255',
            'last_name'      => 'nullable|string|max:255',
            'nic_number'    => 'nullable|string|max:20',
            'email'         => 'nullable|email',
            'gender'      => 'nullable|string|max:20',
            'mobile'      => 'nullable|string|max:20',
            'whatsapp'    => 'nullable|string|max:20',
            'contact_address' => 'nullable|string|max:500',
            'branch_id'   => 'nullable|exists:branches,branch_id',
            'course_id'   => 'nullable', // array if you use multi-course
        ]);

        $batch = Batch::where('isActive', 1)
            ->orderBy('batch_no')
            ->get();




        $student = Student::findOrFail($id);
        $student->update($validated);

        $enrollment = Enrollment::with('student')->findOrFail($validated['enrollment_id']);

        DB::transaction(function () use ($enrollment, $validated) {
            // update batch on the enrollment
            $enrollment->update(['batch_id' => $validated['batch_id']]);

            // if user typed a new student_id, set it on the student
            if (!empty($validated['student_id'])) {
                $enrollment->student->update(['student_id' => $validated['student_id']]);
            }
        });


        return back()->with('success', 'Student updated successfully.');
    }
}
