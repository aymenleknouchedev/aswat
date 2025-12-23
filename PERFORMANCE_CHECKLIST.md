# Performance Optimization Checklist

## ✅ Phase 1: Quick Wins (40% Improvement)
Estimated time: ~1 hour | Expected improvement: Initial load 40% faster

- [ ] **Add `loading="lazy"` to all below-fold images**
  - [ ] [resources/views/user/components/header.blade.php](resources/views/user/components/header.blade.php)
  - [ ] [resources/views/user/components/many-titles.blade.php](resources/views/user/components/many-titles.blade.php)
  - [ ] [resources/views/user/components/people.blade.php](resources/views/user/components/people.blade.php)
  - [ ] [resources/views/user/window.blade.php](resources/views/user/window.blade.php)
  - [ ] [resources/views/user/components/media.blade.php](resources/views/user/components/media.blade.php)
  - [ ] Other image-containing components

- [ ] **Add Resource Hints to head**
  - [ ] Add `<link rel="preconnect">` for critical external domains
  - [ ] Add `<link rel="dns-prefetch">` for CDNs
  - [ ] Add `<link rel="preload">` for critical fonts

- [ ] **Defer non-critical CSS**
  - [ ] Keep only critical CSS in `<head>`
  - [ ] Use `media="print" onload="this.media='all'"` for others
  - [ ] Add `<noscript>` fallback

- [ ] **Test Phase 1 improvements**
  - [ ] Run Lighthouse before and after
  - [ ] Test on slow 3G connection
  - [ ] Verify images load on scroll
  - [ ] Hard refresh to clear cache

---

## ✅ Phase 2: Medium Priority (30% Improvement)
Estimated time: ~1-2 hours | Expected improvement: Additional 30% faster

- [ ] **Replace quote replacer with optimized version**
  - [ ] Copy [public/user/js/quote-replacer-optimized.js](public/user/js/quote-replacer-optimized.js)
  - [ ] Remove old inline script from [resources/views/layouts/index.blade.php](resources/views/layouts/index.blade.php)
  - [ ] Update script tag to use optimized version
  - [ ] Test quote replacement still works
  - [ ] Check browser console for errors

- [ ] **Replace photos-scroll.js with optimized version**
  - [ ] Copy [public/user/js/photos-scroll-optimized.js](public/user/js/photos-scroll-optimized.js)
  - [ ] Update script tag in layout
  - [ ] Test photo carousel functionality
  - [ ] Verify lazy loading of photos
  - [ ] Test caching behavior

- [ ] **Lazy load external SDKs**
  - [ ] Copy [public/user/js/external-sdks-optimized.js](public/user/js/external-sdks-optimized.js)
  - [ ] Remove `<script async defer>` for Facebook SDK
  - [ ] Add optimized SDK loader script tag
  - [ ] Test Instagram/Facebook embeds still load
  - [ ] Verify delay doesn't affect UX

- [ ] **Test Phase 2 improvements**
  - [ ] Run Lighthouse again
  - [ ] Check DOM processing is debounced
  - [ ] Verify photos API caching works
  - [ ] Test on multiple network speeds

---

## ✅ Phase 3: Best Practices (20% Improvement)
Estimated time: ~2-3 hours | Expected improvement: Final 20% optimization

- [ ] **Image Optimization**
  - [ ] Convert images to WebP format
  - [ ] Create responsive image sets with `srcset`
  - [ ] Add width/height attributes to prevent layout shift
  - [ ] Compress images with optimization tools

- [ ] **Inline Critical CSS**
  - [ ] Identify critical styles for above-fold content
  - [ ] Create [resources/views/layouts/critical.css](resources/views/layouts/critical.css)
  - [ ] Inline critical CSS in `<head>`
  - [ ] Defer rest via external file
  - [ ] Test for layout shift (CLS)

- [ ] **Implement Service Worker**
  - [ ] Create [public/user/service-worker.js](public/user/service-worker.js)
  - [ ] Register in [public/user/js/init.js](public/user/js/init.js)
  - [ ] Cache static assets
  - [ ] Test offline functionality
  - [ ] Monitor cache invalidation

- [ ] **Add Caching Headers**
  - [ ] Configure .htaccess or web.config for browser caching
  - [ ] Set cache expiry for static assets (1 year)
  - [ ] Use versioning for CSS/JS files (query params or renamed)
  - [ ] Enable gzip compression on server

- [ ] **Test Phase 3 improvements**
  - [ ] Verify all metrics improved
  - [ ] Test on various devices and networks
  - [ ] Check Core Web Vitals (CLS, FID, LCP)

---

## ✅ Verification Steps

Before declaring success, verify:

- [ ] **First Page Load**
  - [ ] Hard refresh (Ctrl+Shift+R) clears cache
  - [ ] Page renders progressively
  - [ ] Images load as you scroll
  - [ ] No layout shifts (CLS < 0.1)
  - [ ] Interactive within 2-3 seconds

- [ ] **Repeat Page Load**
  - [ ] Regular refresh (F5)
  - [ ] Should be much faster
  - [ ] Cached assets load instantly

