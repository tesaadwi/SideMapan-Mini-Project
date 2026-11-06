

const express = require('express');
const cors = require('cors');
require('dotenv').config();

const pool = require('./db');

const app = express();

app.use(cors());
app.use(express.json());
app.use(express.static('public'));

// Letakkan sebelum route GET /
app.use(express.static('public'));

// Status verifikasi yang diperbolehkan
const statusValid = ['menunggu', 'disetujui', 'ditolak'];

// ==================================================
// 1. HALAMAN UTAMA API
// ==================================================
app.get('/', (req, res) => {
    res.json({
        message: 'API SideMapan berhasil berjalan!',
        endpoints: {
            daftar: 'GET /api/umkm',
            detail: 'GET /api/umkm/:id',
            tambah: 'POST /api/umkm',
            update: 'PUT /api/umkm/:id',
            hapus: 'DELETE /api/umkm/:id',
        },
    });
});

// ==================================================
// 2. TES KONEKSI DATABASE
// ==================================================
app.get('/api/db-test', async (req, res) => {
    try {
        const result = await pool.query('SELECT NOW() AS waktu_database');

        res.json({
            message: 'Koneksi PostgreSQL berhasil!',
            data: result.rows[0],
        });
    } catch (error) {
        console.error('Database error:', error.message);

        res.status(500).json({
            message: 'Koneksi PostgreSQL gagal.',
        });
    }
});

//  GET: MENAMPILKAN SEMUA UMKM
app.get('/api/umkm', async (req, res) => {
    try {
        const result = await pool.query(
            'SELECT * FROM umkm ORDER BY id DESC'
        );

        res.json({
            message: 'Data UMKM berhasil diambil.',
            total: result.rowCount,
            data: result.rows,
        });
    } catch (error) {
        console.error('Gagal mengambil UMKM:', error.message);

        res.status(500).json({
            message: 'Terjadi kesalahan saat mengambil data UMKM.',
        });
    }
});

//  GET: MENAMPILKAN DETAIL UMKM
app.get('/api/umkm/:id', async (req, res) => {
    const id = Number(req.params.id);

    if (!Number.isInteger(id) || id < 1) {
        return res.status(400).json({
            message: 'ID UMKM tidak valid.',
        });
    }

    try {
        const result = await pool.query(
            'SELECT * FROM umkm WHERE id = $1',
            [id]
        );

        if (result.rowCount === 0) {
            return res.status(404).json({
                message: 'Data UMKM tidak ditemukan.',
            });
        }

        res.json({
            message: 'Detail UMKM berhasil diambil.',
            data: result.rows[0],
        });
    } catch (error) {
        console.error('Gagal mengambil detail UMKM:', error.message);

        res.status(500).json({
            message: 'Terjadi kesalahan saat mengambil detail UMKM.',
        });
    }
});


// 5. POST: MENAMBAHKAN UMKM
app.post('/api/umkm', async (req, res) => {
    const {
        nama_usaha,
        nama_pemilik,
        deskripsi,
        alamat,
        no_telepon,
        kategori,
        status_verifikasi,
    } = req.body;

    if (
        typeof nama_usaha !== 'string' ||
        !nama_usaha.trim() ||
        typeof nama_pemilik !== 'string' ||
        !nama_pemilik.trim()
    ) {
        return res.status(400).json({
            message: 'Nama usaha dan nama pemilik wajib diisi.',
        });
    }

    const status = status_verifikasi || 'menunggu';

    if (!statusValid.includes(status)) {
        return res.status(400).json({
            message: 'Status harus menunggu, disetujui, atau ditolak.',
        });
    }

    try {
        const result = await pool.query(
            `INSERT INTO umkm
                (nama_usaha, nama_pemilik, deskripsi, alamat,
                 no_telepon, kategori, status_verifikasi)
             VALUES ($1, $2, $3, $4, $5, $6, $7)
             RETURNING *`,
            [
                nama_usaha.trim(),
                nama_pemilik.trim(),
                deskripsi ?? null,
                alamat ?? null,
                no_telepon ?? null,
                kategori ?? null,
                status,
            ]
        );

        res.status(201).json({
            message: 'UMKM berhasil ditambahkan.',
            data: result.rows[0],
        });
    } catch (error) {
        console.error('Gagal menambahkan UMKM:', error.message);

        res.status(500).json({
            message: 'Terjadi kesalahan saat menambahkan UMKM.',
        });
    }
});

