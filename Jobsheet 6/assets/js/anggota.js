document.addEventListener("DOMContentLoaded", function () {
    muatDataAnggota();
});

async function muatDataAnggota() {
    const tbody = document.querySelector("#tabel-anggota tbody");
    const loading = document.getElementById("loading-indicator");

    if (!tbody || !loading) return;

    tbody.innerHTML = "";
    loading.hidden = false;

    try {
        await new Promise(function (resolve) {
            setTimeout(resolve, 600);
        });

        const response = await fetch("../data/anggota.json");

        if (!response.ok) {
            throw new Error("Data peminjam gagal dimuat.");
        }

        const data = await response.json();

        if (!Array.isArray(data) || data.length === 0) {
            tbody.innerHTML =
                '<tr><td colspan="6">Belum ada data peminjam.</td></tr>';
            return;
        }

        data.forEach(function (anggota, index) {
            const row = document.createElement("tr");

            const values = [
                index + 1,
                anggota.nama,
                anggota.nomor_identitas,
                anggota.telepon,
                anggota.alamat
            ];

            values.forEach(function (value) {
                const cell = document.createElement("td");
                cell.textContent = value;
                row.appendChild(cell);
            });

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
            '<tr><td colspan="6">Gagal memuat data peminjam. Periksa server dan file JSON.</td></tr>';
    } finally {
        loading.hidden = true;
    }
}