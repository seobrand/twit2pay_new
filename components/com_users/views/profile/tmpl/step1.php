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
$ses_var = $db->loadObject();
//echo '<pre';print_r($ses_var);
$crm_id = $ses_var->crm_customer_id;
$app = JFactory::getApplication();

$menu = $app->getMenu();
// get active menu id
$activeId = $menu->getActive()->id;

?>

<?php if($crm_id != 0 && $activeId == 140){?>
<form id="member-profile" action="<?php echo JRoute::_('index.php?option=com_users&task=profile.update1'); ?>" method="post" class="form-validate form-horizontal" enctype="multipart/form-data">
<div class="update_form_main">
        <ul class="update_collm">
          <li class="clearfix">
            <div class="update_left_text">Name </div>
            <div class="update_right_box">
             <input type="text" class="update_input required" aria-required="true" required="required" name="jform[name]" id="jform_name" value="<?php echo $ses_var->name; ?>" size="30"/>
            </div>
          </li>
         <?php /*?> <li class="clearfix">
            <div class="update_left_text"> Last Name  </div>
            <div class="update_right_box">
              <input type="text" value="Massey" class="update_input">
            </div>
          </li><?php */?>
           
           
           
          <li class="clearfix">
            <div class="update_left_text">Shipping  Address</div>
            <div class="update_right_box">
             <input type="text" class="update_input required" aria-required="true" required="required" name="jform[profile][address1]" id="jform_profile_address1" value="<?php echo $profile->profile['address1'];?>" size="30"/>
            </div>
          </li>
          <li class="clearfix">
            <div class="update_left_text">City</div>
            <div class="update_right_box">
              <input type="text" class="update_input required" aria-required="true" required="required" name="jform[profile][city]" id="jform_profile_city" value="<?php echo $profile->profile['city']; ?>" size="30"/>
            </div>
          </li>
          <li class="clearfix">
            <div class="update_left_text">State</div>
            <div class="update_right_box">
              <select id="jform_profile_region" name="jform[profile][region]" class="update_sel" aria-invalid="false">
<option value="Alabana">Alabama</option>
                  <option value="Alaska" <?php  if($profile->profile['region'] == 'Alaska'){?>selected="selected"<?php }?>>Alaska</option>
                  <option value="American Samoa" <?php  if($profile->profile['region'] == 'American Samoa'){?>selected="selected"<?php }?>>American Samoa</option>
                  <option value="Arizona" <?php  if($profile->profile['region'] == 'Arizona'){?>selected="selected"<?php }?>>Arizona</option>
                  <option value="Arkansas" <?php  if($profile->profile['region'] == 'Arkansas'){?>selected="selected"<?php }?>>Arkansas</option>
                  <option value="California" <?php  if($profile->profile['region'] == 'California'){?>selected="selected"<?php }?>>California</option>
                  <option value="Colorado" <?php  if($profile->profile['region'] == 'Colorado'){?>selected="selected"<?php }?>>Colorado</option>
                  <option value="Connecticut" <?php  if($profile->profile['region'] == 'Connecticut'){?>selected="selected"<?php }?>>Connecticut</option>
                  <option value="Delaware" <?php  if($profile->profile['region'] == 'Delaware'){?>selected="selected"<?php }?>>Delaware</option>
                  <option value="District of Columbia" <?php  if($profile->profile['region'] == 'District of Columbia'){?>selected="selected"<?php }?>>District of Columbia</option>
                  <option value="Florida" <?php  if($profile->profile['region'] == 'Florida'){?>selected="selected"<?php }?>>Florida</option>
                  <option value="Georgia" <?php  if($profile->profile['region'] == 'Georgia'){?>selected="selected"<?php }?>>Georgia</option>
                  <option value="Guam" <?php  if($profile->profile['region'] == 'Guam'){?>selected="selected"<?php }?>>Guam</option>
                  <option value="Hawaii" <?php  if($profile->profile['region'] == 'Hawaii'){?>selected="selected"<?php }?>>Hawaii</option>
                  <option value="Idaho" <?php  if($profile->profile['region'] == 'Idaho'){?>selected="selected"<?php }?>>Idaho</option>
                  <option value="Illinois" <?php  if($profile->profile['region'] == 'Illinois'){?>selected="selected"<?php }?>>Illinois</option>
                  <option value="Indiana" <?php  if($profile->profile['region'] == 'Indiana'){?>selected="selected"<?php }?>>Indiana</option>
                  <option value="Iowa" <?php  if($profile->profile['region'] == 'Iowa'){?>selected="selected"<?php }?>>Iowa</option>
                  <option value="Kansas" <?php  if($profile->profile['region'] == 'Kansas'){?>selected="selected"<?php }?>>Kansas</option>
                  <option value="Kentucky" <?php  if($profile->profile['region'] == 'Kentucky'){?>selected="selected"<?php }?>>Kentucky</option>
                  <option value="Louisiana" <?php  if($profile->profile['region'] == 'Louisiana'){?>selected="selected"<?php }?>>Louisiana</option>
                  <option value="Maine" <?php  if($profile->profile['region'] == 'Maine'){?>selected="selected"<?php }?>>Maine</option>
                  <option value="Maryland" <?php  if($profile->profile['region'] == 'Maryland'){?>selected="selected"<?php }?>>Maryland</option>
                  <option value="Massachusetts" <?php  if($profile->profile['region'] == 'Massachusetts'){?>selected="selected"<?php }?>>Massachusetts</option>
                  <option value="Michigan" <?php  if($profile->profile['region'] == 'Michigan'){?>selected="selected"<?php }?>>Michigan</option>
                  <option value="Minnesota" <?php  if($profile->profile['region'] == 'Minnesota'){?>selected="selected"<?php }?>>Minnesota</option>
                  <option value="Mississippi" <?php  if($profile->profile['region'] == 'Mississippi'){?>selected="selected"<?php }?>>Mississippi</option>
                  <option value="Missouri" <?php  if($profile->profile['region'] == 'Missouri'){?>selected="selected"<?php }?>>Missouri</option>
                  <option value="Montana" <?php  if($profile->profile['region'] == 'Montana'){?>selected="selected"<?php }?>>Montana</option>
                  <option value="Nebraska" <?php  if($profile->profile['region'] == 'Nebraska'){?>selected="selected"<?php }?>>Nebraska</option>
                  <option value="Nevada" <?php  if($profile->profile['region'] == 'Nevada'){?>selected="selected"<?php }?>>Nevada</option>
                  <option value="New Hampshire" <?php  if($profile->profile['region'] == 'New Hampshire'){?>selected="selected"<?php }?>>New Hampshire</option>
                  <option value="New Jersey" <?php  if($profile->profile['region'] == 'New Jersey'){?>selected="selected"<?php }?>>New Jersey</option>
                  <option value="New Mexico" <?php  if($profile->profile['region'] == 'New Mexico'){?>selected="selected"<?php }?>>New Mexico</option>
                  <option value="New York" <?php  if($profile->profile['region'] == 'New York'){?>selected="selected"<?php }?>>New York</option>
                  <option value="North Carolina" <?php  if($profile->profile['region'] == 'North Carolina'){?>selected="selected"<?php }?>>North Carolina</option>
                  <option value="North Dakota" <?php  if($profile->profile['region'] == 'North Dakota'){?>selected="selected"<?php }?>>North Dakota</option>
                  <option value="Northern Marianas Islands" <?php  if($profile->profile['region'] == 'Northern Marianas Islands'){?>selected="selected"<?php }?>>Northern Marianas Islands</option>
                  <option value="Ohio" <?php  if($profile->profile['region'] == 'Ohio'){?>selected="selected"<?php }?>>Ohio</option>
                  <option value="Oklahoma" <?php  if($profile->profile['region'] == 'Oklahoma'){?>selected="selected"<?php }?>>Oklahoma</option>
                  <option value="Oregon" <?php  if($profile->profile['region'] == 'Oklahoma'){?>selected="selected"<?php }?>>Oregon</option>
                  <option value="Pennsylvania" <?php  if($profile->profile['region'] == 'Pennsylvania'){?>selected="selected"<?php }?>>Pennsylvania</option>
                  <option value="Puerto Rico" <?php  if($profile->profile['region'] == 'Puerto Rico'){?>selected="selected"<?php }?>>Puerto Rico</option>
                  <option value="Rhode Island" <?php  if($profile->profile['region'] == 'Rhode Island'){?>selected="selected"<?php }?>>Rhode Island</option>
                  <option value="South Carolina" <?php  if($profile->profile['region'] == 'South Carolina'){?>selected="selected"<?php }?>>South Carolina</option>
                  <option value="South Dakota" <?php  if($profile->profile['region'] == 'South Dakota'){?>selected="selected"<?php }?>South Dakota</option>
                  <option value="Tennessee" <?php  if($profile->profile['region'] == 'Tennessee'){?>selected="selected"<?php }?>>Tennessee</option>
                  <option value="Texas" <?php  if($profile->profile['region'] == 'Texas'){?>selected="selected"<?php }?>>Texas</option>
                  <option value="Utah" <?php  if($profile->profile['region'] == 'Utah'){?>selected="selected"<?php }?>>Utah</option>
                  <option value="Vermont" <?php  if($profile->profile['region'] == 'Vermont'){?>selected="selected"<?php }?>>Vermont</option>
                  <option value="Virginia" <?php  if($profile->profile['region'] == 'Virginia'){?>selected="selected"<?php }?>>Virginia</option>
                  <option value="Virgin Islands" <?php  if($profile->profile['region'] == 'Virgin Islands'){?>selected="selected"<?php }?>>Virgin Islands</option>
                  <option value="Washington" <?php  if($profile->profile['region'] == 'Washington'){?>selected="selected"<?php }?>>Washington</option>
                  <option value="West Virginia" <?php  if($profile->profile['region'] == 'West Virginia'){?>selected="selected"<?php }?>>West Virginia</option>
                  <option value="Wisconsin" <?php  if($profile->profile['region'] == 'Wisconsin'){?>selected="selected"<?php }?>>Wisconsin</option>
                  <option value="Wyoming" <?php  if($profile->profile['region'] == 'Wyoming'){?>selected="selected"<?php }?>>Wyoming</option>
</select>
            </div>
          </li>
          <li class="clearfix">
            <div class="update_left_text">Zip</div>
            <div class="update_right_box">
             <ul class="user_action">
                <li>
                 <input id="jform_profile_postal_code" type="text" class="update_input_03 required" aria-required="true" required="required" size="30" value="<?php echo $profile->profile['postal_code']; ?>" name="jform[profile][postal_code]">
                
                </ul>
            </div>
          </li>
        </ul>
        
        <input type="submit" value="Update" class="update_button">
      </div>
      <div class="form-actions">
      <input type="hidden" name="jform[username]" id="jform_username" value="<?php echo $user->username; ?>"/>
       <input type="hidden" name="jform[email1]" id="jform_email1" value="<?php echo $user->email; ?>"/>
         <input type="hidden" name="jform[email2]" id="jform_email2" value="<?php echo $user->email; ?>"/>
         <input type="hidden" name="jform[profile][baddress]" id="jform_profile_baddress" value="<?php echo $profile->profile['baddress']; ?>"/>
<input type="hidden" name="jform[profile][bcity]" id="jform_profile_bcity" value="<?php echo $profile->profile['bcity']; ?>"/>
<input type="hidden" name="jform[profile][bregion]" id="jform_profile_bregion" value="<?php echo $profile->profile['bregion']; ?>"/>
<input type="hidden" name="jform[profile][bpostal_code]" id="jform_profile_bpostal_code" value="<?php echo $profile->profile['bpostal_code']; ?>"/>
        <input type="hidden" name="jform[profile][dob]" id="jform_profile_dob" value="<?php echo $profile->profile['dob']; ?>"/>
      
      <input type="hidden" name="option" value="com_users" />
      <input type="hidden" name="task" value="profile.update1" />
      <?php echo JHtml::_('form.token'); ?> </div>
      </form>
<?php }else{?>
<form id="member-profile" action="<?php echo JRoute::_('index.php?option=com_users&task=profile.save1'); ?>" method="post" class="form-validate form-horizontal" enctype="multipart/form-data">
<div class="step_secound">
       <div class="home_text_title">Sign up: Step 2 </div>
      <div class="home_billing_subtitle">Billing Address: </div>
      
    
      <ul class="step_listing">
      <li> 
      <input type="text" class="step_input required" aria-required="true" required="required" name="jform[profile][address1]" id="jform_profile_address1" value="<?php if($profile->profile['address1'] != ''){ echo $profile->profile['address1'];}else{ echo 'Address';} ?>" size="30"/>
      </li>
      <li>
      <input type="text" class="step_input required" aria-required="true" required="required" name="jform[profile][city]" id="jform_profile_city" value="<?php if($profile->profile['city'] != ''){ echo $profile->profile['city'];}else{echo 'City';} ?>" size="30"/>
      </li>
      <li>
      <select id="jform_profile_region" name="jform[profile][region]" class="step_select02" aria-invalid="false">
<option value="Alabana">Alabama</option>
                  <option value="Alaska" <?php  if($profile->profile['region'] == 'Alaska'){?>selected="selected"<?php }?>>Alaska</option>
                  <option value="American Samoa" <?php  if($profile->profile['region'] == 'American Samoa'){?>selected="selected"<?php }?>>American Samoa</option>
                  <option value="Arizona" <?php  if($profile->profile['region'] == 'Arizona'){?>selected="selected"<?php }?>>Arizona</option>
                  <option value="Arkansas" <?php  if($profile->profile['region'] == 'Arkansas'){?>selected="selected"<?php }?>>Arkansas</option>
                  <option value="California" <?php  if($profile->profile['region'] == 'California'){?>selected="selected"<?php }?>>California</option>
                  <option value="Colorado" <?php  if($profile->profile['region'] == 'Colorado'){?>selected="selected"<?php }?>>Colorado</option>
                  <option value="Connecticut" <?php  if($profile->profile['region'] == 'Connecticut'){?>selected="selected"<?php }?>>Connecticut</option>
                  <option value="Delaware" <?php  if($profile->profile['region'] == 'Delaware'){?>selected="selected"<?php }?>>Delaware</option>
                  <option value="District of Columbia" <?php  if($profile->profile['region'] == 'District of Columbia'){?>selected="selected"<?php }?>>District of Columbia</option>
                  <option value="Florida" <?php  if($profile->profile['region'] == 'Florida'){?>selected="selected"<?php }?>>Florida</option>
                  <option value="Georgia" <?php  if($profile->profile['region'] == 'Georgia'){?>selected="selected"<?php }?>>Georgia</option>
                  <option value="Guam" <?php  if($profile->profile['region'] == 'Guam'){?>selected="selected"<?php }?>>Guam</option>
                  <option value="Hawaii" <?php  if($profile->profile['region'] == 'Hawaii'){?>selected="selected"<?php }?>>Hawaii</option>
                  <option value="Idaho" <?php  if($profile->profile['region'] == 'Idaho'){?>selected="selected"<?php }?>>Idaho</option>
                  <option value="Illinois" <?php  if($profile->profile['region'] == 'Illinois'){?>selected="selected"<?php }?>>Illinois</option>
                  <option value="Indiana" <?php  if($profile->profile['region'] == 'Indiana'){?>selected="selected"<?php }?>>Indiana</option>
                  <option value="Iowa" <?php  if($profile->profile['region'] == 'Iowa'){?>selected="selected"<?php }?>>Iowa</option>
                  <option value="Kansas" <?php  if($profile->profile['region'] == 'Kansas'){?>selected="selected"<?php }?>>Kansas</option>
                  <option value="Kentucky" <?php  if($profile->profile['region'] == 'Kentucky'){?>selected="selected"<?php }?>>Kentucky</option>
                  <option value="Louisiana" <?php  if($profile->profile['region'] == 'Louisiana'){?>selected="selected"<?php }?>>Louisiana</option>
                  <option value="Maine" <?php  if($profile->profile['region'] == 'Maine'){?>selected="selected"<?php }?>>Maine</option>
                  <option value="Maryland" <?php  if($profile->profile['region'] == 'Maryland'){?>selected="selected"<?php }?>>Maryland</option>
                  <option value="Massachusetts" <?php  if($profile->profile['region'] == 'Massachusetts'){?>selected="selected"<?php }?>>Massachusetts</option>
                  <option value="Michigan" <?php  if($profile->profile['region'] == 'Michigan'){?>selected="selected"<?php }?>>Michigan</option>
                  <option value="Minnesota" <?php  if($profile->profile['region'] == 'Minnesota'){?>selected="selected"<?php }?>>Minnesota</option>
                  <option value="Mississippi" <?php  if($profile->profile['region'] == 'Mississippi'){?>selected="selected"<?php }?>>Mississippi</option>
                  <option value="Missouri" <?php  if($profile->profile['region'] == 'Missouri'){?>selected="selected"<?php }?>>Missouri</option>
                  <option value="Montana" <?php  if($profile->profile['region'] == 'Montana'){?>selected="selected"<?php }?>>Montana</option>
                  <option value="Nebraska" <?php  if($profile->profile['region'] == 'Nebraska'){?>selected="selected"<?php }?>>Nebraska</option>
                  <option value="Nevada" <?php  if($profile->profile['region'] == 'Nevada'){?>selected="selected"<?php }?>>Nevada</option>
                  <option value="New Hampshire" <?php  if($profile->profile['region'] == 'New Hampshire'){?>selected="selected"<?php }?>>New Hampshire</option>
                  <option value="New Jersey" <?php  if($profile->profile['region'] == 'New Jersey'){?>selected="selected"<?php }?>>New Jersey</option>
                  <option value="New Mexico" <?php  if($profile->profile['region'] == 'New Mexico'){?>selected="selected"<?php }?>>New Mexico</option>
                  <option value="New York" <?php  if($profile->profile['region'] == 'New York'){?>selected="selected"<?php }?>>New York</option>
                  <option value="North Carolina" <?php  if($profile->profile['region'] == 'North Carolina'){?>selected="selected"<?php }?>>North Carolina</option>
                  <option value="North Dakota" <?php  if($profile->profile['region'] == 'North Dakota'){?>selected="selected"<?php }?>>North Dakota</option>
                  <option value="Northern Marianas Islands" <?php  if($profile->profile['region'] == 'Northern Marianas Islands'){?>selected="selected"<?php }?>>Northern Marianas Islands</option>
                  <option value="Ohio" <?php  if($profile->profile['region'] == 'Ohio'){?>selected="selected"<?php }?>>Ohio</option>
                  <option value="Oklahoma" <?php  if($profile->profile['region'] == 'Oklahoma'){?>selected="selected"<?php }?>>Oklahoma</option>
                  <option value="Oregon" <?php  if($profile->profile['region'] == 'Oklahoma'){?>selected="selected"<?php }?>>Oregon</option>
                  <option value="Pennsylvania" <?php  if($profile->profile['region'] == 'Pennsylvania'){?>selected="selected"<?php }?>>Pennsylvania</option>
                  <option value="Puerto Rico" <?php  if($profile->profile['region'] == 'Puerto Rico'){?>selected="selected"<?php }?>>Puerto Rico</option>
                  <option value="Rhode Island" <?php  if($profile->profile['region'] == 'Rhode Island'){?>selected="selected"<?php }?>>Rhode Island</option>
                  <option value="South Carolina" <?php  if($profile->profile['region'] == 'South Carolina'){?>selected="selected"<?php }?>>South Carolina</option>
                  <option value="South Dakota" <?php  if($profile->profile['region'] == 'South Dakota'){?>selected="selected"<?php }?>South Dakota</option>
                  <option value="Tennessee" <?php  if($profile->profile['region'] == 'Tennessee'){?>selected="selected"<?php }?>>Tennessee</option>
                  <option value="Texas" <?php  if($profile->profile['region'] == 'Texas'){?>selected="selected"<?php }?>>Texas</option>
                  <option value="Utah" <?php  if($profile->profile['region'] == 'Utah'){?>selected="selected"<?php }?>>Utah</option>
                  <option value="Vermont" <?php  if($profile->profile['region'] == 'Vermont'){?>selected="selected"<?php }?>>Vermont</option>
                  <option value="Virginia" <?php  if($profile->profile['region'] == 'Virginia'){?>selected="selected"<?php }?>>Virginia</option>
                  <option value="Virgin Islands" <?php  if($profile->profile['region'] == 'Virgin Islands'){?>selected="selected"<?php }?>>Virgin Islands</option>
                  <option value="Washington" <?php  if($profile->profile['region'] == 'Washington'){?>selected="selected"<?php }?>>Washington</option>
                  <option value="West Virginia" <?php  if($profile->profile['region'] == 'West Virginia'){?>selected="selected"<?php }?>>West Virginia</option>
                  <option value="Wisconsin" <?php  if($profile->profile['region'] == 'Wisconsin'){?>selected="selected"<?php }?>>Wisconsin</option>
                  <option value="Wyoming" <?php  if($profile->profile['region'] == 'Wyoming'){?>selected="selected"<?php }?>>Wyoming</option>
</select>
</li>
<li>
 <input id="jform_profile_postal_code" type="text" class="step_input required" aria-required="true" required="required" size="30" value="<?php if($profile->profile['postal_code'] != ''){ echo $profile->profile['postal_code'];}else{echo 'Zip';} ?>" name="jform[profile][postal_code]">

      </li>
      <li><input type="submit" value="Next" class="step_next" ></li>
      </ul>
    
      

 </div>
 
    <div class="form-actions">
      <input type="hidden" name="jform[username]" id="jform_username" value="<?php echo $user->username; ?>"/>
       <input type="hidden" name="jform[name]" id="jform_name" value="<?php echo $user->name; ?>" />
       <input type="hidden" name="jform[email1]" id="jform_email1" value="<?php echo $user->email; ?>"/>
         <input type="hidden" name="jform[email2]" id="jform_email2" value="<?php echo $user->email; ?>"/>
         <input type="hidden" name="jform[profile][baddress]" id="jform_profile_baddress" value="<?php echo $profile->profile['baddress']; ?>"/>
<input type="hidden" name="jform[profile][bcity]" id="jform_profile_bcity" value="<?php echo $profile->profile['bcity']; ?>"/>
<input type="hidden" name="jform[profile][bregion]" id="jform_profile_bregion" value="<?php echo $profile->profile['bregion']; ?>"/>
<input type="hidden" name="jform[profile][bpostal_code]" id="jform_profile_bpostal_code" value="<?php echo $profile->profile['bpostal_code']; ?>"/>
        <input type="hidden" name="jform[profile][dob]" id="jform_profile_dob" value="<?php echo $profile->profile['dob']; ?>"/>
      
      <input type="hidden" name="option" value="com_users" />
      <input type="hidden" name="task" value="profile.save1" />
      <?php echo JHtml::_('form.token'); ?> </div>
      
      
      
  </form>
  <?php }?>
</div>
