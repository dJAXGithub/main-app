<style type="text/css">
.box{
    position:fixed;
    top:-800px;
    left:10%;
    right:10%;
    background-color:#fff;
    color:#7F7F7F;
    padding:20px;
    -moz-border-radius: 20px;
    -webkit-border-radius:20px;
    -khtml-border-radius:20px;
    -moz-box-shadow: 0 1px 5px #333;
    -webkit-box-shadow: 0 1px 5px #333;
	-moz-border-radius: 24px;
	-webkit-border-radius: 24px;
	border-radius: 24px;
	/*IE 7 AND 8 DO NOT SUPPORT BORDER RADIUS*/
	-moz-box-shadow: 0px 0px 3px #000000;
	-webkit-box-shadow: 0px 0px 3px #000000;
	box-shadow: 0px 0px 3px #000000;
	/*IE 7 AND 8 DO NOT SUPPORT BLUR PROPERTY OF SHADOWS*/
    z-index:101;
}
linkPop {	
color:#7F7F7F;
font-weight: bold; 
font-style: italic; 
text-decoration:none;
}
a.boxclose{
    float:right;
    width:26px;
    height:26px;
    background:transparent url(images/cancel.png) repeat top left;
    margin-top:-30px;
    margin-right:-30px;
    cursor:pointer;
}
.box h1{
    margin:-20px -20px 0px -20px;
    padding:10px;
    color:#f15931;
	font-weight:lighter;
    -moz-border-radius:20px 20px 0px 0px;
    -webkit-border-top-left-radius: 20px;
    -webkit-border-top-right-radius: 20px;
    -khtml-border-top-left-radius: 20px;
    -khtml-border-top-right-radius: 20px;
}		
.logo{
    position:fixed;
    width:120px;
    height:120px;
    position:absolute;
	bottom:-25px;
	right:10px;
    background:transparent url(images/log_popup.png) no-repeat top left;
	background-size: 100% 100%;
    z-index:105;
    cursor:pointer;
}
.italica {
	font-style: italic;
}
</style>
<div class="overlay" id="overlay" style="display:none;"></div>
<div class="box" id="box" style="font-family:Arial, Helvetica, sans-serif">
            <a class="boxclose" id="boxclose"></a>
            <div class="logo" id="logo"></div>
            <h1>Welcome to RHOVIT!</h1>
            <p style="font-size:15px">
                Join the fastest growing home for digital entertainment.<br />
                <br />
RHOVIT is a Do-It-Yourself distribution platform for FILM, TV, MUSIC, BOOKS, COMICS & VIDEO GAMES!<br />
<br />
<span class="italica">Users:</span> Surf endless promotional videos for free. Pay for the content you want to buy. An online comic book? A movie? A TV series? 100% of the profit from your purchase will go back to the content provider. <br />
<br />
<span class="italica">Content Providers:</span> Upload your own content. Set your own price. <span style="font-weight: bold; font-style: italic;">Keep all the sales profit, plus</span> ad revenue for only $9.99 a month! <br />
<br />
<span class="italica">University Students:</span> <a href="mailto:info@rhovit.com" class="link_item">Contact us</a> to learn how to get a free account. </p><br />
<a class="linkPop link_item" href="sign_up.php">User Sign-Up</a> |
<a class="linkPop link_item" href="login_cp.php">Provider Zone</a> |
<a class="linkPop link_item" href="about.php">Learn More</a> 
</div>

<!-- JavaScript -->
<script type="text/javascript">
if (cookies_devolver("yaVino")==null) { 
	cookies_establecer('yaVino', 'si', new Date("October 12, 2050"), '/') 
	jQuery(function() {
               jQuery(document).ready(function () {
                    jQuery('#overlay').fadeIn('fast',function(){
                        jQuery('#box').animate({'top':'160px'},500);
                    });
                });
                jQuery('#boxclose').click(function(){
                    jQuery('#box').animate({'top':'-800px'},500,function(){
                        jQuery$('#overlay').fadeOut('fast');
                    });
                });

    });
} 

function cookies_establecer(name, value, expires, path, domain, secure) { 
	var curCookie = name + "=" + escape(value) + 
	((expires) ? "; expires=" + expires.toGMTString() : "") + 
	((path) ? "; path=" + path : "") + 
	((domain) ? "; domain=" + domain : "") + 
	((secure) ? "; secure" : ""); 

	document.cookie = curCookie; 
} 

function cookies_devolver(name) { 
	var dc = document.cookie; 
	var prefix = name + "="; 
	var begin = dc.indexOf("; " + prefix); 
	if (begin == -1) { 
	begin = dc.indexOf(prefix); 
	if (begin != 0) return null; 
	} else 
	begin += 2; 
	var end = document.cookie.indexOf(";", begin); 
	if (end == -1) 
	end = dc.length; 
	return unescape(dc.substring(begin + prefix.length, end)); 
} 
</script>
