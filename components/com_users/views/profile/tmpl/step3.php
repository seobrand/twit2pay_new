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
//echo '<pre>';print_r($user);

?>

<script type="text/javascript">
function enabled(id){
	var val = document.getElementById(id).value
	if(val == 'yes'){
		document.getElementById('jform_profile_tax_no').disabled = false;
	}else{
		document.getElementById('jform_profile_tax_no').disabled = true;
		document.getElementById('jform_profile_tax_no').value = '';
	}
}

function dob(){
	var year = document.getElementById('year').value;
	var month = document.getElementById('month').value;
	var date = document.getElementById('date').value;
	var dob = year+'-'+month+'-'+date;
	document.getElementById('jform_profile_dob').value = dob;
}

</script>


<form id="member-profile" action="<?php echo JRoute::_('index.php?option=com_users&task=profile.save3'); ?>" method="post" class="form-validate form-horizontal" enctype="multipart/form-data">

<div class="step_title">step 3 of 4 - about your business</div>
 <div class="business_step">
          <ul>
   <li>
              <div class="business_type">
              <p>What type of business do you have?</p>
<select id="jform_profile_buss_type" name="jform[profile][buss_type]" class="business_type_combo" aria-invalid="false">
<option value="Accountant" <?php if($profile->profile['buss_type'] == 'Accountant'){?>selected="selected"<?php }?>>Accountant</option>
<option value="CPA" <?php if($profile->profile['buss_type'] == 'CPA'){?>selected="selected"<?php }?>>CPA</option>
<option value="Bookkeepers" <?php if($profile->profile['buss_type'] == 'Bookkeepers'){?>selected="selected"<?php }?>>Bookkeepers</option>
<option value="Car Dealers" <?php if($profile->profile['buss_type'] == 'Car Dealers'){?>selected="selected"<?php }?>>Car Dealers</option>
<option value="Beauty Professionals" <?php if($profile->profile['buss_type'] == 'Beauty Professionals'){?>selected="selected"<?php }?>>Beauty Professionals</option>
<option value="Builders & Contractors" <?php if($profile->profile['buss_type'] == 'Builders & Contractors'){?>selected="selected"<?php }?>>Builders</option>
<option value="Christian Church & Ministry" <?php if($profile->profile['buss_type'] == 'Christian Church & Ministry'){?>selected="selected"<?php }?>>Christian Church</option>
<option value="Computer & Software Professionals" <?php if($profile->profile['buss_type'] == 'Computer & Software Professionals'){?>selected="selected"<?php }?>>Computer</option>
<option value="Cruise, Travel & Vacation" <?php if($profile->profile['buss_type'] == 'Cruise, Travel & Vacation'){?>selected="selected"<?php }?>>Cruise, Travel</option>
<option value="Dentist" <?php if($profile->profile['buss_type'] == 'Dentist'){?>selected="selected"<?php }?>>Dentist</option>
<option value="Engineer" <?php if($profile->profile['buss_type'] == 'Engineer'){?>selected="selected"<?php }?>>Engineer</option>
<option value="Retail store" <?php if($profile->profile['buss_type'] == 'Retail store'){?>selected="selected"<?php }?>>Retail store</option>
<option value="Whole sale industries" <?php if($profile->profile['buss_type'] == 'Whole sale industries'){?>selected="selected"<?php }?>>Whole sale industries</option>
<option value="Petshop" <?php if($profile->profile['buss_type'] == 'Petshop'){?>selected="selected"<?php }?>>Petshop</option>
<option value="Executives" <?php if($profile->profile['buss_type'] == 'Executives'){?>selected="selected"<?php }?>> Executives</option>
<option value="Food & Restaurant" <?php if($profile->profile['buss_type'] == 'Food & Restaurant'){?>selected="selected"<?php }?>>Food</option>
<option value="Finance & Money Professionals" <?php if($profile->profile['buss_type'] == 'Finance & Money Professionals'){?>selected="selected"<?php }?>>Finance</option>
<option value="Hauling" <?php if($profile->profile['buss_type'] == 'Hauling'){?>selected="selected"<?php }?>>Hauling</option>
<option value="Fitness Centers & Gym" <?php if($profile->profile['buss_type'] == 'Fitness Centers & Gym'){?>selected="selected"<?php }?>>Fitness Centers</option>
<option value="Moving" <?php if($profile->profile['buss_type'] == 'Moving'){?>selected="selected"<?php }?>>Moving</option>
<option value="Trucking" <?php if($profile->profile['buss_type'] == 'Trucking'){?>selected="selected"<?php }?>>Trucking</option>
<option value="Health & Wellness Professionals" <?php if($profile->profile['buss_type'] == 'Health & Wellness Professionals'){?>selected="selected"<?php }?>>Health</option>
<option value="Hotel & Motel" <?php if($profile->profile['buss_type'] == 'Hotel & Motel'){?>selected="selected"<?php }?>>Hotel</option>
<option value="HR Professionals" <?php if($profile->profile['buss_type'] == 'HR Professionals'){?>selected="selected"<?php }?>>HR Professionals</option>
<option value="Insurance Agents & Brokers" <?php if($profile->profile['buss_type'] == 'Insurance Agents & Brokers'){?>selected="selected"<?php }?>>Insurance Agents</option>
<option value="Interior Decorator & Designer" <?php if($profile->profile['buss_type'] == 'Interior Decorator & Designer'){?>selected="selected"<?php }?>>Interior Decorator</option>
<option value="IT Computer Professionals" <?php if($profile->profile['buss_type'] == 'IT Computer Professionals'){?>selected="selected"<?php }?>>IT Computer Professionals</option>
<option value="Jewelers" <?php if($profile->profile['buss_type'] == 'Jewelers'){?>selected="selected"<?php }?>>Jewelers</option>
<option value="k-12 Teachers" <?php if($profile->profile['buss_type'] == 'k-12 Teachers'){?>selected="selected"<?php }?>>k-12 Teachers</option>
<option value="Marketing Executives" <?php if($profile->profile['buss_type'] == 'Marketing Executives'){?>selected="selected"<?php }?>>Marketing Executives</option>
<option value="Mortgage Brokers" <?php if($profile->profile['buss_type'] == 'Mortgage Brokers'){?>selected="selected"<?php }?>>Mortgage Brokers</option>
<option value="Bankers" <?php if($profile->profile['buss_type'] == 'Bankers'){?>selected="selected"<?php }?>>Bankers</option>
<option value="Pharmacy" <?php if($profile->profile['buss_type'] == 'Pharmacy'){?>selected="selected"<?php }?>>Pharmacy</option>
<option value="Physician" <?php if($profile->profile['buss_type'] == 'Physician'){?>selected="selected"<?php }?>>Physician</option>
<option value="Real Estate Agents" <?php if($profile->profile['buss_type'] == 'Real Estate Agents'){?>selected="selected"<?php }?>>Real Estate Agents</option>
</select>
</div>
</li>
<li>
<div class="business_name">
                <p>Business Legal Name</p>
               <input id="jform_profile_buss_name" type="text" class="business_type_txtbox required" aria-required="true" required="required" size="30" value="<?php echo $profile->profile['buss_name']; ?>" name="jform[profile][buss_name]">
              </div>
              
              <div class="tax_id">
                <p>Do you have a Tax ID (EIN)?</p>
                <div class="tax_radio_btn">
                  <input type="radio" <?php if($profile->profile['tax_no'] == ''){?>checked="checked" <?php }?> name="q1" value="no" id="q1" class="radio_btn" onclick="enabled(this.id)">
                  No </div>
                <div class="tax_radio_btn">
                  <input type="radio" <?php if($profile->profile['tax_no'] != ''){?>checked="checked" <?php }?> name="q1" value="yes" id="q2" class="radio_btn" onclick="enabled(this.id)">
                  Yes </div>
                <div class="taxid_box">

