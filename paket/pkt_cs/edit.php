<?php 
   require_once('../../_header.php'); 
   $id_cs = $_GET['id_cs'];
   $data_cs = query("SELECT * FROM tb_cuci_satuan WHERE id_cs = '$id_cs'")[0];
   // var_dump($data_cs);   
?>
   
   <?php if (isset($_POST['ubah'])) : ?>
      <?php if (edit_cs($_POST) > 0) : ?>
         <!-- Statement 1 -->
         <div class="alert">
				<div class="box">
            <img src="<?=url('_assets/img/berhasil.png')?>" height="68" alt="alert sukses">
					<p>Layanan Berhasil Diubah</p>
					<button onclick="window.location='http://localhost/rumah_laundry/paket/pkt_cs/pkt_cs.php'" class="btn-alert">Ok</button>
				</div>
         </div>
         <?php else :?>   
         <!-- Statement 2 -->
         <div class="alert">
            <div class="box">
            <img src="<?=url('_assets/img/gagal.png')?>" height="68" alt="alert gagal">
               <p>Layanan Gagal Diubah</p>
               <button onclick="window.location='http://localhost/rumah_laundry/paket/pkt_cs/pkt_cs.php'" class="btn-alert">Ok</button>
            </div>
         </div>
      <?php endif ?>
   <?php endif ?>

   <div id="edit_cs" class="main-content">
      <div class="container">
         <div class="baris">
            <div class="col mt-2">
               <div class="card">
                  <div class="card-title card-flex">
                     <div class="card-col">
                        <h2>Ubah Layanan</h2>	
                     </div>
                     <div class="card-col txt-right">
                        <a href="<?=url('paket/pkt_cs/pkt_cs.php')?>" class="btn-xs bg-primary">Kembali</a>
                     </div>
                  </div>

                  <div class="card-body">
                     <form action="" method="post" class="form-input">
                     <input type="hidden" name="id_cs" value="<?=$data_cs['id_cs']?>">
                        <div class="form-grup">
                           <label for="nama">Nama Layanan</label>
                           <input type="text" name="nama_paket_cs" placeholder="Nama Layanan" value="<?=$data_cs['nama_paket_cs']?>" autocomplete="off" id="nama" required>
                        </div>

                        <div class="form-grup">
                           <label for="wk">Waktu Kerja</label>
                           <div class="input-group">
                              <input type="text" name="waktu_kerja_cs" placeholder="Durasi Kerja" value="<?=$data_cs['waktu_kerja_cs']?>" autocomplete="off" id="wk" required>
                              <select name="waktu_kerja_unit">
                                    <option value="hari" <?= ($data_cs['durasi_cs'] == 'hari') ? 'selected' : ''; ?>>Hari</option>
                                    <option value="jam" <?= ($data_cs['durasi_cs'] == 'jam') ? 'selected' : ''; ?>>Jam</option>
                                    <!-- Add more units as needed -->
                              </select>
                           </div>
                        </div>

                        <div class="form-grup">
                           <label for="berat">Jml Min</label>
                           <input type="text" name="kuantitas_cs" placeholder="Jml Min" value="<?=$data_cs['kuantitas_cs']?>" autocomplete="off" id="berat" required>
                        </div>

                        <div class="form-grup">
                           <label for="tarif">Tarif</label>
                           <input type="text" name="tarif_cs" placeholder="Harga Layanan" value="<?=$data_cs['tarif_cs']?>" autocomplete="off" id="tarif" required>
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