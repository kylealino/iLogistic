<?php
namespace App\Models;
use CodeIgniter\Model;

class MyUserModel extends Model
{
    // .. other member variables
    protected $db;

    public function __construct()
    {
        parent::__construct();
        $this->session = session();
        $this->request = \Config\Services::request();
        //$this->db = \Config\Database::connect();
        // OR $this->db = db_connect();
        $this->mydbname = model('App\Models\MyDBNamesModel');
        $this->db_erp = $this->mydbname->medb(0);
        $this->mylibzdb = model('App\Models\MyLibzDBModel');
    }


    
    
    public function mysys_user() { 
        return $this->session->get('__xsys_myuserziamsys__');
    }   
    
    public function msys_pw_salt() { 
        return "mysyztemzB3L3";
    } 
    
    public function msys_is_logged() { 
        return $this->session->get('__xsys_myuserziamsys_is_logged__');
    }
    
    public function mpw_tkn() { 
        return self::mysys_user() . self::msys_pw_salt();
    }    
    
	public function mysys_usergrp() { 
		return $this->session->__xsys_myuserziamsys_group__;
	}
	public function mysys_userlvl() { 
		return $this->session->__xsys_myuserziamsys_level__;
	}
	
	public function mysys_userdept() { 
		return $this->session->__xsys_myuserziamsys_dept__;
	}
		    
    
    public function Verify_User($cuser='') { 
		$str = "select `myua_uname`,`myua_fulln`,`myua_passwd`,`myua_date_s`,`myua_date_e`,`mactive`,`muser_encde`,`mflag`,`mprocdate`,
		current_date() xcurdate,myua_dept,`myua_aremote` from {$this->db_erp}.`myua_user` where myua_uname = '{$cuser}' limit 1 ";
		$q = $this->mylibzdb->myoa_sql_exec($str,'URI: ' . $_SERVER['PHP_SELF'] . chr(13) . chr(10) . 'File: ' . __FILE__  . chr(13) . chr(10) . 'Line Number: ' . __LINE__);		
		return $q;
	}  //end Verify_User

    public function Verify_Password($cuserpassdb='',$cuserpass='') { 
		$str = "select if('{$cuserpassdb}' = sha2('{$cuserpass}',512),1,0) metruefalse limit 1 ";
		//echo $str . '<br/>';
		//die();
		$q = $this->mylibzdb->myoa_sql_exec($str,'URI: ' . $_SERVER['PHP_SELF'] . chr(13) . chr(10) . 'File: ' . __FILE__  . chr(13) . chr(10) . 'Line Number: ' . __LINE__);		
		//$row = $q->getRow();		
		$row = $q->getRowArray();
		$q->freeResult();
		return $row['metruefalse'];
	}  //end Verify_User

    // ======== start for user access per module
    public function get_Active_menus($dbname,$cuser,$field='',$tblname='') { 
        $adata = '';
        $str = "select * from {$dbname}.`$tblname` WHERE `myua_uname` = '$cuser' AND ISACTIVE='Y' AND $field limit 1";
        $q = $this->mylibzdb->myoa_sql_exec($str,'URI: ' . $_SERVER['PHP_SELF'] . chr(13) . chr(10) . 'File: ' . __FILE__  . chr(13) . chr(10) . 'Line Number: ' . __LINE__);
        $adata=$q->resultID->num_rows;
        $q->freeResult();
        return $adata;
    } //end get_Active_menus


    public function ua_brnch($dbname,$uname){
        $adata = array();
        $str = "select myuabranch from {$dbname}.`myua_branch` where myusername ='$uname' AND ISACTIVE='Y'";
        //$q = $this->db->query($str);
        $q = $this->mylibzdb->myoa_sql_exec($str,'URI: ' . $_SERVER['PHP_SELF'] . chr(13) . chr(10) . 'File: ' . __FILE__  . chr(13) . chr(10) . 'Line Number: ' . __LINE__);
        if($q->getNumRows() > 0) { 
            $qrw = $q->getResultArray();
            foreach($qrw as $rw): 
                $adata[] = $rw['myuabranch'];
            endforeach;
        }
        $q->freeResult();
        return $adata;
    } //end ua_brnch