<input id="jform_profile_tax_no" type="text" disabled="disabled" class="taxid_txtbox reqiured" aria-required="true" required="required" size="30" value="<?php echo $profile->profile['tax_no']; ?>" name="jform[profile][tax_no]">
</div>
</div>
</li>

<li>
<div class="business_name">
                <p>Bank Account</p>
<input id="jform_profile_bank_acc" type="text" class="business_type_txtbox required" aria-required="true" required="required"  size="30" value="<?php echo $profile->profile['bank_acc']; ?>" name="jform[profile][bank_acc]">
</div>

<div class="business_name">
                <p>Routing Number</p>
<input id="jform_profile_r_no" type="text" class="business_type_txtbox required" aria-required="true" required="required" value="<?php echo $profile->profile['r_no']; ?>" size="30" value="<?php echo $profile->profile['r_no']; ?>" name="jform[profile][r_no]">
</div>
</li>

<li>
<div class="business_name">
                <p>Social Security Number</p>
<input id="jform_profile_ss_no" type="text" class="business_type_txtbox required" aria-required="true" required="required" size="30" value="<?php echo $profile->profile['ss_no']; ?>" name="jform[profile][ss_no]">
</div>
<?php $date = explode('-',$profile->profile['dob']);
$year = $date[0];
$month = $date[1];
$day = $date[2];
?>
<div class="birth_day">
                <p>Your Birthday</p>
                <select name="month" id="month" class="birth_combo required" aria-required="true" required="required">
                  <option value="">Month</option>
                  <option value="1" <?php if($month == 1){?>selected="selected"<?php }?>>January</option>
                  <option value="2" <?php if($month == 2){?>selected="selected"<?php }?>>February</option>
                  <option value="3" <?php if($month == 3){?>selected="selected"<?php }?>>March</option>
                  <option value="4" <?php if($month == 4){?>selected="selected"<?php }?>>April</option>
                  <option value="5" <?php if($month == 5){?>selected="selected"<?php }?>>May</option>
                  <option value="6" <?php if($month == 6){?>selected="selected"<?php }?>>June</option>
                  <option value="7" <?php if($month == 7){?>selected="selected"<?php }?>>July</option>
                  <option value="8" <?php if($month == 8){?>selected="selected"<?php }?>>August</option>
                  <option value="9" <?php if($month == 9){?>selected="selected"<?php }?>>September</option>
                  <option value="10" <?php if($month == 10){?>selected="selected"<?php }?>>October</option>
                  <option value="11" <?php if($month == 11){?>selected="selected"<?php }?>>November</option>
                  <option value="12" <?php if($month == 12){?>selected="selected"<?php }?>>December</option>
                </select>
                <select name="date" id="date" class="birth_combo required" aria-required="true" required="required">
                  <option value="">Date</option>
                  <?php for($i=1; $i<=31; $i++){?>
                  <option value="<?php echo $i?>" <?php if($day == $i){?>selected="selected"<?php }?>><?php echo $i?></option>
                  <?php }?>
                 
                </select>
                <select name="year" id="year" class="birth_combo marginright0 required" aria-required="true" required="required">
                  <option value="">Year</option>
                  <?php for($i=1950; $i<=1995; $i++){?>
                   <option value="<?php echo $i?>" <?php if($year == $i){?>selected="selected"<?php }?>><?php echo $i?></option>
                  <?php }?>
                 
                  
                </select>
              </div>

</li>
</ul>
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
       <input type="hidden" name="jform[profile][dob]" id="jform_profile_dob" value="<?php echo $profile->profile['dob']; ?>"/>
     
      <input type="hidden" name="option" value="com_users" />
      <input type="hidden" name="task" value="profile.save3" />
      <?php echo JHtml::_('form.token'); ?> </div>
      
      <div class="left_side_btn">
          <input type="button" value="< Previous" class="previous_btn" onClick="window.location.href='index.php?option=com_users&view=profile&layout=step2&Itemid=136'">
        </div>
        <div class="right_side_btn">
          <input type="submit" value="Next >" class="next_btn" onclick="dob();">
        </div>
  </form>
</div>
