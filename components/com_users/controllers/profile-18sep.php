<?php
/**
 * @package		Joomla.Site
 * @subpackage	com_users
 * @copyright	Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

require_once JPATH_COMPONENT.'/controller.php';

/**
 * Profile controller class for Users.
 *
 * @package		Joomla.Site
 * @subpackage	com_users
 * @since		1.6
 */
class UsersControllerProfile extends UsersController
{
	/**
	 * Method to check out a user for editing and redirect to the edit form.
	 *
	 * @since	1.6
	 */
	public function edit()
	{
		$app			= JFactory::getApplication();
		$user			= JFactory::getUser();
		$loginUserId	= (int) $user->get('id');

		// Get the previous user id (if any) and the current user id.
		$previousId = (int) $app->getUserState('com_users.edit.profile.id');
		$userId	= (int) JRequest::getInt('user_id', null, '', 'array');

		// Check if the user is trying to edit another users profile.
		if ($userId != $loginUserId) {
			JError::raiseError(403, JText::_('JERROR_ALERTNOAUTHOR'));
			return false;
		}

		// Set the user id for the user to edit in the session.
		$app->setUserState('com_users.edit.profile.id', $userId);

		// Get the model.
		$model = $this->getModel('Profile', 'UsersModel');

		// Check out the user.
		if ($userId) {
			$model->checkout($userId);
		}

		// Check in the previous user.
		if ($previousId) {
			$model->checkin($previousId);
		}

		// Redirect to the edit screen.
		$this->setRedirect(JRoute::_('index.php?option=com_users&view=profile&layout=edit', false));
	}

