<?php
class GDriveHelper
{
	/**
	 * 
	 * Insert or update a file in GoogleDrive
	 * @param TMultimedia $modelMultimedia
	 * @return Id_google_drive
	 */
	static public function uploadFile($modelMultimedia)
	{
		$service = self::getService();
		$idGoogleDrive = $modelMultimedia->Id_google_drive;
		
		if(isset($modelMultimedia))
		{
			$mimeType = $modelMultimedia->mimeType;
	
			//prepare file info
			$file = new Google_DriveFile();
			$file->setTitle($modelMultimedia->description);
			$file->setMimeType($mimeType);

			//get file data
			$data = file_get_contents('docs/'.$modelMultimedia->file_name);
	
// 			$parentId = '0B3IgC6E17ly-cnRSdEFFMFpIMzA';

// 			// Set the parent folder.
// 			if ($parentId != null)
// 			{
// 				$parent = new Google_ParentReference();
// 				$parent->setId($parentId);
// 				$file->setParents(array($parent));
// 			}
	
			if(isset($idGoogleDrive))
				self::updateFile($service, $idGoogleDrive, $file, $data, $mimeType);
			else
				$idGoogleDrive = self::insertFile($service, $file, $data, $mimeType);
				
		}
		
		return $idGoogleDrive;
	}
	
	static public function removeFilePermission($fileId, $permissionId)
	{
		//$service->permissions->delete($fileId, $permissionId);
	}
	
	private function shareFile($service, $Id_google_drive, $Id_customer)
	{
		
		$userCustomers = UserCustomer::model()->findAllByAttributes(array('Id_customer'=>$Id_customer));
		
// 		foreach($userCustomers as $modelUserCustomer)
// 		{
// 			$newPermission = new Google_Permission();
// 			$newPermission->setValue($modelUserCustomer->user->email);
// 			$newPermission->setType('user');
// 			$newPermission->setRole('reader');
// 			$service->permissions->insert($Id_google_drive, $newPermission);
// 		}
	}
	
	private function insertFile($service, $file, $data, $mimeType)
	{
		$createdFile = $service->files->insert($file, array(
		      'data' => $data,
		      'mimeType' => $mimeType,
		));
		
		return (string)$createdFile['id'];
	}
	
	private function updateFile($service, $Id_google_drive, $file, $data, $mimeType)
	{
		$updatedFile = $service->files->update($Id_google_drive, $file, array(
					      'data' => $data,
					      'mimeType' => $mimeType,
		));
				
	}
	
	private function getService()
	{
		$clientData = $_SESSION['GOOGLE_DRIVE_CLIENT_DATA'];
		
		$client = new Google_Client();
		
		$client->setClientId($clientData->getClientId());
		$client->setClientSecret($clientData->getClientSecret());
		$client->setScopes($clientData->getScope());
		$client->setRedirectUri($clientData->getRedirectUri());
		
		$service = new Google_DriveService($client);
		
		$client->setAccessToken($_SESSION['GOOGLE_DRIVE_TOKEN']);
		
		return $service;
	}
	

}