// 6. PUT: MEMPERBARUI DATA UMKM
app.put('/api/umkm/:id', async (req, res) => {
    const id = Number(req.params.id);

    if (!Number.isInteger(id) || id < 1) {
        return res.status(400).json({
            message: 'ID UMKM tidak valid.',
        });
    }

    const {
        nama_usaha,
        nama_pemilik,
        deskripsi,
        alamat,
        no_telepon,
        kategori,
        status_verifikasi,
    } = req.body;

    if (nama_usaha !== undefined &&
        (typeof nama_usaha !== 'string' || !nama_usaha.trim())) {
        return res.status(400).json({
            message: 'Nama usaha tidak boleh kosong.',
        });
    }

    if (nama_pemilik !== undefined &&
        (typeof nama_pemilik !== 'string' || !nama_pemilik.trim())) {
        return res.status(400).json({
            message: 'Nama pemilik tidak boleh kosong.',
        });
    }

    if (
        status_verifikasi !== undefined &&
        !statusValid.includes(status_verifikasi)
    ) {
        return res.status(400).json({
            message: 'Status verifikasi tidak valid.',
        });
    }

    try {
        const result = await pool.query(
            `UPDATE umkm SET
                nama_usaha = COALESCE($1, nama_usaha),
                nama_pemilik = COALESCE($2, nama_pemilik),
                deskripsi = COALESCE($3, deskripsi),
                alamat = COALESCE($4, alamat),
                no_telepon = COALESCE($5, no_telepon),
                kategori = COALESCE($6, kategori),
                status_verifikasi = COALESCE($7, status_verifikasi),
                updated_at = CURRENT_TIMESTAMP
             WHERE id = $8
             RETURNING *`,
            [
                nama_usaha === undefined ? null : nama_usaha.trim(),
                nama_pemilik === undefined ? null : nama_pemilik.trim(),
                deskripsi ?? null,
                alamat ?? null,
                no_telepon ?? null,
                kategori ?? null,
                status_verifikasi ?? null,
                id,
            ]
        );

        if (result.rowCount === 0) {
            return res.status(404).json({
                message: 'Data UMKM tidak ditemukan.',
            });
        }

        res.json({
            message: 'Data UMKM berhasil diperbarui.',
            data: result.rows[0],
        });
    } catch (error) {
        console.error('Gagal memperbarui UMKM:', error.message);

        res.status(500).json({
            message: 'Terjadi kesalahan saat memperbarui UMKM.',
        });
    }
});

// 7. DELETE: MENGHAPUS UMKM
app.delete('/api/umkm/:id', async (req, res) => {
    const id = Number(req.params.id);

    if (!Number.isInteger(id) || id < 1) {
        return res.status(400).json({
            message: 'ID UMKM tidak valid.',
        });
    }

    try {
        const result = await pool.query(
            'DELETE FROM umkm WHERE id = $1 RETURNING *',
            [id]
        );

        if (result.rowCount === 0) {
            return res.status(404).json({
                message: 'Data UMKM tidak ditemukan.',
            });
        }

        res.json({
            message: 'UMKM berhasil dihapus.',
            data: result.rows[0],
        });
    } catch (error) {
        console.error('Gagal menghapus UMKM:', error.message);

        res.status(500).json({
            message: 'Terjadi kesalahan saat menghapus UMKM.',
        });
    }
});

// ==================================================
// MENJALANKAN SERVER
// ==================================================
const PORT = process.env.PORT || 3000;

app.listen(PORT, () => {
    console.log(`Server SideMapan berjalan di http://localhost:${PORT}`);
});
