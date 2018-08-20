<?php
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	session_start();
	if(!empty($_SESSION['uidkey'])){
		if(!defined('mainload')) { define('mainload','ALIBABA',true); }
		include_once("../../../../includes/config.php");
		include_once("../../../../includes/classes.php");
		include_once("../../../../includes/functions.php");
	}else{
		defined('mainload') or die('Restricted Access');	
	}
}else{
	defined('mainload') or die('Restricted Access');
}

$id_client_user_level   = isset($_REQUEST['id_client_user_level']) ? $sanitize->number($_REQUEST['id_client_user_level']) : "";
//========================================================== LINK CHILDREN =======================//
	function lchild($parent){
		global $tpref;
		global $db;
		global $lparam;
		global $ajax_dir;
		global $id_client_user_level;
		global $r;
		
		$qlink 	= $db->query("SELECT PAGE,ID_PAGE_CLIENT,NAME FROM system_pages_client WHERE ID_PARENT='".$parent."' ORDER BY DEPTH ASC, SERI ASC");
		$jml 	= $db->numRows($qlink);
		if($jml>0){
	?>
			<ul>
	<?php
			while($dt = $db->fetchNextObject($qlink)){
				$r++;
				$id_page	= $dt->ID_PAGE_CLIENT;
				$chakses 	= $db->recount("SELECT ID_RIGHTACCESS FROM system_pages_client_rightaccess WHERE ID_PAGE_CLIENT = '".$dt->ID_PAGE_CLIENT."' AND ID_CLIENT_USER_LEVEL = '".$id_client_user_level."'");
			?>
				<li style='padding-top:0'>
				   <input type="checkbox" name='id_halaman[<?php echo $r; ?>]' value='<?php echo $id_page; ?>' <?php if($chakses>0){ ?> checked <?php } ?> style='margin-top:0'><small><?php echo $r; ?> - <?php echo $dt->NAME; ?></small>
					<input type='hidden'  name='ori_page_id[<?php echo $r; ?>]' value='<?php echo $id_page; ?>' /> 
				   <?php echo lchild($id_page); ?>
				</li>
			<?php
			}
	?>
		</ul>
	<?php
		
		}
	}
//========================================================== END OF LINK CHILDREN =======================//
?>
        <div class='alert alert-info' style="margin:5px">
            Beri tanda centang pada daftar menu Modul dibawah ini, yang menunjukan halaman mana yang bisa di akses oleh level pengguna 
        </div>
        <ul id="tree2">
        <?php
        $r = 0;
        $qlink = $db->query("SELECT PAGE,ID_PAGE_CLIENT,NAME FROM system_pages_client WHERE ID_PAGE_CLIENT IS NOT NULL AND ID_PARENT='0' AND ID_MODULE = '2' ORDER BY DEPTH ASC, SERI ASC");
        while($dt = $db->fetchNextObject($qlink)) {
            $r++;
            $id_page 		= $dt->ID_PAGE_CLIENT;
            $chakses = $db->recount("SELECT ID_RIGHTACCESS FROM system_pages_client_rightaccess WHERE ID_PAGE_CLIENT = '".$dt->ID_PAGE_CLIENT."' AND ID_CLIENT_USER_LEVEL = '".$id_client_user_level."'");
            ?>
                <li style='padding-top:0'>
                <b>
                    <input type="checkbox" name='id_halaman[<?php echo $r; ?>]' value='<?php echo $id_page; ?>' <?php if($chakses > 0){ ?> checked <?php } ?> style='margin-top:0'><small><?php echo $r; ?> - <?php echo $dt->NAME; ?></small>
                    <input type='hidden'   name='ori_page_id[<?php echo $r; ?>]' value='<?php echo $id_page; ?>' />
                </b>
                <?php echo lchild($dt->ID_PAGE_CLIENT); ?>
                </li>   
        <?php
        }
        ?>	
        </ul>
        <div class='form-group'>
            <button type="submit" name="direction" class="btn btn-primary" value="insert">Simpan Data</button>
            <input type="hidden" name="jmlpage" value="<?php echo $r; ?>" />
        </div>
