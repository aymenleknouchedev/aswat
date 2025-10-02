<?php

namespace App\Http\Controllers;

use App\Mail\NormalEmail;
use App\Models\Mail as MailModel;
use App\Models\MailAttachement;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SendMailController extends Controller
{
    public function index()
    {
        return view('dashboard.sendmail');
    }

    public function send(Request $request)
    {
        // Validate the request data
        $request->validate([
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

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
                        'file_path' => asset($path),
                        'file_name' => $file->getClientOriginalName(),
                    ]);

                    $attachments[] = $mailAttachment;
                }
            }

            Mail::to($mail->email)->send(new NormalEmail($mail, $attachments));

            return response()->json(['message' => 'Email sent successfully!', 'success' => true], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage(), 'success' => false], 500);
        }
    }
}
