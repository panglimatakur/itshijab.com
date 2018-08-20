<?php
$datas 		= array("id_category"=>@$id_category);
$results  	= $itshijab->viewProduct($datas); 
if(count($results) > 0){
foreach($results as &$datas){?>
	<div class="col-md-4">
		<div class="item-box item-box-list">
			<h3><?php echo ucwords($datas["nama"]); ?></h3>
			<div class="img-thumbnail">
				<div class="img-thumbnail-inner">
					<img src="<?php echo $datas['photo']; ?>" />
				</div>
			</div>
			<div class="price"><?php echo $itshijab->money("Rp.",$datas['harga']); ?></div>
			<div class="btn-item-box col-md-12 btn-group npl text-center">
				<a href="javascript:void()" class="btn btn-danger col-md-6 order" data-value="<?php echo $datas['id_product']; ?>">
					<i class="fa fa-shopping-cart"></i> Ke Troli
				</a>
				<a href="?page=item_detail&id_product=<?php echo $datas['id_product']; ?>" class="btn btn-warning col-md-6">
					<i class="fa fa-search"></i> Detail
				</a>
			</div>
		</div>
	</div>
<?php }
}else{?>
	<div class="alert alert-danger">Maaf, Produk untuk kategori ini belum terdaftar</div>
<?php }
?>
