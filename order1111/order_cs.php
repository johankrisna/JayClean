<?php 
   require_once('../_header.php'); 
   $data_cs = query("SELECT * FROM tb_cuci_satuan");
?>

<?php if (isset($_POST['order_cs'])) {
    // Validasi input sebelum memproses order
    $requiredFields = ['nama_pel_cs', 'no_telp_cs', 'alamat_cs', 'jenis_paket_cs', 'jml_pcs', 'tgl_masuk_cs', 'tgl_keluar_cs'];
    $errors = [];
    
    foreach ($requiredFields as $field) {
        if (empty($_POST[$field])) {
            $errors[] = "Field $field harus diisi";
        }
    }

    if (empty($errors)) {
        // Jika tidak ada error, maka lanjutkan proses order
        if (order_cs($_POST) > 0) : ?>
            <div class="alert">
                <div class="box">
                    <img src="<?= url('_assets/img/berhasil.png') ?>" height="68" alt="alert sukses">
                    <p>Order Berhasil Ditambahkan</p>
                    <button onclick="window.location='http://localhost/rumah_laundry/'" class="btn-alert">Ok</button>
                </div>
            </div>
        <?php else : ?>
            <div class="alert">
                <div class="box">
                    <img src="<?= url('_assets/img/gagal.png') ?>" height="68" alt="alert gagal">
                    <p>Order Gagal Ditambahkan</p>
                    <button onclick="window.location='http://localhost/rumah_laundry/'" class="btn-alert">Ok</button>
                </div>
            </div>
        <?php endif;
    } else {
        // Jika ada error, tampilkan pesan error
        ?>
        <div class="alert">
            <div class="box">
                <img src="<?= url('_assets/img/gagal.png') ?>" height="68" alt="alert gagal">
                <p><?= implode('<br>', $errors) ?></p>
                <button onclick="window.location='http://localhost/rumah_laundry/'" class="btn-alert">Ok</button>
            </div>
        </div>
    <?php
    }
   }
   ?>
   

   <div id="order_cs" class="main-content">
      <div class="container">
         <div class="baris">
            <div class="col mt-2">
               <div class="card">
                  <div class="card-title card-flex">
                     <div class="card-col">
                        <h2> Cuci Dalam</h2>
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
                                 <input type="text" name="nama_pel_cs" placeholder="Nama lengkap" autocomplete="off" id="nama">
                              </div>

                              <div class="form-grup">
                                 <label for="no-telp">Nomor Telepon</label>
                                 <input type="text" name="no_telp_cs" placeholder="Nomor Telepon" autocomplete="off" id="no-telp">
                              </div>

                              <div class="form-grup">
                                 <label for="alamat">Alamat</label>
                                 <textarea name="alamat_cs" rows="4" id="alamat"></textarea>
                              </div>
                           </div>

                           <div class="col-form m-1">
                              <div class="form-grup">
                                 <label for="pilih_paket">Pilih Jenis Layanan</label>
                                 <select name="jenis_paket_cs" id="pilih_paket">
                                    <option>-- Pilih Jenis Layanan --</option>
                                       <?php foreach ($data_cs as $cs) : ?>
                                       <option><?=$cs['nama_cs']?></option>
                                       <?php endforeach ?>
                                    </select>
                              </div>

                              <div class="form-grup">
                                 <label for="kuantitas">Jumlah</label>
                                 <input type="number" name="jml_pcs" placeholder="Jumlah" autocomplete="off" id="kuantitas">
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

                              <div class="form-grup">
                                 <label for="ket">Keterangan</label>
                                 <textarea name="keterangan_cs" rows="4" id="ket"></textarea>
                              </div>
                           </div>
                        </div>
                        
                        <div class="form-footer">
                           <div class="buttons">
                              <button type="submit" name="order_cs" class="btn-sm bg-primary">Pesan</button>
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