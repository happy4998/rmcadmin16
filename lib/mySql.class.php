<?php
 
  class mySql
  {
        
  	private $mConnection;
  	
  	public function __construct($sDbHost="",$sDbUser="",$sDbPassword="",$sDbName="")
	{     
                $this->mConnection = new PDO('mysql:host='.$sDbHost.';dbname='.$sDbName,$sDbUser,$sDbPassword,array(PDO::MYSQL_ATTR_LOCAL_INFILE => TRUE,));
                $this->executeQuery("SET 
                                        character_set_results =  'utf8', 
                                        character_set_client = 'utf8', 
                                        character_set_connection = 'utf8', 
                                        character_set_database = 'utf8', 
                                        character_set_server = 'utf8'");
        }
        
	public function executeQuery($sQuery,$aPlaceHolders = array())
	{
		$mQuery =$this->mConnection->prepare($sQuery);
		$mQuery->execute();
                return $mQuery;
                
	}
        public function getLastInsertedId($sQuery = false)
        {   if($sQuery){
                $mQuery =$this->mConnection->prepare($sQuery);
                $mQuery->execute();
	    }	
            return $nLastInsertId = $this->mConnection->lastInsertId();
        }        
	public function getData($mQueryHandler,$sChoice="ARRAY")
	{
            $aRecordSet = array();
        
            switch($sChoice)
            {
                    case "ROW":
                                $aRecordSet = $mQueryHandler->fetch(PDO::FETCH_BOTH);
                    break;

                    case "ARRAY":
                                $aRecordSet = $mQueryHandler->fetchAll();
                    break;
                    
                    case "OBJ":
                                $aRecordSet = $mQueryHandler->fetchAll(PDO::FETCH_ASSOC);
                    break;						
            } 
            return $aRecordSet;
        }
        public function countQueryRow($sQuery)
	{
		$aRecordSet = $this->getData($sQuery);
                return count($aRecordSet);
	}
        public function connectionClose()
	{
		$this->mConnection= null;
	}
  }
  
