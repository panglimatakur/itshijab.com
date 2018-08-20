<link href="<?php echo $dirhost; ?>/libraries/prettify/css/prettify.css" rel="stylesheet" />
<div class="row">

    <h2 class="title text-center">Panduan API <?php echo $website_name; ?></h2>
        <div class="col-md-12">
                


Konfigurasi Halaman: <a href="<?php echo $dirhost."/api/v1/api.rar"; ?>">Download API</a><br /><br />

<pre class="pre-scrollable prettyprint linenums">
include ("ithijab_api.php");  
$api_key = "api_key_kamu";
  
//contoh :  $api_key = "0GT528RT6728E937RG";     
</pre>
<br />
<br />
<h2 class="title text-center" style="margin-left:0">Menampilkan Produk</h2>


Input :<br /><br />
<pre class="pre-scrollable prettyprint linenums">
//Menampilkan semua produk
$result = $itshijab->viewProduct(); 

//Menampilkan produk berdasarkan variable tertentu 
$datas  = array("nama"=>$nama,
	       "code"=>$code,
               "deskripsi"=>$deskripsi,
               "harga"=>$harga,
               "diskon"=>$diskon);
$result  = $itshijab->viewProduct($datas);  

//Menampilkan semua produk dengan batasan  (paging)
$datas   = array("limit"=>"$urutan_mulai_pengambilan_data,$jumlah_data_yang_ditampilkan");
$result  = $itshijab->viewProduct($datas);  



</pre>
<br />
Contoh Menampilkan Semua Produk:<br /><br />
<pre class="pre-scrollable prettyprint linenums">
include ("ithijab_api.php");  
$api_key = "0GT528RT6728E937RG";

$result  = $itshijab->viewProduct();   
foreach($result as &$data){
  print "&lt;pre&gt;";
  print_r($data); 
  print "&lt;/pre&gt;";
}
</pre>
<br />
Contoh enampilkan produk berdasarkan nama produk:<br /><br />
<pre class="pre-scrollable prettyprint linenums">
include ("ithijab_api.php");  
$api_key = "0GT528RT6728E937RG";

$datas   = array("nama"=>"Chloe Marun");
$result  = $itshijab->viewProduct($datas);   
foreach($result as &$data){
  print "&lt;pre&gt;";
  print_r($data); 
  print "&lt;/pre&gt;";
}
</pre>
<br />
Contoh menampilkan produk berdasarkan code produk:<br /><br />
<pre class="pre-scrollable prettyprint linenums">
include ("ithijab_api.php");  
$api_key = "0GT528RT6728E937RG";

$datas   = array("code"=>"CH0003");
$result  = $itshijab->viewProduct($datas);   
foreach($result as &$data){
  print "&lt;pre&gt;";
  print_r($data); 
  print "&lt;/pre&gt;";
}
</pre>
<br />
Contoh menampilkan produk berdasarkan harga produk:<br /><br />
<pre class="pre-scrollable prettyprint linenums">
include ("ithijab_api.php");  
$api_key = "0GT528RT6728E937RG";

$datas   = array("harga"=>"70000");
$result  = $itshijab->viewProduct($datas);   
foreach($result as &$data){
  print "&lt;pre&gt;";
  print_r($data); 
  print "&lt;/pre&gt;";
}
</pre>

<br />
Contoh menampilkan produk berdasarkan nama dan code produk:<br /><br />
<pre class="pre-scrollable prettyprint linenums">
include ("ithijab_api.php");  
$api_key = "0GT528RT6728E937RG";

$datas   = array("nama"=>"Chloe Marun","code"=>"CH0003");
$result  = $itshijab->viewProduct($datas);   
foreach($result as &$data){
  print "&lt;pre&gt;";
  print_r($data); 
  print "&lt;/pre&gt;";
}
</pre>
<br />
Contoh menampilkan produk berdasarkan nama dan harga produk:<br /><br />
<pre class="pre-scrollable prettyprint linenums">
//Menampilkan produk berdasarkan nama dan harga produk
$datas   = array("nama"=>"Chloe Marun","harga"=>"200000");
$result  = $itshijab->viewProduct($datas);   
foreach($result as &$data){
  print "&lt;pre&gt;";
  print_r($data); 
  print "&lt;/pre&gt;";
}
</pre>
<br />
Contoh menampilkan produk berdasarkan opsi dengan batasan tertentu (paging):<br /><br />

<pre class="pre-scrollable prettyprint linenums">
//Menampilkan semua produk dengan batasan  (paging)
$datas   = array("nama"=>"Chloe Marun",
		 "harga"=>"200000",
                 "limit"=>"0,10");
$result  = $itshijab->viewProduct($datas);   
foreach($result as &$data){
  print "&lt;pre&gt;";
  print_r($data); 
  print "&lt;/pre&gt;";
}
</pre>&gt;
<br /><br />
<h2 class="title text-center" style="margin-top:10px">Menampilkan Kategori Produk</h2>
Input :<br /><br />
<pre class="pre-scrollable prettyprint linenums">
$result  = $itshijab->viewProductCategory();   
foreach($result as &$data){
  print "&lt;pre&gt;";
  print_r($data); 
  print "&lt;/pre&gt;";
}
</pre>
<br />
Contoh :<br /><br />
<pre class="pre-scrollable prettyprint linenums">
include ("ithijab_api.php");  
$key 	 = "0GT528RT6728E937RG";
$result  = $itshijab->viewProductCategory();   
foreach($result as &$data){
  print "&lt;pre&gt;";
  print_r($data); 
  print "&lt;/pre&gt;";
}
</pre>


<br /><br />
<h2 class="title text-center" style="margin-top:10px">Menampilkan Satuan Produk</h2>
Input :<br /><br />
<pre class="pre-scrollable prettyprint linenums">
$result  = $itshijab->viewProductUnit();   
foreach($result as &$data){
  print "&lt;pre&gt;";
  print_r($data); 
  print "&lt;/pre&gt;";
}
</pre>
<br />
Contoh :<br /><br />
<pre class="pre-scrollable prettyprint linenums">
include ("ithijab_api.php");  
$key 	 = "0GT528RT6728E937RG";

$result  = $itshijab->viewProductUnit();   
print_r($result);
</pre>


		</div>
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
