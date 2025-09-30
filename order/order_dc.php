<?php
require_once('../_header.php');
$data_dc = query("SELECT * FROM tb_dry_clean");

function displaySuccessMessage()
{
    ?>
    <div class="alert">
        <div class="box">
            <img src="<?= url('_assets/img/berhasil.png') ?>" height="68" alt="alert sukses">
            <p>Order Berhasil Ditambahkan</p>
            <button onclick="window.location='http://localhost/rumah_laundry/'" class="btn-alert">Ok</button>
        </div>
    </div>
<?php
}

function displayFailureMessage()
{
    ?>
    <div class="alert">
        <div class="box">
            <img src="<?= url('_assets/img/gagal.png') ?>" height="68" alt="alert gagal">
            <p>Order Gagal Ditambahkan</p>
            <button onclick="window.location='http://localhost/rumah_laundry/order/order_dc.php'" class="btn-alert">Ok</button>
        </div>
    </div>
<?php
}

if (isset($_POST['order_dc'])) {
    // Validasi input sebelum memproses order
    $requiredFields = ['nama_pel_dc', 'no_telp_dc', 'alamat_dc', 'jenis_paket_dc', 'berat_qty_dc', 'tgl_masuk_dc', 'tgl_keluar_dc'];
    $errors = [];

    foreach ($requiredFields as $field) {
        if (empty($_POST[$field])) {
            $errors[] = "Terdapat field yang kosong";
            break; // Stop the loop if any field is empty
        }
    }

    // Validasi nomor telepon memiliki setidaknya 9 angka
    if (!empty($_POST['no_telp_dc']) && !preg_match('/^\d{9,}$/', $_POST['no_telp_dc'])) {
        $errors[] = "Nomor Telepon harus memiliki setidaknya 9 angka";
    }

    if (empty($errors)) {
        // Jika tidak ada error, maka lanjutkan proses order
        if (order_dc($_POST) > 0) {
            displaySuccessMessage();
        } else {
            displayFailureMessage();
        }
    } else {
        // Jika ada error, tampilkan pesan error
        ?>
        <div class="alert">
            <div class="box">
                <img src="<?= url('_assets/img/gagal.png') ?>" height="68" alt="alert gagal">
                <p><?= implode('<br>', $errors) ?></p>
                <button onclick="window.location='http://localhost/rumah_laundry/order/order_dc.php'" class="btn-alert">Ok</button>
            </div>
        </div>
<?php
    }
}
?>

   <div id="order_dc" class="main-content">
      <div class="container">
         <div class="baris">
            <div class="col mt-2">
               <div class="card">
                  <div class="card-title card-flex">
                     <div class="card-col">
                        <h2>Cuci Luar</h2>
                     </div>

                     <div class="card-col txt-right">
                        <a href="<?=url('order/order.php')?>" class="btn-xs bg-primary">Kembali</a>
                     </div>
                  </div>

                  <div class="card-body">
                     <form action="" method="post">
                        <div class="row-input">
                           <div class="col-form m-1">
                              <div class="form-grup">
                                 <label for="nama">Nama Pelanggan</label>
                                 <input type="text" name="nama_pel_dc" placeholder="Nama lengkap" autocomplete="off" id="nama">
                              </div>

                              <div class="form-grup">
                                 <label for="no-telp">Nomor Telepon</label>
                                 <input type="text" name="no_telp_dc" placeholder="Nomor Telepon" autocomplete="off" id="no-telp">
                              </div>

                              <div class="form-grup">
                                 <label for="alamat">Alamat</label>
                                 <textarea name="alamat_dc" rows="4" id="alamat"></textarea>
                              </div>
                           </div>

                           <div class="col-form m-1">
                              <div class="form-grup">
                                 <label for="pilih_paket">Pilih Jenis Layanan</label>
                                 <select name="jenis_paket_dc" id="pilih_paket">
                                    <option>-- Pilih Jenis Layanan --</option>
                                       <?php foreach ($data_dc as $dc) : ?>
                                       <option><?=$dc['nama_paket_dc']?></option>
                                       <?php endforeach ?>
                                    </select>
                              </div>

                              <div class="form-grup">
                                 <label for="kuantitas">Jumlah</label>
                                 <input type="number" name="berat_qty_dc" placeholder="Jumlah" autocomplete="off" id="kuantitas">
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
    <label for="status">Status</label>
    <select name="status">
        <option value="Belum Selesai">Belum Selesai</option>
    </select>
</div>
                           </div>
                        </div>
                        
                        <div class="form-footer">
                           <div class="buttons">
                              <button type="submit" name="order_dc" class="btn-sm bg-primary">Pesan</button>
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