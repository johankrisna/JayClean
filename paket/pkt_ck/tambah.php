<?php require_once('../../_header.php') ?>
   
   <?php if (isset($_POST['tambah'])) : ?>
      <?php if (add_ck($_POST) > 0) : ?>
         <!-- Statement 1 -->
         <div class="alert">
				<div class="box">
            <img src="<?=url('_assets/img/berhasil.png')?>" height="68" alt="alert sukses">
					<p>Layanan Berhasil Ditambahkan</p>
					<button onclick="window.location='http://localhost/rumah_laundry/paket/pkt_ck/pkt_ck.php'" class="btn-alert">Ok</button>
				</div>
         </div>
         
         <?php else : ?>
         <!-- Statement 2 -->
         <div class="alert">
            <div class="box-red">
            <img src="<?=url('_assets/img/gagal.png')?>" height="68" alt="alert gagal">
               <p>Layanan Gagal Ditambahkan</p>
               <button onclick="window.location='http://localhost/rumah_laundry/paket/pkt_ck/pkt_ck.php'" class="btn-alert">Ok</button>
            </div>
         </div>
      <?php endif ?>      
   <?php endif ?>

   <div id="tambah_paket_ck" class="main-content">
      <div class="container">
         <div class="baris">
            <div class="col mt-2">
               <div class="card">
                  <div class="card-title card-flex">
                     <div class="card-col">
                        <h2>Tambah Layanan Cuci Komplit</h2>	
                     </div>
                     <div class="card-col txt-right">
                        <a href="<?=url('paket/pkt_ck/pkt_ck.php')?>" class="btn-xs bg-primary">Kembali</a>
                     </div>
                  </div>

                  <div class="card-body">
                     <form action="" method="post" class="form-input">
                        <div class="form-grup">
                              <label for="nama">Nama Layanan</label>
                              <input type="text" name="nama_paket_ck" placeholder="Nama Layanan" autocomplete="off" id="nama" required>
                        </div>

                        <div class="form-grup">
                              <label for="wk">Waktu Kerja</label>
                              <div class="input-group">
                                 <input type="text" name="waktu_kerja_ck" placeholder="Durasi Kerja" autocomplete="off" id="wk" required>
                                 <select name="durasi_ck">
                                    <option value="hari">Hari</option>
                                    <option value="jam">Jam</option>
                                    <!-- Add more units as needed -->
                                 </select>
                              </div>
                        </div>

                        <div class="form-grup">
                              <label for="berat">Jml Min</label>
                              <input type="text" name="kuantitas_ck" placeholder="Jml Min" autocomplete="off" id="berat" required>
                        </div>

                        <div class="form-grup">
                              <label for="tarif">Tarif</label>
                              <input type="text" name="tarif_ck" placeholder="Harga Layanan" autocomplete="off" id="tarif" required>
                        </div>

                        <div class="form-grup">
                              <button type="submit" class="mt-1" name="tambah">Tambah</button>
                        </div>
                     </form>
                  </div>





                  <!-- <div class="card-body">
                     <form action="" method="post" class="form-input">
                        <div class="form-grup">
                           <label for="nama">Nama Layanan</label>
                           <input type="text" name="nama_paket_ck" placeholder="Nama Layanan" autocomplete="off" id="nama" required>
                        </div>

                        <div class="form-grup">
                           <label for="wk">Waktu Kerja</label>
                           <input type="text" name="waktu_kerja_ck" placeholder="Durasi Kerja" autocomplete="off" id="wk" required>
                        </div>

                        <div class="form-grup">
                           <label for="berat">Jml Min</label>
                           <input type="text" name="kuantitas_ck" placeholder="Jml Min" autocomplete="off" id="berat" required>
                        </div>

                        <div class="form-grup">
                           <label for="tarif">Tarif</label>
                           <input type="text" name="tarif_ck" placeholder="Harga Layanan" autocomplete="off" id="tarif" required>
                        </div>

                        <div class="form-grup ">
                           <button type="submit" class="mt-1" name="tambah">Tambah</button>
                        </div>
                     </form>
                  </div> -->
               </div>
            </div>
         </div>
      </div>
   </div>

<?php require_once('../../_footer.php')?>