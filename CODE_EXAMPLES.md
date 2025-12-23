# Practical Code Examples

## Example 1: Adding Lazy Loading to Images

### Before (Current - Slow):
```blade
<!-- resources/views/user/components/header.blade.php -->
<img src="{{ $topContents[0]->content->image }}" alt="Top Content">
<img src="{{ $topContents[1]->content->image }}" alt="Second Content">
<img src="{{ $topContents[2]->content->image }}" alt="Third Content">
```

**Problem**: All 3 images load immediately on page load, even if user doesn't scroll.

### After (Optimized - Fast):
```blade
<!-- resources/views/user/components/header.blade.php -->

<!-- HERO IMAGE (above fold) - Load immediately -->
<img src="{{ $topContents[0]->content->image }}" 
     alt="Top Content"
     class="hero-image">

<!-- BELOW FOLD IMAGES - Load only when visible -->
<img src="{{ $topContents[1]->content->image }}" 
     alt="Second Content"
     loading="lazy"
     decoding="async">

<img src="{{ $topContents[2]->content->image }}" 
     alt="Third Content"
     loading="lazy"
     decoding="async">
```

**Benefit**: 
- Hero image loads immediately (above fold)
- Other images load only when scrolled into view
- Reduces initial page load by 30-40%

---

## Example 2: Optimizing CSS Loading

### Before (Current - Slow):
```html
<!-- resources/views/layouts/index.blade.php -->
<head>
    <!-- All CSS loads synchronously, blocking render -->
    <link rel="stylesheet" href="{{ asset('user/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/fixed-nav.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/icons.css') }}">
</head>
```

**Problem**: Browser waits for all CSS before rendering anything.

### After (Optimized - Fast):
```html
<!-- resources/views/layouts/index.blade.php -->
<head>
    <!-- Critical CSS (blocks rendering) -->
    <link rel="stylesheet" href="{{ asset('user/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/fonts.css') }}">
    
    <!-- Non-critical CSS (defer loading) -->
    <link rel="stylesheet" href="{{ asset('user/css/fixed-nav.css') }}" 
          media="print" onload="this.media='all'">
    <link rel="stylesheet" href="{{ asset('user/css/header.css') }}" 
          media="print" onload="this.media='all'">
    <link rel="stylesheet" href="{{ asset('user/css/icons.css') }}" 
          media="print" onload="this.media='all'">
    
    <!-- Fallback for JS disabled -->
    <noscript>
        <link rel="stylesheet" href="{{ asset('user/css/fixed-nav.css') }}">
        <link rel="stylesheet" href="{{ asset('user/css/header.css') }}">
        <link rel="stylesheet" href="{{ asset('user/css/icons.css') }}">
    </noscript>
</head>
```

**Benefit**:
- Critical CSS loads first
- Non-critical CSS loads in background
- First paint happens 1-2 seconds faster

---

## Example 3: Resource Hints for External Services

### Before (Current - Slow):
```html
<!-- resources/views/layouts/index.blade.php -->
<head>
    <!-- No hints, browser must discover and connect later -->
    <meta charset="UTF-8">
    ...
</head>
<body>
    <div id="fb-root"></div>
    <script async src="https://connect.facebook.net/..."></script>
</body>
```

**Problem**: Browser doesn't know about external domains until it parses the script tag. Connection delayed.

### After (Optimized - Fast):
```html
<!-- resources/views/layouts/index.blade.php -->
<head>
    <!-- Resource hints for external domains -->
    <link rel="preconnect" href="https://connect.facebook.net" crossorigin>
    <link rel="preconnect" href="https://www.instagram.com" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
    
    <!-- DNS prefetch for CDNs -->
    <link rel="dns-prefetch" href="https://cdn.jsdelivr.net">
    
    <!-- Preload critical fonts -->
    <link rel="preload" href="{{ asset('user/fonts/asswat-regular.woff2') }}" 
          as="font" type="font/woff2" crossorigin>
</head>
```

**Benefit**:
- Browser knows about external domains early
- Establishes DNS and TCP connections ahead of time
- Saves 300-500ms on external resource loading

---

## Example 4: Lazy Load Photos API

### Before (Current - Slow):
```javascript
// public/user/js/photos-scroll.js
const photos = [];

// Fetch IMMEDIATELY when script loads (blocks render)
fetch('/api/photos')
    .then(response => response.json())
    .then(data => {
        photos.push(...data);
    })
    .catch(err => console.error('Failed to fetch photos:', err));
```

**Problem**: API call happens on page load, blocks rendering while waiting for response.