    public function ua_comp_code($dbname,$uname) { 
        $adata = array();
        $str = "select myuacomp,bb.COMP_CODE from {$dbname}.`myua_company` aa
        JOIN {$this->db_erp}.mst_company bb ON(aa.myuacomp=bb.recid)
         where myusername ='$uname' AND ISACTIVE='Y'";
        //$q = $this->db->query($str);
        $q = $this->mylibzdb->myoa_sql_exec($str,'URI: ' . $_SERVER['PHP_SELF'] . chr(13) . chr(10) . 'File: ' . __FILE__  . chr(13) . chr(10) . 'Line Number: ' . __LINE__);
        if($q->resultID->num_rows > 0) { 
            $qrw = $q->getResultArray();
            foreach($qrw as $rw): 
                $adata[] = $rw['COMP_CODE'];
            endforeach;
        }
        $q->freeResult();
        return $adata;    
    }  //end ua_comp_code

	public function ua_comp($dbname,$uname){
		$adata = array();
		$str = "select myuacomp from {$this->db_erp}.`myua_company` where myusername ='$uname' AND ISACTIVE='Y'";
		//$q = $this->db->query($str);
		$q = $this->mylibzdb->myoa_sql_exec($str,'URI: ' . $_SERVER['PHP_SELF'] . chr(13) . chr(10) . 'File: ' . __FILE__  . chr(13) . chr(10) . 'Line Number: ' . __LINE__);
		if($q->getNumRows() > 0) { 
			$qrw = $q->getResultArray();
			foreach($qrw as $rw): 
				$adata[] = $rw['myuacomp'];
			endforeach;
		}
		$q->freeResult();
		return $adata;
	}
	
	public function ua_supp($dbname,$uname){
		$adata = array();
		$str = "select myuasupp_id from {$this->db_erp}.`myua_supp` where myusername ='$uname' AND ISACTIVE='Y'";
		//$q = $this->db->query($str);
		$q = $this->mylibzdb->myoa_sql_exec($str,'URI: ' . $_SERVER['PHP_SELF'] . chr(13) . chr(10) . 'File: ' . __FILE__  . chr(13) . chr(10) . 'Line Number: ' . __LINE__);
		if($q->getNumRows() > 0) { 
			$qrw = $q->getResultArray();
			foreach($qrw as $rw): 
				$adata[] = $rw['myuasupp_id'];
			endforeach;
		}
		$q->freeResult();
		return $adata;
	}  //end ua_supp
	
	public function ua_cust($dbname,$uname){
		$adata = array();
		$str = "select myuacust_id from {$this->db_erp}.`myua_cust` where myusername ='$uname' AND ISACTIVE='Y'";
		//$q = $this->db->query($str);
		$q = $this->mylibzdb->myoa_sql_exec($str,'URI: ' . $_SERVER['PHP_SELF'] . chr(13) . chr(10) . 'File: ' . __FILE__  . chr(13) . chr(10) . 'Line Number: ' . __LINE__);
		if($q->getNumRows() > 0) { 
			$qrw = $q->getResultArray();
			foreach($qrw as $rw): 
				$adata[] = $rw['myuacust_id'];
			endforeach;
		}
		$q->free_result();
		return $adata;
	}  //end ua_cust
	
