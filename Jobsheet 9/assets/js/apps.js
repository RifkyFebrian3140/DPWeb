document.addEventListener("DOMContentLoaded", function () {
    initHamburgerMenu();
    initTableFilter();
    initHapusConfirm();
});

function initHamburgerMenu() {
    const button = document.querySelector(".nav-toggle-label");
    const nav = document.querySelector("header nav");
    if (!button || !nav) return;
    button.addEventListener("click", function () {
        const isOpen = nav.classList.toggle("nav-open");
        button.setAttribute("aria-expanded", String(isOpen));
        button.textContent = isOpen ? "✕ Tutup Menu" : "☰ Menu";
    });
}

// Filter instan hanya pada baris yang sedang tampil. Tombol Cari tetap
// menjalankan pencarian server-side lintas halaman.
function initTableFilter() {
    const search = document.querySelector("#search-input");
    const table = document.querySelector(".table-responsive table");
    if (!search || !table) return;
    search.addEventListener("input", function () {
        const keyword = search.value.toLowerCase().trim();
        table.querySelectorAll("tbody tr").forEach(function (row) {
            row.style.display = row.textContent.toLowerCase().includes(keyword) ? "" : "none";
        });
    });
}

function initHapusConfirm() {
    document.addEventListener("submit", function (event) {
        const form = event.target.closest("form.form-hapus");
        if (!form) return;
        if (!confirm("Yakin ingin menghapus data ini secara permanen?")) {
            event.preventDefault();
        }
    });
}
