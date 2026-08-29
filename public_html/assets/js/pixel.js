// UTM extraction
function getUTMs() {
    const params = new URLSearchParams(window.location.search);
    return {
        source: params.get('utm_source'),
        medium: params.get('utm_medium'),
        campaign: params.get('utm_campaign'),
        content: params.get('utm_content'),
        term: params.get('utm_term'),
        fbclid: params.get('fbclid')
    };
}

// Internal tracking
function trackEvent(eventType, data = {}) {
    const payload = {
        event_type: eventType,
        url: window.location.href,
        referrer: document.referrer,
        utm: getUTMs(),
        device: /Mobi|Android/i.test(navigator.userAgent) ? 'Mobile' : 'Desktop',
        browser: navigator.userAgent, // Simplified browser string
        ...data
    };

    fetch('/api/track.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(payload)
    }).catch(e => console.error('Tracking error', e));
}

document.addEventListener('DOMContentLoaded', () => {
    // Track PageView internally
    trackEvent('page_view');

    // Handle Buy Now clicks
    const buyButtons = document.querySelectorAll('.buy-btn');
    buyButtons.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            
            const url = btn.getAttribute('href');
            
            // Fire Meta Pixel Event
            if (typeof fbq === 'function') {
                fbq('track', 'InitiateCheckout', {
                    value: 99,
                    currency: 'INR'
                });
            }
            
            // Track internally
            trackEvent('initiate_checkout', { value: 99, currency: 'INR' });
            
            // Redirect after slight delay to ensure events fire
            setTimeout(() => {
                window.location.href = url;
            }, 300);
        });
    });
});