	/**
	 * Method to save a user's profile data.
	 *
	 * @return	void
	 * @since	1.6
	 */
	public function save()
	{
		// Check for request forgeries.
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

		// Initialise variables.
		$app	= JFactory::getApplication();
		$model	= $this->getModel('Profile', 'UsersModel');
		$user	= JFactory::getUser();
		$userId	= (int) $user->get('id');

		// Get the user data.
		$data = JRequest::getVar('jform', array(), 'post', 'array');

		// Force the ID to this user.
		$data['id'] = $userId;

		// Validate the posted data.
		$form = $model->getForm();
		if (!$form) {
			JError::raiseError(500, $model->getError());
			return false;
		}

		// Validate the posted data.
		$data = $model->validate($form, $data);

		// Check for errors.
		if ($data === false) {
			// Get the validation messages.
			$errors	= $model->getErrors();

			// Push up to three validation messages out to the user.
			for ($i = 0, $n = count($errors); $i < $n && $i < 3; $i++) {
				if ($errors[$i] instanceof Exception) {
					$app->enqueueMessage($errors[$i]->getMessage(), 'warning');
				} else {
					$app->enqueueMessage($errors[$i], 'warning');
				}
			}

			// Save the data in the session.
			$app->setUserState('com_users.edit.profile.data', $data);

			// Redirect back to the edit screen.
			$userId = (int) $app->getUserState('com_users.edit.profile.id');
			$this->setRedirect(JRoute::_('index.php?option=com_users&view=profile&layout=edit&user_id='.$userId, false));
			return false;
		}

		// Attempt to save the data.
		$return	= $model->save($data);

		// Check for errors.
		if ($return === false) {
			// Save the data in the session.
			$app->setUserState('com_users.edit.profile.data', $data);

			// Redirect back to the edit screen.
			$userId = (int)$app->getUserState('com_users.edit.profile.id');
			$this->setMessage(JText::sprintf('COM_USERS_PROFILE_SAVE_FAILED', $model->getError()), 'warning');
			$this->setRedirect(JRoute::_('index.php?option=com_users&view=profile&layout=edit&user_id='.$userId, false));
			return false;
		}

		// Redirect the user and adjust session state based on the chosen task.
		switch ($this->getTask()) {
			case 'apply':
				// Check out the profile.
				$app->setUserState('com_users.edit.profile.id', $return);
				$model->checkout($return);

				// Redirect back to the edit screen.
				$this->setMessage(JText::_('COM_USERS_PROFILE_SAVE_SUCCESS'));
				$this->setRedirect(JRoute::_(($redirect = $app->getUserState('com_users.edit.profile.redirect')) ? $redirect : 'index.php?option=com_users&view=profile&layout=edit&hidemainmenu=1', false));
				break;

			default:
				// Check in the profile.
				$userId = (int)$app->getUserState('com_users.edit.profile.id');
				if ($userId) {
					$model->checkin($userId);
				}

				// Clear the profile id from the session.
				$app->setUserState('com_users.edit.profile.id', null);

				// Redirect to the list screen.
				$this->setMessage(JText::_('COM_USERS_PROFILE_SAVE_SUCCESS'));
				$this->setRedirect(JRoute::_(($redirect = $app->getUserState('com_users.edit.profile.redirect')) ? $redirect : 'index.php?option=com_users&view=profile&user_id='.$return, false));
				break;
		}

		// Flush the data from the session.
		$app->setUserState('com_users.edit.profile.data', null);
	}
	
	
	public function save1()
	{
		
		/*$db =& JFactory::getDBO();
		$query = "SELECT * FROM twit2pay_users";
		$db->setQuery( $query );
		$ses_var = $db->loadObjectList();
		print_r($ses_var);die;*/
		// Check for request forgeries.
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
	
		$app	= JFactory::getApplication();
		$model	= $this->getModel('Profile', 'UsersModel');
		$user	= JFactory::getUser();
		
		//echo '<pre>'; print_r($user);
		$userId	= (int) $user->get('id');
		$crm_customer_id	= (int) $user->get('crm_customer_id');
	
		// Get the user data.
		$data = $app->input->post->get('jform', array(), 'array');
	
		// Force the ID to this user.
		$data['id'] = $userId;
		// Validate the posted data.
		$form = $model->getForm();
		if (!$form)
		{
			JError::raiseError(500, $model->getError());
			return false;
		}
		// Validate the posted data.
		//echo '<pre>';print_r($data); var_dump($crm_customer_id); die;
		$data = $model->validate($form, $data);
	
		// Check for errors.
		if ($data === false)
		{
		// Get the validation messages.
			$errors	= $model->getErrors();
	
			// Push up to three validation messages out to the user.
			for ($i = 0, $n = count($errors); $i < $n && $i < 3; $i++)
			{
			if ($errors[$i] instanceof Exception)
			{
			$app->enqueueMessage($errors[$i]->getMessage(), 'warning');
			} else {
					$app->enqueueMessage($errors[$i], 'warning');
					}
			}
	
			// Save the data in the session.
			$app->setUserState('com_users.edit.profile.data', $data);

					// Redirect back to the edit screen.
					$userId = (int) $app->getUserState('com_users.edit.profile.id');
							$this->setRedirect(JRoute::_('index.php?option=com_users&view=profile&layout=step2&Itemid=124&user_id='.$userId, false));
							return false;
		}
		// Validate the posted data.
		//$data = $model->validate($form, $data);
		//echo '<pre>'; print_r($data); 
		// Attempt to save the data.
		$return	= $model->save($data);
		
		if ( $crm_customer_id == 0 )
		{
			/* Process Response CRM api
			 * Govind Totla
			 * August 28, 2013
			 * 
			 * */
			$url = "https://api.responsecrm.com/customer";
			$request = '<?xml version="1.0" encoding="utf-8"?>'.
				'<insert_customer>'.
					'<authorization>'.
						'<username>teeshirt</username>'.
						'<password>teeshirt1</password>'.
					'</authorization>'.
					'<customers>'.
						'<customer>'.
							'<siteid>1003842</siteid>'.
							'<phone>(714) 555-1234</phone>'.
							'<email>'.$data['email1'].'</email>'.
							'<ipaddress>192.168.1.1</ipaddress>'.
							'<address>'.
								'<firstname>'.$data['name'].'</firstname>'.
								'<lastname></lastname>'.
								'<address1>'.$data['profile']['address1'].'</address1>'.
								'<address2>'.$data['profile']['apt'].'</address2>'.
								'<city>'.$data['profile']['city'].'</city>'.
								'<state>'.$data['profile']['region'].'</state>'.
								'<zipcode>'.$data['profile']['postal_code'].'</zipcode>'.
								'<country_iso>US</country_iso>'.
							'</address>'.
						'</customer>'.
					'</customers>'.
				'</insert_customer>';
			$request = str_replace("\n","",$request);
			$request = str_replace("\t","",$request);
			$request = trim($request);
			// Initialize handle and set options
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_TIMEOUT, 4);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
			// Execute the request and also time the transaction
			$result = curl_exec($ch);
			// Close the handle
			curl_close($ch);
			//convert to xml object
			if ( !empty($result) )
				$xml_array = json_decode(json_encode((array)simplexml_load_string($result)),1);
			
			$customerid	=	$xml_array['insert_customer_results']['insert_customer_result']['customerid'];
			$user_id	=	$data['id'];
			$db =& JFactory::getDBO();
			$q = "UPDATE  #__users set `crm_customer_id` = '$customerid' WHERE `id` = '$user_id' LIMIT 1";
			$db->setQuery($q);
			$db->query();
		}
		// Check for errors.
		if ($return === false)
		{
			// Save the data in the session.
			$app->setUserState('com_users.edit.profile.data', $data);
			// Redirect back to the edit screen.
			$userId = (int) $app->getUserState('com_users.edit.profile.id');
			$this->setMessage(JText::sprintf('COM_USERS_PROFILE_SAVE_FAILED', $model->getError()), 'warning');
			$this->setRedirect(JRoute::_('index.php?option=com_users&view=profile&layout=step1&Itemid=123&user_id='.$userId, false));
			return false;
		}
		// Redirect the user and adjust session state based on the chosen task.
		switch ($this->getTask())
		{
			case 'apply':
				// Check out the profile.
				$app->setUserState('com_users.edit.profile.id', $return);
				$model->checkout($return);
		
				// Redirect back to the edit screen.
				//$this->setMessage(JText::_('COM_USERS_PROFILE_SAVE_SUCCESS'));
				$this->setRedirect(JRoute::_(($redirect = $app->getUserState('com_users.edit.profile.redirect')) ? $redirect : 'index.php?option=com_users&view=profile&layout=step2&Itemid=124&hidemainmenu=1', false));
				break;
		
			default:
				// Check in the profile.
				$userId = (int) $app->getUserState('com_users.edit.profile.id');
				if ($userId)
				{
					$model->checkin($userId);
				}
		
				// Clear the profile id from the session.
				$app->setUserState('com_users.edit.profile.id', null);
		
				// Redirect to the list screen.
				//$this->setMessage(JText::_('COM_USERS_PROFILE_SAVE_SUCCESS'));
				$this->setRedirect(JRoute::_(($redirect = $app->getUserState('com_users.edit.profile.redirect')) ? $redirect : 'index.php?option=com_users&view=profile&layout=step2&Itemid=124&user_id='.$return, false));
				break;
		}
		// Flush the data from the session.
		$app->setUserState('com_users.edit.profile.data', null);
	}
	
	function xml2array($xml) 
	{
	   $arXML = array();
	   $arXML['name'] = trim($xml->getName());
	   $arXML['value'] = trim((string)$xml);
	   $t = array();
	   foreach($xml -> attributes() as $name => $value){
		  $t[$name] = trim($value);
	   }
	   $arXML['attr'] = $t;
	   $t=array();
	   foreach($xml -> children() as $name => $xmlchild) {
		  $t[$name][] = xml2array($xmlchild); //FIX : For multivalued node
	   }
	   $arXML['children'] = $t;
	   return($arXML);
	}
	
	public function save2()
	{
		// Check for request forgeries.
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
	
		$app	= JFactory::getApplication();
		$model	= $this->getModel('Profile', 'UsersModel');
		$user	= JFactory::getUser();
		$userId	= (int) $user->get('id');
		
		$db =& JFactory::getDBO();
		$query = "SELECT * FROM #__users where id = '$userId'";
		$db->setQuery( $query );
		$ses_var = $db->loadObjectList();
		
		//$crm_customer_id	= (int) $user->get('crm_customer_id');
		$crm_customer_id	= (int) $ses_var[0]->crm_customer_id;
		
		// Get the user data.
		$data = $app->input->post->get('jform', array(), 'array');
	
		// Force the ID to this user.
		$data['id'] = $userId;
		// extract Credit card details and prevent to save it in our DB.
		$cc		=	$data['profile'];
		
		// Validate the posted data.
		$form = $model->getForm();
		if (!$form)
		{
			JError::raiseError(500, $model->getError());
			return false;
		}
		// Validate the posted data.
		$data = $model->validate($form, $data);
		// Check for errors.
		if ($data === false)
		{
			// Get the validation messages.
			$errors	= $model->getErrors();
			// Push up to three validation messages out to the user.
			for ($i = 0, $n = count($errors); $i < $n && $i < 3; $i++)
			{
				if ($errors[$i] instanceof Exception)
				{
					$app->enqueueMessage($errors[$i]->getMessage(), 'warning');
				}
				else
				{
				$app->enqueueMessage($errors[$i], 'warning');
				}
			}
			// Save the data in the session.
			$app->setUserState('com_users.edit.profile.data', $data);
			// Redirect back to the edit screen.
			$userId = (int) $app->getUserState('com_users.edit.profile.id');
			$this->setRedirect(JRoute::_('index.php?option=com_users&view=profile&layout=step3&Itemid=125&user_id='.$userId, false));
			return false;
		}
		// Validate the posted data.
		//$data = $model->validate($form, $data);
		// Attempt to save the data.
		$return	= $model->save($data);	
		
		/* Process Response CRM api
		 * Govind Totla
		 * August 28, 2013
		 * 
		 * */
		/*$url = "https://api.responsecrm.com/customer/$crm_customer_id";
		$request = '<?xml version="1.0" encoding="utf-8"?>
					<CustomerChangeRequest>
						<FirstName>'.$data['name'].'</FirstName>
						<LastName>Customer</LastName>
						<EmailAddress>'.$data['email1'].'</EmailAddress>
						<PhoneNumber>9999999999</PhoneNumber>
						<Security>
							<username>teeshirt</username>
							<password>teeshirt1</password>
						</Security>
						<ShippingAddress>
							<firstname>'.$data['name'].'</firstname>
							<lastname></lastname>
							<address1>'.$cc['profile']['address1'].'</address1>
							<address2>'.$cc['profile']['apt'].'</address2>
							<city>'.$cc['profile']['city'].'</city>
							<state>'.$cc['profile']['region'].'</state>
							<zipcode>'.$cc['profile']['postal_code'].'</zipcode>
							<country_iso>US</country_iso>
						</ShippingAddress>
						<CreditCardData>
							<CardType>'.$cc['profile']['cardtype'].'</CardType>
							<CreditCardNumber>'.$cc['profile']['cardtype'].'</CreditCardNumber>
							<NameOnCard>'.$cc['profile']['cardtype'].'</NameOnCard>
							<CVV>'.$cc['profile']['cardtype'].'</CVV>
							<ExpMonth>'.$cc['profile']['cardtype'].'</ExpMonth>
							<ExpYear>'.$cc['profile']['cardtype'].'</ExpYear>
						</CreditCardData>
						<BankAccountData>
							<NameOnAccount>Joe Smith</NameOnAccount>
							<AccountHolderType>BUSINESS</AccountHolderType>
							<AccountType>CHECKING</AccountType>
							<AccountNumber>122203030489</AccountNumber>
							<ABANumber>34893984820</ABANumber>
						</BankAccountData>
					</CustomerChangeRequest>';*/
					
		$url = "https://api.responsecrm.com/transaction";
		$request = '<?xml version="1.0" encoding="utf-8"?>
					<run_transaction>
						<authorization>
							<username>teeshirt</username>
							<password>teeshirt1</password>
						</authorization>
					<transactions>
						<transaction>
							<customerid>'.$crm_customer_id.'</customerid>
							<ordertype>test</ordertype>
							<ipaddress>192.168.100.51</ipaddress>
							<processor_id>testprocessor</processor_id>
							<CardType>'.$cc['profile']['cardtype'].'</CardType>
							<CreditCardNumber>'.$cc['profile']['cardtype'].'</CreditCardNumber>
							<NameOnCard>'.$cc['profile']['cardtype'].'</NameOnCard>
							<CVV>'.$cc['profile']['cardtype'].'</CVV>
							<ExpMonth>'.$cc['profile']['cardtype'].'</ExpMonth>
							<ExpYear>'.$cc['profile']['cardtype'].'</ExpYear>
							<check_account />
							<check_name />
							<check_aba />
							<account_holder_type />
							<account_type />
							<address>
								<firstname>'.$data['name'].'</firstname>
								<lastname></lastname>
								<address1>'.$cc['profile']['address1'].'</address1>
								<address2>'.$cc['profile']['apt'].'</address2>
								<city>'.$cc['profile']['city'].'</city>
								<state>'.$cc['profile']['region'].'</state>
								<zipcode>'.$cc['profile']['postal_code'].'</zipcode>
								<country_iso>US</country_iso>
							</address>
							<product_groups>
								<product_group>
									<product_group_key>d264a3b6-e78e-4429-9c11-896bc9b567c6</product_group_key>
									<products>
										<product>
											<product_id>1</product_id>
											<amount>0</amount>
										</product>
									</products>
								</product_group>
							</product_groups>
						</transaction>
					</transactions>
					</run_transaction>';
        	
		$request = str_replace("\n","",$request);
		$request = str_replace("\t","",$request);
		$request = trim($request);
		// Initialize handle and set options
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 4);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
		// Execute the request and also time the transaction
		$result = curl_exec($ch); 
		// Close the handle
		curl_close($ch);
		//convert to xml object
		$xml_array	=	array();
		if ( !empty($result) )
			$xml_array = json_decode(json_encode((array)simplexml_load_string($result)),1);
		//echo '<pre>';print_r($xml_array); die;
		
		
		
		
		/*
		if ( count($xml_array) >0 )
		{
			$customerid	=	$xml_array['insert_customer_results']['insert_customer_result']['customerid'];
			$user_id	=	$data['id'];
			$db =& JFactory::getDBO();
			$q = "UPDATE  #__users set `crm_customer_id` = '$customerid' WHERE `id` = '$user_id' LIMIT 1";
			$db->setQuery($q);
			$db->query();
		}*/
		// Check for errors.
		if ($return === false)
		{
			// Save the data in the session.
			$app->setUserState('com_users.edit.profile.data', $data);

			// Redirect back to the edit screen.
			$userId = (int) $app->getUserState('com_users.edit.profile.id');
			$this->setMessage(JText::sprintf('COM_USERS_PROFILE_SAVE_FAILED', $model->getError()), 'warning');
			$this->setRedirect(JRoute::_('index.php?option=com_users&view=profile&layout=step2&Itemid=124&user_id='.$userId, false));
			return false;
		}
		
	
		// Redirect the user and adjust session state based on the chosen task.
		switch ($this->getTask())
		{
			case 'apply':
				// Check out the profile.
				$app->setUserState('com_users.edit.profile.id', $return);
				$model->checkout($return);

				// Redirect back to the edit screen.
				//$this->setMessage(JText::_('COM_USERS_PROFILE_SAVE_SUCCESS'));
				$this->setRedirect(JRoute::_(($redirect = $app->getUserState('com_users.edit.profile.redirect')) ? $redirect : 'index.php?option=com_users&view=profile&layout=step3&Itemid=125&hidemainmenu=1', false));
			break;
			default:
				// Check in the profile.
				$userId = (int) $app->getUserState('com_users.edit.profile.id');
				if ($userId)
				{
					$model->checkin($userId);
				}

				// Clear the profile id from the session.
				$app->setUserState('com_users.edit.profile.id', null);
				// Redirect to the list screen.
				//$this->setMessage(JText::_('COM_USERS_PROFILE_SAVE_SUCCESS'));
				//$this->setRedirect(JRoute::_(($redirect = $app->getUserState('com_users.edit.profile.redirect')) ? $redirect : 'index.php?option=com_users&view=profile&layout=step3&Itemid=125&user_id='.$return, false));
				
				$this->setRedirect(JRoute::_(($redirect = $app->getUserState('com_users.edit.profile.redirect')) ? $redirect : 'index.php?option=com_content&view=article&id=10&Itemid=127', false));
			break;
		}
		// Flush the data from the session.
		$app->setUserState('com_users.edit.profile.data', null);
	}
	
	
	public function save3()
	{
	
		/*$db =& JFactory::getDBO();
			 $query = "SELECT * FROM twit2pay_users";
		$db->setQuery( $query );
		$ses_var = $db->loadObjectList();
	
	
			print_r($ses_var);die;*/
	
		// Check for request forgeries.
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
	
			$app	= JFactory::getApplication();
			$model	= $this->getModel('Profile', 'UsersModel');
			$user	= JFactory::getUser();
			$userId	= (int) $user->get('id');
	
			// Get the user data.
			$data = $app->input->post->get('jform', array(), 'array');
	
			// Force the ID to this user.
			$data['id'] = $userId;
			// Validate the posted data.
			$form = $model->getForm();
			if (!$form)
			{
			JError::raiseError(500, $model->getError());
				return false;
		}
		// Validate the posted data.
			
		$data = $model->validate($form, $data);
	
		// Check for errors.
		if ($data === false)
		{
			// Get the validation messages.
			$errors	= $model->getErrors();
	
			// Push up to three validation messages out to the user.
			for ($i = 0, $n = count($errors); $i < $n && $i < 3; $i++)
				{
				if ($errors[$i] instanceof Exception)
				{
				$app->enqueueMessage($errors[$i]->getMessage(), 'warning');
			} else {
			$app->enqueueMessage($errors[$i], 'warning');
			}
			}
	
			// Save the data in the session.
			$app->setUserState('com_users.edit.profile.data', $data);
	
				// Redirect back to the edit screen.
					$userId = (int) $app->getUserState('com_users.edit.profile.id');
				$this->setRedirect(JRoute::_('index.php?option=com_users&view=profile&layout=step4&Itemid=126&user_id='.$userId, false));
				return false;
			}
			// Validate the posted data.
			//$data = $model->validate($form, $data);
	
			// Attempt to save the data.
			$return	= $model->save($data);
			//echo '<pre>';print_r($data);die;
				// Check for errors.
				if ($return === false)
				{
				// Save the data in the session.
				$app->setUserState('com_users.edit.profile.data', $data);
	
				// Redirect back to the edit screen.
				$userId = (int) $app->getUserState('com_users.edit.profile.id');
					$this->setMessage(JText::sprintf('COM_USERS_PROFILE_SAVE_FAILED', $model->getError()), 'warning');
					$this->setRedirect(JRoute::_('index.php?option=com_users&view=profile&layout=step3&Itemid=125&user_id='.$userId, false));
					return false;
				}
	
				// Redirect the user and adjust session state based on the chosen task.
					switch ($this->getTask())
					{
					case 'apply':
					// Check out the profile.
						$app->setUserState('com_users.edit.profile.id', $return);
					$model->checkout($return);
	
					// Redirect back to the edit screen.
					//$this->setMessage(JText::_('COM_USERS_PROFILE_SAVE_SUCCESS'));
					$this->setRedirect(JRoute::_(($redirect = $app->getUserState('com_users.edit.profile.redirect')) ? $redirect : 'index.php?option=com_users&view=profile&layout=step4&Itemid=126&hidemainmenu=1', false));
					break;
	
					default:
					// Check in the profile.
					$userId = (int) $app->getUserState('com_users.edit.profile.id');
				if ($userId)
				{
				$model->checkin($userId);
					}
	
				// Clear the profile id from the session.
					$app->setUserState('com_users.edit.profile.id', null);
	
					// Redirect to the list screen.
				//$this->setMessage(JText::_('COM_USERS_PROFILE_SAVE_SUCCESS'));
					$this->setRedirect(JRoute::_(($redirect = $app->getUserState('com_users.edit.profile.redirect')) ? $redirect : 'index.php?option=com_users&view=profile&layout=step4&Itemid=126&user_id='.$return, false));
				break;
			}
	
			// Flush the data from the session.
			$app->setUserState('com_users.edit.profile.data', null);
			}
	
	
	public function save4()
	{
			/*$db =& JFactory::getDBO();
			 $query = "SELECT * FROM twit2pay_users";
					$db->setQuery( $query );
					$ses_var = $db->loadObjectList();
	
	
					print_r($ses_var);die;*/
	
			// Check for request forgeries.
				JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
	
						$app	= JFactory::getApplication();
					$model	= $this->getModel('Profile', 'UsersModel');
					$user	= JFactory::getUser();
						$userId	= (int) $user->get('id');
	
						// Get the user data.
								$data = $app->input->post->get('jform', array(), 'array');
	
								// Force the ID to this user.
								$data['id'] = $userId;
			// Validate the posted data.
				$form = $model->getForm();
				if (!$form)
				{
				JError::raiseError(500, $model->getError());
				return false;
					}
					// Validate the posted data.
						
				$data = $model->validate($form, $data);
	
				// Check for errors.
				if ($data === false)
				{
				// Get the validation messages.
				$errors	= $model->getErrors();
	
				// Push up to three validation messages out to the user.
					for ($i = 0, $n = count($errors); $i < $n && $i < 3; $i++)
					{
					if ($errors[$i] instanceof Exception)
						{
				$app->enqueueMessage($errors[$i]->getMessage(), 'warning');
					} else {
				$app->enqueueMessage($errors[$i], 'warning');
					}
					}
	
					// Save the data in the session.
					$app->setUserState('com_users.edit.profile.data', $data);
	
						// Redirect back to the edit screen.
						$userId = (int) $app->getUserState('com_users.edit.profile.id');
			$this->setRedirect(JRoute::_('index.php?option=com_content&view=article&id=10&Itemid=127', false));
							return false;
					}
					// Validate the posted data.
					//$data = $model->validate($form, $data);
	
			// Attempt to save the data.
				$return	= $model->save($data);
				// Check for errors.
				if ($return === false)
					{
					// Save the data in the session.
					$app->setUserState('com_users.edit.profile.data', $data);
	
					// Redirect back to the edit screen.
					$userId = (int) $app->getUserState('com_users.edit.profile.id');
					$this->setMessage(JText::sprintf('COM_USERS_PROFILE_SAVE_FAILED', $model->getError()), 'warning');
					$this->setRedirect(JRoute::_('index.php?option=com_users&view=profile&layout=step4&Itemid=126&user_id='.$userId, false));
			return false;
					}
	
					// Redirect the user and adjust session state based on the chosen task.
				switch ($this->getTask())
					{
					case 'apply':
				// Check out the profile.
				$app->setUserState('com_users.edit.profile.id', $return);
					$model->checkout($return);
	
					// Redirect back to the edit screen.
					//$this->setMessage(JText::_('COM_USERS_PROFILE_SAVE_SUCCESS'));
							$this->setRedirect(JRoute::_(($redirect = $app->getUserState('com_users.edit.profile.redirect')) ? $redirect : 'index.php?option=com_content&view=article&id=10&Itemid=127', false));
							break;
	
							default:
							// Check in the profile.
							$userId = (int) $app->getUserState('com_users.edit.profile.id');
									if ($userId)
										{
									$model->checkin($userId);
					}
	
							// Clear the profile id from the session.
								$app->setUserState('com_users.edit.profile.id', null);
	
								// Redirect to the list screen.
				//$this->setMessage(JText::_('COM_USERS_PROFILE_SAVE_SUCCESS'));
					$this->setRedirect(JRoute::_(($redirect = $app->getUserState('com_users.edit.profile.redirect')) ? $redirect : 'index.php?option=com_content&view=article&id=10&Itemid=127', false));
					break;
					}
	
					// Flush the data from the session.
							$app->setUserState('com_users.edit.profile.data', null);
					}
	
}
