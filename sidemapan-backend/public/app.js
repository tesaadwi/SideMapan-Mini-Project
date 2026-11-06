
const API_URL = '/api/umkm';

const statusElement = document.getElementById('status');
const umkmListElement = document.getElementById('umkm-list');

async function loadUmkm() {
    statusElement.textContent = 'Memuat data UMKM...';

    try {
        const response = await fetch(API_URL);

        if (!response.ok) {
            throw new Error('Gagal mengambil data dari API.');
        }

        const result = await response.json();

        const umkmDisetujui = result.data.filter(
            (umkm) => umkm.status_verifikasi === 'disetujui'
        );

        if (umkmDisetujui.length === 0) {
            statusElement.textContent =
                'Belum ada UMKM yang disetujui untuk ditampilkan.';
            umkmListElement.replaceChildren();
            return;
        }

        statusElement.textContent =
            `${umkmDisetujui.length} UMKM ditemukan.`;

        umkmListElement.replaceChildren();

        umkmDisetujui.forEach((umkm) => {
            const card = document.createElement('article');
            card.className = 'umkm-card';

            const symbol = document.createElement('div');
            symbol.className = 'umkm-symbol';
            symbol.textContent = '🌿';

            const category = document.createElement('span');
            category.className = 'category';
            category.textContent = umkm.kategori || 'UMKM Lokal';

            const title = document.createElement('h3');
            title.textContent = umkm.nama_usaha;

            const description = document.createElement('p');
            description.textContent =
                umkm.deskripsi || 'Usaha lokal Desa Gilang.';

            const owner = document.createElement('p');
            owner.textContent = `Pemilik: ${umkm.nama_pemilik}`;

            const address = document.createElement('p');
            address.textContent = `Alamat: ${umkm.alamat || '-'}`;

            const detailLink = document.createElement('a');
            detailLink.className = 'detail-link';
            detailLink.href = `detail.html?id=${encodeURIComponent(umkm.id)}`;
            detailLink.textContent = 'Lihat detail →';

            card.append(
                symbol,
                category,
                title,
                description,
                owner,
                address,
                detailLink
            );

            umkmListElement.appendChild(card);
        });
    } catch (error) {
        console.error(error);

        statusElement.textContent =
            'Data belum dapat dimuat. Periksa server dan koneksi database.';
    }
}

loadUmkm();
