/**
 * main.js – entry-point for client-side behaviour.
 *
 * Keeps things simple for now; add modules here as the project grows.
 */

document.addEventListener('DOMContentLoaded', () => {
    // Auto-dismiss flash alerts after 4 seconds
    document.querySelectorAll('.alert').forEach((alert) => {
        setTimeout(() => {
            alert.style.transition = 'opacity 0.5s ease';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        }, 4000);
    });

    // Prevent double-submission of any form
    document.querySelectorAll('form').forEach((form) => {
        form.addEventListener('submit', () => {
            const btn = form.querySelector('button[type="submit"], input[type="submit"]');
            if (btn) {
                const originalText = btn.textContent;
                btn.disabled = true;
                btn.textContent = originalText + '…';
            }
        });
    });
});