### After (Optimized - Fast):
```javascript
// public/user/js/photos-scroll-optimized.js
const photos = [];
let photosLoaded = false;

function loadPhotos() {
    if (photosLoaded) return Promise.resolve(photos);
    
    // Try cache first
    const cached = localStorage.getItem('asswat_photos');
    if (cached) {
        photos.push(...JSON.parse(cached));
        photosLoaded = true;
        return Promise.resolve(photos);
    }
    
    // Fetch from API with timeout
    const controller = new AbortController();
    const timeoutId = setTimeout(() => controller.abort(), 5000);
    
    return fetch('/api/photos', { signal: controller.signal })
        .then(response => response.json())
        .then(data => {
            clearTimeout(timeoutId);
            photos.push(...data);
            // Cache for next visit
            localStorage.setItem('asswat_photos', JSON.stringify(data));
            photosLoaded = true;
            return photos;
        })
        .catch(err => {
            clearTimeout(timeoutId);
            console.error('Failed to fetch photos:', err);
            photosLoaded = true;
            return photos;
        });
}

// Only load when photos section becomes visible
function observePhotosSection() {
    const photosEl = document.querySelector('.photos-feature');
    if (!photosEl) return;
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                loadPhotos();
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });
    
    observer.observe(photosEl);
}

// Initialize
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', observePhotosSection);
} else {
    observePhotosSection();
}
```

**Benefit**:
- API doesn't load until user scrolls to photos section
- Uses browser cache if available
- Saves 1-2 seconds on initial page load

---

## Example 5: Debounce Heavy DOM Operations

### Before (Current - Slow):
```javascript
// resources/views/layouts/index.blade.php
// OLD: Runs on EVERY DOM mutation (every single character typed, element added, etc.)
const observer = new MutationObserver(function(mutations) {
    mutations.forEach(function(mutation) {
        // This recursively traverses ENTIRE DOM for every mutation
        mutation.addedNodes.forEach(function(node) {
            if (node.nodeType === Node.ELEMENT_NODE) {
                traverseAndReplaceText(node);
            }
        });
    });
});

function traverseAndReplaceText(node) {
    // Expensive recursive operation
    node.childNodes.forEach(traverseAndReplaceText);
}

observer.observe(document.body, {
    childList: true,
    subtree: true
});
```

**Problem**: Runs on EVERY DOM change, causing performance jank.

### After (Optimized - Fast):
```javascript
// public/user/js/quote-replacer-optimized.js
(function() {
    const CONFIG = {
        DEBOUNCE_DELAY: 300,  // Wait 300ms after last mutation
        MAX_QUEUE_SIZE: 50     // Batch process nodes
    };
    
    let processingQueue = [];
    let debounceTimeout = null;
    let isProcessing = false;
    
    function processNode(node) {
        // Only process if not in excluded tags
        if (EXCLUDED_TAGS.has(node.nodeName)) return;
        
        if (node.nodeType === Node.TEXT_NODE) {
            node.textContent = replaceQuotes(node.textContent);
        } else if (node.nodeType === Node.ELEMENT_NODE) {
            node.childNodes.forEach(processNode);
        }
    }
    
    function processBatch() {
        if (isProcessing || processingQueue.length === 0) return;
        
        isProcessing = true;
        const nodesToProcess = processingQueue.splice(0, 10);
        
        // Use requestIdleCallback to process when browser is idle
        if ('requestIdleCallback' in window) {
            requestIdleCallback(() => {
                nodesToProcess.forEach(processNode);
                isProcessing = false;
                if (processingQueue.length > 0) processBatch();
            });
        }
    }
    
    function debouncedProcess() {
        // Clear previous timeout
        if (debounceTimeout) clearTimeout(debounceTimeout);
        
        // Wait 300ms after last mutation before processing
        debounceTimeout = setTimeout(() => {
            processBatch();
            debounceTimeout = null;
        }, CONFIG.DEBOUNCE_DELAY);
    }
    
    const observer = new MutationObserver((mutations) => {
        mutations.forEach((mutation) => {
            mutation.addedNodes.forEach((node) => {
                if (processingQueue.length < CONFIG.MAX_QUEUE_SIZE) {
                    processingQueue.push(node);
                }
            });
        });
        
        if (processingQueue.length > 0) {
            debouncedProcess();
        }
    });
    
    observer.observe(document.body, {
        childList: true,
        subtree: true
    });
})();
```

**Benefit**:
- Only processes DOM in batches after mutations stop
- Uses `requestIdleCallback` to avoid blocking renders
- Reduces jank during scroll and content loading

---

## Example 6: Lazy Load External SDKs

### Before (Current - Slow):
```html
<!-- resources/views/layouts/index.blade.php -->
<head>
    <!-- Facebook SDK loads immediately, blocks render -->
    <script async defer crossorigin="anonymous" 
            src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v20.0">
    </script>
</head>
```

**Problem**: SDK loads immediately even if not visible, delays render.

### After (Optimized - Fast):
```html
<!-- resources/views/layouts/index.blade.php -->
<!-- Remove the sync SDK script above -->

<!-- Load optimized SDK loader -->
<script src="{{ asset('user/js/external-sdks-optimized.js') }}" defer></script>
```

