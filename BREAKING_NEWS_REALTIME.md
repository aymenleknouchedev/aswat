# Breaking News Real-Time System

## Overview

The breaking news system has been refactored into separate, maintainable components with real-time update capabilities. New breaking news items are detected automatically and displayed immediately to users.

## File Structure

### Frontend Files
- **`resources/views/user/components/breaking-news.blade.php`** - Modal HTML component
- **`public/user/css/breaking-news.css`** - Modal styling and animations
- **`public/user/js/breaking-news.js`** - Real-time polling and display logic

### Backend Files
- **`app/Http/Controllers/BreakingNewsController.php`** - CRUD operations for breaking news
- **`app/Http/Controllers/HomePageController.php`** - API endpoint for fetching breaking news
- **`app/Models/BreakingContent.php`** - Breaking news model
- **`routes/client.php`** - API routes (includes `/api/breaking-news` endpoint)

## How It Works

### Real-Time Updates (Frontend)

The `breaking-news.js` file implements automatic polling:

1. **Initial Load**: Fetches all breaking news from `/api/breaking-news`
2. **Continuous Polling**: Every 5 seconds, checks for new breaking news
3. **Duplicate Detection**: Filters out already-displayed items
4. **Immediate Display**: New items are shown in the modal instantly
5. **Pause on Hidden**: Stops polling when the browser tab is not visible
6. **Resume on Focus**: Resumes polling when the tab becomes visible again

### Configuration (in breaking-news.js)

```javascript
const CONFIG = {
    POLL_INTERVAL: 5000,           // Poll every 5 seconds
    ITEM_DISPLAY_DURATION: 5000,   // Each news item shows for 5 seconds
    ANIMATION_DELAY: 5,            // Stagger animation delay in seconds
};
```

**Adjust these values to match your needs:**
- Increase `POLL_INTERVAL` to reduce server load (less frequent checks)
- Decrease `POLL_INTERVAL` for faster real-time updates
- Change `ITEM_DISPLAY_DURATION` to control how long each news item displays

### API Response Format

```json
{
    "data": [
        "عاجل: حدث مهم جدا",
        "عاجل: خبر آخر",
        "عاجل: تحديث أخير"
    ],
    "updated_at": 1702129200
}
```

The `updated_at` timestamp helps the frontend detect when new data is available.

## Adding Breaking News

### Via Dashboard

1. Navigate to the dashboard breaking news section
2. Enter the breaking news text
3. Click "Add Breaking News"
4. The news is automatically cached and cleared for instant frontend updates

**File**: `app/Http/Controllers/BreakingNewsController.php` (store method)

### Cache Management

When breaking news is added or deleted:
- The cache is automatically cleared: `Cache::forget('breaking-news')`
- Frontend polls and detects the new news within 5 seconds
- No page refresh needed

## Frontend Integration

### Including in Views

```blade
<!-- In your main layout or page -->
<link rel="stylesheet" href="{{ asset('user/css/breaking-news.css') }}">
@include('user.components.breaking-news')
<script src="{{ asset('user/js/breaking-news.js') }}"></script>
```

### Customization

**CSS Classes Available**:
- `.breaking-news-modal` - Main modal container
- `.breaking-news-header` - Header with title and close button
- `.breaking-news-content` - Content area
- `.breaking-news-title` - Title with pulsing indicator dot
- `.breaking-news-item` - Individual news item
- `.breaking-news-close` - Close button

**Styling Example** (add to your CSS):

```css
.breaking-news-modal {
    background: linear-gradient(135deg, #C1121F 0%, #8B0A17 100%);
    /* Customize colors, gradients, positioning, etc. */
}
```

## Performance Optimization

### Current Optimizations

1. **Smart Polling**: Only polls when page is visible
2. **Duplicate Detection**: Prevents showing the same news twice
3. **Cache TTL**: Breaking news cached for 5 minutes
4. **Cleanup**: Timeouts are properly cleared to prevent memory leaks

### For High-Traffic Sites

If you expect many concurrent users:

1. **Increase Poll Interval**:
   ```javascript
   POLL_INTERVAL: 10000,  // 10 seconds instead of 5
   ```

2. **Implement WebSockets** (optional):
   - Use Laravel Echo or Socket.io for true real-time updates
   - Replace polling with event-driven updates
   - File: `public/user/js/breaking-news-websocket.js` (create new)

3. **Database Indexing**:
   ```sql
   CREATE INDEX idx_breaking_content_created ON breaking_content(created_at DESC);
   ```

## Debugging

Enable console logging to monitor polling:

```javascript
// In breaking-news.js, uncomment or add:
console.log('Breaking news check at:', new Date().toLocaleTimeString());
console.log('New breaking news detected:', newItems);
```

## API Endpoint Details

**GET** `/api/breaking-news`

**Returns**:
- `data`: Array of breaking news strings (last 10 minutes)
- `updated_at`: Unix timestamp of last update

**Cache**: 5 minutes (auto-clears when new news is added)

**Response Example**:
```json
{
    "data": ["خبر عاجل 1", "خبر عاجل 2"],
    "updated_at": 1702129200
}
```

## User Interactions

1. **Auto-play**: News displays automatically on page load
2. **Manual Close**: Users can close the modal with the X button
3. **Re-open**: Clicking the collapsed header re-opens the modal
4. **Responsive**: Works on mobile and desktop

## Keyboard Accessibility

- ✅ ARIA labels on all interactive elements
- ✅ Proper semantic HTML
- ✅ Screen reader support for loading state

## Browser Support

- ✅ Chrome, Firefox, Safari, Edge (all modern versions)
- ✅ Mobile browsers (iOS Safari, Chrome Mobile)
- ✅ Graceful degradation for older browsers

## Troubleshooting

### Breaking news not showing

1. Check if BreakingContent has data: `BreakingContent::all()`
2. Verify cache is being cleared: `Cache::has('breaking-news')`
3. Check browser console for errors
4. Ensure CSS and JS files are loading (check Network tab)

### Not updating in real-time

1. Verify polling is working (check Network tab for `/api/breaking-news` requests)
2. Check if page visibility API is blocking polling (tab must be visible)
3. Increase `POLL_INTERVAL` for testing (e.g., `3000` for 3-second updates)

### High server load

1. Increase `POLL_INTERVAL` to reduce requests
2. Increase cache TTL in `HomePageController.php` (from 5 to 10+ minutes)
3. Add database indexing on `created_at` column

## Future Enhancements

- [ ] WebSocket integration for true real-time updates
- [ ] Sound notification for new breaking news
- [ ] Persistence of news history (IndexedDB)
- [ ] User preferences for notification frequency
- [ ] Analytics tracking for breaking news engagement
