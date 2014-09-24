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

//$doc->addStyleSheet($this->baseurl.'/templates/system/css/system.css');
//$doc->addStyleSheet($this->baseurl.'/templates/'.$this->template.'/css/position.css', $type = 'text/css', $media = 'screen,projection');
//$doc->addStyleSheet($this->baseurl.'/templates/'.$this->template.'/css/layout.css', $type = 'text/css', $media = 'screen,projection');
//$doc->addStyleSheet($this->baseurl.'/templates/'.$this->template.'/css/print.css', $type = 'text/css', $media = 'print');

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


$doc->addStyleSheet($template_css_base_url. 'reset.css', $type = 'text/css', $media = 'screen,projection');
$doc->addStyleSheet($template_css_base_url. 'style.css', $type = 'text/css', $media = 'screen,projection');


$doc->addScript($template_js_base_url.'pie_class.js', 'text/javascript');



$home = 0 ;
$menu = $app->getMenu();
$activeId = $menu->getActive()->id;
if ($menu->getActive() == $menu->getDefault()) {

	$home = 1;

}
$user =& JFactory::getUser();
//echo '<pre>';print_r($user);
$db =& JFactory::getDBO();
$query = "SELECT * FROM #__users where id = '$user->id'";
$db->setQuery( $query );
$ses_var = $db->loadObject();
//echo '<pre';print_r($ses_var);
$crmId = $ses_var->crm_customer_id;
//echo $crmId  = $user->crm_customer_id;

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
        <?php if(!empty($crmId)){?>
         <ul style="display:none;">
            <li><a href="<?php echo $this->baseurl ?>/index.php?option=com_users&view=profile&layout=step1&Itemid=140">My Account</a></li>
            <li><a href="<?php echo $this->baseurl ?>/index.php?option=com_users&view=profile&layout=step1&Itemid=140">My Shipping Address</a></li>
            <li><a href="<?php echo $this->baseurl ?>/index.php?option=com_users&view=profile&layout=step2&Itemid=141">Update My Credit Card</a></li>
            <li><a href="<?php echo $this->baseurl ?>/index.php?option=com_content&view=article&id=13&Itemid=139">My Purchase</a></li>
            <li><a href="<?php echo $this->baseurl ?>/index.php?option=com_quicklogout&view=quicklogout&Itemid=111">Log Out</a></li>
          </ul>
         <?php }?> 
        </li>
      </ul>
      <?php }?>
    </div>
  </div>
  <div id="header_logo"><a href="<?php echo $this->baseurl ?>"><img src="<?php echo $template_image_base_url?>logo.png" width="201" height="71" alt=" "></a></div>
</header>
<section id="container_outer">
  <div id="home_container" class="clearfix">
  
    <div class="home_signup_box">
    
        <?php if($user->guest) { ?>
	  <!--start Sign Up Form-->
		<div class="step_one">
      <div class="home_text_title">Sign up: Step 1 </div>
      <div class="home_text_subtitle"><span>Let your words do the shopping!</span>
      <jdoc:include type="modules" name="social-login" />
      </div>
      </div>
			
		
        
    <!--end Sign Up Form-->
     <?php }elseif(empty($crmId) || $activeId == 123 || $activeId == 124 || $activeId == 127 || $activeId == 111)
    {
	?>
	
		<jdoc:include type="component" />
   
 <?php }else{
 	
 	$app = JFactory::getApplication();
 	$link = JURI::base().'index.php?option=com_users&view=profile&layout=step1&Itemid=140';
 		
 	$app->redirect($link);
  }?>
 
    </div>
    
    
    
    <div class="home_right_text"><p>Twt2Pay is the fastest way to process online transactions. In just 140 characters you can purchase concert tickets to apparel and anything in between. </p></div>
  </div>
</section>
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
olark.identify('1784-120-10-2042');/*]]>{/literal}*/</script>
<noscript>
<a href="https://www.olark.com/site/1784-120-10-2042/contact" title="Contact us" target="_blank">Questions? Feedback?</a> powered by <a href="http://www.olark.com?welcome" title="Olark live chat software">Olark live chat software</a>
</noscript>
<!-- end olark code -->


				<jdoc:include type="modules" name="debug" />
        </body>
</html>
