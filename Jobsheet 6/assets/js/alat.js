document.addEventListener("DOMContentLoaded", function () {
    muatDataAlat();
});

async function muatDataAlat() {
    const tbody = document.querySelector("#tabel-alat tbody");
    const loading = document.getElementById("loading-indicator");

    if (!tbody || !loading) return;

    tbody.innerHTML = "";
    loading.hidden = false;

    try {
        await new Promise(function (resolve) {
            setTimeout(resolve, 600);
        });

        const response = await fetch("../data/alat.json");

        if (!response.ok) {
            throw new Error("Data alat gagal dimuat.");
        }

        const data = await response.json();

        if (!Array.isArray(data) || data.length === 0) {
            tbody.innerHTML =
                '<tr><td colspan="6">Belum ada data alat kemah.</td></tr>';
            return;
        }

        data.forEach(function (alat, index) {
            const row = document.createElement("tr");

            const nomor = document.createElement("td");
            nomor.textContent = index + 1;
            row.appendChild(nomor);

            const nama = document.createElement("td");
            nama.textContent = alat.nama_alat;
            row.appendChild(nama);

            const kategori = document.createElement("td");
            kategori.textContent = alat.kategori;
            row.appendChild(kategori);

            const stok = document.createElement("td");
            stok.textContent = alat.stok;
            row.appendChild(stok);

            const kondisi = document.createElement("td");
            const status = document.createElement("span");
            status.className = alat.kondisi === "Baik"
                ? "status status-good"
                : "status status-warning";
            status.textContent = alat.kondisi;
            kondisi.appendChild(status);
            row.appendChild(kondisi);

            const aksi = document.createElement("td");

            const edit = document.createElement("a");
            edit.href = "tambah.html";
            edit.className = "btn btn-small btn-secondary";
            edit.textContent = "Edit";

            const hapus = document.createElement("button");
            hapus.type = "button";
            hapus.className = "btn btn-small btn-danger btn-hapus";
            hapus.textContent = "Hapus";

            aksi.append(edit, document.createTextNode(" "), hapus);
            row.appendChild(aksi);

            tbody.appendChild(row);
        });
    } catch (error) {
        console.error(error);
        tbody.innerHTML =
            '<tr><td colspan="6">Gagal memuat data alat. Periksa server dan file JSON.</td></tr>';
    } finally {
        loading.hidden = true;
    }
}