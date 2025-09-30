<?php 
   require_once('../../_header.php'); 
   $no_dc = $_GET['or_dc_number'];
   $data = query("SELECT * FROM tb_order_dc WHERE or_dc_number = '$no_dc'")[0];
   // var_dump($data);
?>

<?php if (isset($_POST['bayar_dc'])) : ?>
   <script>
      window.location="http://localhost/rumah_laundry/detail_order/detail_dc/bayar.php?or_dc_number=<?=$no_dc?>"
   </script>
<?php endif ?>

   <div id="detail_or_dc" class="main-content">
      <div class="container">
         <div class="baris">
            <div class="col mt-2">
            <div class="card-col txt-right">
                        <a href="<?=url('dasboard.php')?>" class="btn-xs bg-primary">Kembali</a>
                     </div>
               <div class="card-md">
                  <div class="card-title card-flex">
                     <div class="card-col">
                        <h2>Detail Order</h2>	
                     </div>

                     <div class="card-col txt-right">
                        <h3 class="no-order"><small>No Order : </small><?= $data['or_dc_number']?></h3>	
                     </div>
                  </div>

                  <div class="card-body">
                     <form action="" method="post">
                        <input type="hidden" name="or_dc_number" value="<?=$data['or_dc_number']?>">
                        <div class="jdl-or">
                           <h4>Customer</h4>
                        </div>
                        <table class="tb-detail_customer">   
                           <tr>
                              <th>Nama</th>
                              <td><input type="text" name="nama_pel_dc" disabled value="<?=$data['nama_pel_dc']?>"></td>
                           </tr>

                           <tr>
                              <th>Nomor Telepon</th>
                              <td><input type="text" name="no_telp_dc" disabled value="<?=$data['no_telp_dc']?>"></td>
                           </tr>

                           <tr>
                              <th>Alamat</th>
                              <td>
                                 <textarea name="alamat_dc" disabled class="txt-area">
                                    <?=$data['alamat_dc']?>
                                 </textarea>
                              </td>
                           </tr>

                           <tr>
                              <th>Order Masuk</th>
                              <td><input type="text" name="tgl_masuk_dc" disabled value="<?=$data['tgl_masuk_dc']?>"></td>
                           </tr>

                           <tr>
                              <th>Diambil Pada</th>
                              <td><input type="text" name="tgl_keluar_dc" disabled value="<?=$data['tgl_keluar_dc']?>"></td>
                           </tr>
                           
                           <tr>
                              <th>Durasi Kerja</th>
                              <td><input type="text" name="waktu_kerja_dc" disabled value="<?=$data['waktu_kerja_dc']?>"></td>
                           </tr>

                           <tr>
                              <th>Jenis Layanan</th>
                              <td><input type="text" name="jenis_paket_dc" disabled value="<?=$data['jenis_paket_dc']?>"></td>
                           </tr>
                        </table>

                        <div class="mt-1"></div>
                        
                        <div class="jdl-or">
                           <h4>Order</h4>
                        </div>
                        
                        <table class="tb-detail_order">   
                           <tr>
                              <th>Jumlah</th>
                              <th>Harga Per-Pcs</th>
                              <th>Total Bayar</th>
                           </tr>

                           <tr>
                              <td><input type="text" name="berat_qty_dc" disabled value="<?=$data['berat_qty_dc'] . ' Pcs'?>"></td>
                              <td><input type="text" name="tarif_dc" disabled value="<?= 'Rp. ' . $data['tarif_dc']?>"></td>
                              <td><input type="text" name="total_bayar_dc" disabled value="<?= 'Rp. ' . $data['total_bayar_dc']?>"></td>
                           </tr>
                        </table>

                        <div class="details">
                           <h4 class="mb-01">Keterangan:</h4>
                           <p class="lead">
                              <textarea name="keterangan_dc" disabled class="txt-area">
                                 <?=$data['keterangan_dc']?>
                              </textarea>
                           </p>
                        </div>

                        <div class="form-footer_detail">
                           <div class="buttons">
                              <button type="submit" name="bayar_dc" class="btn-sm bg-primary">Bayar Sekarang</button>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

<?php require_once('../../_footer.php') ?>