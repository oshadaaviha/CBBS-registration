<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\ErrorLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class ErrorLogController extends Controller
{
    //Error Handling -> Save Error Log
    public function ShowError($e){

        $errorLine = $e->getLine();
        $errorMsg = $e->getMessage();
        $errorFile = $e->getFile();

        $error = new ErrorLog;

        $error->line =$errorLine;
        $error->message = $errorMsg;
        $error->file = $errorFile;
        $error->date = Carbon::now()->toDateString();
        $error->time = Carbon::now()->toTimeString();

        $error->save();

    }

    //Redirect to the Error Page
    public function SomethingWentWrongMessage(){

        return view('Layout.errorPage');
    }
}
