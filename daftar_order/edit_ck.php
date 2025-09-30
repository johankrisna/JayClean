<?php
require_once('../_header.php');
$data_ck = query("SELECT * FROM tb_cuci_komplit");

// Jika mendapatkan nomor order dari parameter URL
if (isset($_GET['or_ck_number'])) {
    $or_ck_number = $_GET['or_ck_number'];

    // Mendapatkan data order cuci komplit berdasarkan nomor order
    $order_ck_data = get_order_ck_by_number($or_ck_number);
}

// Jika ada pengiriman data form edit
if (isset($_POST['edit_ck'])) {
    $or_ck_number = $_POST['or_ck_number'];

    // Validasi input sebelum memproses edit
    $requiredFields = ['nama_pel_ck', 'no_telp_ck', 'alamat_ck', 'jenis_paket_ck', 'berat_qty_ck', 'tgl_masuk_ck', 'tgl_keluar_ck'];
    $errors = [];

    foreach ($requiredFields as $field) {
        if (empty($_POST[$field])) {
            $errors[] = "Field $field harus diisi";
        }
    }

    if (empty($errors)) {
        // Jika tidak ada error, maka lanjutkan proses edit
        $edit_data = [
            'nama_pel_ck' => $_POST['nama_pel_ck'],
            'no_telp_ck' => $_POST['no_telp_ck'],
            'alamat_ck' => $_POST['alamat_ck'],
            'jenis_paket_ck' => $_POST['jenis_paket_ck'],
            'berat_qty_ck' => $_POST['berat_qty_ck'],
            'tgl_masuk_ck' => $_POST['tgl_masuk_ck'],
            'tgl_keluar_ck' => $_POST['tgl_keluar_ck'],
            'keterangan_ck' => $_POST['keterangan_ck']
        ];

        // Panggil fungsi edit_order_ck
        $edit_result = edit_order_ck($edit_data, $or_ck_number);

        // Tampilkan pesan hasil edit
        echo '<div class="alert">
                <div class="box">
                    <img src="' . url('_assets/img/') . ($edit_result ? 'berhasil.png' : 'gagal.png') . '" height="68" alt="alert sukses">
                    <p>' . ($edit_result ? 'Edit Berhasil' : 'Edit Gagal') . '</p>
                    <button onclick="window.location=\'http://localhost/rumah_laundry/dasboard.php\'" class="btn-alert">Ok</button>
                </div>
            </div>';
    } else {
        // Jika ada error, tampilkan pesan error
        echo '<div class="alert">
                <div class="box">
                    <img src="' . url('_assets/img/gagal.png') . '" height="68" alt="alert gagal">
                    <p>' . implode('<br>', $errors) . '</p>
                    <button onclick="window.location=\'http://localhost/rumah_laundry/daftar_order/edit_ck.php\'" class="btn-alert">Ok</button>
                </div>
            </div>';
    }
}
?>

<div id="edit_ck" class="main-content">
    <div class="container">
        <div class="baris">
            <div class="col mt-2">
                <div class="card">
                    <div class="card-title card-flex">
                        <div class="card-col">
                            <h2>Edit Order Cuci Komplit</h2>
                        </div>
                        <div class="card-col txt-right">
                            <a href="<?= url('dasboard.php') ?>" class="btn-xs bg-primary">Kembali</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <input type="hidden" name="or_ck_number" value="<?= $order_ck_data['or_ck_number'] ?>">
                            <!-- Menampilkan data order cuci komplit yang akan diedit -->
                            <div class="row-input">
                                <div class="col-form m-1">
                                    <div class="form-grup">
                                        <label for="nama">Nama Pelanggan</label>
                                        <input type="text" name="nama_pel_ck" value="<?= $order_ck_data['nama_pel_ck'] ?>" autocomplete="off" id="nama">
                                    </div>

                                    <div class="form-grup">
                                        <label for="no-telp">Nomor Telepon</label>
                                        <input type="text" name="no_telp_ck" value="<?= $order_ck_data['no_telp_ck'] ?>" autocomplete="off" id="no-telp">
                                    </div>

                                    <div class="form-grup">
                                        <label for="alamat">Alamat</label>
                                        <textarea name="alamat_ck" rows="4" id="alamat"><?= $order_ck_data['alamat_ck'] ?></textarea>
                                    </div>
                                </div>

                                <div class="col-form m-1">
                                    <div class="form-grup">
                                        <label for="pilih_paket">Pilih Jenis Layanan</label>
                                        <select name="jenis_paket_ck" id="pilih_paket">
                                            <option>-- Pilih Jenis Layanan --</option>
                                            <?php foreach ($data_ck as $ck) : ?>
                                                <option <?= $ck['nama_paket_ck'] === $order_ck_data['jenis_paket_ck'] ? 'selected' : '' ?>><?= $ck['nama_paket_ck'] ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>

                                    <div class="form-grup">
                                        <label for="kuantitas">Jumlah</label>
                                        <input type="number" name="berat_qty_ck" value="<?= $order_ck_data['berat_qty_ck'] ?>" autocomplete="off" id="kuantitas">
                                    </div>

                                    <?php
                           // Mendapatkan tanggal sekarang
                                 $today = date('Y-m-d');
                              ?>
<!-- Input Tanggal Order Masuk -->
<div class="form-grup">
    <label for="tgl_order_msk">Tanggal Order Masuk</label>
    <input type="date" name="tgl_masuk_ck" autocomplete="on" id="tgl_order_msk" value="<?= date('Y-m-d') ?>" min="<?= date('Y-m-d') ?>" max="<?= date('Y-m-d') ?>">
</div>

<!-- Input Tanggal Order Keluar -->
<div class="form-grup">
    <label for="tgl_order_klr">Tanggal Order Keluar</label>
    <input type="date" name="tgl_keluar_ck" id="tgl_order_klr" min="<?= date('Y-m-d') ?>" max="<?= date('Y-m-d', strtotime('+5 days')) ?>" value="<?= date('Y-m-d') ?>">
</div>

<script>
// Mengatur tanggal keluar otomatis menjadi hari ini
document.getElementById('tgl_order_klr').valueAsDate = new Date();
</script>

<div class="form-group">
    <label for="ket">Keterangan</label>
    <select name="keterangan_ck" id="ket">
        <option value="selesai" <?= ($order_ck_data['keterangan_ck'] === 'selesai') ? 'selected' : '' ?>>Selesai</option>
        <option value="belum-selesai" <?= ($order_ck_data['keterangan_ck'] === 'belum-selesai') ? 'selected' : '' ?>>Belum Selesai</option>
    </select>
</div>

                                </div>
                            </div>

                            <div class="form-footer">
                                <div class="buttons">
                                    <button type="submit" name="edit_ck" class="btn-sm bg-primary">Simpan Perubahan</button>
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
