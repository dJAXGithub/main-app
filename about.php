<?php
include('includes/pack_includes.php');
$header_helper = new header_helper();
include('header.php');
if (!security::IsRhovitUserAuthenticated()) include("login.php");
?>
<link href="css/mobile.css" rel="stylesheet" type="text/css" />
<div class="contentCenter">	  
<img src="images/Rhovit_about_page.jpg"/>
<div style="padding:10px; font-size:17px">
  
<p><span class="bajada">WELCOME TO THE RHOVIT MARKETPLACE</span><br />
        WHERE USERS CAN SURF VIDEOS AND PURCHASE PRODUCTS ALL IN ONE PLACE <br />
AND WHERE CONTENT PROVIDERS KEEP 100% OF THE PROFIT FROM THOSE PURCHASES!</p></td>
  <hr/>
    <p style="text">THANK YOU FOR CHECKING US OUT DURING OUR <span class="rojito">CLOSED BETA PHASE</span>. IF YOU SEE SOME <span class="rojito">ROUGH EDGES, LET US KNOW</span> AND WE'LL SMOTH THEM OUT AS SOON AS POSSIBLE.</p></td>
  <hr/>
  <p><img src="images/rhovit_user.png"/><br />
</p>
      <p class="bajada">Shopping for your favorite entertainment is as fun as the entertainment itself!</p>
      <span style="text-align:left"><p>Every piece of content on Rhovit has Video and Pictures along with all kinds of other great stuff! You can buy Comics and Books, watch your favorite TV shows or Music artists, and find out the latest about your favorite Video Game or Film. <br />
        <span class="rojito">With Rhovit, it's all in one place. </span></p>
    <p>Rhovit is a space designined for you to easily discover new artists and digital products. There's a lot of great stuff out there, but sometimes it gets lost and doesn't find the audience it should. That's why every product listed on our site will hit the front page under THE NEW. So <span class="rojito">the more you visit Rhovit.com, the more new stuff you'll find!</span></p></span></td>
  <hr/>
      <p><img src="images/content_providers.png"/>
</p>
      </p>
      <p><span class="bajada">Profit &amp; Control is now returned to you, The Artist</span><br />
    </p>
    <span style="text-align:left">
      <p><span class="rojito">Rhovit doesn't take a percentage of any sale and is completely hands off on pricing.</span> Depending on the amount of material a provider has they either pay a $9.99 monthly hosting fee or just their hosting costs. When a product is purchased from a provider, the provider pay for the transaction and download fee, but then keeps 100% of the profit. <span class="rojito">The content provider also receives up to 50% of the revenue from ads placed on their pages and videos.</span></p>
    <p>To keep costs down, we use 2 payment systems on Rhovit: Dwolla and Google Wallet. When you make a purchase using your Dwolla account and it is under $10 the content provider pays nothing. If it's over $10 they only pay .25 cents. We know some of you like your credit cards which is why we're also using Google Wallet. Depending on what is cheaper for the transaction, the content provider is charged 5% or 1.9% + 30cents. Both are great options compared to a standard credit card fee which means <span class="rojito">more money to the content provider!</span></p>
    </span>
<hr/>
<img src="images/content_distribution.png"/>
      <p><span class="bajada">Our goal is complete DISRUPTION!</span><br />
      </p>
      <span style="text-align:left">
    <p>We have a lot of exciting things on the burner here at Rhovit. Giving users a site to surf and shop and providers a place to keep all their profit is only the first step. <span class="rojito">Join Rhovit in the distribution revolution and be part of the anarchy!</span></p>
    </span>
    </div>

<?php include('footer.php'); ?>