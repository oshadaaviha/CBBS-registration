<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class BatchController extends Controller
{
    public function BatchManagement(){

        try {

            $data = Batch::where('isActive', 1)->get();

            return view('batch.batchManagement',compact('data'));
        } catch (Exception $e) {
            app(ErrorLogController::class)->ShowError($e);
            return redirect()->back()->with('error', 'Something went wrong. Please try again');
        }

    }


    public function AddBatch(Request $request)
    {

        try {

            $batch_id = Str::random(7);

            if (Batch::where('batch_id', '=', $batch_id)
            ->where('batch_no', $request->batch_no)
            ->exists()) {
                $batch_id = Str::random(7);
            }

            if (Batch::where('batch_no', $request->batch_no)
            ->where('isActive', 1)
            ->exists()) {
                return redirect()->back()->with('error', 'Batch No Already Exists');
            }
            $data = new Batch();

            $data->batch_id = $batch_id;
            $data->batch_no = $request->batch_no;
            $data->batch_name = $request->batch_name;
            $data->year_month = $request->year_month;
            $data->graduation_date = $request->graduation_date;


            $data->isActive = 1;
            $data->save();


            return redirect()->back()->with('message', 'Batch Added Successfully');
        } catch (Exception $e) {
            app(ErrorLogController::class)->ShowError($e);
            return redirect()->back()->with('error', 'Something went wrong. Please try again');
        }
    }

    public function EditBatch(Request $request)
    {
        try {

            if (Batch::where('batch_no', $request->batch_no)
            ->where('batch_id', '!=', $request->batch_id)
            ->where('isActive', 1)
            ->exists()) {
                return redirect()->back()->with('error', 'Batch No Already Exists');
            }

            Batch::where(['batch_id' => $request->batch_id])->update([
                'batch_no' => $request->batch_no,
                'batch_name' => $request->batch_name,
                'year_month' => $request->year_month,
                'graduation_date' => $request->graduation_date,
            ]);


            return redirect()->back()->with('message', 'Batch Edited Successfully');
        } catch (Exception $e) {
            app(ErrorLogController::class)->ShowError($e);
            return redirect()->back()->with('error', 'Something went wrong. Please try again');
        }
    }

    public function DeleteBatch($batch_id)
    {


        try {


            Batch::where(['batch_id' => $batch_id])->update([
                'isActive' => 0,
            ]);


            return redirect()->back()->with('message', 'Batch Deleted Successfully');
        } catch (Exception $e) {
            app(ErrorLogController::class)->ShowError($e);
            return redirect()->back()->with('error', 'Something went wrong. Please try again');
        }
    }
}
