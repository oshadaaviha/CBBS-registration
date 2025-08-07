<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Branch;

class BranchController extends Controller
{
    public function BranchManagement(){

        try {

            $data = Branch::where('isActive', 1)->get();

            return view('branch.branchManagement',compact('data'));
        } catch (Exception $e) {
            app(ErrorLogController::class)->ShowError($e);
            return redirect()->back()->with('error', 'Something went wrong. Please try again');
        }

    }


    public function AddBranch(Request $request)
    {

        try {

            $branch_id = Str::random(7);

            if (Branch::where('branch_id', '=', $branch_id)->exists()) {
                $branch_id = Str::random(7);
            }

            if (Branch::where('branch_name', $request->branch_name)
            ->where('isActive', 1)
            ->exists()) {
                return redirect()->back()->with('error', 'Branch Name Already Exists');
            }

            $data = new Branch();

            $data->branch_id = $branch_id;
            $data->branch_name = $request->branch_name;
            $data->tvec_code = $request->tvec_code;

            $data->isActive = 1;
            $data->save();


            return redirect()->back()->with('message', 'Branch Added Successfully');
        } catch (Exception $e) {
            app(ErrorLogController::class)->ShowError($e);
            return redirect()->back()->with('error', 'Something went wrong. Please try again');
        }
    }

    public function EditBranch(Request $request)
    {

        // dd($request->all());

        try {



            if (Branch::where('branch_name', $request->branch_name)
            ->where('branch_id', '!=', $request->branch_id)
            ->where('isActive', 1)
            ->exists()) {
                return redirect()->back()->with('error', 'Branch Name Already Exists');
            }


            Branch::where(['branch_id' => $request->branch_id])->update([
                'branch_name' => $request->branch_name,
                'tvec_code' => $request->tvec_code,
            ]);


            return redirect()->back()->with('message', 'Branch Edited Successfully');
        } catch (Exception $e) {
            app(ErrorLogController::class)->ShowError($e);
            return redirect()->back()->with('error', 'Something went wrong. Please try again');
        }
    }

    public function DeleteBranch($branch_id)
    {


        try {


            Branch::where(['branch_id' => $branch_id])->update([
                'isActive' => 0,
            ]);


            return redirect()->back()->with('message', 'Branch Deleted Successfully');
        } catch (Exception $e) {
            app(ErrorLogController::class)->ShowError($e);
            return redirect()->back()->with('error', 'Something went wrong. Please try again');
        }
    }
}
