<?php
# ********************************************************
# Project : Info4City
# Manager : 
# Author  : Vikas Saini
# Created : ---
# Graphics: ---
# Edits By: ---
# Doc Role: This Class is for Making the Query and Contacting With	the Data Abstraction Layer
# ********************************************************

require_once("db.class.php");
class CLSQueryMaker
{
	var $db_last="";
	var $strHostLink;
	var $strUsername;
	var $strPassWord;
	var $strDatabaseName;
	var $mySql;	
	var $strErrorMessage;

	/**
	 * __construct()			: Constructor of the class
     * 
	 * @param $strpHost			: Host to connect
	 * @param $strpUserName		: User name to connect
	 * @param $strpUserName		: User name to connect	
	 * @param $strpPassword		: User password to connect	
	 * @param $strpDatabaseName	: Name of the database
	 * @return 
	 **/

	function __construct($strpHost, $strpUserName, $strpPassword, $strpDatabaseName){
		$this->strHostLink = $strpHost;
		$this->strUsername = $strpUserName;
		$this->strPassWord = $strpPassword;
		$this->strDatabaseName = $strpDatabaseName;
		$this->mySql =  new CLSMySql($this->strHostLink, $this->strUsername, $this->strPassWord, $this->strDatabaseName);
	}

	/**
	 * mysqlRawquery()			: make a mysql query
	 * 
	 * @param $db_base			: database to access
	 * @param $query			: query to launch
	 * @return 
	 **/

	function mysqlRawquery($query) {
		if(!$this->mySql->dbConnect()){
			$this->strErrorMessage = $this->mySql->getErrorMessage();
			return false;
		}

		if(!$this->mySql->dbExecuteQuery($query)){					
			$this->strErrorMessage = $this->mySql->getErrorMessage();
			return false;
		}
		if (strtoupper(substr($query,0,6))=="SELECT"){
			$db_result=$this->mySql->dbFetchResult();
			return $db_result;
		}
		return true;
	}

	/**
	 * mysqlSelect()      : make a mysql select
	 *
	 * @param $fields     : list of field to select
	 * @param $tables     : list names of the tables
	 * @param $where      : where condition
	 * @param $order_by   : fields to be ordered by
	 * @param $group_by   : fields to be groupered by
	 * @param $having     : having condition
	 * @param $limit      : limit clause
	 * @return 
	 **/

	function mysqlSelect($fields,$tables,$where="",$order_by="",$group_by="",$having="",$limit="") {
		$sql="SELECT $fields FROM $tables ";
		if (!empty($where)) $sql.="WHERE $where ";  
		if (!empty($group_by)) $sql.="GROUP BY $group_by ";  
		if (!empty($order_by)) $sql.="ORDER BY $order_by ";  
		if (!empty($having)) $sql.="HAVING $having ";  
		if (!empty($limit)) $sql.="LIMIT $limit ";
		//echo "<br>".$sql."<br />"; 
		return $this->mysqlRawquery($sql);
	}

	function mysqlAffected(){
		return $this->mySql->dbGetAffectedRows();
	}

	function mysqlCountRows(){
		return $this->mySql->dbGetNumRows();
	}

	/**
	 * mysqlInsert()				: make a mysql insert
	 *
	 * @param $table				: name of the table
	 * @param $liste_champs			: array of the field to insert
	 * @param $liste_valeur			: array of the valued of the field to insert
	 * @return 
	 **/

	function mysqlInsert($table,$liste_champs,$liste_valeur,$debug=0) {
		$sql="INSERT INTO `$table` ";
		if (count($liste_champs)==count($liste_valeur)+1) // have to find next_id and insert in $liste_valeur
		array_unshift($liste_valeur,$this->mysqlNextIndex($liste_champs[0],$table));
		$temp1=implode("`,`",$liste_champs);
		$temp2=implode("','",$liste_valeur);
		$sql.="(`$temp1`) VALUES ('$temp2')";
		//echo $sql;
		if($debug=="1"){
		}
		return $this->mysqlRawquery($sql);
	}
	
	
	function mysqlMultipleInsert($table,$liste_champs,$liste_valeur) {
		$i=0;
		$sql="INSERT INTO `$table` ";
		$temp1=implode(",",$liste_champs);
		$sql.="($temp1) VALUES ";			
		foreach($liste_valeur as $k=>$v) {
			$sql .= "('".implode("','",$v)."')";				
			$i++;
		  if(count($liste_valeur) > $i)
			$sql .= ",";
		}
//			print $sql;
//			print "<br>";
		return $this->mysqlRawquery($sql);
	}

