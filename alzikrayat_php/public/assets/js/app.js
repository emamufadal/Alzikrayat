// Run client-side validation after the page has finished loading.
document.addEventListener('DOMContentLoaded', () => {
    // Find the registration form so its password can be checked before submission.
    const registerForm = document.getElementById('registerForm');

    // Only attach validation when the registration form exists on the current page.
    if (registerForm) {
        registerForm.addEventListener('submit', (event) => {
    // Read the password field from the registration form.
            const password = registerForm.querySelector('[name=password]');

    // Prevent submission when the password is shorter than eight characters.
            if (password && password.value.length < 8) {
                event.preventDefault();
                alert('Password must contain at least 8 characters.');
            }
        });
    }

    // Find the photo upload form for client-side image validation.
    const photoForm = document.getElementById('photoForm');

    // Only attach image validation when the photo form exists.
    if (photoForm) {
        photoForm.addEventListener('submit', (event) => {
    // Read the first selected image file.
            const image = photoForm.querySelector('[name=image]').files[0];

    // Prevent submission when the selected image exceeds the 5MB limit.
            if (image && image.size > 5242880) {
                event.preventDefault();
                alert('Image size must be 5MB or less.');
            }
        });
    }
});

    // Handle the gallery layout selector and saved display preference.
// Gallery display style switcher.
document.addEventListener('DOMContentLoaded', () => {
    // Find the gallery container and its style buttons.
    const gallery = document.getElementById('photoGallery');
    const styleButtons = document.querySelectorAll('.gallery-style-btn');

    if (!gallery || !styleButtons.length) {
        return;
    }

    // Use a stable browser-storage key for the selected gallery style.
    const storageKey = 'alzikrayatGalleryStyle';
    // List the gallery styles supported by the application.
    const supportedStyles = ['three', 'four', 'list', 'full'];

    // Apply the selected style and update the active button state.
    const applyGalleryStyle = (style) => {
    // Fall back to the default style for unsupported values.
        if (!supportedStyles.includes(style)) {
            style = 'three';
        }

    // Remove all previous gallery style classes before adding the selected one.
        supportedStyles.forEach((name) => {
            gallery.classList.remove(`gallery-style-${name}`);
        });

        gallery.classList.add(`gallery-style-${style}`);

    // Update each button so the selected style is visually marked.
        styleButtons.forEach((button) => {
            const isActive = button.dataset.galleryStyle === style;

            button.classList.toggle('active', isActive);
            button.setAttribute(
                'aria-pressed',
                isActive ? 'true' : 'false'
            );
        });

        try {
    // Save the selected gallery style in browser storage.
            localStorage.setItem(storageKey, style);
        } catch (error) {
            // The gallery still works if browser storage is unavailable.
        }
    };

    // Start with the default gallery style before reading saved preferences.
    let savedStyle = 'three';

    try {
    // Load the previously selected gallery style from browser storage.
        savedStyle = localStorage.getItem(storageKey) || 'three';
    } catch (error) {
        // Use the default style.
    }

    // Apply the saved or default gallery style when the page loads.
    applyGalleryStyle(savedStyle);

    styleButtons.forEach((button) => {
        button.addEventListener('click', () => {
            applyGalleryStyle(button.dataset.galleryStyle);
        });
    });
});
