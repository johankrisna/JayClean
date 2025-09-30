<?php
require_once('../_header.php');
$data_dc = query("SELECT * FROM tb_dry_clean");

// Jika mendapatkan nomor order dari parameter URL
if (isset($_GET['or_dc_number'])) {
    $or_dc_number = $_GET['or_dc_number'];

    // Mendapatkan data order dry clean berdasarkan nomor order
    $order_dc_data = get_order_dc_by_number($or_dc_number);
}

// Jika ada pengiriman data form edit
if (isset($_POST['edit_dc'])) {
    $or_dc_number = $_POST['or_dc_number'];

    // Validasi input sebelum memproses edit
    $requiredFields = ['nama_pel_dc', 'no_telp_dc', 'alamat_dc', 'jenis_paket_dc', 'berat_qty_dc', 'tgl_masuk_dc', 'tgl_keluar_dc'];
    $errors = [];

    foreach ($requiredFields as $field) {
        if (empty($_POST[$field])) {
            $errors[] = "Field $field harus diisi";
        }
    }

    if (empty($errors)) {
        // Jika tidak ada error, maka lanjutkan proses edit
        $edit_data_dc = [
            'nama_pel_dc' => $_POST['nama_pel_dc'],
            'no_telp_dc' => $_POST['no_telp_dc'],
            'alamat_dc' => $_POST['alamat_dc'],
            'jenis_paket_dc' => $_POST['jenis_paket_dc'],
            'berat_qty_dc' => $_POST['berat_qty_dc'],
            'tgl_masuk_dc' => $_POST['tgl_masuk_dc'],
            'tgl_keluar_dc' => $_POST['tgl_keluar_dc'],
            'keterangan_dc' => $_POST['keterangan_dc']
        ];

        // Panggil fungsi edit_order_dc
        $edit_result_dc = edit_order_dc($edit_data_dc, $or_dc_number);

        // Tampilkan pesan hasil edit
        echo '<div class="alert">
                <div class="box">
                    <img src="' . url('_assets/img/') . ($edit_result_dc ? 'berhasil.png' : 'gagal.png') . '" height="68" alt="alert sukses">
                    <p>' . ($edit_result_dc ? 'Edit Berhasil' : 'Edit Gagal') . '</p>
                    <button onclick="window.location=\'http://localhost/rumah_laundry/dasboard.php\'" class="btn-alert">Ok</button>
                </div>
            </div>';
    } else {
        // Jika ada error, tampilkan pesan error
        echo '<div class="alert">
                <div class="box">
                    <img src="' . url('_assets/img/gagal.png') . '" height="68" alt="alert gagal">
                    <p>' . implode('<br>', $errors) . '</p>
                    <button onclick="window.location=\'http://localhost/rumah_laundry/\'" class="btn-alert">Ok</button>
                </div>
            </div>';
    }
}
?>

<div id="edit_dc" class="main-content">
    <div class="container">
        <div class="baris">
            <div class="col mt-2">
                <div class="card">
                    <div class="card-title card-flex">
                        <div class="card-col">
                            <h2>Edit Order Cuci Luar</h2>
                        </div>
                        <div class="card-col txt-right">
                            <a href="<?= url('dasboard.php') ?>" class="btn-xs bg-primary">Kembali</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <input type="hidden" name="or_dc_number" value="<?= $order_dc_data['or_dc_number'] ?>">
                            <!-- Menampilkan data order dry clean yang akan diedit -->
                            <div class="row-input">
                                <div class="col-form m-1">
                                    <div class="form-grup">
                                        <label for="nama">Nama Pelanggan</label>
                                        <input type="text" name="nama_pel_dc" value="<?= $order_dc_data['nama_pel_dc'] ?>" autocomplete="off" id="nama">
                                    </div>

                                    <div class="form-grup">
                                        <label for="no-telp">Nomor Telepon</label>
                                        <input type="text" name="no_telp_dc" value="<?= $order_dc_data['no_telp_dc'] ?>" autocomplete="off" id="no-telp">
                                    </div>

                                    <div class="form-grup">
                                        <label for="alamat">Alamat</label>
                                        <textarea name="alamat_dc" rows="4" id="alamat"><?= $order_dc_data['alamat_dc'] ?></textarea>
                                    </div>
                                </div>

                                <div class="col-form m-1">
                                    <div class="form-grup">
                                        <label for="pilih_paket">Pilih Jenis Layanan</label>
                                        <select name="jenis_paket_dc" id="pilih_paket">
                                            <option>-- Pilih Jenis Layanan --</option>
                                            <?php foreach ($data_dc as $dc) : ?>
                                                <option <?= $dc['nama_paket_dc'] === $order_dc_data['jenis_paket_dc'] ? 'selected' : '' ?>><?= $dc['nama_paket_dc'] ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>

                                    <div class="form-grup">
                                        <label for="kuantitas">Jumlah</label>
                                        <input type="number" name="berat_qty_dc" value="<?= $order_dc_data['berat_qty_dc'] ?>" autocomplete="off" id="kuantitas">
                                    </div>

                                    <?php
                           // Mendapatkan tanggal sekarang
                                 $today = date('Y-m-d');
                              ?>
<!-- Input Tanggal Order Masuk -->
<div class="form-grup">
    <label for="tgl_order_msk">Tanggal Order Masuk</label>
    <input type="date" name="tgl_masuk_dc" autocomplete="on" id="tgl_order_msk" value="<?= date('Y-m-d') ?>" min="<?= date('Y-m-d') ?>" max="<?= date('Y-m-d') ?>">
</div>

<!-- Input Tanggal Order Keluar -->
<div class="form-grup">
    <label for="tgl_order_klr">Tanggal Order Keluar</label>
    <input type="date" name="tgl_keluar_dc" id="tgl_order_klr" min="<?= date('Y-m-d') ?>" max="<?= date('Y-m-d', strtotime('+5 days')) ?>" value="<?= date('Y-m-d') ?>">
</div>

<script>
// Mengatur tanggal keluar otomatis menjadi hari ini
document.getElementById('tgl_order_klr').valueAsDate = new Date();
</script>

<div class="form-group">
    <label for="ket">Keterangan</label>
    <select name="keterangan_dc" id="ket">
        <option value="selesai" <?= ($order_dc_data['keterangan_dc'] === 'selesai') ? 'selected' : '' ?>>Selesai</option>
        <option value="belum-selesai" <?= ($order_dc_data['keterangan_dc'] === 'belum-selesai') ? 'selected' : '' ?>>Belum Selesai</option>
    </select>
</div>

                                </div>
                            </div>

                            <div class="form-footer">
                                <div class="buttons">
                                    <button type="submit" name="edit_dc" class="btn-sm bg-primary">Simpan Perubahan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once('../_footer.php') ?>
