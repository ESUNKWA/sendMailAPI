<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use App\Mail\GenericMail;
use Illuminate\Support\Facades\Validator;

class MailController extends Controller
{
    public function send(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'recipients' => 'required|array',
            'recipients.*' => 'email',
            'subject' => 'required|string',
            'body' => 'required|string',
            'attachment' => 'nullable|file|max:10240' // 10 Mo max
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            foreach ($request->recipients as $email) {
            $sendMail = Mail::to($email)->send(new GenericMail(
                    $request->subject,
                    $request->body,
                    $request->file('attachment')
                ));
            }

            
            return response()->json(['message' => $sendMail]);
        
    }
}
