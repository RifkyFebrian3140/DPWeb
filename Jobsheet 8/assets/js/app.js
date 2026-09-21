document.addEventListener("DOMContentLoaded", function () {
    // Hilangkan pesan notifikasi setelah 5 detik
    const flashMessages = document.querySelectorAll(".flash");

    flashMessages.forEach(function (message) {
        setTimeout(function () {
            message.style.transition = "opacity 0.5s ease";
            message.style.opacity = "0";

            setTimeout(function () {
                message.remove();
            }, 500);
        }, 5000);
    });

    // Cegah form dikirim berkali-kali
    const forms = document.querySelectorAll("form");

    forms.forEach(function (form) {
        form.addEventListener("submit", function () {
            const submitButton = form.querySelector(
                'button[type="submit"], input[type="submit"]'
            );

            if (submitButton) {
                submitButton.disabled = true;
                submitButton.textContent = "Menyimpan...";
            }
        });
    });
});