	public function view_recs($npages = 1,$npagelimit = 30,$msearchrec='') {
		$cuser = $this->mysys_user();
		$mpw_tkn = $this->mpw_tkn();
		if(!isset($cuser)) {
			//die();
		}

		$str_optn = "";
		if(!empty($msearchrec)) { 
			$msearchrec = $this->mylibzdb->dbx->escapeString($msearchrec);
			$str_optn = " where (myusername like '%$msearchrec%' or myuserfulln like '%$msearchrec%') ";
		}
		
		$strqry = "
		select aa.*,
		sha2(concat(aa.recid,'{$mpw_tkn}'),384) mtkn_arttr 
		 from {$this->db_erp}.`myusers` aa {$str_optn} 
		";
		
		
		$str = "
		select count(*) __nrecs from ({$strqry}) oa
		";
		$qry = $this->mylibzdb->myoa_sql_exec($str,'URI: ' . $_SERVER['PHP_SELF'] . chr(13) . chr(10) . 'File: ' . __FILE__  . chr(13) . chr(10) . 'Line Number: ' . __LINE__);
		$rw = $qry->getRowArray();
		$npagelimit = ($npagelimit > 0 ? $npagelimit : 30);
		$nstart = ($npagelimit * ($npages - 1));
		
		$npage_count = ceil(($rw['__nrecs'] + 0) / $npagelimit);
		$data['npage_count'] = $npage_count;
		$data['npage_curr'] = $npages;
		$str = "
		SELECT * from ({$strqry}) oa limit {$nstart},{$npagelimit} ";
		$qry = $this->mylibzdb->myoa_sql_exec($str,'URI: ' . $_SERVER['PHP_SELF'] . chr(13) . chr(10) . 'File: ' . __FILE__  . chr(13) . chr(10) . 'Line Number: ' . __LINE__);
		
		if($qry->resultID->num_rows > 0) { 
			$data['rlist'] = $qry->getResultArray();
		} else { 
			$data = array();
			$data['npage_count'] = 1;
			$data['npage_curr'] = 1;
			$data['rlist'] = '';
		}
		return $data;
	}  //end view_recs 
	
	public function ua_mod_access_verify($dbname,$uname,$MSA_SYS,$MSA_MODULE,$MSA_SMODULE) { 
		$cuser = $this->mysys_user();
		$mpw_tkn = $this->mpw_tkn();
		$str = "select `MSA_MRK` from {$dbname}.mod_sec_accs where `MSA_USER` = '$uname' and `MSA_SYS` = '$MSA_SYS' and MSA_MODULE = '$MSA_MODULE' and MSA_SMODULE = '$MSA_SMODULE' and MSA_MRK = 'Y'";
		$q = $this->mylibzdb->myoa_sql_exec($str,'URI: ' . $_SERVER['PHP_SELF'] . chr(13) . chr(10) . 'File: ' . __FILE__  . chr(13) . chr(10) . 'Line Number: ' . __LINE__);
		$lok = (($q->resultID->num_rows > 0) ? 1 : 0);
		$q->freeResult();
		return $lok;
	} //end ua_mod_access
	
	
	
