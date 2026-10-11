document.addEventListener("DOMContentLoaded", function () {
    initHamburgerMenu();
    initValidasiForm();
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

// Validasi form
function initValidasiForm() {
    document.querySelectorAll("form").forEach(function (form) {
        form.noValidate = true;

        form.addEventListener("submit", function (event) {
            event.preventDefault();

            form.querySelectorAll(".error-message").forEach(function (error) {
                error.remove();
            });

            let valid = true;
            let firstInvalidField = null;

            function tampilkanError(field, pesan) {
                const error = document.createElement("small");
                error.className = "error-message";
                error.textContent = pesan;
                error.setAttribute("role", "alert");

                field.insertAdjacentElement("afterend", error);
                valid = false;

                if (!firstInvalidField) {
                    firstInvalidField = field;
                }
            }

            form.querySelectorAll("[required]").forEach(function (field) {
                if (!field.value.trim()) {
                    tampilkanError(field, "Field ini wajib diisi.");
                }
            });

            const tahun = form.querySelector('[name="tahun"]');

            if (tahun && tahun.value.trim() !== "") {
                const nilai = Number(tahun.value);
                const tahunSekarang = new Date().getFullYear();

                if (
                    !Number.isInteger(nilai) ||
                    nilai < 1900 ||
                    nilai > tahunSekarang
                ) {
                    tampilkanError(
                        tahun,
                        "Tahun harus antara 1900 dan " + tahunSekarang + "."
                    );
                }
            }

            const stok = form.querySelector('[name="stok"]');

            if (stok && stok.value.trim() !== "") {
                const nilai = Number(stok.value);

                if (!Number.isInteger(nilai) || nilai < 0) {
                    tampilkanError(
                        stok,
                        "Stok harus bilangan bulat dan tidak boleh negatif."
                    );
                }
            }

            form.querySelectorAll("input, select, textarea").forEach(function (field) {
                if (
                    field.value.trim() !== "" &&
                    !field.checkValidity()
                ) {
                    tampilkanError(
                        field,
                        field.validationMessage || "Format input tidak valid."
                    );
                }
            });

            if (!valid) {
                if (firstInvalidField) firstInvalidField.focus();
                return;
            }

            alert("Validasi berhasil! Data siap diproses.");
        });
    });
}

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