<?php
/**
 * @package                Joomla.Site
 * @subpackage	Templates.beez_20
 * @copyright        Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license                GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

$template_base_url=$this->baseurl . '/templates/twit-home';
$template_image_base_url=$template_base_url.'/images/';
$template_css_base_url=$template_base_url.'/css/';
$template_js_base_url=$template_base_url.'/js/';

// get title
$mydoc =JFactory::getDocument();
$mytitle = $mydoc->getTitle();

$app = JFactory::getApplication();

$menu = $app->getMenu();
// get active menu id
 $activeId = $menu->getActive()->id;

// get active menu
$active   = $menu->getActive();

if ($menu->getActive() == $menu->getDefault()) {

	$home = 1;

}

jimport('joomla.filesystem.file');

// check modules
$showRightColumn	= ($this->countModules('position-3') or $this->countModules('position-6') or $this->countModules('position-8'));
$showbottom			= ($this->countModules('position-9') or $this->countModules('position-10') or $this->countModules('position-11'));
$showleft			= ($this->countModules('position-4') or $this->countModules('position-7') or $this->countModules('position-5'));

if ($showRightColumn==0 and $showleft==0) {
	$showno = 0;
}

JHtml::_('behavior.framework', true);

// get params
$color				= $this->params->get('templatecolor');
$logo				= $this->params->get('logo');
$navposition		= $this->params->get('navposition');
$app				= JFactory::getApplication();
$doc				= JFactory::getDocument();
$templateparams		= $app->getTemplate(true)->params;



$files = JHtml::_('stylesheet', 'templates/'.$this->template.'/css/general.css', null, false, true);
if ($files):
	if (!is_array($files)):
		$files = array($files);
	endif;
	foreach($files as $file):
		$doc->addStyleSheet($file);
	endforeach;
endif;

//$doc->addStyleSheet('templates/'.$this->template.'/css/'.htmlspecialchars($color).'.css');
if ($this->direction == 'rtl') {
	$doc->addStyleSheet($this->baseurl.'/templates/'.$this->template.'/css/template_rtl.css');
	if (file_exists(JPATH_SITE . '/templates/' . $this->template . '/css/' . $color . '_rtl.css')) {
		$doc->addStyleSheet($this->baseurl.'/templates/'.$this->template.'/css/'.htmlspecialchars($color).'_rtl.css');
	}
}

//$doc->addScript($this->baseurl.'/templates/'.$this->template.'/javascript/md_stylechanger.js', 'text/javascript');
//$doc->addScript($this->baseurl.'/templates/'.$this->template.'/javascript/hide.js', 'text/javascript');
$doc->addStyleSheet($template_css_base_url. 'reset.css', $type = 'text/css', $media = 'screen,projection');
$doc->addStyleSheet($template_css_base_url. 'style.css', $type = 'text/css', $media = 'screen,projection');

$doc->addScript($template_js_base_url.'pie_class.js', 'text/javascript');

$user =& JFactory::getUser();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" >
<head>
<script src="http://code.jquery.com/jquery-1.8.0.min.js"></script>
<jdoc:include type="head" />
<!--[if (IE 7)|(IE 8)]>
<script src="<?php echo $template_js_base_url?>html5.js" type="text/javascript"></script>
<![endif]-->
<!--[if lt IE 10]>
<script type="text/javascript" src="<?php echo $template_js_base_url?>PIE.js"></script>
<![endif]-->

<script>
jQuery(document).ready(function (){
	jQuery(".welcome_nav").hover(function() {
	jQuery("#header_inner ul li ul").toggle();
		
	})
})
</script>
<!--[if lte IE 6]>
<link href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/ieonly.css" rel="stylesheet" type="text/css" />
<?php if ($color=="personal") : ?>
<style type="text/css">
#line {
	width:98% ;
}
.logoheader {
	height:200px;
}
#header ul.menu {
	display:block !important;
	width:98.2% ;
}
</style>
<?php endif; ?>
<![endif]-->

<!--[if IE 7]>
<link href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/ie7only.css" rel="stylesheet" type="text/css" />
<![endif]-->
<!--[if IE 8]>
  <link href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/ie8.css" />
  
<![endif]-->
<script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/js/css3-mediaqueries.js"></script>
<script type="text/javascript">
	var big ='<?php echo (int)$this->params->get('wrapperLarge');?>%';
	var small='<?php echo (int)$this->params->get('wrapperSmall'); ?>%';
	var altopen='<?php echo JText::_('TPL_BEEZ2_ALTOPEN', true); ?>';
	var altclose='<?php echo JText::_('TPL_BEEZ2_ALTCLOSE', true); ?>';
	var bildauf='<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/images/plus.png';
	var bildzu='<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/images/minus.png';
	var rightopen='<?php echo JText::_('TPL_BEEZ2_TEXTRIGHTOPEN', true); ?>';
	var rightclose='<?php echo JText::_('TPL_BEEZ2_TEXTRIGHTCLOSE', true); ?>';
	var fontSizeTitle='<?php echo JText::_('TPL_BEEZ2_FONTSIZE', true); ?>';
	var bigger='<?php echo JText::_('TPL_BEEZ2_BIGGER', true); ?>';
	var reset='<?php echo JText::_('TPL_BEEZ2_RESET', true); ?>';
	var smaller='<?php echo JText::_('TPL_BEEZ2_SMALLER', true); ?>';
	var biggerTitle='<?php echo JText::_('TPL_BEEZ2_INCREASE_SIZE', true); ?>';
	var resetTitle='<?php echo JText::_('TPL_BEEZ2_REVERT_STYLES_TO_DEFAULT', true); ?>';
	var smallerTitle='<?php echo JText::_('TPL_BEEZ2_DECREASE_SIZE', true); ?>';
</script>

</head>

<body>
<!--start header-->
<header id="header_main">
  <div id="header_outer">
  
    <div id="header_inner" class="clearfix">
     <?php if($user->guest) { ?>
     <ul>
        <li class="welcome_nav"><a href="javascript:void(0)" >Welcome guest!</a>
        </li>
      </ul>
     <?php }else{?>
      <ul>
        <li class="welcome_nav"><a href="#" >Welcome <?php echo $user->name?>!</a>
          <ul style="display:none;">
            <li><a href="<?php echo $this->baseurl ?>/index.php?option=com_users&view=profile&layout=step1&Itemid=140">My Account</a></li>
            <li><a href="<?php echo $this->baseurl ?>/index.php?option=com_users&view=profile&layout=step1&Itemid=140">My Shipping Address</a></li>
            <li><a href="<?php echo $this->baseurl ?>/index.php?option=com_users&view=profile&layout=step2&Itemid=141">Update My Credit Card</a></li>
            <li><a href="<?php echo $this->baseurl ?>/index.php?option=com_content&view=article&id=13&Itemid=139">My Purchase</a></li>
            <li><a href="<?php echo $this->baseurl ?>/index.php?option=com_quicklogout&view=quicklogout&Itemid=111">Log Out</a></li>
          </ul>
        </li>
      </ul>
      <?php }?>
    </div>
  </div>
  <div id="header_logo"><a href="<?php echo $this->baseurl ?>"><img src="<?php echo $template_image_base_url?>logo.png" width="201" height="71" alt=" "></a></div>
</header>
<!--end header-->
<section id="container_outer">
  <div class="page_heading">Account Settings</div>
  <div id="main_pg_container">
    <div id="main_page_inner">
      <div class="menu_outer clearfix">
        <div class="site_title"><span><?php echo $mytitle?></span></div>
        <nav>
          <ul class="clearfix">
            <li><a href="<?php echo $this->baseurl ?>/index.php?option=com_content&view=article&id=13&Itemid=139" class="history_link <?php if($activeId == 139){?>active<?php }?>"><span>History</span></a></li>
            <li><a href="<?php echo $this->baseurl ?>/index.php?option=com_users&view=profile&layout=step1&Itemid=140" class="address_link <?php if($activeId == 140){?>active<?php }?>"><span>Address</span></a></li>
            <li><a href="<?php echo $this->baseurl ?>/index.php?option=com_users&view=profile&layout=step1&Itemid=141" class="billing_link <?php if($activeId == 141){?>active<?php }?>"><span>Billing</span></a></li>
          </ul>
        </nav>
      </div>
    
  <?php  
   if ($activeId == 139)
		{
   ?>
   </div>
   <div class="payment_history_box">
	<?php 		
			$db =& JFactory::getDBO();
			
			$user	= JFactory::getUser();
			$userId	= (int) $user->get('id');
		
			$q = "SELECT * FROM #__transactions WHERE `replyed_user_id` = '$userId'";
			$db->setQuery($q);
			$db->query();
			$ses_var = $db->getNumRows(); 
			if ( $ses_var != 0 )
			{
				$ses_var = $db->loadObjectList();
				//echo '<pre>';print_r($ses_var);
			echo '<div class="payment_history_box">';
			echo '<table  class="payment_tbl">';
			echo '<thead><tr>';
			echo '<th class="pay_trans_date">Transaction Date</th>
                  <th class="pay_purchase">Item Purchased</th>
                  <th class="pay_hash">Hashtag</th>
                  <th class="pay_cost">Cost</th>';
			echo '</tr></thead><tbody>';
			foreach( $ses_var as $ses_va)
			{
				echo '<tr>';
				echo '<td>'.$ses_va->transaction_date.'</td>';
				echo '<td>'.$ses_va->hastag.'</td>';
				echo '<td>#'.$ses_va->hastag.'</td>';
				echo '<td>'.$ses_va->price.'</td>';
				echo '</tr>';
			}
			echo '</tbody></table></div>';
			
			}else{
              echo "<p style='padding-left:36px;'>No transaction exist..</p>";
             }
		}elseif ($activeId == 140 || $activeId == 141){?>
              <jdoc:include type="component" />
        <?php  }elseif($activeId == 136){?>

     <!--   <jdoc:include type="component" />-->
      <?php
      
		require_once( JPATH_LIBRARIES. '/TwitterAPIExchange.php');
		$token = '788739937-h59OmiJ567yosl8COmBEctwqSBakFgKApF07BbYc';
		$token_secret = 'gy5mtTdysLVQ0bDxL4P0vBcL8tGV6FKgZuufQE844';
		$consumer_key = 'Lgondc3bWLQ9SNUw3wDkxg';
		$consumer_secret = '6cwRoSM6j4cSFuZgTfBFtpb2gvofERnd5DcSJrKyj6U';

		$settings = array(
			'oauth_access_token' => "$token",
			'oauth_access_token_secret' => "$token_secret",
			'consumer_key' => "$consumer_key",
			'consumer_secret' => "$consumer_secret"
		);


		if ( $_POST['test_me'] == 1)
		{
			$db =& JFactory::getDBO();
			
			foreach($_POST['tweet_usr'] as $key=>$balue) 
			{
				$hastag = $_POST['tweet_screen_name'][$key];
				$q = "SELECT * FROM #__users WHERE `username` LIKE '$balue' LIMIT 1";
				$db->setQuery($q);
				$db->query();
				$ses_var = $db->getNumRows(); 
				
				$replyed_user_id	=	0;
				if ( $ses_var != 0 )
				{
					$ses_var = $db->loadObject();
					$replyed_user_id	=	$ses_var->id;
					$crm_customer_id	=	$ses_var->crm_customer_id;
				}
				else   // re tweet because it is not in our DB. ask user to register with us.
				{
					
					$url = 'https://api.twitter.com/1.1/statuses/update.json';
					$postfields = array(
						'status' => '@'.$_POST['tweet_screen_name'][$key].' create your account on twit2pay http://seobranddev.com/twit2pay_joomla.',
						'in_reply_to_status_id' => $key
					);
					$requestMethod = 'POST';
					$twitter = new TwitterAPIExchange($settings);
					$twitter->buildOauth($url, $requestMethod)
								 ->setPostfields($postfields)
								 ->performRequest(); 
					//echo '<br />@'.$_POST['tweet_screen_name'][$key].' create your account on twit2pay. <br />';
				}
				
				 $q2 = "SELECT * FROM #__transactions WHERE `tweet_id` LIKE '$key' LIMIT 1";
				$db->setQuery($q2);
				$db->query();
				$cnt = $db->getNumRows();
				
				if ( $cnt == 0 && $replyed_user_id != 0)
				{
					$p_name=	$_POST['product_name'];
					$db =& JFactory::getDBO();
					$qu = "SELECT product_id, price, name FROM #__tweet_strings WHERE name like '$p_name'";
					$db->setQuery($qu);
					$db->query();
					$p_lists = $db->loadObject();
							
					/* Process Response CRM */					
					$headers = array();
					$headers[] = 'Accept: application/xml';
					$headers[] = 'Content-Type: application/xml; charset=UTF-8';
					$url = "https://api.responsecrm.com/transaction";
					$request ='<?xml version="1.0" encoding="utf-8"?>
								<run_transaction>
								<authorization>
									<username>teeshirt</username>
									<password>teeshirt1</password>
								</authorization>
								<transactions>
									<transaction>
										<customerid>'.$crm_customer_id.'</customerid>
										<ordertype>signup</ordertype>
										<ipaddress>'.$_SERVER["REMOTE_ADDR"].'</ipaddress>					
										<product_groups>
											<product_group>
												<product_group_key>d264a3b6-e78e-4429-9c11-896bc9b567c6</product_group_key>
												<products>
													<product>
														<product_id>'.$p_lists->product_id.'</product_id>
														<amount>'.$p_lists->price.'</amount>
													</product>
												</products>
											</product_group>
										</product_groups> 
									</transaction> 
								</transactions>
							</run_transaction>';	
				  
					$ch1 = curl_init();
					curl_setopt($ch1, CURLOPT_HTTPHEADER, $headers);
					curl_setopt ($ch1, CURLOPT_URL, $url);
					curl_setopt ($ch1, CURLOPT_SSL_VERIFYPEER, FALSE);
					curl_setopt ($ch1, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6");
					curl_setopt ($ch1, CURLOPT_TIMEOUT, 60);
					curl_setopt($ch1, CURLOPT_POSTFIELDS, $request);
					curl_setopt ($ch1, CURLOPT_FOLLOWLOCATION, 0);
					curl_setopt ($ch1, CURLOPT_RETURNTRANSFER, 1);
					$result = curl_exec ($ch1);
					// update response in __transactions
					
				  $q = "INSERT INTO #__transactions (`tweet_id`, `replyed_user_id`, `replyed_usr_s_name`, `status`, `response`, `transaction_date`,`hastag`, `price`) VALUES ('$key', '$replyed_user_id', '$balue', '0', '$result', now(), '$p_lists->name', '$p_lists->price')";
					$db->setQuery($q);
					$db->query(); 
					
				}
			}
		}
		
		
		if ($_REQUEST['option'] =='com_content' && $_REQUEST['Itemid'] == 136 && $_REQUEST['id'] == 12 ) 
		{ 
			$db =& JFactory::getDBO();
			$qu = "SELECT name FROM #__tweet_strings";
			$db->setQuery($qu);
			$db->query();
			$hashes = $db->loadObjectList();
			echo "<br />";
			echo "<br />";
			?>
			<form id="member-profile" action="" method="post" class="form-validate form-horizontal" enctype="multipart/form-data">
				<input type="hidden" name="test_me" value="2"/>
				<select style="width:250px; height:38px; padding:5px;" name="twit_text">
					<?php foreach ($hashes as $hash) { ?>
					<option value="<?php echo $hash->name;?>"><?php echo $hash->name;?></option>
					<?php } ?>
				</select>
				<input style="height:38px; padding:5px;" type="submit" name="Update_Tweets" value="Get Tweets" />
			</form>
			<?php
			echo "<br />";
			echo "<br />";
			echo "<br />";
			$name	=	'';
			if ( $_POST['test_me'] == 2)
			{
				$name=	$_POST['twit_text'];
				$url = 'https://api.twitter.com/1.1/search/tweets.json';
				$getfield = '?q=%23'.$name.'%2BAND%2B%23twit2pay&include_entities=true';
				$requestMethod = 'GET';
				
				$twitter = new TwitterAPIExchange($settings);
				$ape	=	$twitter->setGetfield($getfield)
									 ->buildOauth($url, $requestMethod)
									 ->performRequest();
				$twits = json_decode($ape);
				?>
				<form id="member-profile" action="" method="post" class="form-validate form-horizontal" enctype="multipart/form-data">
				<input type="hidden" name="test_me" value="1"/>
				
				<?php
				echo "<h2>Recent from #$name and #twit2pay </h2>";
				echo "<br />";
				echo "<ul>";
				if ( count($twits->statuses) > 0) :
				foreach($twits as $twit)
				{
					foreach($twit as $twi)
					{
						//echo '<pre>'; print_r($twi); echo '</pre>';
						if ( $twi->text != '')
						{
							echo '<li style="padding-top:20px;">';
							echo $twi->text; 
							if ( $twi->user->screen_name != '')
							{
								echo "<br />";
								echo '<input type="hidden" name="tweet_id['.$twi->id_str.']" value="'.$twi->id_str.'"/>';
								echo '<input type="hidden" name="tweet_usr['.$twi->id_str.']" value="'.str_replace(' ', '', strtolower($twi->user->name)).'"/>';
								echo '<input type="hidden" name="tweet_screen_name['.$twi->id_str.']" value="'.$twi->user->screen_name.'"/>';
								echo "   ";
								echo '<a href="http://twitter.com/'.$twi->user->screen_name.'">@'.$twi->user->screen_name.'</a>';
							}
							echo '</li>';
						}
					}
				}
				echo '<input type="hidden" name="product_name" value="'.$name.'"/>';
				echo  '<li style="padding-top:20px;"><input type="submit" name="Process" value="Process" /></li>';
				else :
					echo '<li style="padding-top:20px;">No data found.</li>';
				endif;
				echo "</ul>";
			}
		}
			
		
      ?>
		</form>
  
		<?php }?>
		
		<?php  if ($activeId != 139){?>
		</div>  
		<?php }?>
  </div>  
  