	/**
	 * mysqlUpdate()                  : make a mysql update
	 *
	 * @param $table				  : name of the table
	 * @param $liste_champs	          : array of the field to update
	 * @param $liste_valeur	          : array of the valued of the field to update
	 * @param $where				  : where condition
	 * @return 
	 **/

	function mysqlUpdate($table,$liste_champs,$liste_valeur,$where,$ipid='') {
		if ($where!="") {
			$sql="UPDATE `$table` SET ";
			for ($i=0;$i<count($liste_champs);$i++)
				$sql.="`".$liste_champs[$i]."`='".$liste_valeur[$i]."'".(($i==count($liste_champs)-1)?"":" , ");
			  $sql.=" WHERE $where";
echo $sql;
			return $this->mysqlRawquery($sql);
		}
	}

	/**
	 * mysqlDelete()	: make a mysql delete query
	 *
	 * @param $table    : name of the table
	 * @param $where    : where condition
	 * @return 
	 **/

	function mysqlDelete($table,$where) {
		if ($where!="") {
			echo $sql="DELETE FROM `$table` WHERE ($where)";
			return $this->mysqlRawquery($sql);
		}
	}

	/**
	 * mysqlNextIndex()		: find the most free little index of the table
	 *
	 * @param $index		: the name of the index column
	 * @param $table		: name of the table
	 * @return 
	 **/

	function mysqlNextIndex($index,$table) {
		$tab=$this->mysqlRawquery("SELECT $index FROM $table ORDER BY $index DESC LIMIT 0,1");
		if (count($tab)==0)
			return 0;
		else
			return $tab[0][$index]+1;
	}

	/**
	 * mysqlSelectDiff()	: make a select a,b,c,d from table1 where (a not in select a from table2 where ())and/or()
	 *
	 * @param $db_base			: database to access
	 * @param $query_plus		: select of the lines we want
	 * @param $query_moins: !! select of the lines we don't want (!! 1 column only)
	 * @return
	 **/

	function mysqlSelectDiff($query_plus,$query_moins) {
		$tab_plus=$this->mysqlRawquery($query_plus);
		if ($query_moins!="") {
			$tab_moins=$this->mysqlRawquery($query_moins);
			if (count($tab_moins)>0) {	
				$keys1=array_keys($tab_plus[0]);
				$keys2=array_keys($tab_moins[0]);
				for ($i=0,$res=array();$i<count($tab_plus);$i++) {
					for ($j=0,$find=false;$j<count($tab_moins);$j++)
						if ($tab_moins[$j][$keys2[0]]==$tab_plus[$i][$keys1[0]])
							$find=true;
					if (!$find)
						$res[]=$tab_plus[$i];
				}
				return $res;
			}
			else
				return $tab_plus;
		}
		else
			return $tab_plus;
	}

	/**
	 * mysqlSelectValue()
	 *
	 * @param $query      : la requete avec seuleument 1 colonne selectionn�!!
	 * @param $default    : default value to return if query return null result
	 * @return la valeur retourn� en ligne 0 de la requete.
 	 **/

	function mysqlSelectValue($query,$default="") {
		$tab=$this->mysqlRawquery($query." LIMIT 0,1");
		if (count($tab)==1) {
			$keys=array_keys($tab[0]);	
			return $tab[0][$keys[0]];
		}else{
			return $default;
		}
	}

	function mysqlFreeResult(){
		$this->mySql->dbFreeResult();
	}

	function mysqlLastId(){
		return $this->mySql->dbGetLastId();
	}

	function getErrorMessage(){
		return $this->strErrorMessage;
	}
}// END OF CLASS
?>