<?php

namespace App\Services;

use App\Models\Contact;
use App\Models\Mail as MailModel;
use App\Mail\NormalEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class ContactService
{
    /**
     * Process and store a contact submission.
     */
    public function processContactSubmission(array $validated, Request $request): Contact
    {
        // Create contact record
        $contact = Contact::create([
            'first_name'  => $validated['first_name'],
            'last_name'   => $validated['last_name'],
            'email'       => $validated['email'],
            'subject'     => $validated['subject'],
            'description' => $validated['description'],
            'ip_address'  => $request->ip(),
            'user_agent'  => $request->userAgent(),
            'status'      => 'pending',
        ]);

        // Create mail record for tracking
        $mail = $this->createMailRecord($validated);
        $mail->save();

        // Process attachments and send email
        $files = $this->processAttachments($request);
        $this->sendEmailToAdmin($mail, $files);

        return $contact;
    }

    /**
     * Create a mail record from contact data.
     */
    private function createMailRecord(array $validated): MailModel
    {
        $mail = new MailModel();
        $mail->user_id = null;
        $mail->email = config('app.admin_email');
        $mail->subject = $validated['subject'];

        $fullName = trim($validated['first_name'] . ' ' . $validated['last_name']);
        $mail->body = $this->formatEmailBody($validated, $fullName);

        return $mail;
    }

    /**
     * Format the email body in a clean, professional manner.
     */
    private function formatEmailBody(array $validated, string $fullName): string
    {
        return <<<BODY
الاسم: {$validated['first_name']}
اللقب: {$validated['last_name']}
الاسم الكامل: {$fullName}
البريد الإلكتروني: {$validated['email']}

الموضوع: {$validated['subject']}

الرسالة:
{$validated['description']}
BODY;
    }

    /**
     * Process and store file attachments.
     */
    private function processAttachments(Request $request): array
    {
        $files = [];

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $path = $file->store('contact-attachments', 'public');
                $files[] = [
                    'path' => $path,
                    'url'  => asset('storage/' . $path),
                    'name' => $file->getClientOriginalName(),
                ];
            }
        }

        return $files;
    }

    /**
     * Send email notification to admin.
     */
    private function sendEmailToAdmin(MailModel $mail, array $files): void
    {
        try {
            $fileUrls = array_column($files, 'url');
            Mail::to(config('app.admin_email'))->send(new NormalEmail($mail, $fileUrls));
        } catch (\Exception $e) {
            Log::error('Contact form email failed', [
                'error'   => $e->getMessage(),
                'subject' => $mail->subject,
                'email'   => $mail->email,
            ]);
        }
    }
}
