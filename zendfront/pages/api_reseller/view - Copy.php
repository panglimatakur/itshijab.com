<?php defined('mainload') or die('Restricted Access'); ?>


<link href="<?php echo $dirhost; ?>/libraries/prettify/css/prettify.css" rel="stylesheet" />
<div class="row">

    <h2 class="title text-center">Panduan API <?php echo $website_name; ?></h2>
        <div class="col-md-12">
        <h3>Authentifikasi</h3>
        Untuk dapat menggunakan menampilkan item-item produk itshijab.com di website atau blog anda, anda dapat menggunakan API di bawah ini<br><br>
        <pre class="prettyprint">http://itshijab.com/api/?api_key=kode_api_kamu_disini</pre>
    </div>
    <h2 class="title text-center">Menampilkan Katalog</h2>
    <div class="col-md-12">
     Untuk dapat  menampilkan item-item produk itshijab.com di website atau blog anda, anda dapat menggunakan API di bawah ini<br><br>
     
     <h3>Menampilkan Semua Katalog Produk <?php echo $website_name; ?></h3>
     Untuk dapat menampilkan seluruuh item-item produk itshijab.com di website atau blog anda, anda dapat menggunakan API di bawah ini<br><br>
     Javascript :  
        <pre class="pre-scrollable prettyprint linenums">
$.ajax({
    url 		: "http://itshijab.com/api/?api_key=kode_api_kamu_disini",
    type		: "GET",
    dataType		: "jsonp",
    jsonpCallback	: "mycallback",
    data 		: {"fetch":"all_product","api_key":kode_api_kamu_disini}, 
    success 		: function(response){

    }
})	
        </pre>
    </div>
    
    <br />
    <br />

</div>


<script type="text/javascript" src="<?php echo $dirhost; ?>/libraries/prettify/js/prettify.js"></script>
<script src="<?php echo $dirhost; ?>/libraries/prettify/js/bootstrap-modalmanager.js"></script>
<script src="<?php echo $dirhost; ?>/libraries/prettify/js/bootstrap-modal.js"></script>
<script type="text/javascript">

  $(function(){
    $.fn.modalmanager.defaults.resize = true;
    $('[data-source]').each(function(){
      var $this = $(this),
        $source = $($this.data('source'));
      var text = [];
      $source.each(function(){
        var $s = $(this);
        if ($s.attr('type') == 'text/javascript'){
          text.push($s.html().replace(/(\n)*/, ''));
        }else{
          text.push($s.clone().wrap('<div>').parent().html());
        }
      });
      $this.text(text.join('\n\n').replace(/\t/g, '    '));
    });
    prettyPrint();
  });
</script>
