# Content Date Tracking & User Update System

## Overview
Implemented comprehensive date tracking and user update tracking for content management system with the following features:

## Database Changes

### Migration: `2024_12_07_000001_add_date_tracking_to_contents`

Added three new fields to the `contents` table:

1. **`published_at`** (timestamp, nullable)
   - Stores the date when content is/was published
   - Can be manually set to schedule publication
   - Modified from `useCurrent()` to nullable to support draft status
   - Changed when user manually updates the publish date after publication

2. **`published_date`** (timestamp, nullable)
   - Stores the original/first publication date
   - Permanent record of when content was first published
   - Never changes after initial publication (except in draft → publish scenario)
   - Used to distinguish creation date from publication date

3. **`updated_by_user_id`** (foreign key to users, nullable)
   - Tracks which user last edited the content
   - Useful for audit trails and responsibility tracking
   - Foreign key with nullOnDelete

### Updated Model: `Content`

Added to fillable array:
```php
'published_at',
'published_date',
'updated_by_user_id',
```

Added relationship:
```php
public function updatedByUser()
{
    return $this->belongsTo(User::class, 'updated_by_user_id');
}
```

## Business Logic Implementation

### Content Creation (`store()` method)

**Draft Status:**
- `published_at = null`
- `published_date = null`
- `status = 'draft'`
- User can edit and update data freely without recording publication history

**Direct Publish:**
- When user publishes directly without scheduling:
  - `published_at = now()`
  - `published_date = now()` (Creation date = Publish date)
  - `status = 'published'`

**Scheduled Publish:**
- When user schedules publish for future:
  - `published_at = scheduled_time`
  - `published_date = null` (Not published yet)
  - `status = 'scheduled'`
  - Job dispatched to publish at scheduled time

### Content Update (`update()` method)

**Scenario 1: Keep as Draft**
- `published_at = null`
- `published_date = null`
- `updated_by_user_id = current_user_id`
- No publication data recorded

**Scenario 2: Convert Draft to Published**
- First time publish after draft:
  - `published_at = provided_time or now()`
  - `published_date = provided_time or now()` (Set once)
  - `status = 'published'`
  - `updated_by_user_id = current_user_id`

**Scenario 3: Manual Date Change After Published**
- Detect if content was already published and date changed:
  - Only update `published_at` (the publication schedule)
  - Keep `published_date` unchanged (original publication record)
  - `status` remains 'published'
  - `updated_by_user_id = current_user_id`

**Scenario 4: Reschedule Published Content**
- Future date provided for published content:
  - `published_at = new_scheduled_time`
  - `status = 'scheduled'`
  - `published_date` remains unchanged (original publication date preserved)
  - Job re-dispatched

## Usage Examples

### Example 1: Create and publish immediately
```
User creates content and clicks "نشر" (Publish)
→ published_at = 2024-12-07 14:30:00
→ published_date = 2024-12-07 14:30:00  (Same)
→ status = 'published'
→ user_id = 1
→ updated_by_user_id = null
```

### Example 2: Create as draft, edit later, then publish
```
Day 1: User creates as draft
→ published_at = null
→ published_date = null
→ status = 'draft'
→ user_id = 1

Day 5: Same or different user publishes
→ published_at = 2024-12-12 10:00:00
→ published_date = 2024-12-12 10:00:00  (Publication date, not creation date)
→ status = 'published'
→ user_id = 1 (unchanged)
→ updated_by_user_id = 2 (who published it)
```

### Example 3: Edit publish date after publication
```
Initial state (published):
→ published_at = 2024-12-07 14:30:00
→ published_date = 2024-12-07 14:30:00
→ status = 'published'

User changes date to 2024-12-15 09:00:00
→ published_at = 2024-12-15 09:00:00  (CHANGED)
→ published_date = 2024-12-07 14:30:00  (UNCHANGED - original preserved)
→ status = 'published'
→ updated_by_user_id = 3
```

### Example 4: Schedule for future
```
User creates content with scheduled date: 2024-12-20 10:00:00
→ published_at = 2024-12-20 10:00:00
→ published_date = null  (Not published yet)
→ status = 'scheduled'
→ Job dispatched to auto-publish on 2024-12-20
```

## Fields Explanation

### `created_at` (Laravel standard)
- Automatically set when record is created
- Never changes
- Represents database record creation time

### `updated_at` (Laravel standard)
- Automatically updated when record is modified
- Changes every time content is edited
- Represents last database modification time

### `published_date` (Custom)
- Permanent publication date
- Set ONLY when content transitions to published status
- Never changes after that
- Distinguishes "when was it published" from "when was it created in database"

### `published_at` (Modified)
- Stores scheduled or actual publication timestamp
- Can be changed by admin after publication for rescheduling
- Used for both scheduling and display

### `updated_by_user_id` (Custom)
- Tracks who made the last edit/update
- Useful for audit trails
- Shows accountability for changes

## Database Queries for Reporting

### Get content creation timeline
```sql
SELECT id, title, created_at, user_id FROM contents ORDER BY created_at DESC;
```

### Get publication timeline
```sql
SELECT id, title, published_date, status FROM contents 
WHERE status IN ('published', 'scheduled') 
ORDER BY published_date DESC;
```

### Get who updated content
```sql
SELECT c.id, c.title, c.updated_at, u.name as updated_by 
FROM contents c
LEFT JOIN users u ON c.updated_by_user_id = u.id
WHERE c.status = 'published'
ORDER BY c.updated_at DESC;
```

## Summary

This implementation provides:
1. ✅ **Clear separation** between creation date and publication date
2. ✅ **Draft support** with no publication tracking
3. ✅ **Publication history** preserved through `published_date`
4. ✅ **User accountability** via `updated_by_user_id`
5. ✅ **Schedule management** without losing original publication date
6. ✅ **Audit trail** capability through `created_at`, `updated_at`, `published_date`, and `updated_by_user_id`
