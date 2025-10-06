<?php

namespace App\Http\Controllers;

use App\Mail\NormalEmail;
use App\Models\Mail as MailModel;
use App\Models\MailAttachement;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class SendMailController extends Controller
{
    public function index()
    {
        return view('dashboard.sendmail');
    }

    public function send(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'success' => false], 422);
        }

        try {
            $mail = new MailModel();
            $mail->user_id = Auth::id();
            $mail->email = $request->input('email');
            $mail->subject = $request->input('subject');
            $mail->body = $request->input('body');
            $mail->save();

            $attachments = [];

            if ($request->hasFile('attachments')) {
                foreach ($request->file('attachments') as $file) {
                    $uniqueName = Str::uuid()->toString() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
                    $path = $file->storeAs('attachments', $uniqueName, 'public');

                    $mailAttachment = MailAttachement::create([
                        'mail_id'   => $mail->id,
                        'file_path' => asset('storage/' . $path),
                        'file_name' => $uniqueName,
                    ]);

                    $attachments[] = $mailAttachment;
                }
            }

            $files = [];
            foreach ($attachments as $attachment) {
                $files[] = $attachment->file_path;
            }

            Mail::to($mail->email)->send(new NormalEmail($mail, $files));

            return response()->json(['message' => 'Email sent successfully!', 'success' => true], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage(), 'success' => false], 500);
        }
    }
}