</section> 

<div class="pricing_title">
  <p><?php echo $mytitle; ?></p>
</div>
<!--start middle-->

<!--end middle-->
<!--start footer-->
<footer id="footer_outer">
<div class="footer_inner">
  <div class="footer_nav">
    <jdoc:include type="modules" name="footer-resorce" />
  </div>
  <div class="footer_address">
  <address>
  30 Enterprise, Suite 210, Aliso Viejo, CA 92656 | Tel: (949) 274-8975 Fax: (949) 266-8260<br>
Twt2Pay, Inc is a registered ISO/MSP of Wells Fargo, N.A., Walnut Creek, CA.
  </address>
  </div>
</div>
</footer>

<!--end footer-->


<!-- begin olark code -->
<script data-cfasync="false" type='text/javascript'>/*{literal}<![CDATA[*/
window.olark||(function(c){var f=window,d=document,l=f.location.protocol=="https:"?"https:":"http:",z=c.name,r="load";var nt=function(){f[z]=function(){(a.s=a.s||[]).push(arguments)};var a=f[z]._={},q=c.methods.length;while(q--){(function(n){f[z][n]=function(){f[z]("call",n,arguments)}})(c.methods[q])}a.l=c.loader;a.i=nt;a.p={0:+new Date};a.P=function(u){a.p[u]=new Date-a.p[0]};function s(){a.P(r);f[z](r)}f.addEventListener?f.addEventListener(r,s,false):f.attachEvent("on"+r,s);var ld=function(){function p(hd){hd="head";return["<",hd,"></",hd,"><",i,' onl' + 'oad="var d=',g,";d.getElementsByTagName('head')[0].",j,"(d.",h,"('script')).",k,"='",l,"//",a.l,"'",'"',"></",i,">"].join("")}var i="body",m=d[i];if(!m){return setTimeout(ld,100)}a.P(1);var j="appendChild",h="createElement",k="src",n=d[h]("div"),v=n[j](d[h](z)),b=d[h]("iframe"),g="document",e="domain",o;n.style.display="none";m.insertBefore(n,m.firstChild).id=z;b.frameBorder="0";b.id=z+"-loader";if(/MSIE[ ]+6/.test(navigator.userAgent)){b.src="javascript:false"}b.allowTransparency="true";v[j](b);try{b.contentWindow[g].open()}catch(w){c[e]=d[e];o="javascript:var d="+g+".open();d.domain='"+d.domain+"';";b[k]=o+"void(0);"}try{var t=b.contentWindow[g];t.write(p());t.close()}catch(x){b[k]=o+'d.write("'+p().replace(/"/g,String.fromCharCode(92)+'"')+'");d.close();'}a.P(2)};ld()};nt()})({loader: "static.olark.com/jsclient/loader0.js",name:"olark",methods:["configure","extend","declare","identify"]});
/* custom configuration goes here (www.olark.com/documentation) */
olark.identify('1784-120-10-2042');/*]]>{/literal}*/</script><noscript><a href="https://www.olark.com/site/1784-120-10-2042/contact" title="Contact us" target="_blank">Questions? Feedback?</a> powered by <a href="http://www.olark.com?welcome" title="Olark live chat software">Olark live chat software</a></noscript><!-- end olark code -->







<?php /*?><jdoc:include type="modules" name="position-5" /><?php */?>
 

<jdoc:include type="modules" name="debug" />
</body>
				
      
</html>
