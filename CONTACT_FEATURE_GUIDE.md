# Contact Us Feature Documentation

## Overview
Complete contact form functionality with professional email handling, data persistence, and validation.

## Files Created/Modified

### 1. Environment Configuration
- **File**: `.env`
- **Change**: Added `ADMIN_EMAIL=bouzitharoun@gmail.com`
- **Purpose**: Centralized admin email configuration

### 2. Configuration
- **File**: `config/app.php`
- **Change**: Added `'admin_email' => env('ADMIN_EMAIL', 'admin@example.com')`
- **Purpose**: Access admin email throughout the application using `config('app.admin_email')`

### 3. Database Models & Migrations

#### Contact Model
- **File**: `app/Models/Contact.php`
- **Features**:
  - Stores contact submissions
  - Tracks submission status (pending, read, responded)
  - Records IP address and user agent
  - Mass assignable fields for easy data creation

#### Contact Migration
- **File**: `database/migrations/2026_03_09_000000_create_contacts_table.php`
- **Table Columns**:
  - `id`: Primary key
  - `first_name`, `last_name`: Contact person details
  - `email`: Requester's email
  - `subject`: Message subject
  - `description`: Message body
  - `status`: Submission status (pending/read/responded)
  - `ip_address`: Requester's IP for tracking
  - `user_agent`: Browser information
  - `timestamps`: Created/updated dates

### 4. HTTP Layer

#### Form Request Validation
- **File**: `app/Http/Requests/StoreContactRequest.php`
- **Features**:
  - Centralized validation rules
  - Arabic error messages (localization-ready)
  - File upload validation (max 10MB per file)
  - Max description length: 5000 characters

#### Controller Updates
- **File**: `app/Http/Controllers/HomePageController.php`
- **Changes**:
  - Removed debug `dd()` statement
  - Injected `ContactService`
  - Simplified `submitContact()` method
  - Uses form request validation
  - Cleaner, more readable code

### 5. Service Layer

#### ContactService
- **File**: `app/Services/ContactService.php`
- **Responsibilities**:
  - Process contact submissions
  - Create contact records in database
  - Create mail tracking records
  - Handle file attachments
  - Send admin notification emails
  - Error logging with context

**Key Methods**:
- `processContactSubmission()`: Main processing method
- `createMailRecord()`: Generate mail record
- `formatEmailBody()`: Professional email formatting
- `processAttachments()`: Handle file uploads
- `sendEmailToAdmin()`: Send notification with error handling

## Routes

### Contact Form Display
```
GET /contact-us
```
Shows the contact form page (view already exists)

### Contact Form Submission
```
POST /contact-us
```
Processes the form submission
- Validates input
- Stores in database
- Sends email to admin
- Redirects with success message

## Usage Flow

### Form Submission:
1. User fills contact form with:
   - First Name
   - Last Name
   - Email
   - Subject
   - Description
   - Optional file attachments

2. Form validates on submission:
   - All fields except files are required
   - Email format validation
   - File size validation (max 10MB)
   - Description max 5000 characters

3. System processes:
   - Stores contact in `contacts` table
   - Creates mail record for tracking
   - Processes file attachments
   - Sends email to `ADMIN_EMAIL`

4. User receives:
   - Redirect to contact page
   - Success message: "تم إرسال رسالتك بنجاح. شكرًا لتواصلك معنا."

### Admin Receives:
- Email notification to configured admin email
- Contact details (name, email, subject)
- Full message body
- File attachments (if any)
- All stored in database for reference

## Database Management

### Migration
Run migration to create contacts table:
```bash
php artisan migrate
```

### Accessing Contact Data
```php
// Get all contacts
$contacts = Contact::all();

// Get pending contacts
$pending = Contact::where('status', 'pending')->get();

// Get contacts by email
$userContacts = Contact::where('email', 'user@example.com')->get();
```

## File Structure
```
app/
├── Models/
│   └── Contact.php
├── Services/
│   └── ContactService.php
├── Http/
│   ├── Controllers/
│   │   └── HomePageController.php (updated)
│   └── Requests/
│       └── StoreContactRequest.php
database/
└── migrations/
    └── 2026_03_09_000000_create_contacts_table.php
config/
└── app.php (updated)
```

## Features

✅ **Professional Validation** - Form request with custom messages
✅ **Database Storage** - All submissions stored for future reference
✅ **Email Notifications** - Admin receives emails with attachments
✅ **File Handling** - Support for multiple file attachments
✅ **Error Logging** - Failed emails logged with context
✅ **Security** - IP tracking and user agent logging
✅ **Clean Code** - Service layer separation of concerns
✅ **Scalable** - Easy to extend with additional features

## Customization

### Change Admin Email
Update `.env`:
```
ADMIN_EMAIL=new-admin@example.com
```

### Add More Fields
1. Update `StoreContactRequest` validation rules
2. Update `Contact` model fillable array
3. Add migration for new table columns
4. Update `ContactService` email formatting

### Modify Email Template
Edit the `formatEmailBody()` method in `ContactService` to customize email format.

## Notes

- Routes are already configured in `routes/client.php`
- View file `resources/views/user/contact-us.blade.php` already exists
- Email template uses existing `NormalEmail` mailable class
- All data is stored for CRM/tracking purposes
