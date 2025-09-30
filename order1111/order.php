<?php require_once('../_header.php')?>

   <div class="main-content" id="id_order">
      <div class="container">
         <div class="baris">
            <div class="col mt-2">
               <div class="card">
                  <div class="card-title card-flex">
                     <div class="card-col">
                        <h2>Tambah Order Baru</h2>	
                     </div>
                     
                     <div class="card-col txt-right">
                        <a href="<?=url()?>" class="btn-xs bg-primary">Kembali</a>
                     </div>
                  </div>

                  <div class="card-body mt-2">
                     <div class="col">
                        <div class="order-sub-judul txt-center">
                           <h3 class="mb-1">Pilih Paket</h3>
                        </div>

                        <div class="container-paket">
                           <div class="col-paket">
                              <a href="<?=url('order/order_ck.php')?>" class="paket">
                                 <img src="<?=url('_assets/img/komplit.jpg')?>" alt="Cuci Komplit" width="160">
                                 <h4>Cuci Komplit</h4>
                              </a>
                           </div>

                           <div class="col-paket">
                              <a href="<?=url('order/order_dc.php')?>" class="paket">
                                 <img src="<?=url('_assets/img/Outer.jpg')?>" alt="Outer" width="160">
                                 <h4>Cuci Luar</h4>
                              </a>
                           </div>

                           <div class="col-paket">
                              <a href="<?=url('order/order_cs.php')?>" class="paket">
                                 <img src="<?=url('_assets/img/Inner.jpg')?>" alt="Inner" width="160">
                                 <h4>Cuci Dalam</h4>
                              </a>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

<?php require_once('../_footer.php')?>