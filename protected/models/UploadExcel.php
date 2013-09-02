<?php
class UploadExcel extends CFormModel
{
	public $file;

	public function rules()
	{
        return array(
            array('file', 'file', 'types'=>'xlsx,xls'),
        );
    }
}
