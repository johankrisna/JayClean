<?php 
   require_once('../../_header.php');
   $id_dc = $_GET['id_dc'];
   $data_dc = query("SELECT * FROM tb_dry_clean WHERE id_dc = '$id_dc'")[0];
   // var_dump($data_dc);
?>

<?php if (isset($_POST['ubah'])) : ?>
      <?php if (edit_dc($_POST) > 0) : ?>
         <!-- Statement 1 -->
         <div class="alert">
				<div class="box">
            <img src="<?=url('_assets/img/berhasil.png')?>" height="68" alt="alert sukses">
					<p>Layanan Berhasil Diubah</p>
					<button onclick="window.location='http://localhost/rumah_laundry/paket/pkt_dc/pkt_dc.php'" class="btn-alert">Ok</button>
				</div>
         </div>
         
         <?php else : ?>
         <!-- Statement 2 -->
         <div class="alert">
            <div class="box">
            <img src="<?=url('_assets/img/gagal.png')?>" height="68" alt="alert gagal">
               <p>Layanan Gagal Diubah</p>
               <button onclick="window.location='http://localhost/rumah_laundry/paket/pkt_dc/pkt_dc.php'" class="btn-alert">Ok</button>
            </div>
         </div>
      <?php endif ?>      
   <?php endif ?>

   <div id="edit_dc" class="main-content">
      <div class="container">
         <div class="baris">
            <div class="col mt-2">
               <div class="card">
                  <div class="card-title card-flex">
                     <div class="card-col">
                        <h2>Ubah Layanan</h2>	
                     </div>
                     <div class="card-col txt-right">
                        <a href="<?=url('paket/pkt_dc/pkt_dc.php')?>" class="btn-xs bg-primary">Kembali</a>
                     </div>
                  </div>

                  <div class="card-body">
                     <form action="" method="post" class="form-input">
                     <input type="hidden" name="id_dc" value="<?=$data_dc['id_dc']?>">
                        <div class="form-grup">
                           <label for="nama">Nama Layanan</label>
                           <input type="text" name="nama_paket_dc" placeholder="Nama Layanan" value="<?=$data_dc['nama_paket_dc']?>" autocomplete="off" id="nama" required>
                        </div>

                        <div class="form-grup">
                           <label for="wk">Waktu Kerja</label>
                           <div class="input-group">
                              <input type="text" name="waktu_kerja_dc" placeholder="Durasi Kerja" value="<?=$data_dc['waktu_kerja_dc']?>" autocomplete="off" id="wk" required>
                              <select name="waktu_kerja_unit">
                                    <option value="hari" <?= ($data_dc['durasi_dc'] == 'hari') ? 'selected' : ''; ?>>Hari</option>
                                    <option value="jam" <?= ($data_dc['durasi_dc'] == 'jam') ? 'selected' : ''; ?>>Jam</option>
                                    <!-- Add more units as needed -->
                              </select>
                           </div>
                        </div>

                        <div class="form-grup">
                           <label for="berat">Jml Min</label>
                           <input type="text" name="kuantitas_dc" placeholder="Jml Min" value="<?=$data_dc['kuantitas_dc']?>" autocomplete="off" id="berat" required>
                        </div>

                        <div class="form-grup">
                           <label for="tarif">Tarif</label>
                           <input type="text" name="tarif_dc" placeholder="Harga Layanan" value="<?=$data_dc['tarif_dc']?>" autocomplete="off" id="tarif" required>
                        </div>

                        <div class="form-grup ">
                           <button type="submit" class="mt-1" name="ubah">Update</button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

<?php require_once('../../_footer.php') ?>