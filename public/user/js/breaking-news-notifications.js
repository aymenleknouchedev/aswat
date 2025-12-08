/**
 * Breaking News Real-Time Notification System (Optional)
 * This is an enhanced version with sound notification capability
 * 
 * Usage: Replace the breaking-news.js with this file if you want sound notifications
 * Or use alongside the main breaking-news.js
 */

class BreakingNewsNotifier {
    constructor() {
        this.enabled = true;
        this.soundEnabled = false;
        this.audioContext = null;
        this.lastNotificationTime = 0;
        this.notificationCooldown = 1000; // Minimum 1 second between notifications
    }

    /**
     * Play a simple beep notification sound
     */
    playNotificationSound() {
        if (!this.soundEnabled || !window.AudioContext) return;

        try {
            const audioContext = new (window.AudioContext || window.webkitAudioContext)();
            const oscillator = audioContext.createOscillator();
            const gainNode = audioContext.createGain();

            oscillator.connect(gainNode);
            gainNode.connect(audioContext.destination);

            // Create a pleasant notification sound (high beep)
            oscillator.frequency.value = 800; // Hz
            oscillator.type = 'sine';

            gainNode.gain.setValueAtTime(0.3, audioContext.currentTime);
            gainNode.gain.exponentialRampToValueAtTime(0.01, audioContext.currentTime + 0.3);

            oscillator.start(audioContext.currentTime);
            oscillator.stop(audioContext.currentTime + 0.3);
        } catch (error) {
            console.error('Error playing notification sound:', error);
        }
    }

    /**
     * Send browser notification if permitted
     * @param {String} title - Notification title
     * @param {String} body - Notification body
     */
    sendBrowserNotification(title, body) {
        if ('Notification' in window && Notification.permission === 'granted') {
            try {
                new Notification(title, {
                    body: body,
                    icon: '/favicon.ico',
                    badge: '/favicon.ico',
                    tag: 'breaking-news',
                    requireInteraction: false,
                });
            } catch (error) {
                console.error('Error sending notification:', error);
            }
        }
    }

    /**
     * Request notification permissions from user
     */
    requestNotificationPermission() {
        if ('Notification' in window && Notification.permission === 'default') {
            Notification.requestPermission().then(permission => {
                if (permission === 'granted') {
                    console.log('Notification permission granted');
                }
            });
        }
    }

    /**
     * Throttle notifications to prevent spam
     */
    canNotify() {
        const now = Date.now();
        if (now - this.lastNotificationTime >= this.notificationCooldown) {
            this.lastNotificationTime = now;
            return true;
        }
        return false;
    }

    /**
     * Enable/disable sound notifications
     */
    setSoundEnabled(enabled) {
        this.soundEnabled = enabled;
    }

    /**
     * Enable/disable all notifications
     */
    setEnabled(enabled) {
        this.enabled = enabled;
    }
}

// Initialize the notifier (can be used alongside main breaking-news.js)
const notifier = new BreakingNewsNotifier();

// Auto-request notification permission on load
document.addEventListener('DOMContentLoaded', () => {
    notifier.requestNotificationPermission();

    // Optional: Add a settings button to toggle sound
    // You can call: notifier.setSoundEnabled(true/false);
});
