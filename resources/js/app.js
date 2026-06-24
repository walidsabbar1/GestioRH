/**
 * RH Manager — Application JavaScript
 */

document.addEventListener('DOMContentLoaded', () => {
    initSidebar();
    initToasts();
    initModals();
    initPhotoUpload();
});

/**
 * Sidebar Mobile Toggle
 */
function initSidebar() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebar-overlay');
    const openBtn = document.getElementById('mobile-menu-open');
    const closeBtn = document.getElementById('mobile-menu-close');

    if (!sidebar) return;

    const toggleSidebar = (open) => {
        if (open) {
            sidebar.classList.add('open');
            if (overlay) overlay.style.display = 'block';
            document.body.style.overflow = 'hidden';
        } else {
            sidebar.classList.remove('open');
            if (overlay) overlay.style.display = 'none';
            document.body.style.overflow = '';
        }
    };

    if (openBtn) openBtn.addEventListener('click', () => toggleSidebar(true));
    if (closeBtn) closeBtn.addEventListener('click', () => toggleSidebar(false));
    if (overlay) overlay.addEventListener('click', () => toggleSidebar(false));
}

/**
 * Toast Notifications
 */
function initToasts() {
    const toasts = document.querySelectorAll('.toast');

    toasts.forEach((toast) => {
        // Auto-dismiss after 4 seconds
        setTimeout(() => {
            toast.style.animation = 'slideInRight 0.3s ease reverse forwards';
            setTimeout(() => toast.remove(), 300);
        }, 4000);

        // Close button
        const closeBtn = toast.querySelector('.toast-close');
        if (closeBtn) {
            closeBtn.addEventListener('click', () => {
                toast.style.animation = 'slideInRight 0.3s ease reverse forwards';
                setTimeout(() => toast.remove(), 300);
            });
        }
    });
}

/**
 * Delete Confirmation Modals
 */
function initModals() {
    // Open modal
    document.querySelectorAll('[data-modal-target]').forEach((btn) => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            const modalId = btn.dataset.modalTarget;
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.style.display = 'flex';
                document.body.style.overflow = 'hidden';
            }
        });
    });

    // Close modal
    document.querySelectorAll('[data-modal-close]').forEach((btn) => {
        btn.addEventListener('click', () => {
            const modal = btn.closest('.modal-overlay');
            if (modal) {
                modal.style.display = 'none';
                document.body.style.overflow = '';
            }
        });
    });

    // Close on overlay click
    document.querySelectorAll('.modal-overlay').forEach((overlay) => {
        overlay.addEventListener('click', (e) => {
            if (e.target === overlay) {
                overlay.style.display = 'none';
                document.body.style.overflow = '';
            }
        });
    });

    // Close on Escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            document.querySelectorAll('.modal-overlay').forEach((modal) => {
                if (modal.style.display !== 'none') {
                    modal.style.display = 'none';
                    document.body.style.overflow = '';
                }
            });
        }
    });
}

/**
 * Photo Upload Preview
 */
function initPhotoUpload() {
    const photoInput = document.getElementById('photo-input');
    const photoPreview = document.getElementById('photo-preview');
    const photoPlaceholder = document.getElementById('photo-placeholder');
    const photoContainer = document.getElementById('photo-upload');

    if (!photoInput || !photoContainer) return;

    photoContainer.addEventListener('click', () => photoInput.click());

    photoInput.addEventListener('change', (e) => {
        const file = e.target.files[0];

        if (!file) return;

        // Validate file type
        const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
        if (!allowedTypes.includes(file.type)) {
            alert('Format non supporté. Utilisez JPG, JPEG, PNG ou WebP.');
            photoInput.value = '';
            return;
        }

        // Validate file size (5MB)
        if (file.size > 5 * 1024 * 1024) {
            alert('La taille maximale autorisée est de 5 Mo.');
            photoInput.value = '';
            return;
        }

        // Show preview
        const reader = new FileReader();
        reader.onload = (event) => {
            if (photoPreview) {
                photoPreview.src = event.target.result;
                photoPreview.style.display = 'block';
            }
            if (photoPlaceholder) {
                photoPlaceholder.style.display = 'none';
            }
        };
        reader.readAsDataURL(file);
    });
}
