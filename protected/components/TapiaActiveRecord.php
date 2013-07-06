<?php 

abstract class TapiaActiveRecord extends CActiveRecord
{
//     const BELONGS_TO='CBelongsToRelation';
//     const HAS_ONE='CHasOneRelation';
//     const HAS_MANY='CHasManyRelation';
//     const MANY_MANY='CManyManyRelation';
//     const STAT='CStatRelation';
	protected function beforeSave()
	{
		foreach($this->metadata->tableSchema->columns as $columnName => $column){
			if ($column->dbType == 'date'){
				$this->$columnName = Yii::app()->lc->toDatabase($this->$columnName,'date','small','date',null);
			}elseif ($column->dbType == 'datetime'){
				$this->$columnName = Yii::app()->lc->toDatabase($this->$columnName,'datetime','small','datetime',null);
			}elseif($column->dbType == 'timestamp'){
				$this->$columnName = Yii::app()->lc->toDatabase($this->$columnName,'datetime','small','datetime',null);
			}
		}
		return parent::beforeSave();
	}
	protected function afterSave()
	{
		foreach($this->metadata->tableSchema->columns as $columnName => $column){
			if ($column->dbType == 'date'){
				$this->$columnName = Yii::app()->lc->toLocal($this->$columnName, 'date', 'small');
			}elseif ($column->dbType == 'datetime'){
				$this->$columnName = Yii::app()->lc->toLocal($this->$columnName, 'datetime', 'small');
			}elseif ($column->dbType == 'timestamp'){
				$this->$columnName = Yii::app()->lc->toLocal($this->$columnName, 'datetime', 'small');
			}
		}
		return parent::afterSave();
	}
	protected function afterFind()
	{
		foreach($this->metadata->tableSchema->columns as $columnName => $column){
			if ($column->dbType == 'date'){
				$this->$columnName = Yii::app()->lc->toLocal($this->$columnName, 'date', 'small');
			}elseif ($column->dbType == 'datetime'){
				$this->$columnName = Yii::app()->lc->toLocal($this->$columnName, 'datetime', 'small');
			}elseif ($column->dbType == 'timestamp'){
				$this->$columnName = Yii::app()->lc->toLocal($this->$columnName, 'datetime', 'small');
			}
		}
		return parent::afterFind();
	}
	
    /**
     * @var CDbConnection the default database connection for all active record classes.
     * By default, this is the 'db' application component.
     * @see getDbConnection
     */
    public static $db2;
 
//     private static $_models=array();            // class name => model
 
//     private $_md;                               // meta data
//     private $_new=false;                        // whether this instance is new or not
//     private $_attributes=array();               // attribute name => attribute value
//     private $_related=array();                  // attribute name => related objects
//     private $_c;                                // query criteria (used by finder only)
//     private $_pk;                               // old primary key value
 
    /**
     * Returns the database connection used by active record.
     * By default, the "db" application component is used as the database connection.
     * You may override this method if you want to use a different database connection.
     * @return CDbConnection the database connection used by active record.
     */
    public function getDbConnection()
    {
        if(self::$db2!==null)
            return self::$db2;
        else
        {
 
            // Create CDbConnection and set properties
            self::$db2 = new CDbConnection();
            foreach(Yii::app()->db2 as $key => $value)
                self::$db2->$key = $value;
 
 
        // Uncomment the following lines to prove that you have two database connections
        /*
            CVarDumper::dump(Yii::app()->db);
            echo '<br />';
            CVarDumper::dump(Yii::app()->tapiaDB);
            die;
        */
            if(self::$db2 instanceof CDbConnection)
            {
                self::$db2->setActive(true);
                return self::$db2;
            }
            else
                throw new CDbException(Yii::t('yii','Active Record requires a "db" CDbConnection application component.'));
        }
    }
}