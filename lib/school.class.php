<?php
  class school extends siCommon
  {
        // constructor
        public function __construct($aCredentials) 
        {           
            parent::__construct($aCredentials['dbHost'],$aCredentials['dbUser'],$aCredentials['dbPassword'],$aCredentials['dbName']);
        }
        public function getschool($sTableName,$aFields,$sCondition)
        {
            $sQuery = " SELECT 
                            " . $aFields[0] . "
                        FROM 
                            ".$sTableName." 
                        where 
                            " . $sCondition;
            $mQueryCategoryHandler = $this->getList($sQuery);
            return $this->getData($mQueryCategoryHandler,"ARRAY");
        }
        public function insertUpdateschool($sTableName,$aInsertFields,$aInsertValues)
        {
            $this->saveRecords($sTableName,$aInsertFields,$aInsertValues);
            return $nLastInsertId = $this->getLastInsertedId();
        }
        public function getJobAndschool($sJobTableName,$sJobThreadTableName,$aFields ,$sCondition)
        {
            $sQuery = "SELECT 
                            ".implode(',' , $aFields)."
                        FROM
                                    ".$sJobTableName."
                        LEFT JOIN
                                    ".$sJobThreadTableName."
                        ON
                                    $sJobTableName.id = $sJobThreadTableName.id_jobs
                        WHERE".
                                    $sCondition;
            $sQueryHandler = $this->executeQuery($sQuery);
            $result = $this->getData($sQueryHandler,"ARRAY");
            return $result;
        }
        
        public function updateschool($sTableName,$sValues,$sWhere){
            $sQuery="UPDATE $sTableName SET $sValues WHERE $sWhere";
            $this->executeQuery($sQuery);
        }

        public function insertschool($sTableName,$aFields,$aValues){
            $this->insertRecords($sTableName,$aFields,$aValues);
            return $nLastInsertId = $this->getLastInsertedId();
        }
  }