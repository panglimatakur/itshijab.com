<?php defined('mainload') or die('Restricted Access'); ?>
<div class="form-group col-md-12">
	<?php 
        if(!empty($msg)){
            switch ($msg){
                case "1":
                    echo msg("Terimakasih <b>".@$nama_rec."</b>, Konfirmasi pembayaran berhasil diterima, silahkan menunggu beberapa saat untuk pengecekan hingga pengiriman pemesanan, yang akan kami konfirmasikan via email anda <code>".@$email_rec."</code>.","success");
                break;
                case "2":
                    echo msg("Pengisian Form Belum Lengkap","error");
                break;
                case "3":
                    echo msg("Maaf, nomor invoce ini tidak ditemukan, silahkan ulangi lagi","error");
                break;
            }
        }
    ?>
    <div class="features_items"><!--features_items-->
        <h2 class="title text-center">Konfirmasi Pembayaran</h2>
        <form method="post" action="" enctype="multipart/form-data" >
            <div class="col-md-12">
            	<div  style="margin:4px; text-align:center; padding:10px; border:4px solid #EFEFEF">
                	Live Screen Streaming Finance Next Feature
                </div>
            </div>

            <div class="form-group col-md-6">
                <label class="req">Nomor Invoice</label>
                <input type="text" name="noinvoice" id="noinvoice" value="<?php echo @$noinvoice; ?>"  class="form-control uppercase" />
            </div>
            <div class="form-group col-md-6">
                <label class="req">Jumlah Pembayaran</label>
                <input type="text" name="jml_bayar" id="jml_bayar" value="<?php echo @$jml_bayar; ?>" Required class="form-control" />
            </div>
            <div class="form-group col-md-6" >
                <label class="req">Nama Bank</label>
                <select name="nmbank"class="form-control" Required>
                <option value="">--PILIH BANK--</option>
                <?php while($dt_bank = $db->fetchNextObject($q_bank)){?>
                    <option value="<?php echo $dt_bank->ID_BANK_ACCOUNT; ?>" <?php if(!empty($nmbank)){?>selected<?php } ?>>
                        <?php echo $dt_bank->BANK_NAME; ?>
                    </option>
                <?php } ?>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label class="req">Nama Rekening</label>
                <input type="text" name="nmrek" id="nmrek" value="<?php echo @$nmrek; ?>" Required class="form-control uppercase" />
            </div>
            <div class="form-group col-md-6">
                <label class="req">Nomor Rekening</label>
                <input type="text" name="norek" id="norek" value="<?php echo @$norek; ?>" Required class="form-control" />
            </div>
            <div class="form-group col-md-6">
                <label class="req">Rekening Tujuan</label>
                <select name="nmbank_dest" id="nmbank_dest" class="form-control" Required/>
                <option value="">--PILIH BANK--</option>
                <?php while($dt_bank_dest = $db->fetchNextObject($q_bank_dest)){?>
                    <option value="<?php echo $dt_bank_dest->ID_BANK_ACCOUNT; ?>" <?php if(!empty($nmbank_dest)){?>selected<?php } ?>>
                        <?php echo $dt_bank_dest->BANK_NAME; ?>
                    </option>
                <?php } ?>
                </select>
            </div>
            <div class="col-md-12" id="bank_info"></div>
            <div class="form-group col-md-12">
                <button name="direction" type="submit" value="confirm" class="btn btn-primary">
                    <i class="fa fa-bell"></i> Konfirmasi Pembayaran
                </button>
                <input type="hidden" id="data_page" value="<?php echo $dirhost; ?>/<?php echo $ajax_dir; ?>/data.php"/>
                
            </div>
        </form>
    </div>    
    <div class="clearfix"></div>
</div>