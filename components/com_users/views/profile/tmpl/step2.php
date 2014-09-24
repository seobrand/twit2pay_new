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

$db =& JFactory::getDBO();
$query = "SELECT * FROM #__users where id = '$user->id'";
$db->setQuery( $query );
$ses_var = $db->loadObjectList();
$crm_id = $ses_var[0]->crm_customer_id;
$app = JFactory::getApplication();

$menu = $app->getMenu();
// get active menu id
$activeId = $menu->getActive()->id;
?>

<?php if($crm_id != 0 && $activeId == 141){?>
<form id="member-profile" action="<?php echo JRoute::_('index.php?option=com_users&task=profile.update2'); ?>" method="post" class="form-validate form-horizontal" enctype="multipart/form-data">
  <div class="update_form_main">
        <ul class="update_collm">
        <li class="clearfix">
            <div class="update_left_text"> Card Type </div>
            <div class="update_right_box">
              <select id="jform_profile_cardtype" class="update_sel" name="jform[profile][cardtype]" aria-invalid="false">
			<option value="VISA" <?php if($ses_var[0]->cc_type == 'VISA'){?>selected="selected"<?php }?>>Visa</option>
			<option value="AMEX" <?php if($ses_var[0]->cc_type == 'AMEX'){?>selected="selected"<?php }?>>Amex</option>
			<option value="DISCOVER" <?php if($ses_var[0]->cc_type == 'DISCOVER'){?>selected="selected"<?php }?>>Discover</option>
			<option value="MASTERCARD" <?php if($ses_var[0]->cc_type == 'MASTERCARD'){?>selected="selected"<?php }?>>Master Card</option>
		</select>
            </div>
          </li>
          <li class="clearfix">
            <div class="update_left_text"> Name on Card </div>
            <div class="update_right_box">
              <input id="jform_profile_name_on_card" type="text" class="update_input required" aria-required="true" required="required"  maxlength="40" size="30" value="<?php echo $ses_var[0]->cc_name;?>" name="jform[profile][name_on_card]" >
            </div>
          </li>
          <li class="clearfix">
            <div class="update_left_text"> Credit Card Number <img src="<?php echo $this->baseurl?>/templates/twit-home/images/payment-img.gif" width="51" height="40" alt=" " class="card_pay_img"></div>
            <div class="update_right_box">
             <input id="jform_profile_ccnumber" type="text" class="update_input required" aria-required="true" required="required" size="16" maxlength="16" value="<?php echo $ses_var[0]->cc_number; ?>" name="jform[profile][ccnumber]" >
            </div>
          </li>
          <li class="clearfix">
            <div class="update_left_text"> Expiration Date </div>
            <div class="update_right_box">
              <select id="jform_profile_expmonth" class="update_sel" name="jform[profile][expmonth]" aria-invalid="false">
			<option value="01" <?php if($ses_var[0]->cc_exp_month == '01'){?>selected="selected"<?php }?>>Jan</option>
			<option value="02" <?php if($ses_var[0]->cc_exp_month == '02'){?>selected="selected"<?php }?>>Feb</option>
			<option value="03" <?php if($ses_var[0]->cc_exp_month == '03'){?>selected="selected"<?php }?>>Mar</option>
			<option value="04" <?php if($ses_var[0]->cc_exp_month == '04'){?>selected="selected"<?php }?>>Apr</option>
			<option value="05" <?php if($ses_var[0]->cc_exp_month == '05'){?>selected="selected"<?php }?>>May</option>
			<option value="06" <?php if($ses_var[0]->cc_exp_month == '06'){?>selected="selected"<?php }?>>Jun</option>
			<option value="07" <?php if($ses_var[0]->cc_exp_month == '07'){?>selected="selected"<?php }?>>Jul</option>
			<option value="08" <?php if($ses_var[0]->cc_exp_month == '08'){?>selected="selected"<?php }?>>Aug</option>
			<option value="09" <?php if($ses_var[0]->cc_exp_month == '09'){?>selected="selected"<?php }?>>Sep</option>
			<option value="10" <?php if($ses_var[0]->cc_exp_month == '10'){?>selected="selected"<?php }?>>Oct</option>
			<option value="11" <?php if($ses_var[0]->cc_exp_month == '11'){?>selected="selected"<?php }?>>Nov</option>
			<option value="12" <?php if($ses_var[0]->cc_exp_month == '12'){?>selected="selected"<?php }?>>Dec</option>
		</select>
		<select id="jform_profile_expyear" class="update_sel" name="jform[profile][expyear]" aria-invalid="false">
			
			<?php for ($i= date('Y'); $i < (date('Y') + 8); $i++) { ?>
			<option value="<?php echo $i; ?>" <?php if($ses_var[0]->cc_exp_year == $i){?>selected="selected"<?php }?>><?php echo $i;?></option>
			<?php } ?>
		</select>
		
            </div>
          </li>
          <li class="clearfix">
            <div class="update_left_text"> CVV </div>
            <div class="update_right_box">
            <input id="jform_profile_cvv" type="text" class="update_input_02 required" aria-required="true" required="required" size="3"  maxlength="3" value="<?php echo $ses_var[0]->cc_cvv;?>" name="jform[profile][cvv]" >
            </div>
          </li>
          <li class="clearfix">
            <div class="update_left_text"> Billing Address Same as Shipping? </div>
            <div class="update_right_box">
              <ul class="user_action">
                <li>
                  <input type="button" value="Yes" class="input_action">
                  <input type="button" value="No" class="input_action">
                </li>
                <li>Are you going to answer yes or no?</li>
              </ul>
            </div>
          </li>
          <li class="clearfix">
            <div class="update_left_text">Billing Address</div>
            <div class="update_right_box">
              <input type="text" id="jform_profile_baddress" name="jform[profile][baddress]" value="<?php echo $profile->profile['baddress']?>" aria-required="true" required="required" class="update_input">
            </div>
          </li>
          <li class="clearfix">
            <div class="update_left_text">City</div>
            <div class="update_right_box">
              <input type="text" id="jform_profile_bcity" name="jform[profile][bcity]" value="<?php echo $profile->profile['bcity']?>" aria-required="true" required="required" class="update_input">
            </div>
          </li>
          <li class="clearfix">
            <div class="update_left_text">State</div>
            <div class="update_right_box">
              <select id="jform_profile_bregion" name="jform[profile][bregion]" class="update_sel" aria-invalid="false">
                  <option value="Alabana">Alabama</option>
                  <option value="Alaska" <?php  if($profile->profile['bregion'] == 'Alaska'){?>selected="selected"<?php }?>>Alaska</option>
                  <option value="American Samoa" <?php  if($profile->profile['bregion'] == 'American Samoa'){?>selected="selected"<?php }?>>American Samoa</option>
                  <option value="Arizona" <?php  if($profile->profile['bregion'] == 'Arizona'){?>selected="selected"<?php }?>>Arizona</option>
                  <option value="Arkansas" <?php  if($profile->profile['bregion'] == 'Arkansas'){?>selected="selected"<?php }?>>Arkansas</option>
                  <option value="California" <?php  if($profile->profile['bregion'] == 'California'){?>selected="selected"<?php }?>>California</option>
                  <option value="Colorado" <?php  if($profile->profile['bregion'] == 'Colorado'){?>selected="selected"<?php }?>>Colorado</option>
                  <option value="Connecticut" <?php  if($profile->profile['bregion'] == 'Connecticut'){?>selected="selected"<?php }?>>Connecticut</option>
                  <option value="Delaware" <?php  if($profile->profile['bregion'] == 'Delaware'){?>selected="selected"<?php }?>>Delaware</option>
                  <option value="District of Columbia" <?php  if($profile->profile['bregion'] == 'District of Columbia'){?>selected="selected"<?php }?>>District of Columbia</option>
                  <option value="Florida" <?php  if($profile->profile['bregion'] == 'Florida'){?>selected="selected"<?php }?>>Florida</option>
                  <option value="Georgia" <?php  if($profile->profile['bregion'] == 'Georgia'){?>selected="selected"<?php }?>>Georgia</option>
                  <option value="Guam" <?php  if($profile->profile['bregion'] == 'Guam'){?>selected="selected"<?php }?>>Guam</option>
                  <option value="Hawaii" <?php  if($profile->profile['bregion'] == 'Hawaii'){?>selected="selected"<?php }?>>Hawaii</option>
                  <option value="Idaho" <?php  if($profile->profile['bregion'] == 'Idaho'){?>selected="selected"<?php }?>>Idaho</option>
                  <option value="Illinois" <?php  if($profile->profile['bregion'] == 'Illinois'){?>selected="selected"<?php }?>>Illinois</option>
                  <option value="Indiana" <?php  if($profile->profile['bregion'] == 'Indiana'){?>selected="selected"<?php }?>>Indiana</option>
                  <option value="Iowa" <?php  if($profile->profile['bregion'] == 'Iowa'){?>selected="selected"<?php }?>>Iowa</option>
                  <option value="Kansas" <?php  if($profile->profile['bregion'] == 'Kansas'){?>selected="selected"<?php }?>>Kansas</option>
                  <option value="Kentucky" <?php  if($profile->profile['bregion'] == 'Kentucky'){?>selected="selected"<?php }?>>Kentucky</option>
                  <option value="Louisiana" <?php  if($profile->profile['bregion'] == 'Louisiana'){?>selected="selected"<?php }?>>Louisiana</option>
                  <option value="Maine" <?php  if($profile->profile['bregion'] == 'Maine'){?>selected="selected"<?php }?>>Maine</option>
                  <option value="Maryland" <?php  if($profile->profile['bregion'] == 'Maryland'){?>selected="selected"<?php }?>>Maryland</option>
                  <option value="Massachusetts" <?php  if($profile->profile['bregion'] == 'Massachusetts'){?>selected="selected"<?php }?>>Massachusetts</option>
                  <option value="Michigan" <?php  if($profile->profile['bregion'] == 'Michigan'){?>selected="selected"<?php }?>>Michigan</option>
                  <option value="Minnesota" <?php  if($profile->profile['bregion'] == 'Minnesota'){?>selected="selected"<?php }?>>Minnesota</option>
                  <option value="Mississippi" <?php  if($profile->profile['bregion'] == 'Mississippi'){?>selected="selected"<?php }?>>Mississippi</option>
                  <option value="Missouri" <?php  if($profile->profile['bregion'] == 'Missouri'){?>selected="selected"<?php }?>>Missouri</option>
                  <option value="Montana" <?php  if($profile->profile['bregion'] == 'Montana'){?>selected="selected"<?php }?>>Montana</option>
                  <option value="Nebraska" <?php  if($profile->profile['bregion'] == 'Nebraska'){?>selected="selected"<?php }?>>Nebraska</option>
                  <option value="Nevada" <?php  if($profile->profile['bregion'] == 'Nevada'){?>selected="selected"<?php }?>>Nevada</option>
                  <option value="New Hampshire" <?php  if($profile->profile['bregion'] == 'New Hampshire'){?>selected="selected"<?php }?>>New Hampshire</option>
                  <option value="New Jersey" <?php  if($profile->profile['bregion'] == 'New Jersey'){?>selected="selected"<?php }?>>New Jersey</option>
                  <option value="New Mexico" <?php  if($profile->profile['bregion'] == 'New Mexico'){?>selected="selected"<?php }?>>New Mexico</option>
                  <option value="New York" <?php  if($profile->profile['bregion'] == 'New York'){?>selected="selected"<?php }?>>New York</option>
                  <option value="North Carolina" <?php  if($profile->profile['bregion'] == 'North Carolina'){?>selected="selected"<?php }?>>North Carolina</option>
                  <option value="North Dakota" <?php  if($profile->profile['bregion'] == 'North Dakota'){?>selected="selected"<?php }?>>North Dakota</option>
                  <option value="Northern Marianas Islands" <?php  if($profile->profile['bregion'] == 'Northern Marianas Islands'){?>selected="selected"<?php }?>>Northern Marianas Islands</option>
                  <option value="Ohio" <?php  if($profile->profile['bregion'] == 'Ohio'){?>selected="selected"<?php }?>>Ohio</option>
                  <option value="Oklahoma" <?php  if($profile->profile['bregion'] == 'Oklahoma'){?>selected="selected"<?php }?>>Oklahoma</option>
                  <option value="Oregon" <?php  if($profile->profile['bregion'] == 'Oklahoma'){?>selected="selected"<?php }?>>Oregon</option>
                  <option value="Pennsylvania" <?php  if($profile->profile['bregion'] == 'Pennsylvania'){?>selected="selected"<?php }?>>Pennsylvania</option>
                  <option value="Puerto Rico" <?php  if($profile->profile['bregion'] == 'Puerto Rico'){?>selected="selected"<?php }?>>Puerto Rico</option>
                  <option value="Rhode Island" <?php  if($profile->profile['bregion'] == 'Rhode Island'){?>selected="selected"<?php }?>>Rhode Island</option>
                  <option value="South Carolina" <?php  if($profile->profile['bregion'] == 'South Carolina'){?>selected="selected"<?php }?>>South Carolina</option>
                  <option value="South Dakota" <?php  if($profile->profile['bregion'] == 'South Dakota'){?>selected="selected"<?php }?>South Dakota</option>
                  <option value="Tennessee" <?php  if($profile->profile['bregion'] == 'Tennessee'){?>selected="selected"<?php }?>>Tennessee</option>
                  <option value="Texas" <?php  if($profile->profile['bregion'] == 'Texas'){?>selected="selected"<?php }?>>Texas</option>
                  <option value="Utah" <?php  if($profile->profile['bregion'] == 'Utah'){?>selected="selected"<?php }?>>Utah</option>
                  <option value="Vermont" <?php  if($profile->profile['bregion'] == 'Vermont'){?>selected="selected"<?php }?>>Vermont</option>
                  <option value="Virginia" <?php  if($profile->profile['bregion'] == 'Virginia'){?>selected="selected"<?php }?>>Virginia</option>
                  <option value="Virgin Islands" <?php  if($profile->profile['bregion'] == 'Virgin Islands'){?>selected="selected"<?php }?>>Virgin Islands</option>
                  <option value="Washington" <?php  if($profile->profile['bregion'] == 'Washington'){?>selected="selected"<?php }?>>Washington</option>
                  <option value="West Virginia" <?php  if($profile->profile['bregion'] == 'West Virginia'){?>selected="selected"<?php }?>>West Virginia</option>
                  <option value="Wisconsin" <?php  if($profile->profile['bregion'] == 'Wisconsin'){?>selected="selected"<?php }?>>Wisconsin</option>
                  <option value="Wyoming" <?php  if($profile->profile['bregion'] == 'Wyoming'){?>selected="selected"<?php }?>>Wyoming</option>
</select>
            </div>
          </li>
          <li class="clearfix">
            <div class="update_left_text">Zip</div>
            <div class="update_right_box">
             <ul class="user_action">
                <li>
                <input type="text" id="jform_profile_bpostal_code" name="jform[profile][bpostal_code]" value="<?php echo $profile->profile['bpostal_code']?>" aria-required="true" required="required" class="update_input_03"></li>
                
                </ul>
            </div>
          </li>
        </ul>
        
        <input type="submit" value="Update" class="update_button">
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
<input type="hidden" name="jform[profile][dob]" id="jform_profile_dob" value="<?php echo $profile->profile['dob']; ?>"/>
<input type="hidden" name="option" value="com_users" />
<input type="hidden" name="task" value="profile.update2" />

      <?php echo JHtml::_('form.token'); ?> </div>
     
       
  </form>
<?php }else{?>
<form id="member-profile" action="<?php echo JRoute::_('index.php?option=com_users&task=profile.save2'); ?>" method="post" class="form-validate form-horizontal" enctype="multipart/form-data">
 <div class="step_third">
       <div class="home_text_title">Sign up: Step 3 </div>
      <div class="home_billing_subtitle">Credit Card: </div>
      
    
      <ul class="step_listing">
      <li>
      <select id="jform_profile_cardtype" class="step_select" name="jform[profile][cardtype]" aria-invalid="false">
			<option value="VISA" <?php if($ses_var[0]->cc_type == 'VISA'){?>selected="selected"<?php }?>>Visa</option>
			<option value="AMEX" <?php if($ses_var[0]->cc_type == 'AMEX'){?>selected="selected"<?php }?>>Amex</option>
			<option value="DISCOVER" <?php if($ses_var[0]->cc_type == 'DISCOVER'){?>selected="selected"<?php }?>>Discover</option>
			<option value="MASTERCARD" <?php if($ses_var[0]->cc_type == 'MASTERCARD'){?>selected="selected"<?php }?>>Master Card</option>
		</select>
      </li>
       <li>
      <input id="jform_profile_name_on_card" type="text" class="step_input required" aria-required="true" required="required"  maxlength="40" size="30" value="<?php if($ses_var[0]->cc_name != ''){ echo $ses_var[0]->cc_name;}else{echo 'Name on Card';} ?>" name="jform[profile][name_on_card]" >
      </li>
      <li>
      <input id="jform_profile_ccnumber" type="text" class="step_input required" aria-required="true" required="required" size="16" maxlength="16" value="<?php if($ses_var[0]->cc_number != ''){ echo $ses_var[0]->cc_number;}else{echo 'Card Number';} ?>" name="jform[profile][ccnumber]" >
      
      </li>
      <li>
      <input id="jform_profile_cvv" type="text" class="step_input3 required" aria-required="true" required="required" size="3"  maxlength="3" value="<?php if($ses_var[0]->cc_cvv != 0){ echo $ses_var[0]->cc_cvv; }else{echo 'cvv';} ?>" name="jform[profile][cvv]" >
      </li>
     <li>
     </li>
      
      <li>
     
      <select id="jform_profile_expmonth" class="step_select" name="jform[profile][expmonth]" aria-invalid="false">
			<option value="01" <?php if($ses_var[0]->cc_exp_month == '01'){?>selected="selected"<?php }?>>Jan</option>
			<option value="02" <?php if($ses_var[0]->cc_exp_month == '02'){?>selected="selected"<?php }?>>Feb</option>
			<option value="03" <?php if($ses_var[0]->cc_exp_month == '03'){?>selected="selected"<?php }?>>Mar</option>
			<option value="04" <?php if($ses_var[0]->cc_exp_month == '04'){?>selected="selected"<?php }?>>Apr</option>
			<option value="05" <?php if($ses_var[0]->cc_exp_month == '05'){?>selected="selected"<?php }?>>May</option>
			<option value="06" <?php if($ses_var[0]->cc_exp_month == '06'){?>selected="selected"<?php }?>>Jun</option>
			<option value="07" <?php if($ses_var[0]->cc_exp_month == '07'){?>selected="selected"<?php }?>>Jul</option>
			<option value="08" <?php if($ses_var[0]->cc_exp_month == '08'){?>selected="selected"<?php }?>>Aug</option>
			<option value="09" <?php if($ses_var[0]->cc_exp_month == '09'){?>selected="selected"<?php }?>>Sep</option>
			<option value="10" <?php if($ses_var[0]->cc_exp_month == '10'){?>selected="selected"<?php }?>>Oct</option>
			<option value="11" <?php if($ses_var[0]->cc_exp_month == '11'){?>selected="selected"<?php }?>>Nov</option>
			<option value="12" <?php if($ses_var[0]->cc_exp_month == '12'){?>selected="selected"<?php }?>>Dec</option>
		</select>
		
		<select id="jform_profile_expyear" class="step_select" name="jform[profile][expyear]" aria-invalid="false">
			
			<?php for ($i= date('Y'); $i < (date('Y') + 8); $i++) { ?>
			<option value="<?php echo $i; ?>" <?php if($ses_var[0]->cc_exp_year == $i){?>selected="selected"<?php }?>><?php echo $i;?></option>
			<?php } ?>
		</select>
      
      </li>
      <li><input type="Submit" value="Submit" class="step_submit" ></li>
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
<input type="hidden" name="jform[profile][dob]" id="jform_profile_dob" value="<?php echo $profile->profile['dob']; ?>"/>
<input type="hidden" name="option" value="com_users" />
<input type="hidden" name="task" value="profile.save2" />

      <?php echo JHtml::_('form.token'); ?> </div>
     
       
  </form>
<<?php }?>
   
    
</div>
