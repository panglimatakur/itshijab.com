<?php defined('mainload') or die('Restricted Access'); ?>
 <div id="contact-page" class="container">
    <div class="bg">
        <div class="row">    		
            <div class="col-sm-12">    			   			
                <h2 class="title text-center">Contact <strong>Us</strong></h2>  
                
				<?php 
                    if(!empty($msg)){
                        switch ($msg){
                            case "1":
                                echo msg("Terimakasih, pesan anda berhasil dikirim, silahkan menunggu respon selanjutnya","success");
                            break;
                            case "3":
                                echo msg("Pengisian Form Belum Lengkap","error");
                            break;
                        }
                    }
                ?>
                <div id="gmap" class="contact-map">
                    <div id="map">
                    
                        <?php echo $client_map; ?>
            
                    </div>
                </div>
            </div>			 		
        </div>    	
        <div class="row">  	
            <div class="col-sm-8">
                <div class="contact-form">
                    <h2 class="title text-center">Get In Touch</h2>
                    <div class="status alert alert-success" style="display: none"></div>
                    <form id="main-contact-form" class="contact-form row" name="contact-form" method="post">
                        <div class="form-group col-md-6">
                            <input type="text" name="email_name" id="email_name" value="<?php echo @$email_name; ?>" class="form-control" required placeholder="Name" />
                        </div>
                        <div class="form-group col-md-6">
                            <input type="email" name="email_email" id="email_email"  class="form-control" value="<?php echo @$email_email; ?>" required placeholder="Email">
                        </div>
                        <div class="form-group col-md-12">
                            <input type="text" name="email_subject" id="email_subject" class="form-control" value="<?php echo @$email_subject; ?>" required placeholder="Subject">
                        </div>
                        <div class="form-group col-md-12">
                            <textarea name="email_msg" id="email_msg" required class="form-control" rows="8" placeholder="Tulis pesan anda disini" style="height:200px"><?php echo @$email_msg; ?></textarea>
                           
                        </div>                        
                        <div class="form-group col-md-12">
                            <button type="submit" name="direction" class="btn btn-primary pull-right" value="send">Kirim Pesan</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="contact-info">
                    <h2 class="title text-center">Contact Info</h2>
                    <address>
                        <p><h2><?php echo @$client_name; ?></h2></p>
                        <?php if(!empty($client_address)){?>
                        	<p><strong>Alamat:</strong> <br />
								<?php echo @$client_address; ?></p>
                        <?php } ?>
                        <?php if(!empty($client_phone)){?>
                        	<p><strong>Mobile:</strong> <br />
								<?php echo @$client_phone; ?></p>
                        <?php } ?>
                        <?php if(!empty($client_email)){?>
                        	<p><strong>Email:</strong> <br />
								<?php echo @$client_email; ?></p>
                        <?php } ?>
                    </address>
                    <div class="social-networks">
                        <h2 class="title text-center">Social Networking</h2>
                        <ul>
                            <li>
                                <a href="#"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-google-plus"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-youtube"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>    			
        </div>  
    </div>	
</div><!--/#contact-page-->




