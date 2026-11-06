
const formUmkm = document.getElementById('formUmkm');
const pesanForm = document.getElementById('pesanForm');
const btnSimpan = document.getElementById('btnSimpan');

formUmkm.addEventListener('submit', async function (event) {
    event.preventDefault();
    pesanForm.textContent = '';
    pesanForm.className = 'form-message';

    const dataUmkm = {
        nama_usaha: document.getElementById('nama_usaha').value.trim(),
        nama_pemilik: document.getElementById('nama_pemilik').value.trim(),
        kategori: document.getElementById('kategori').value.trim(),
        no_telepon: document.getElementById('no_telepon').value.trim(),
        alamat: document.getElementById('alamat').value.trim(),
        deskripsi: document.getElementById('deskripsi').value.trim()
    };

    if (!dataUmkm.nama_usaha || !dataUmkm.nama_pemilik) {
        tampilkanPesan('Nama usaha dan nama pemilik wajib diisi.', 'error');
        return;
    }

    btnSimpan.disabled = true;
    btnSimpan.textContent = 'Mengirim...';

    try {
        const response = await fetch('/api/umkm', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(dataUmkm)
        });

        const hasil = await response.json();

        if (!response.ok) {
            throw new Error(hasil.message || 'Data UMKM gagal dikirim.');
        }

        tampilkanPesan(
            'Data UMKM berhasil dikirim! Status saat ini menunggu verifikasi.',
            'success'
        );

        formUmkm.reset();
    } catch (error) {
        tampilkanPesan(
            error.message || 'Tidak dapat terhubung ke server.',
            'error'
        );
    } finally {
        btnSimpan.disabled = false;
        btnSimpan.textContent = 'Kirim Data UMKM';
    }
});

function tampilkanPesan(pesan, jenis) {
    pesanForm.textContent = pesan;
    pesanForm.className = `form-message ${jenis}`;
}
