<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class ContactForm extends CFormModel
{
	public $name;
	public $email;
	public $subject;
	public $body;
	public $verifyCode;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			// name, email, subject and body are required
			array('name, email, subject, body', 'required', 'message'=>'{attribute} '.Yii::app()->lc->t('cannot be blank.')),
			// email has to be a valid email address
			array('email', 'email', 'message'=> '{attribute} '. Yii::app()->lc->t('is not a valid email address.')),
			// verifyCode needs to be entered correctly
			array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements(), 'message'=> Yii::app()->lc->t('The verification code is incorrect.')),
		);
	}

	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels()
	{
		return array(
			'verifyCode'=>Yii::app()->lc->t('Verification Code'),
			'name'=>Yii::app()->lc->t('Name'),		
			'email'=>Yii::app()->lc->t('Email'),
			'subject'=>Yii::app()->lc->t('Subject'),
			'body'=>Yii::app()->lc->t('Body'),
		);
	}
}