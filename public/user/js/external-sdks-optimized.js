/**
 * Optimized External SDKs Loader
 * Lazy loads Facebook and Instagram SDKs on scroll or on-demand
 * Place this in your head tag or load before other scripts
 */

(function() {
    'use strict';
    
    const CONFIG = {
        FACEBOOK_SDK_ID: 'facebook-jssdk',
        FACEBOOK_SDK_URL: 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v20.0',
        INSTAGRAM_SDK_URL: 'https://www.instagram.com/embed.js',
        TIMEOUT_MS: 8000,
        INITIAL_DELAY_MS: 2000
    };
    
    let sdksLoaded = false;
    let loadingPromise = null;
    
    /**
     * Load Facebook SDK
     */
    function loadFacebookSDK() {
        return new Promise((resolve) => {
            if (document.getElementById(CONFIG.FACEBOOK_SDK_ID)) {
                resolve(true);
                return;
            }
            
            window.fbAsyncInit = function() {
                resolve(true);
            };
            
            const script = document.createElement('script');
            script.id = CONFIG.FACEBOOK_SDK_ID;
            script.src = CONFIG.FACEBOOK_SDK_URL;
            script.async = true;
            script.defer = true;
            script.crossOrigin = 'anonymous';
            
            script.onerror = () => {
                console.warn('Failed to load Facebook SDK');
                resolve(false);
            };
            
            const firstScript = document.getElementsByTagName('script')[0];
            if (firstScript && firstScript.parentNode) {
                firstScript.parentNode.insertBefore(script, firstScript);
            } else {
                document.body.appendChild(script);
            }
        });
    }
    
    /**
     * Load Instagram SDK
     */
    function loadInstagramSDK() {
        return new Promise((resolve) => {
            if (document.querySelector('script[src*="instagram.com/embed"]')) {
                resolve(true);
                return;
            }
            
            const script = document.createElement('script');
            script.src = CONFIG.INSTAGRAM_SDK_URL;
            script.async = true;
            
            script.onerror = () => {
                console.warn('Failed to load Instagram SDK');
                resolve(false);
            };
            
            script.onload = () => {
                if (window.instgrm) {
                    window.instgrm.Embed.process();
                }
                resolve(true);
            };
            
            document.body.appendChild(script);
        });
    }
    
    /**
     * Load all external SDKs with timeout protection
     */
    function loadAllSDKs() {
        if (sdksLoaded) return Promise.resolve(true);
        
        if (loadingPromise) return loadingPromise;
        
        sdksLoaded = true;
        
        loadingPromise = Promise.race([
            Promise.all([
                loadFacebookSDK(),
                loadInstagramSDK()
            ]),
            new Promise((_, reject) => 
                setTimeout(() => reject(new Error('SDK loading timeout')), CONFIG.TIMEOUT_MS)
            )
        ])
            .catch(err => {
                console.warn('SDK loading error:', err);
                return false;
            });
        
        return loadingPromise;
    }
    
    /**
     * Check if there are embeds on the page
     */
    function hasEmbeds() {
        return document.querySelector('.fb-embed-block, .instagram-media, [data-instgrm-permalink]') !== null;
    }
    
    /**
     * Set up scroll listener to load SDKs
     */
    function initScrollListener() {
        const listener = () => {
            loadAllSDKs();
            window.removeEventListener('scroll', listener);
        };
        
        window.addEventListener('scroll', listener, { once: true, passive: true });
    }
    
    /**
     * Initialize SDK loading
     */
    function init() {
        // Only load if there are embeds on the page
        if (!hasEmbeds()) return;
        
        // Set up scroll listener for lazy loading
        initScrollListener();
        
        // Fallback: load after initial delay if not scrolled
        setTimeout(() => {
            if (!sdksLoaded) {
                loadAllSDKs();
            }
        }, CONFIG.INITIAL_DELAY_MS);
    }
    
    // Start initialization when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
    
    // Expose globally for manual control
    window.externalSDKsModule = {
        loadAllSDKs,
        loadFacebookSDK,
        loadInstagramSDK,
        isLoaded: () => sdksLoaded,
        hasEmbeds
    };
})();
