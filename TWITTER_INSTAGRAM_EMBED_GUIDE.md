# Twitter & Instagram Embed Feature Guide

## Overview
This guide explains the Twitter and Instagram embed functionality that has been integrated into the TinyMCE editor in your Laravel application.

## Features Added

### 1. **Twitter Embed Button**
- **Button Label**: تويتر (Twitter in Arabic)
- **Location**: Toolbar in the main editor
- **Functionality**: Allows users to embed tweets by providing a tweet URL

### 2. **Instagram Embed Button**
- **Button Label**: إنستجرام (Instagram in Arabic)
- **Location**: Toolbar in the main editor
- **Functionality**: Allows users to embed Instagram posts by providing a post URL

## How to Use

### Embedding a Tweet

1. Click the **تويتر** (Twitter) button in the editor toolbar
2. A prompt will appear asking for the tweet URL
3. Paste the Twitter/X tweet URL (e.g., `https://twitter.com/user/status/1234567890`)
4. A dialog box will open with a textarea to confirm or modify the URL
5. Click **إدراج** (Insert) to embed the tweet
6. The tweet will appear as a stylized block in the editor with:
   - A blue left border (#1da1f2)
   - A light blue background (#f5f8fa)
   - The tweet URL displayed for reference
   - Clickable to open the original tweet in a new window

### Embedding an Instagram Post

1. Click the **إنستجرام** (Instagram) button in the editor toolbar
2. A prompt will appear asking for the Instagram post URL
3. Paste the Instagram post URL (e.g., `https://www.instagram.com/p/ABC123DEF/`)
4. A dialog box will open with a textarea to confirm or modify the URL
5. Click **إدراج** (Insert) to embed the post
6. The post will appear as a stylized block in the editor with:
   - A pink left border (#e4405f)
   - A light pink background (#fdf9f9)
   - The Instagram URL displayed for reference
   - Clickable to open the original post in a new window

## Technical Details

### Files Modified
- **File**: `resources/views/components/head/tinymce-config.blade.php`

### Changes Made

#### 1. External Scripts Added (Section 7)
```html
<!-- Twitter Embed Script -->
<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>

<!-- Instagram Embed Script -->
<script async src="//www.instagram.com/embed.js" charset="utf-8"></script>
```

#### 2. Button Definitions Added
Two new TinyMCE buttons were registered in the editor setup:

**vvcTwitterEmbed Button:**
- Opens a dialog to accept Twitter/X tweet URLs
- Validates the URL is not empty
- Inserts an HTML blockquote element with styling
- Triggers Twitter widget loader for enhanced rendering

**vvcInstagramEmbed Button:**
- Opens a dialog to accept Instagram post URLs
- Validates the URL is not empty
- Inserts an HTML div element with styling
- Triggers Instagram embed processor for enhanced rendering

#### 3. Toolbar Updated
The editor toolbar now includes both new buttons:
```javascript
'| link table image media blockquote vvcPicker vvcClickableText vvcReadMore vvcFacebookPost vvcTwitterEmbed vvcInstagramEmbed vvcPaste'
```

#### 4. CSS Styling Added
Enhanced styling for Twitter and Instagram embeds in the editor content:

**Twitter Tweet Styles:**
```css
.twitter-tweet{
    border-left:4px solid #1da1f2;
    padding:12px 0 12px 12px;
    margin:16px 0;
    background:#f5f8fa;
    border-radius:4px;
}
```

**Instagram Embed Block Styles:**
```css
.instagram-embed-block{
    border-left:4px solid #e4405f;
    padding:12px 0 12px 12px;
    margin:16px 0;
    background:#fdf9f9;
    border-radius:4px;
}
```

## Security Features

### XSS Protection
- All user-provided URLs are escaped using the `escapeHtml()` function
- Special attention to prevent attribute injection via `data-` attributes
- URLs marked as `contenteditable="false"` and `mceNonEditable` to prevent unwanted editing

### Content Safety
- Embeds are wrapped in non-editable blocks (`mceNonEditable` class)
- Click handlers use `onclick="window.open(...)"` for safe navigation
- No inline scripts are executed

## Rendering Behavior

### Editor Display
When embedded, the content displays as:

**Twitter:**
```
┌─ 🐦 تغريدة تويتر
├─ https://twitter.com/...
└─ [Clickable block]
```

**Instagram:**
```
┌─ 📷 منشور إنستجرام
├─ https://www.instagram.com/...
└─ [Clickable block]
```

### Frontend Display
When the content is displayed on the frontend:

1. **Twitter**: The original tweet embed will render with full styling and functionality if Twitter's widget script is loaded
2. **Instagram**: The original Instagram post will render with full styling and functionality if Instagram's embed script is loaded

## Browser Compatibility

- **Twitter Embed**: Works on all modern browsers that support the Twitter widgets API
- **Instagram Embed**: Works on all modern browsers that support the Instagram embeds API

## Troubleshooting

### Tweets/Posts Not Rendering
**Issue**: The embed appears as just the URL in the block
**Solution**: 
- Ensure the URLs are correct and publicly accessible
- Make sure external scripts (Twitter/Instagram embed CDNs) are not blocked by ad blockers or security settings
- Check browser console for any script loading errors

### Dialog Not Appearing
**Issue**: Clicking the button doesn't open the input dialog
**Solution**:
- Ensure TinyMCE is fully loaded
- Check browser console for JavaScript errors
- Refresh the page and try again

### Embed Not Clickable
**Issue**: Can't click to open the original post
**Solution**:
- This is normal if the embed isn't rendered yet - refresh the page
- Check that JavaScript is enabled
- Verify that popup windows aren't blocked in your browser

## Future Enhancements

Possible improvements:
1. Add URL validation before inserting
2. Show preview/thumbnail of tweets and posts before inserting
3. Support for other social media platforms (TikTok, YouTube Shorts, etc.)
4. Custom styling options for embeds
5. Responsive sizing for different screen widths

## Notes

- The embeds will only render with full styling on the frontend if the external scripts (Twitter/Instagram widgets) are also included in your main layout
- For RTL (Right-to-Left) content, the text direction is handled automatically by CSS
- The embeds are compatible with the existing Facebook embed feature
- All embeds follow the same non-editable block pattern for consistency

## Support Resources

- **Twitter Embed Docs**: https://developer.twitter.com/en/docs/twitter-for-websites/embedded-tweets/overview
- **Instagram Embed Docs**: https://developers.facebook.com/docs/instagram/embedding
- **TinyMCE Custom Buttons**: https://www.tiny.cloud/develop/customize-ui/
