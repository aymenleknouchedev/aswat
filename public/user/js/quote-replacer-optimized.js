/**
 * Optimized Quote Replacer with Debounce
 * Prevents heavy DOM operations on every mutation
 * Replace the existing quote replacer in layouts/index.blade.php
 */

(function() {
    'use strict';
    
    // Configuration
    const CONFIG = {
        DEBOUNCE_DELAY: 300,
        MAX_QUEUE_SIZE: 50,
        BATCH_PROCESSING: true
    };
    
    // State
    let processingQueue = [];
    let debounceTimeout = null;
    let isProcessing = false;
    
    // Excluded tags that shouldn't have quotes replaced
    const EXCLUDED_TAGS = new Set(['SCRIPT', 'STYLE', 'CODE', 'PRE', 'TEXTAREA', 'INPUT']);
    
    /**
     * Replace straight quotes with French guillemets
     */
    function replaceQuotes(str) {
        return str.replace(/"([^"]*)"/g, '«$1»');
    }
    
    /**
     * Process a single node and its text
     */
    function processNode(node) {
        if (!node) return;
        
        // Skip excluded elements
        if (EXCLUDED_TAGS.has(node.nodeName)) return;
        
        // Process text nodes
        if (node.nodeType === Node.TEXT_NODE) {
            const text = node.textContent.trim();
            if (text.length > 0) {
                node.textContent = replaceQuotes(node.textContent);
            }
        }
        // Process element nodes recursively
        else if (node.nodeType === Node.ELEMENT_NODE && !EXCLUDED_TAGS.has(node.nodeName)) {
            node.childNodes.forEach(processNode);
        }
    }
    
    /**
     * Batch process nodes from queue
     */
    function processBatch() {
        if (isProcessing || processingQueue.length === 0) return;
        
        isProcessing = true;
        const batchSize = 10;
        const nodesToProcess = processingQueue.splice(0, batchSize);
        
        // Use requestIdleCallback if available, otherwise use setTimeout
        if ('requestIdleCallback' in window) {
            requestIdleCallback(() => {
                nodesToProcess.forEach(processNode);
                isProcessing = false;
                
                // Continue with next batch if queue not empty
                if (processingQueue.length > 0) {
                    processBatch();
                }
            });
        } else {
            nodesToProcess.forEach(processNode);
            isProcessing = false;
            
            if (processingQueue.length > 0) {
                requestAnimationFrame(processBatch);
            }
        }
    }
    
    /**
     * Debounced processor to prevent excessive DOM traversal
     */
    function debouncedProcess() {
        if (debounceTimeout) {
            clearTimeout(debounceTimeout);
        }
        
        debounceTimeout = setTimeout(() => {
            processBatch();
            debounceTimeout = null;
        }, CONFIG.DEBOUNCE_DELAY);
    }
    
    /**
     * Initial processing of body on DOMContentLoaded
     */
    function processInitialBody() {
        if (document.body) {
            processNode(document.body);
        }
    }
    
    /**
     * Set up MutationObserver with optimizations
     */
    function setupMutationObserver() {
        if (typeof MutationObserver === 'undefined') return;
        
        const observer = new MutationObserver((mutations) => {
            // Collect nodes to process, avoiding duplicates
            const nodesToAdd = new Set();
            
            mutations.forEach((mutation) => {
                if (mutation.type === 'childList') {
                    mutation.addedNodes.forEach((node) => {
                        if (node.nodeType === Node.ELEMENT_NODE || node.nodeType === Node.TEXT_NODE) {
                            nodesToAdd.add(node);
                        }
                    });
                }
            });
            
            // Add to queue with size limit
            nodesToAdd.forEach((node) => {
                if (processingQueue.length < CONFIG.MAX_QUEUE_SIZE) {
                    processingQueue.push(node);
                }
            });
            
            // Trigger debounced processing
            if (processingQueue.length > 0) {
                debouncedProcess();
            }
        });
        
        // Start observing
        observer.observe(document.body, {
            childList: true,
            subtree: true
        });
        
        return observer;
    }
    
    /**
     * Initialize the quote replacer
     */
    function init() {
        // Process initial page content
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', processInitialBody);
        } else {
            processInitialBody();
        }
        
        // Set up observer for dynamically added content
        setupMutationObserver();
    }
    
    // Start initialization
    init();
    
    // Expose globally for debugging and manual control
    window.quoteReplacerModule = {
        processNode,
        replaceQuotes,
        clearQueue: () => {
            processingQueue = [];
            if (debounceTimeout) clearTimeout(debounceTimeout);
        },
        getQueueSize: () => processingQueue.length,
        isProcessing: () => isProcessing
    };
})();