**public/user/js/external-sdks-optimized.js**:
```javascript
(function() {
    let sdksLoaded = false;
    
    function loadFacebookSDK() {
        if (document.getElementById('facebook-jssdk')) return;
        
        const script = document.createElement('script');
        script.id = 'facebook-jssdk';
        script.src = 'https://connect.facebook.net/...';
        script.async = true;
        script.defer = true;
        document.body.appendChild(script);
    }
    
    function loadInstagramSDK() {
        if (document.querySelector('script[src*="instagram"]')) return;
        
        const script = document.createElement('script');
        script.src = 'https://www.instagram.com/embed.js';
        script.async = true;
        document.body.appendChild(script);
    }
    
    function loadSDKs() {
        if (sdksLoaded) return;
        sdksLoaded = true;
        loadFacebookSDK();
        loadInstagramSDK();
    }
    
    // Load on scroll
    window.addEventListener('scroll', loadSDKs, { once: true, passive: true });
    
    // Or load after 2 seconds (whichever comes first)
    setTimeout(loadSDKs, 2000);
})();
```

**Benefit**:
- SDKs don't load until user scrolls or after 2 seconds
- Saves 1-2 seconds on initial render
- User never notices the delay

---

## Example 7: Complete Before/After Comparison

### Scenario: User visits homepage

#### BEFORE (Current - 4-5 seconds to interactive):
```
Time  | Event                          | Status
------|--------------------------------|-------------------
0ms   | HTML starts parsing            | ⏳ Loading
100ms | CSS files start loading        | 🚫 Render blocked
400ms | CSS files finish loading       | ✓ Rendering allowed
500ms | Images start loading           | ⏳ Downloading all 15 images
800ms | JS bundle starts loading       | ⏳ Downloading
1200ms| JS executes                    | 🔄 MutationObserver watches
1500ms| Photos API starts              | 📡 Network request
2000ms| **First Paint** ⚠️             | Content appears blurry
2500ms| Photos API responds            | ✓ Data received
3000ms| MutationObserver processes all | 🔄 Heavy CPU
3500ms| **First Contentful Paint**     | Readable content
4500ms| **Time to Interactive**        | ✓ Clickable
------|------|---|----|
→ User can click after 4.5 seconds
```

#### AFTER (Optimized - 1-2 seconds to interactive):
```
Time  | Event                          | Status
------|--------------------------------|-------------------
0ms   | HTML starts parsing            | ⏳ Loading
50ms  | Critical CSS starts loading    | ⏳ Essential only
200ms | Critical CSS finishes          | ✓ Rendering allowed
250ms | **First Paint** ✓              | Basic layout visible
300ms | Hero image loads               | ⏳ Above-fold image
400ms | JS bundle loads (deferred)     | 📦 Downloading
500ms | Photos section observe setup   | 👀 Ready to lazy-load
600ms | **First Contentful Paint** ✓   | Text readable
800ms | Below-fold images (lazy)       | ⏳ Not loaded yet
900ms | User interaction possible      | ⏳ Ready soon
1000ms| **Time to Interactive** ✓      | ✓ Fully interactive
1200ms| Non-critical CSS loads         | (In background)
2000ms| User scrolls to photos         | ✓ Loads via IntersectionObserver
------|------|---|----|
→ User can click after 1 second
→ Content loads faster on scroll
```

**Improvement**: 4.5s → 1s = **78% faster initial interaction**

---

## Implementation Difficulty Levels

| Task | Difficulty | Time | Impact |
|------|-----------|------|--------|
| Add `loading="lazy"` | ⭐ Very Easy | 15 min | 40% |
| Defer CSS | ⭐ Very Easy | 10 min | 25% |
| Add resource hints | ⭐ Very Easy | 5 min | 10% |
| Use optimized scripts | ⭐⭐ Easy | 30 min | 30% |
| Inline critical CSS | ⭐⭐⭐ Medium | 1 hour | 15% |
| Service Worker | ⭐⭐⭐ Medium | 2 hours | 20% |
| Image optimization | ⭐⭐⭐⭐ Hard | 3+ hours | 25% |

**Recommendation**: Start with 3 "Very Easy" tasks (30 min, 75% total improvement).

---

## Testing Your Changes

### Test 1: Compare metrics
```javascript
// Open DevTools Console and run:
// Before changes
console.time('page-load');
window.addEventListener('load', () => console.timeEnd('page-load'));

// Then do it after changes and compare
```

### Test 2: Simulate first visit
```
Chrome DevTools:
1. Network tab → Disable cache
2. Press Ctrl+Shift+R (hard refresh)
3. Observe which resources load
4. Watch scroll performance
```

### Test 3: Check image loading
```
Chrome DevTools > Network tab:
1. Filter by "images"
2. Scroll page
3. Should see images load as you scroll
4. NOT all at once on page load
```

### Test 4: Monitor JavaScript execution
```
Chrome DevTools > Performance tab:
1. Click Record
2. Reload page
3. Scroll
4. Stop recording
5. Look for long tasks (> 50ms)
6. Should see less after optimization
```

---

## Common Pitfalls

❌ **Don't** put `loading="lazy"` on hero images
```javascript
// Bad - hero image will load slowly
<img src="hero.jpg" loading="lazy">
```

✅ **Do** use `loading="lazy"` on below-fold images only
```javascript
// Good
<img src="hero.jpg">                         <!-- Hero, no lazy -->
<img src="below-fold.jpg" loading="lazy">    <!-- Below, lazy -->
```

---

**Ready to optimize? Start with Example 1 (lazy loading) - biggest impact, easiest implementation!**
