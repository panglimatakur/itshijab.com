<?php defined('mainload') or die('Restricted Access'); ?>
<div id="content-page" class="span9 content group">
    <div class="page type-page status-publish group">
        <div class="col-md-12">
    
            <?php 
                if(!empty($msg)){
                    switch ($msg){
                        case "1":
                            echo msg("Data Berhasil Disimpan","success");
                        break;
                        case "2":
                            echo msg("Pengisian Form Belum Lengkap","error");
                        break;
                    }
                }
            ?>
            <div class="tabs-container t-box shadow ">
                <ul class="tabs">
                    <li><h4><a href="#tab1" title="Services">Form Partner</a></h4></li>
                    <li><h4><a href="#tab2" title="Customers">Filtering Partner</a></h4></li>
                </ul>
                <div class="border-box group">
                    <div id="tab1" class="panel group">
                        <p><?php include $call->inc($page_dir."/includes","form_proses.php"); ?></p>
                    </div>
                    <div id="tab2" class="panel group">
                        <p><?php include $call->inc($page_dir."/includes","form_report.php"); ?></p>
                    </div>
                </div>
            </div>
            <input id="proses_page" type="hidden"  value="<?php echo $ajax_dir; ?>/proses.php" />
            <input id="data_page" type="hidden"  value="<?php echo $ajax_dir; ?>/data.php" />

            <a name="report"></a>
            <?php if($num_partner > 0){ ?>
            <table width="100%" class="table table-striped">
                <thead>
                    <tr>
                        <th width="20" class="table_checkbox" style="width:13px">
                            <input type="checkbox" id="select_rows" class="select_rows"/>
                        </th>
                        <th width="852">Nama</th>
                        <th width="852">Alamat</th>
                        <th width="852">Phone</th>
                        <th width="852">Email/Website</th>
                        <th width="116">Actions</th>
                    </tr>
                </thead>
                <tbody>
                      <?php while($dt_partner	= $db->fetchNextObject($q_partner)){ 
                      ?>
                      <tr id="tr_<?php echo $dt_partner->ID_PARTNER; ?>">
                        <td><input type="checkbox" name="row_sel" class="row_sel" value='<?php echo $dt_partner->ID_PARTNER; ?>'/></td>
                        <td><?php echo @$dt_partner->PARTNER_NAME; ?></td>
                        <td>
                            <?php echo @$dt_partner->PARTNER_ADDRESS; ?><br />
                            <?php echo @$db->fob("NAME","system_master_location"," WHERE ID_LOCATION='".$dt_partner->PARTNER_PROVINCE."'"); ?><br />
                            <?php echo @$db->fob("NAME","system_master_location"," WHERE ID_LOCATION='".$dt_partner->PARTNER_CITY."'"); ?>
                        </td>
                        <td>
                            <?php echo @$dt_partner->PARTNER_PHONE; ?><br />
                            <?php echo @$dt_partner->PARTNER_PERSON_CONTACT; ?>
                        </td>
                        <td>
                            <?php echo @$dt_partner->PARTNER_EMAIL; ?><br />
                            <?php echo @$dt_partner->PARTNER_URL; ?>
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="<?php echo $lparam; ?>&direction=edit&no=<?php echo $dt_partner->ID_PARTNER; ?>" class="btn btn-mini" title="Edit">
                                    <i class="icon-pencil"></i>
                                </a>
                                <a href='javascript:void()' onclick="removal('<?php echo $dt_partner->ID_PARTNER; ?>')" class="btn btn-mini" title="Delete">
                                    <i class="icon-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>    
                </tbody>
            </table>
            <?php }else{
                echo "<br>";
                echo msg("Tidak Ada Supplier Yang Terdaftar","error");
            } ?>
            <div class="w-box-footer">
                <form id="form_paging" class="formular" action="#report" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="nama_report" value="<?php echo @$nama_report; ?>" />
                <input type="hidden" name="alamat_report" value="<?php echo @$alamat_report; ?>" />
                <input type="hidden" name="tlp_report" value="<?php echo @$tlp_report; ?>" />
                <input type="hidden" name="kontak_report" value="<?php echo @$kontak_report; ?>" />
                <input type="hidden" name="email_report" value="<?php echo @$email_report; ?>" />
                <input type="hidden" name="website_report" value="<?php echo @$website_report; ?>" />
                <input type="hidden" name="direction" value="show" />
                <?php echo pfoot($str_query,$link_str); ?>       
                </form>
            </div>
        
            <br clear="all" />
         </div>
        
      </div>
</div>
