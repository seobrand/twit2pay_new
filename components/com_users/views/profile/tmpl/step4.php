<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_users
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
//load user_profile plugin language
$lang = JFactory::getLanguage();
$lang->load('plg_user_profile', JPATH_ADMINISTRATOR);
?>
<div class="profile-edit<?php echo $this->pageclass_sfx?>">
<?php if ($this->params->get('show_page_heading')) : ?>
	<div class="page-header">
		<h1><?php echo $this->escape($this->params->get('page_heading')); ?></h1>
	</div>
<?php endif; ?>

<?php 


$app			= JFactory::getApplication();
$user			= JFactory::getUser();
$loginUserId	= (int) $user->get('id');

jimport('joomla.user.helper');
$user = & JFactory::getUser();
$profile = JUserHelper::getProfile($user->id);
//echo '<pre>';print_r($profile);

?>




<form id="member-profile" action="<?php echo JRoute::_('index.php?option=com_users&task=profile.save4'); ?>" method="post" class="form-validate form-horizontal" enctype="multipart/form-data">

<div class="step_title">Step 4 of 4 - confirm your information</div>
 <div class="step_inner">
  <div class="info_container">
            <div class="address_info">
              <p><?php echo $user->get('name')?></p>
              <p><?php echo $profile->profile['apt']?>,<?php echo $profile->profile['address1']?></p>
              <p><?php echo $profile->profile['city']?>, <?php echo $profile->profile['region']?> <?php echo $profile->profile['postal_code']?></p>
              
            </div>
            <div class="business_info">
              <p>About your website</p>
              <ul>
                <li>
                  <div class="left_side_box">
                  <p>Website URL</p>
                    <p>Average Transaction Size</p>
                    <p>Maximum Transaction Size </p>
                    <p>Estimated Monthly Volume</p>
                  </div>
                  <div class="right_side_box">
                    <p><?php echo $profile->profile['website']?></p>
                    <p><?php echo $profile->profile['avg_tra']?> </p>
                    <p><?php echo $profile->profile['max_tra']?></p>
                    <p><?php echo $profile->profile['est_volume']?></p>
                  </div>
                </li>
              </ul>
            </div>
            <div class="business_info">
              <p>Type of Business</p>
              <ul>
                <li>
                  <div class="left_side_box">
                    <p>Your Business Type</p>
                    <p>Business Legal Name</p>
                    <p>Tax Id</p>
                    <p>Bank Account </p>
                    <p>Routing Number</p>
                    <p>Social Security Number</p>
                    <p>Your Birthday</p>
                    
                  </div>
                  <div class="right_side_box">
                    <p><?php echo $profile->profile['buss_type']?></p>
                    <p><?php echo $profile->profile['buss_name']?></p>
                   <p><?php echo $profile->profile['tax_no']?>&nbsp;</p>
                    <p><?php echo $profile->profile['bank_acc']?></p>
                    <p><?php echo $profile->profile['r_no']?></p>
                    <p><?php echo $profile->profile['ss_no']?></p>
                    <p><?php echo $profile->profile['dob']?></p>
                  </div>
                </li>
              </ul>
            </div>
           <?php /*?> <div class="continue_checkbox">
              <p>
                <input type="checkbox" class="check_box">
                By continuing, I agree to MojoPay's <a href="">User Agreement</a>.</p>
            </div><?php */?>
          </div>
    </div>
    <div class="form-actions">
     
      <input type="hidden" name="jform[username]" id="jform_username" value="<?php echo $user->username; ?>" size="30"/>
       <input type="hidden" name="jform[name]" id="jform_name" value="<?php echo $user->name; ?>" size="30"/>
        <input type="hidden" name="jform[email1]" id="jform_email1" value="<?php echo $user->email; ?>" size="30"/>
         <input type="hidden" name="jform[email2]" id="jform_email2" value="<?php echo $user->email; ?>" size="30"/>
     <input type="hidden" name="jform[profile][address1]" id="jform_profile_address1" value="<?php echo $profile->profile['address1']; ?>"/>
     <input type="hidden" name="jform[profile][city]" id="jform_profile_city" value="<?php echo $profile->profile['city']; ?>"/>
      <input type="hidden" name="jform[profile][region]" id="jform_profile_region" value="<?php echo $profile->profile['region']; ?>"/>
      <input type="hidden" name="jform[profile][apt]" id="jform_profile_apt" value="<?php echo $profile->profile['apt']; ?>"/>
       <input type="hidden" name="jform[profile][postal_code]" id="jform_profile_postal_code" value="<?php echo $profile->profile['postal_code']; ?>"/>
      <input type="hidden" name="jform[profile][website]" id="jform_profile_website" value="<?php echo $profile->profile['website']; ?>"/>
     <input type="hidden" name="jform[profile][avg_tra]" id="jform_profile_avg_tra" value="<?php echo $profile->profile['avg_tra']; ?>"/>
      <input type="hidden" name="jform[profile][max_tra]" id="jform_profile_max_tra" value="<?php echo $profile->profile['max_tra']; ?>"/>
       <input type="hidden" name="jform[profile][est_volume]" id="jform_profile_est_volume" value="<?php echo $profile->profile['est_volume']; ?>"/>
       
        <input type="hidden" name="jform[profile][buss_type]" id="jform_profile_buss_type" value="<?php echo $profile->profile['buss_type']; ?>"/>
        <input type="hidden" name="jform[profile][buss_name]" id="jform_profile_buss_name" value="<?php echo $profile->profile['buss_name']; ?>"/>
        <input type="hidden" name="jform[profile][tax_no]" id="jform_profile_tax_no" value="<?php echo $profile->profile['tax_no']; ?>"/>
        <input type="hidden" name="jform[profile][bank_acc]" id="jform_profile_bank_acc" value="<?php echo $profile->profile['bank_acc']; ?>"/>
        <input type="hidden" name="jform[profile][r_no]" id="jform_profile_r_no" value="<?php echo $profile->profile['r_no']; ?>"/>
        <input type="hidden" name="jform[profile][ss_no]" id="jform_profile_ss_no" value="<?php echo $profile->profile['ss_no']; ?>"/>
        <input type="hidden" name="jform[profile][dob]" id="jform_profile_dob" value="<?php echo $profile->profile['dob']; ?>"/>
      
      <input type="hidden" name="option" value="com_users" />
      <input type="hidden" name="task" value="profile.save4" />
      <?php echo JHtml::_('form.token'); ?> </div>
      
     <div class="left_side_btn">
          <input type="button" value="< Previous" class="previous_btn" onClick="window.location.href='index.php?option=com_users&view=profile&layout=step3&Itemid=137'">
        </div>
        <div class="right_side_btn">
          <input type="submit" value="Submit Application" class="submit_application_btn">
        </div>
  </form>
</div>
