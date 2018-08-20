<?php defined('mainload') or die('Restricted Access'); ?>
<div class="col-md-12" >
    <div class="x_panel">
        <div class="x_title">
            <h2>Form <span class="title-highlight">Pencarian</span></h2>
            <div class="clearfix"></div>
        </div>
        <form method="post" action="" >
          <div class="form-group col-md-6">
                <label>Status Transaksi</label>
                  <select name="statlun" class="form-control">
                    <?php while($dt_status = $db->fetchNextObject($q_product_status)){
							$status = $dt_status->ID_TRANSACTION_STATUS;
					?>
                    	<option value='<?php echo $status; ?>' 
								<?php if(!empty($statlun) && $statlun == $status){?> selected <?php } ?>>
								<?php echo $dt_status->NAME; ?>
                        </option>
                    <?php } ?>
                  </select>
          </div>
          <div class="form-group col-md-6">
                <button type="submit" class="btn btn-primary" style="margin-top:25px">Lihat Data</button>
          </div>
        </form>
	</div>
</div>   
<div id="vera"></div>
<div class="col-md-12" >
    <?php if($num_purchase > 0){?>
    <div class="x_panel">
        <a name="report"></a>
        <div class="x_content">
            <div class="x_title">
                <h2>Daftar <span class="title-highlight">Pemesanan</span> Online</h2>
                <div class="clearfix"></div>
            </div>
            <table width="100%" class="table table-data table-stripped table-bordered responsive-utilities jambo_table" id="table_data">
                <thead>
                    <tr>
                      <th width="740">&nbsp;</th>
                      <th width="156" style='text-align:center'>ACTION</th>
                    </tr>
                </thead>
                <tbody>
            <?php  while($dt_purchase = $db->fetchNextObject($q_purchase)){ 
					$q_product_status_tbl = $db->query("SELECT * FROM ".$tpref."transaction_status_master 
														ORDER BY ID_TRANSACTION_STATUS");
					@$email_pengguna 	= $dt_purchase->USER_EMAIL;
					@$status_bayar	= $db->fob("NAME",$tpref."transaction_status_master"," WHERE ID_TRANSACTION_STATUS = '".$dt_purchase->PAID_STATUS."'");
			?>
                  <tr id="div_<?php echo $dt_purchase->ID_PURCHASE; ?>">
                    <td valign="top">
                        <div class="col-md-3"> 
							<div class="form-group">
                            	<label>No Invoice</label><br />
								<code><?php echo @$dt_purchase->PAYMENT_CODE; 		?></code>
                            </div>
                            <div class="form-group">
                            	<label>Nama Penerima</label><br />
								<code><?php echo @$dt_purchase->RECIEVER_NAME; 		?></code> 
                            </div>
                            <div class="form-group">
                            	<label>Email Penerima</label><br />
								<code><?php echo @$email_pengguna; 					?></code>
                            </div>
                            <div class="form-group">
                            	<label>Alamat Penerima</label><br />
								<code><?php echo @$dt_purchase->TO_ADDRESS; 		?></code> 
                            </div>
                            <div class="form-group">
                            	<label>No.HP Penerima</label><br />
								<code><?php echo @$dt_purchase->RECIEVER_CONTACT; 		?></code> 
                            </div>
                        </div>
                        <div class="col-md-3"> 
							<div class="form-group">
                            	<label>Jumlah Bayar</label><br />
								<code><?php echo money("Rp.",@$dt_purchase->PAID); 	?></code>
                            </div>
                            <div class="form-group">
                            	<label>Tipe Pengiriman</label><br />
								<code>JNE <?php echo @$dt_purchase->DELIVERY_TYPE; 		?></code>
                            </div>
                            <div class="form-group">
                            	<label>Ongkos Kirim</label><br />
								<code><?php echo money("Rp.",@$dt_purchase->DELIVERY_FEE); 	?></code>
                            </div>
                            <div class="form-group">
                            	<label>Total Bayar</label><br />
								<code><?php echo money("Rp.",@$dt_purchase->PAID_TOTAL); 	?></code>
                            </div>
                            <div class="form-group">
                            	<label>Status Bayar</label><br />
								<code><?php echo @$status_bayar; 					?></code>
                            </div>
                        </div>
                        <div class="col-md-3"> 
                            <div class="form-group">
                            	<label>Bank Tujuan</label><br />
								<code><?php echo @$dt_purchase->TO_ID_BANK_ACCOUNT; 		?></code>
                            </div>
                            <div class="form-group">
                            	<label>Nama Bank</label><br />
								<code><?php echo @$dt_purchase->BANK_NAME; 			?></code>
                            </div>
                            <div class="form-group">
                            	<label>Nama Rekening</label><br />
								<code><?php echo @$dt_purchase->BANK_ACCOUNT_NAME; 	?></code>
                            </div>
                            <div class="form-group">
                            	<label>Nomor Rekening</label><br />
								<code><?php echo @$dt_purchase->BANK_ACCOUNT_NUMBER;?></code>
                            </div>
                            <div class="form-group">
                            	<label>Waktu Bayar</label><br />
								<code><?php echo @$dt_purchase->PAID_DATETIME; 		?></code>
                            </div>
                        </div>
                        <div class="col-md-3"> 
                            <div class="form-group">
                            	<label>Informasi Tambahan</label><br />
								<code><?php echo @$dt_purchase->ADDITIONAL_INFO; 	?></code>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span id="v_loader_<?php echo $dt_purchase->ID_PURCHASE; ?>"></span>
                        <select id="st_<?php echo $dt_purchase->ID_PURCHASE; ?>" 
                        		onchange="set_status('<?php echo $dt_purchase->ID_PURCHASE; ?>')" 
                                style='margin-top:6px;'
                                class="form-control">
								<?php while($dt_status_tbl = $db->fetchNextObject($q_product_status_tbl)){
                                        $status = $dt_status_tbl->ID_TRANSACTION_STATUS;
                                ?>
                                    <option value='<?php echo $status; ?>' 
                                            <?php if($status == $dt_purchase->PAID_STATUS){?> selected <?php } ?>>
                                            <?php echo $dt_status_tbl->NAME; ?>
                                    </option>
                                <?php } ?>
                        </select>
                    </td>
                  </tr>
            <?php } ?>
                </tbody>
            </table>
        
            <input type="hidden" id="data_page" value="<?php echo $dirhost; ?>/<?php echo $ajax_dir; ?>/data.php"/>
            <input type="hidden" id="proses_page" value="<?php echo $dirhost; ?>/<?php echo $ajax_dir; ?>/proses.php"/>
            <footer>
                <form id="form_paging" class="formular" action="#report" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="direction" value="show" />
                <?php //echo pfoot($str_query,$link_str); ?>       
                </form>
            </footer>
    	</div>
    </div>
    <?php }else{ ?>
        <div class="alert alert-error">Tidak ada daftar transaksi yang terjadi saat ini</div>
    <?php }?>

</div>