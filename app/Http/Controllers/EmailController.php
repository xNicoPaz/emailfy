<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\PlainTextEmail;

class EmailController extends Controller
{
    public function sendEmail(Request $request){
    	$email = new PlainTextEmail($request['from'], $request['subject'], $request['body']);

    	\Mail::to($request['to'])->send($email);

    	return 200;
    }
}
