<?php
class Settings
{
	private $_setting;
	private $_measurementUnits;
	const MT_VOLUME=1;
	const MT_WEIGHT=2;
	const MT_LINEAR=3;
	
	public function __construct()
	{
		try {
			$this->_setting = Setting::model()->findByPk('1');
			$this->_measurementUnits = $this->_setting->measurement->measurementUnits;
				
		} catch (Exception $e) {
			$e->message;
		}
	}
	
	public function getSetting()
	{
		return $this->_setting;
	}
	public function getMeasurementUnits()
	{
		return $this->_measurementUnits;
	}
	/**
	 * get the Measurement Unit description.
	 * @param integer $measurement_type the Id into Measurement_type table
	 * <ul>
	 * <li>Settings::MT_VOLUME : short description of Volume measurement.</li>
	 * <li>Settings::MT_WEIGHT : short description of weight measurement.</li>
	 * <li>Settings::MT_LINEAR : short description of linear measurement.</li>
	 * </ul>
	 * @return short description of measurement type
	 */
	public function getMUShortDescription($measurement_type=self::MT_VOLUME)
	{
		foreach ($this->_measurementUnits as $item)
		{
			if($item->Id_measurement_type == $measurement_type)
			{
				return $item->short_description;				
			}			
		}
		return '';		
	}
	public function getMeasurementUnit($measurement_type=self::MT_VOLUME)
	{
		foreach ($this->_measurementUnits as $item)
		{
			if($item->Id_measurement_type == $measurement_type)
			{
				return $item;				
			}			
		}
		return null;		
	}
	public function getCurrencyShortDescription()
	{
		return $this->_setting->currency->short_description;				
	}
	public function getEscapedCurrencyShortDescription()
	{
		return str_replace ( "$" , "\\$", $this->_setting->currency->short_description);
	}
	
}