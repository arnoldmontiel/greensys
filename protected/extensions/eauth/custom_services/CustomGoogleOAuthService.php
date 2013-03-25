<?php
YiiBase::setPathOfAlias('GoogleAPISrcAlias', dirname(__FILE__) . '/lib/google-api-php-client/src');

class CustomGoogleOAuthService extends GoogleOAuthService
{
	protected $scope = 'https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/drive.file https://www.googleapis.com/auth/userinfo.email';
	
	protected $googleDriveService = null;
	
	protected function fetchAttributes() {
		$this->attributes = (array) $this->makeSignedRequest('https://www.googleapis.com/oauth2/v1/userinfo');		
		
	}
	
	protected function getAccessToken($code) {
		Yii::import('GoogleAPISrcAlias.Google_Client');
				
		$client = new Google_Client();
		$client->setClientId($this->client_id);
		$client->setClientSecret($this->client_secret);
		$client->setScopes($this->scope);					
		$client->setRedirectUri($this->getState('redirect_uri'));
				
		Yii::import('GoogleAPISrcAlias.contrib.Google_DriveService');
		$this->googleDriveService = new Google_DriveService($client);
				
		$accessToken = $client->authenticate($code);
		$client->setAccessToken($accessToken);		
		
		$_SESSION['GOOGLE_DRIVE'] = $this->googleDriveService; 
		return $this->parseJson($accessToken);
	}
	
	/**
	 * Save access token to the session.
	 * @param stdClass $token access token array.
	 */
	protected function saveAccessToken($token) {	
		$this->setState('auth_token', $token->access_token);
		$this->setState('expires', time() + $token->expires_in - 60);
		$this->access_token = $token->access_token;
	}
	
	public function getService()
	{
		return $this->googleDriveService;
	}
	
}
