document.addEventListener('DOMContentLoaded', () => {
    // FAQ Accordion
    const faqs = document.querySelectorAll('.faq-item');
    faqs.forEach(faq => {
        const question = faq.querySelector('.faq-question');
        question.addEventListener('click', () => {
            faq.classList.toggle('active');
        });
    });

    // Floating CTA visibility
    const heroBtn = document.querySelector('.hero .btn-primary');
    const floatingCta = document.querySelector('.floating-cta');
    
    if (heroBtn && floatingCta) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (!entry.isIntersecting) {
                    floatingCta.classList.add('visible');
                } else {
                    floatingCta.classList.remove('visible');
                }
            });
        });
        observer.observe(heroBtn);
    }
});
