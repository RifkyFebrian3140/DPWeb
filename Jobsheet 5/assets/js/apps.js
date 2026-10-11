document.addEventListener("DOMContentLoaded", function () {
    initHamburgerMenu();
    initValidasiForm();
    initTableFilter();
    initHapus();
});

// 1. Hamburger menu
function initHamburgerMenu() {
    const menuButton = document.querySelector(".nav-toggle-label");
    const nav = document.querySelector("header nav");

    if (!menuButton || !nav) {
        return;
    }

    menuButton.addEventListener("click", function () {
        const isOpen = nav.classList.toggle("nav-open");

        menuButton.setAttribute("aria-expanded", String(isOpen));
        menuButton.innerHTML = isOpen ? "✕ Tutup Menu" : "☰ Menu";
    });
}

// 2. Validasi form
function initValidasiForm() {
    const forms = document.querySelectorAll("form");

    forms.forEach(function (form) {
        // Mengaktifkan validasi buatan sendiri agar pesan inline tampil.
        form.noValidate = true;

        form.addEventListener("submit", function (event) {
            event.preventDefault();

            // Hapus pesan error dari pemeriksaan sebelumnya.
            form.querySelectorAll(".error-message").forEach(function (error) {
                error.remove();
            });

            let valid = true;
            let firstInvalidField = null;

            function tandaiTidakValid(field, pesan) {
                tampilkanError(field, pesan);
                valid = false;

                if (!firstInvalidField) {
                    firstInvalidField = field;
                }
            }

            // Periksa semua field wajib.
            form.querySelectorAll("[required]").forEach(function (field) {
                if (!field.value.trim()) {
                    tandaiTidakValid(field, "Field ini wajib diisi.");
                }
            });

            // Periksa rentang tahun jika form memiliki field bernama tahun.
            const tahun = form.querySelector('[name="tahun"]');

            if (tahun && tahun.value.trim() !== "") {
                const nilaiTahun = Number(tahun.value);
                const tahunSekarang = new Date().getFullYear();

                if (
                    !Number.isInteger(nilaiTahun) ||
                    nilaiTahun < 1900 ||
                    nilaiTahun > tahunSekarang
                ) {
                    tandaiTidakValid(
                        tahun,
                        "Tahun harus antara 1900 dan " + tahunSekarang + "."
                    );
                }
            }

            // Periksa stok agar tidak negatif dan harus berupa bilangan bulat.
            const stok = form.querySelector('[name="stok"]');

            if (stok && stok.value.trim() !== "") {
                const nilaiStok = Number(stok.value);

                if (!Number.isInteger(nilaiStok) || nilaiStok < 0) {
                    tandaiTidakValid(
                        stok,
                        "Stok harus berupa bilangan bulat dan tidak boleh negatif."
                    );
                }
            }

            // Periksa validitas bawaan field, misalnya format email.
            form.querySelectorAll("input, select, textarea").forEach(function (field) {
                if (!field.checkValidity() && field.value.trim() !== "") {
                    tandaiTidakValid(
                        field,
                        field.validationMessage || "Format input tidak valid."
                    );
                }
            });

            if (!valid) {
                if (firstInvalidField) {
                    firstInvalidField.focus();
                }

                return;
            }

            // Belum menyimpan data ke server atau database.
            alert("Validasi berhasil! Data siap diproses.");
        });
    });
}

// Membuat dan menampilkan pesan error di bawah field.
function tampilkanError(field, pesan) {
    const error = document.createElement("small");

    error.className = "error-message";
    error.textContent = pesan;
    error.setAttribute("role", "alert");

    field.insertAdjacentElement("afterend", error);
}

// 3. Pencarian tabel secara real-time.
function initTableFilter() {
    const tables = document.querySelectorAll("table");

    tables.forEach(function (table) {
        const wrapper = table.closest(".table-responsive") || table.parentElement;
        const search = document.createElement("input");

        search.type = "search";
        search.placeholder = "Cari data...";
        search.className = "table-search";
        search.setAttribute("aria-label", "Cari data tabel");

        wrapper.insertAdjacentElement("beforebegin", search);

        search.addEventListener("keyup", function () {
            const keyword = search.value.toLowerCase().trim();
            const rows = table.querySelectorAll("tbody tr");

            rows.forEach(function (row) {
                const isiBaris = row.textContent.toLowerCase();

                row.style.display = isiBaris.includes(keyword) ? "" : "none";
            });
        });
    });
}

// 4. Konfirmasi hapus data dari tampilan.
function initHapus() {
    document.querySelectorAll(".btn-hapus").forEach(function (button) {
        button.addEventListener("click", function () {
            const konfirmasi = confirm(
                "Yakin ingin menghapus baris data ini dari tampilan?"
            );

            if (!konfirmasi) {
                return;
            }

            const row = button.closest("tr");

            if (row) {
                row.remove();
            }
        });
    });
}