- [ ] **Network Conditions**
  - [ ] Test on Slow 3G (DevTools > Network)
  - [ ] Test on 4G
  - [ ] Test on WiFi
  - [ ] Performance acceptable on all

- [ ] **Browser Compatibility**
  - [ ] Chrome/Edge (latest)
  - [ ] Firefox (latest)
  - [ ] Safari (latest)
  - [ ] Mobile browsers

- [ ] **Functionality**
  - [ ] Navigation works
  - [ ] Embeds render (Instagram, Facebook)
  - [ ] Load more buttons functional
  - [ ] No JavaScript errors in console
  - [ ] Search/filters work

---

## ✅ Monitoring Setup

- [ ] **Set up Core Web Vitals monitoring**
  ```javascript
  // Add to page
  import {getCLS, getFID, getFCP, getLCP, getTTFB} from 'web-vitals';
  
  getCLS(console.log);
  getFID(console.log);
  getFCP(console.log);
  getLCP(console.log);
  getTTFB(console.log);
  ```

- [ ] **Add performance logging**
  - [ ] Log metrics to analytics service
  - [ ] Track improvements over time
  - [ ] Set up alerts for performance degradation

- [ ] **Create baseline metrics**
  - [ ] Document current performance
  - [ ] Create dashboard for tracking
  - [ ] Set performance budgets

---

## ✅ Documentation

- [ ] **Update README**
  - [ ] Document performance optimizations applied
  - [ ] List files modified
  - [ ] Provide rollback instructions

- [ ] **Create performance guide**
  - [ ] Document best practices for new features
  - [ ] Add performance checklist for code reviews
  - [ ] Provide optimization guidelines

- [ ] **Add comments to optimized code**
  - [ ] Explain why debounce is needed
  - [ ] Document caching strategy
  - [ ] Mark performance-critical sections

---

## ✅ Issue Tracking

If problems occur:

- [ ] **Document issue**
  - [ ] Describe what's broken
  - [ ] Note which optimization caused it
  - [ ] Screenshot/video if needed

- [ ] **Rollback**
  - [ ] Revert the offending change
  - [ ] Test functionality restored
  - [ ] Plan fix or alternative approach

- [ ] **Fix and redeploy**
  - [ ] Apply fix
  - [ ] Test thoroughly
  - [ ] Deploy with monitoring

---

## Expected Metrics

### Before Optimization:
```
First Contentful Paint (FCP):     2-3 seconds
Largest Contentful Paint (LCP):    3-4 seconds
Time to Interactive (TTI):         4-5 seconds
Cumulative Layout Shift (CLS):     0.15-0.25
Total Blocking Time (TBT):         500-800ms
```

### After Phase 1:
```
FCP: 1.5-2 seconds      ✓ 30-40% improvement
LCP: 2-2.5 seconds      ✓ 30-40% improvement
TTI: 2.5-3.5 seconds    ✓ 30-40% improvement
```

### After Phase 2:
```
FCP: 1-1.5 seconds      ✓ 50-60% total improvement
LCP: 1.5-2 seconds      ✓ 50-60% total improvement
TTI: 2-2.5 seconds      ✓ 50-60% total improvement
TBT: < 200ms            ✓ 60-70% reduction
```

### After Phase 3:
```
FCP: < 1 second         ✓ 60-70% total improvement
LCP: 1-1.5 seconds      ✓ 60-70% total improvement
TTI: 1.5-2 seconds      ✓ 60-70% total improvement
CLS: < 0.05             ✓ 70-80% reduction
```

---

## Resources

- [Web Vitals Guide](https://web.dev/vitals/)
- [Lazy Loading Images](https://web.dev/lazy-loading-images/)
- [Critical Rendering Path](https://web.dev/critical-rendering-path/)
- [Performance Budget Guide](https://web.dev/performance-budgets-101/)
- [Chrome DevTools Performance Guide](https://developer.chrome.com/docs/devtools/performance/)

---

## Quick Reference Commands

### Lighthouse Test:
```bash
# Via Chrome DevTools
1. Open DevTools (F12)
2. Go to Lighthouse tab
3. Click "Analyze page load"
4. Note FCP, LCP, TTI metrics
```

### Network Throttling:
```
Chrome DevTools > Network > Throttling
- Offline
- Slow 3G
- 4G
```

### Clear Cache & Hard Refresh:
```
Windows: Ctrl + Shift + R
Mac: Cmd + Shift + R
```

### Test on Mobile:
```
Chrome DevTools > Toggle device toolbar (Ctrl + Shift + M)
or
Test on real device: Check DevTools remote debugging
```

---

## Sign-Off

- [ ] All Phase 1 items complete
- [ ] All Phase 2 items complete  
- [ ] All Phase 3 items complete (optional, depending on budget)
- [ ] All verification steps passed
- [ ] Metrics documented and improved
- [ ] Team notified of changes
- [ ] Monitoring alerts configured
- [ ] Documentation updated

**Date completed**: _______________  
**Team member**: _______________  
**Performance improvement**: ______ %
