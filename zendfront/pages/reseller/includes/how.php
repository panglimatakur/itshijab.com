<?php defined('mainload') or die('Restricted Access'); ?>
<div class="col-sm-12" style="text-align:justify">
    <h2 class="title text-center">Bagaimana tugas<br /> dan caranya?</h2>
    <div class="col-sm-11">
    <p>Pada dasarnya anda hanya perlu menyebarkan link itshijab.com yang sudah diberi ID Unik anda, bisa dalam betuk BANNER ataupun dalam bentuk TEXT, bisa menggunakan website atau blog yang anda miliki, atau bahkan menggunakan media sosial yang anda miliki</p>
    <ol>
    	<li>
            <p>
                <b>Contoh link <?php echo $website_name; ?> berbentuk TEXT yang anda sebarkan : </b><br />
                <code><?php echo $dirhost; ?>/username.anda</code><br />
            </p> 
        </li>
        <li>
            <p>
                <b>Contoh link berbentuk BANNER yang anda tempelkan di website / blog atau bahkan bisa anda tempelkan di website-website yang mendukung pemasangan kode HTML Banner: </b><br />
<pre><?php echo htmlspecialchars('
<a href="'.$dirhost.'/username.anda" target="_blank">
<img src="'.$dirhost.'/files/images/banners/hijab-banner2.jpg" width="60%"/>
</a>'); ?>
</pre>
                Dan akan terlihat hasilnya seperti di bawah ini<br /><br />
                <a href="<?php echo $dirhost; ?>/username.anda" target="_blank">
                    <img src="<?php echo $dirhost; ?>/files/images/banners/hijab-banner2.jpg" width="60%"/>
                </a>                
            </p>
        </li>
    	<li>
            <p>
            	Sedangkan untuk link yang langsung menuju detail/spesifikasi produk, contoh format URL yang bisa anda gunakan, bisa dilihat seperti dibawah ini<br /><br />
                <b>Contoh link berbentuk TEXT yang anda gunakan : </b><br />
                <code><?php echo $dirhost; ?>/detail/13/username.anda</code><br />
           </p>
           <p>
                <b>Contoh link berbentuk BANNER yang anda tempelkan di website / blog atau bahkan bisa anda tempelkan di website-website yang mendukung pemasangan kode HTML Banner: </b><br />
            </p> 
            <p>
<pre><?php echo htmlspecialchars('
<a href="'.$dirhost.'/me/username.anda/id_produk_afiliasi" target="_blank">
<img src="'.$dirhost.'/files/images/banners/hijab-product-banner1.jpg" width="60%"/>
</a>'); ?>
</pre>
                Dan akan terlihat hasilnya seperti di bawah ini<br />
                <a href="www.itshijab.com/me/username.anda/id_produk_afiliasi" target="_blank">
                    <img src="<?php echo $dirhost; ?>/files/images/banners/hijab-product-banner1.jpg" width="30%"/>
                </a>
            </p>
            Link-link format URL ini akan bisa anda liat di dalam halaman control panel itshijab.com, saat anda login, dan anda hanya perlu menyalin format URL tersebut untuk di taruh di website atau Blog anda.
        </li>
        
    </ol>
    </div>
    <h2 class="title text-center">Skema Browser</h2>
    <div class="col-sm-11">
    <p>Dapatkan komisi hingga 10% pda setiap order yang telah di validasi dari ITS-Hijab dengan jutaan pilihan produk untuk diiklankan.</p>
    <img src="<?php echo $dirhost; ?>/files/images/browser.png" width="100%"/>

    </div>
</div>



