<?php
$message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
$message .= '<html xmlns="http://www.w3.org/1999/xhtml">';
$message .= '<head>';
$message .= '<meta name="viewport" content="width=device-width" />';
$message .= '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
$message .= '<title>ZURBemails</title>';
$message .= '
<style type="text/css">
.main-table{
	border:1px solid #DB7963;
	border-radius:3px;
	-moz-border-radius:3px;
	-webkit-border-radius:3px;	
	width: 100%;
}
.btn {
	text-decoration:none;
	color: #FFF;
	background-color: #DB7963;
	padding:10px 16px;
	font-weight:bold;
	margin-right:10px;
	text-align:center;
	cursor:pointer;
	display: inline-block;
}

p.callout {
	padding:15px;
	background-color:#ECF8FF;
	margin-bottom: 15px;
}
.callout a {
	font-weight:bold;
	color: #2BA6CB;
}

table.social {
/* 	padding:15px; */
	background-color: #ebebeb;
	
}
.social .soc-btn {
	padding: 3px 7px;
	font-size:12px;
	margin-bottom:10px;
	text-decoration:none;
	color: #FFF;font-weight:bold;
	display:block;
	text-align:center;
}
a.fb { background-color: #3B5998!important; }
a.tw { background-color: #1daced!important; }
a.gp { background-color: #DB4A39!important; }
a.ms { background-color: #000!important; }

/* ------------------------------------- 
		HEADER 
------------------------------------- */
table.head-wrap { width: 100%; background-color:#DB7963;}
.header.container table td.logo { padding: 15px; }
.header.container table td.label { padding: 15px; padding-left:0px;}

/* ------------------------------------- 
		BODY 
------------------------------------- */
table.body-wrap { width: 100%;}
/* ------------------------------------- 
		FOOTER 
------------------------------------- */
table.footer-wrap { width: 100%;color:#FFF; background-color:#DB7963; clear:both!important;
}
table.footer-wrap a{ color:#FFF; text-decoration:none; }
.footer-wrap .container td.content  p { border-top: 1px solid rgb(215,215,215); padding-top:15px;}
.footer-wrap .container td.content p {
	font-size:10px;
	font-weight: bold;
}

/* ------------------------------------- 
		TYPOGRAPHY 
------------------------------------- */
h1,h2,h3,h4,h5,h6 {
font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif; line-height: 1.1; margin-bottom:15px; color:#000;
}
h1 small, h2 small, h3 small, h4 small, h5 small, h6 small { font-size: 60%; color: #6f6f6f; line-height: 0; text-transform: none; }

h1 { font-weight:200; font-size: 44px;}
h2 { font-weight:200; font-size: 37px;}
h3 { font-weight:500; font-size: 27px;}
h4 { font-weight:500; font-size: 23px;}
h5 { font-weight:900; font-size: 17px;}
h6 { font-weight:900; font-size: 14px; text-transform: uppercase; color:#444;}

.collapse { margin:0!important;}
p, ul { 
	margin-bottom: 10px; 
	font-weight: normal; 
	font-size:12px; 
	line-height:1.6;
}
p.lead { font-size:12px; }
p.last { margin-bottom:0px;}
ul li {
	margin-left:5px;
	list-style-position: inside;
}
/* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
.container {
	display:block!important;
	max-width:800px!important;
	margin:0 auto!important; /* makes it centered */
	clear:both!important;
}
/* This should also be a block element, so that it will fill 100% of the .container */
.content {
	margin:0 auto;
	display:block; 
}

/* Odds and ends */
.column {
	width: 300px;
	float:left;
}
.column tr td { padding: 15px; }
.column-wrap { 
	padding:0!important; 
	margin:0 auto; 
	max-width:600px!important;
}
.column table { width:100%;}
.social .column {
	width: 280px;
	min-width: 279px;
	float:left;
}
.tag_line{
	color:#fff;
	font-size:28px;	
	font-weight:bold;
	text-align:center;
	font-family:\'Century Gothic\'
}
/* Be sure to place a .clear element after each set of columns, just to be safe */
.clear { display: block; clear: both; }
@media only screen and (max-width: 600px) {
	.tag_line{
		font-size:18px;	
	}
	a[class="btn"] { display:block!important; margin-bottom:10px!important; background-image:none!important; margin-right:0!important;}

	div[class="column"] { width: auto!important; float:none!important;}
	
	table.social div[class="column"] {
		width:auto!important;
	}

}
</style>
';
$message .= '</head>';
$message .= '<body bgcolor="#FFFFFF">';
$message .= '
<table class="main-table">
	<tr>
		<td>
		
			<table class="head-wrap">';
$message .= '	<tr>';
$message .= '		<td class="header container">';
$message .= '			<table>';
$message .= '				<tr>';
$message .= '					<td style="width:40%">
									<a href="'.$dirhost.'" target="_blank">
										<img src="'.$web_ftpl_dir.'/images/home/logo-email.png" 
											style="width:100%" />
									</a>
								</td>';
$message .= '					<td class="tag_line">Beauty Is Act<br>Its Hijab</td>';
$message .= '				</tr>';
$message .= '			</table>';
$message .= '		</td>';
$message .= '	</tr>';
$message .= '</table>';


$message .= '<table class="body-wrap">';
$message .= '	<tr>';
$message .= '		<td></td>';
$message .= '		<td class="container" bgcolor="#FFFFFF">';
$message .= '			<div class="content">';
$message .= '			<table>';
$message .= '				<tr>';
$message .= '					<td>';
$message .= 						$content;
$message .= '						<br/>';
$message .= '						<br/>	';
					
$message .= '						<table class="social" width="100%">';
$message .= '							<tr>';
$message .= '								<td>';


$message .= '									<table align="left" class="column">';
$message .= '										<tr>';
$message .= '											<td>';				
$message .= '												<h5 class="">Konek Terus Yaa..?</h5>';
$message .= '												<p class="">
<a href="https://www.facebook.com/search/top/?q=koleksi%20itshijab" class="soc-btn fb">Facebook</a> 
<a href="https://www.instagram.com/itshijab/" class="soc-btn ig">Instagram</a> 
<a href="https://plus.google.com/109206439509897651097" class="soc-btn gp">Google+</a></p>';
$message .= '											</td>';
$message .= '										</tr>';
$message .= '									</table><!-- /column 1 -->	';

$message .= '									<table align="left" class="column">';
$message .= '										<tr>';
$message .= '											<td>	';			
$message .= '												<h5 class="">Kontak Info:</h5>		';										
$message .= '												<p>Phone: <strong>+62 812-8861-6068
 cs@itshijab.com
</strong><br/>';
$message .= '                Email: <strong><a href="emailto:cs@itshijab.com">cs@itshijab.com</a></strong></p>';
$message .= '											</td>';
$message .= '										</tr>';
$message .= '									</table><!-- /column 2 -->';

$message .= '									<span class="clear"></span>	';
$message .= '								</td>';
$message .= '							</tr>';
$message .= '						</table><!-- /social & contact -->';



$message .= '					</td>';
$message .= '				</tr>';
$message .= '			</table>';
$message .= '			</div>';
$message .= '		</td>';
$message .= '		<td></td>';
$message .= '	</tr>';
$message .= '</table>';
$message .= '<table class="footer-wrap">';
$message .= '	<tr>';
$message .= '		<td></td>';
$message .= '		<td class="container">';
$message .= '				<div class="content">';
$message .= '				<table>';
$message .= '				<tr>';
$message .= '					<td align="center">';
$message .= '						<p>';
$message .= '							<a href="#">Terms</a> |';
$message .= '							<a href="#">Privacy</a> |';
$message .= '							<a href="#"><unsubscribe>Unsubscribe</unsubscribe></a>';
$message .= '						</p>';
$message .= '					</td>';
$message .= '				</tr>';
$message .= '			</table>';
$message .= '				</div><!-- /content -->';
$message .= '		</td>';
$message .= '		<td></td>';
$message .= '	</tr>';
$message .= '</table>
</td>
</tr>
</table>';

$message .= '</body>';
$message .= '</html>';

?>