document.addEventListener("DOMContentLoaded", function () {
    initHamburgerMenu();
    initTableFilter();
    initHapusConfirm();
});

// Hamburger menu
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

// Validasi form diproses oleh PHP pada Jobsheet 7.

// Pencarian tabel
function initTableFilter() {
    document.querySelectorAll("table").forEach(function (table) {
        const wrapper = table.closest(".table-responsive") || table.parentElement;
        const search = document.createElement("input");

        search.type = "search";
        search.placeholder = "Cari data...";
        search.className = "table-search";
        search.setAttribute("aria-label", "Cari data tabel");

        wrapper.insertAdjacentElement("beforebegin", search);

        search.addEventListener("input", function () {
            const keyword = search.value.toLowerCase().trim();

            table.querySelectorAll("tbody tr").forEach(function (row) {
                row.style.display = row.textContent.toLowerCase().includes(keyword)
                    ? ""
                    : "none";
            });
        });
    });
}

// Event delegation untuk tombol hapus dinamis
function initHapusConfirm() {
    document.addEventListener("click", function (event) {
        const button = event.target.closest(".btn-hapus");

        if (!button) return;

        const row = button.closest("tr");

        if (!row) return;

        if (confirm("Yakin ingin menghapus baris data ini dari tampilan?")) {
            row.remove();
        }
    });
}