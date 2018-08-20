<div class="col-md-12">
	<?php
    $datas 		= array("id_product"=>$id_product);
    $results  	= $itshijab->viewProduct($datas); 
    foreach($results as &$datas){?>
        <div class="item-box item-box-single">
            <div class="col-md-5">
                <div class="img-thumbnail" style="width:100%; height:auto">
                    <div class="img-thumbnail-inner">
                        <img src="<?php echo $datas['photo']; ?>" width="100%"/>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <h3><?php echo ucwords($datas["nama"]); ?></h3>
                <label>Harga</label><br>
                <div class="price"><?php echo $itshijab->money("Rp.",$datas['harga']); ?></div>
                <label>Deskripsi</label><br>
                <div class="text-justify"><?php echo $datas['deskripsi']; ?></div>
                <br>
                <a href="javascript:void()" class="btn btn-danger btn-block col-md-6 order">
                    <i class="fa fa-shopping-cart"></i> Ke Troli
                </a>
            </div>
            <div class="clearfix"></div>
        </div>
    <?php } ?>
</div>

<h2 class="title col-md-12 text-center">Produk Lainnya</h2>

<?php
$datas		= array("limit"=>"0,6");
$results  	= $itshijab->viewProduct($datas); 
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
<?php } ?>
