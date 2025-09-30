<?php
require_once('../_header.php');
$data_cs = query("SELECT * FROM tb_cuci_satuan");

// Jika mendapatkan nomor order dari parameter URL
if (isset($_GET['or_cs_number'])) {
    $or_cs_number = $_GET['or_cs_number'];

    // Mendapatkan data order cuci satuan berdasarkan nomor order
    $order_cs_data = get_order_cs_by_number($or_cs_number);
}

// Jika ada pengiriman data form edit
if (isset($_POST['edit_cs'])) {
    $or_cs_number = $_POST['or_cs_number'];

    // Validasi input sebelum memproses edit
    $requiredFields = ['nama_pel_cs', 'no_telp_cs', 'alamat_cs', 'jenis_paket_cs', 'jml_pcs', 'tgl_masuk_cs', 'tgl_keluar_cs'];
    $errors = [];

    foreach ($requiredFields as $field) {
        if (empty($_POST[$field])) {
            $errors[] = "Field $field harus diisi";
        }
    }

    if (empty($errors)) {
        // Jika tidak ada error, maka lanjutkan proses edit
        $edit_data = [
            'nama_pel_cs' => $_POST['nama_pel_cs'],
            'no_telp_cs' => $_POST['no_telp_cs'],
            'alamat_cs' => $_POST['alamat_cs'],
            'jenis_paket_cs' => $_POST['jenis_paket_cs'],
            'jml_pcs' => $_POST['jml_pcs'],
            'tgl_masuk_cs' => $_POST['tgl_masuk_cs'],
            'tgl_keluar_cs' => $_POST['tgl_keluar_cs'],
            'keterangan_cs' => $_POST['keterangan_cs']
        ];

        // Panggil fungsi edit_order_cs
        $edit_result = edit_order_cs($edit_data, $or_cs_number);

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
                    <button onclick="window.location=\'http://localhost/rumah_laundry/\'" class="btn-alert">Ok</button>
                </div>
            </div>';
    }
}
?>

<div id="edit_cs" class="main-content">
    <div class="container">
        <div class="baris">
            <div class="col mt-2">
                <div class="card">
                    <div class="card-title card-flex">
                        <div class="card-col">
                            <h2>Edit Order Cuci Dalam</h2>
                        </div>
                        <div class="card-col txt-right">
                            <a href="<?= url('dasboard.php') ?>" class="btn-xs bg-primary">Kembali</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <input type="hidden" name="or_cs_number" value="<?= $order_cs_data['or_cs_number'] ?>">
                            <!-- Menampilkan data order cuci satuan yang akan diedit -->
                            <div class="row-input">
                                <div class="col-form m-1">
                                    <div class="form-grup">
                                        <label for="nama">Nama Pelanggan</label>
                                        <input type="text" name="nama_pel_cs" value="<?= $order_cs_data['nama_pel_cs'] ?>" autocomplete="off" id="nama">
                                    </div>

                                    <div class="form-grup">
                                        <label for="no-telp">Nomor Telepon</label>
                                        <input type="text" name="no_telp_cs" value="<?= $order_cs_data['no_telp_cs'] ?>" autocomplete="off" id="no-telp">
                                    </div>

                                    <div class="form-grup">
                                        <label for="alamat">Alamat</label>
                                        <textarea name="alamat_cs" rows="4" id="alamat"><?= $order_cs_data['alamat_cs'] ?></textarea>
                                    </div>
                                </div>

                                <div class="col-form m-1">
                                    <div class="form-grup">
                                        <label for="pilih_paket">Pilih Jenis Layanan</label>
                                        <select name="jenis_paket_cs" id="pilih_paket">
                                            <option>-- Pilih Jenis Layanan --</option>
                                            <?php foreach ($data_cs as $cs) : ?>
                                                <option <?= $cs['nama_cs'] === $order_cs_data['jenis_paket_cs'] ? 'selected' : '' ?>><?= $cs['nama_cs'] ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>

                                    <div class="form-grup">
                                        <label for="jml_pcs">Jumlah Pcs</label>
                                        <input type="number" name="jml_pcs" value="<?= $order_cs_data['jml_pcs'] ?>" autocomplete="off" id="jml_pcs">
                                    </div>
                                    <?php
                                    // Mendapatkan tanggal sekarang
                                 $today = date('Y-m-d');
                              ?>
<!-- Input Tanggal Order Masuk -->
<div class="form-grup">
    <label for="tgl_order_msk">Tanggal Order Masuk</label>
    <input type="date" name="tgl_masuk_cs" autocomplete="on" id="tgl_order_msk" value="<?= date('Y-m-d') ?>" min="<?= date('Y-m-d') ?>" max="<?= date('Y-m-d') ?>">
</div>

<!-- Input Tanggal Order Keluar -->
<div class="form-grup">
    <label for="tgl_order_klr">Tanggal Order Keluar</label>
    <input type="date" name="tgl_keluar_cs" id="tgl_order_klr" min="<?= date('Y-m-d') ?>" max="<?= date('Y-m-d', strtotime('+5 days')) ?>" value="<?= date('Y-m-d') ?>">
</div>

<script>
// Mengatur tanggal keluar otomatis menjadi hari ini
document.getElementById('tgl_order_klr').valueAsDate = new Date();
</script>

<div class="form-group">
    <label for="keterangan">Keterangan</label>
    <select name="keterangan_cs" id="keterangan">
        <option value="selesai" <?= ($order_cs_data['keterangan_cs'] === 'selesai') ? 'selected' : '' ?>>Selesai</option>
        <option value="belum-selesai" <?= ($order_cs_data['keterangan_cs'] === 'belum-selesai') ? 'selected' : '' ?>>Belum Selesai</option>
    </select>
</div>

                                </div>
                            </div>

                            <div class="form-footer">
                                <div class="buttons">
                                    <button type="submit" name="edit_cs" class="btn-sm bg-primary">Simpan Perubahan</button>
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
