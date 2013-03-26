<?php
class GDriveHelper
{
	
	static public function uploadFile($Id_multimedia)
	{
		$service = self::getService();
		//$service->files->listFiles()
		$client = self::getClient();
		$client->authenticate();
		
		$multimedia = TMultimedia::model()->findByPk($Id_multimedia);
		
		if(isset($multimedia))
		{
			$mimeType = $multimedia->mimeType;
	
			//prepare file info
			$file = new Google_DriveFile();
			$file->setTitle($multimedia->description);
			$file->setMimeType($mimeType);

			//get file data
			//$data = file_get_contents(Yii::app()->baseUrl.'/docs/'.$multimedia->file_name);
			$data = file_get_contents('http://localhost/workspace/Green/docs/'.$multimedia->file_name);
	
// 			$parentId = '0B3IgC6E17ly-cnRSdEFFMFpIMzA';

// 			// Set the parent folder.
// 			if ($parentId != null)
// 			{
// 				$parent = new Google_ParentReference();
// 				$parent->setId($parentId);
// 				$file->setParents(array($parent));
// 			}
	
			if(isset($multimedia->Id_google_drive))
				self::updateFile($service, $multimedia->Id_google_drive, $file, $data, $mimeType);
			else
				self::insertFile($service, $file, $data, $mimeType, $Id_multimedia);
	

			return true;
		}
		
		return false;
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
	
	private function insertFile($service, $file, $data, $mimeType, $Id_multimedia)
	{
		$createdFile = $service->files->insert($file, array(
		      'data' => $data,
		      'mimeType' => $mimeType,
		));
		
		$multimedia = TMultimedia::model()->findByPk($Id_multimedia);
		$multimedia->Id_google_drive = (string)$createdFile['id'];
		$multimedia->save();
		
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
		return $_SESSION['GOOGLE_DRIVE_SERVICE'];
	}
	
	private function getClient()
	{
		return $_SESSION['GOOGLE_DRIVE_CLIENT'];
	}

}