	public function ua_mod_access_save() { 
		$cuser = $this->mysys_user();
		$mpw_tkn = $this->mpw_tkn();
		$mtkn_uatr = $this->request->getVar('mtkn_uatr');
		$mtkn_arttr = $this->request->getVar('mtkn_arttr');
		$mcheck = $this->request->getVar('mcheck');
		if(!$this->ua_mod_access_verify($this->db_erp,$cuser,'00','0001','000101')) { 
			echo "<div class=\"alert alert-danger mb-0\" role=\"alert\"><strong>Restricted.<br/></strong><strong>Access DENIED!!!</strong></div>";
			die();
		}
		
		$str = "select (select myusername from {$this->db_erp}.myusers where sha2(concat(recid,'{$mpw_tkn}'),384) = '$mtkn_uatr') `myusername`,`MSA_SYS`,`MSA_MODULE`,`MSA_SMODULE`,'$mcheck' from {$this->db_erp}.mod_sec_menus aa where sha2(concat(aa.recid,'{$mpw_tkn}'),384) = '$mtkn_arttr'";
		$q = $this->mylibzdb->myoa_sql_exec($str,'URI: ' . $_SERVER['PHP_SELF'] . chr(13) . chr(10) . 'File: ' . __FILE__  . chr(13) . chr(10) . 'Line Number: ' . __LINE__);
		if($q->resultID->num_rows > 0) { 
			$rw = $q->getRowArray();
			$str = "select recid from {$this->db_erp}.mod_sec_accs where `MSA_USER` = '{$rw['myusername']}' and 
			`MSA_SYS` = '{$rw['MSA_SYS']}' and `MSA_MODULE` = '{$rw['MSA_MODULE']}' and `MSA_SMODULE` = '{$rw['MSA_SMODULE']}'";
			$qa = $this->mylibzdb->myoa_sql_exec($str,'URI: ' . $_SERVER['PHP_SELF'] . chr(13) . chr(10) . 'File: ' . __FILE__  . chr(13) . chr(10) . 'Line Number: ' . __LINE__);
			if($qa->resultID->num_rows > 0) { 
				$rwa = $qa->getRowArray();
				$adataz = array();
				$adataz[] = "MSA_MRKxOx'{$mcheck}'";
				$str = " recid = {$rwa['recid']} ";
				$this->mylibzdb->logs_modi_audit($adataz,$this->db_erp,'`mod_sec_accs`','UA_MANAGEMENT',$rwa['recid'],$str);
				$str = "update {$this->db_erp}.mod_sec_accs set `MSA_MRK` = '$mcheck',`MSA_ENCDTE` = now() where recid = {$rwa['recid']}";
				echo "<div class=\"alert alert-success mb-0\" role=\"alert\"><strong>Info.<br/></strong><strong>Update</strong> Access Done!!!</div>";
				$this->mylibzdb->user_logs_activity_module($this->db_erp,'UA_MANAGEMENT','',$cuser,$str,'URI: ' . $_SERVER['PHP_SELF'] . chr(13) . chr(10) . 'File: ' . __FILE__  . chr(13) . chr(10) . 'Line Number: ' . __LINE__);
			} else {
				$adataz = array();
				$adataz[] = "MSA_SYSxOx'{$rw['MSA_SYS']}'";
				$adataz[] = "MSA_MODULExOx'{$rw['MSA_MODULE']}'";
				$adataz[] = "MSA_SMODULExOx'{$rw['MSA_SMODULE']}'";
				$adataz[] = "MSA_MRKxOx'{$mcheck}'";
				$str = " recid = 0 ";
				$this->mylibzdb->logs_modi_audit($adataz,$this->db_erp,'`mod_sec_accs`','UA_MANAGEMENT','',$str);
				$str = "insert into {$this->db_erp}.mod_sec_accs (`MSA_USER`,
				`MSA_SYS`,
				`MSA_MODULE`,
				`MSA_SMODULE`,
				`MSA_MRK`) values('{$rw['myusername']}','{$rw['MSA_SYS']}','{$rw['MSA_MODULE']}','{$rw['MSA_SMODULE']}','$mcheck')";
				echo "<div class=\"alert alert-success mb-0\" role=\"alert\"><strong>Info.<br/></strong><strong>Newly set Access Done!!!</strong></div>";
				$this->mylibzdb->user_logs_activity_module($this->db_erp,'UA_MANAGEMENT','',$cuser,$str,'URI: ' . $_SERVER['PHP_SELF'] . chr(13) . chr(10) . 'File: ' . __FILE__  . chr(13) . chr(10) . 'Line Number: ' . __LINE__);
			}
			$this->mylibzdb->myoa_sql_exec($str,'URI: ' . $_SERVER['PHP_SELF'] . chr(13) . chr(10) . 'File: ' . __FILE__  . chr(13) . chr(10) . 'Line Number: ' . __LINE__);
			$qa->freeResult();
		}
		$q->freeResult();
	} //end ua_ua_mod_access_save
	
}  //end main class
?>
