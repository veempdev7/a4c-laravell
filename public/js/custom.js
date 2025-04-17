// public/js/custom.js

document.addEventListener("DOMContentLoaded", function () {
    console.log('Custom JavaScript loaded');

    // Example: Handle OTP button click
    const otpBtn = document.querySelector('.otp-btn');
    if (otpBtn) {
        otpBtn.addEventListener('click', function (e) {
            e.preventDefault();
            console.log('OTP button clicked');
            // You can add further logic for OTP generation or AJAX requests here
        });
    }
});
