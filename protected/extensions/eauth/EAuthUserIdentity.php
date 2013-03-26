<?php
/**
 * EAuthUserIdentity class file.
 *
 * @author Maxim Zemskov <nodge@yandex.ru>
 * @link http://github.com/Nodge/yii-eauth/
 * @license http://www.opensource.org/licenses/bsd-license.php
 */

/**
 * EAuthUserIdentity is a base User Identity class to authenticate with EAuth.
 * @package application.extensions.eauth
 */
class EAuthUserIdentity extends CBaseUserIdentity {

	const ERROR_NOT_AUTHENTICATED = 3;

	private $_username;
	
	/**
	 * @var EAuthServiceBase the authorization service instance.
	 */
	protected $service;

	/**
	 * @var string the unique identifier for the identity.
	 */
	protected $id;

	/**
	 * @var string the display name for the identity.
	 */
	protected $name;

	/**
	 * Constructor.
	 * @param EAuthServiceBase $service the authorization service instance.
	 */
	public function __construct($service) {
		$this->service = $service;
	}

	/**
	 * Authenticates a user based on {@link service}.
	 * This method is required by {@link IUserIdentity}.
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate() {
		if ($this->service->isAuthenticated) {
			
			// Match authenticated user with DB user.
			$attributes = $this->service->getAttributes();
			$record=User::model()->findByAttributes(array('email'=>$attributes['email']));
			if($record===null){
				$this->errorCode = self::ERROR_NOT_AUTHENTICATED;
			}else{
				$this->_username=$record->username;
				$this->id = $record->username;
				$this->name = $this->service->getAttribute('name');
					
				$this->setState('id', $this->id);
				$this->setState('name', $this->name);
				$this->setState('service', $this->service->serviceName);
				
				$this->errorCode=self::ERROR_NONE;
			}			
		}
		else {
			$this->errorCode = self::ERROR_NOT_AUTHENTICATED;
		}
		return !$this->errorCode;
	}

	/**
	 * Returns the unique identifier for the identity.
	 * This method is required by {@link IUserIdentity}.
	 * @return string the unique identifier for the identity.
	 */
	public function getId() {
		return $this->_username;
	}

	/**
	 * Returns the display name for the identity.
	 * This method is required by {@link IUserIdentity}.
	 * @return string the display name for the identity.
	 */
	public function getName() {
		return $this->name;
	}
	
	/**
	* Returns the service.
	* This method is required by {@link IUserIdentity}.
	* @return the service.
	*/
	public function getService() {
		return $this->service;
	}
}
