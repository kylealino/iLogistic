<?php
namespace App\Models;
use CodeIgniter\Model;
class MyMDArticleModel extends Model
{
	public function __construct()
	{ 
		parent::__construct();
		$this->mylibzsys = model('App\Models\MyLibzSysModel');
		$this->myusermod = model('App\Models\MyUserModel');
		$this->db_erp = $this->myusermod->mydbname->medb(0);
		$this->db_temp = $this->myusermod->mydbname->medb(2);
		$this->cuser = $this->myusermod->mysys_user();
		$this->mpw_tkn = $this->myusermod->mpw_tkn();
	}	
	
	public function view_recs($npages = 1,$npagelimit = 30,$msearchrec='') { 
		$cuser = $this->myusermod->mysys_user();
		$mpw_tkn = $this->myusermod->mpw_tkn();
		if(!isset($cuser)) {
			//die();
		}

		$str_optn = "";
		if(!empty($msearchrec)) { 
			$msearchrec = $this->dbx->escapeString($msearchrec);
			$str_optn = " where (ART_CODE like '%$msearchrec%' or ART_DESC like '%$msearchrec%' or 
			ART_BARCODE1 like '%$msearchrec%') ";
		}
		
		$strqry = "
		select aa.*,
		IF(aa.`ART_ISDISABLE` = 1, 'Inactive','Active') _ART_ISDISABLE,
		sha2(concat(aa.recid,'{$mpw_tkn}'),384) mtkn_arttr 
		 from {$this->db_erp}.`mst_article` aa {$str_optn} 
		";
		
		
		$str = "
		select count(*) __nrecs from ({$strqry}) oa
		";
		$qry = $this->myusermod->mylibzdb->myoa_sql_exec($str,'URI: ' . $_SERVER['PHP_SELF'] . chr(13) . chr(10) . 'File: ' . __FILE__  . chr(13) . chr(10) . 'Line Number: ' . __LINE__);
		$rw = $qry->getRowArray();
		$npagelimit = ($npagelimit > 0 ? $npagelimit : 30);
		$nstart = ($npagelimit * ($npages - 1));
		
		
		$npage_count = ceil(($rw['__nrecs'] + 0) / $npagelimit);
		$data['npage_count'] = $npage_count;
		$data['npage_curr'] = $npages;
		$str = "
		SELECT * from ({$strqry}) oa limit {$nstart},{$npagelimit} ";
		$qry = $this->myusermod->mylibzdb->myoa_sql_exec($str,'URI: ' . $_SERVER['PHP_SELF'] . chr(13) . chr(10) . 'File: ' . __FILE__  . chr(13) . chr(10) . 'Line Number: ' . __LINE__);
		
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
    
	public function imported_view_recs($npages = 1,$npagelimit = 30,$msearchrec='') { 
		$cuser = $this->mylibz->mysys_user();
		$mpw_tkn = $this->mylibz->mpw_tkn();
		//$mtkn_ctrlno = $this->input->get_post('mtkn_ctrlno');
		$str_optn = "";
		if(!empty($msearchrec)) { 
			$msearchrec = $this->dbx->escape_str($msearchrec);
			$str_optn = " WHERE (a.`ML_CTRLNO` like '%$msearchrec%' or a.`ML_USER` like '%$msearchrec%')";
		}
		$strqry = "
		SELECT
		  a.`recid`,
		  a.`ML_CTRLNO`,
		  a.`ML_RECS`,
		  a.`ML_PROC_RECS`,
		  a.`ML_PRODT`,
		  a.`ML_TEMPTBL`,
		  a.`ML_ISPOSTED`,
		  a.`ML_USER`,
		  a.`ML_ENCD`,
		  a.`ML_POST_USER`,
		  a.`ML_POST_ENCD`,
		  a.`ML_TAG`,
		  a.`ML_PROC_USER`,
		  a.`ML_PROC_ENCD`
		FROM {$this->db_erp}.`trx_artm_upld_posting_logs` a
		{$str_optn}

		";
		

		//var_dump($__hmtkn_prd_upldpost_c1_ar);
		$str = "
		select count(*) __nrecs from ({$strqry}) oa
		";
		$qry = $this->mylibz->myoa_sql_exec($str,'URI: ' . $_SERVER['PHP_SELF'] . chr(13) . chr(10) . 'File: ' . __FILE__  . chr(13) . chr(10) . 'Line Number: ' . __LINE__);
		$rw = $qry->row_array();
		$npagelimit = ($npagelimit > 0 ? $npagelimit : 30);
		$nstart = ($npagelimit * ($npages - 1));
		
		
		$npage_count = ceil(($rw['__nrecs'] + 0) / $npagelimit);
		$data['npage_count'] = $npage_count;
		$data['npage_curr'] = $npages;
		$str = "
		SELECT * from ({$strqry}) oa ORDER BY recid DESC limit {$nstart},{$npagelimit}";
		$qry = $this->mylibz->myoa_sql_exec($str,'URI: ' . $_SERVER['PHP_SELF'] . chr(13) . chr(10) . 'File: ' . __FILE__  . chr(13) . chr(10) . 'Line Number: ' . __LINE__);
		
		
		if($qry->num_rows() > 0) { 
			$data['rlist'] = $qry->result_array();
			
		} else { 
			$data = array();
			$data['npage_count'] = 1;
			$data['npage_curr'] = 1;
			$data['rlist'] = '';
		}
		return $data;
	} //end upldpost_hd_view_recs
    
    
    public function profile_save() { 
		$cuser = $this->myusermod->mysys_user();
		$mpw_tkn = $this->myusermod->mpw_tkn();
		
		$mtkn_etr = $this->request->getVar('mtkn_etr');
		$maction = $this->request->getVar('maction');
		$meprodlc = $this->dbx->escapeString($this->request->getVar('meprodlc'));
		$mematcode = $this->dbx->escapeString($this->request->getVar('mematcode'));
		$mebarcode = $this->dbx->escapeString($this->request->getVar('mebarcode'));
		$mematdesc = $this->dbx->escapeString($this->request->getVar('mematdesc'));
		$mepartnumber = $this->dbx->escapeString($this->request->getVar('mepartnumber'));
		$flexSwitchCheckArtRecActive = $this->request->getVar('flexSwitchCheckArtRecActive');
		$meprodt = $this->dbx->escapeString($this->request->getVar('meprodt'));
		$meprodcat = $this->dbx->escapeString($this->request->getVar('meprodcat'));
		$meprodscat = $this->dbx->escapeString($this->request->getVar('meprodscat'));
		$meunitc = (empty($this->request->getVar('meunitc')) ? 0 : ($this->request->getVar('meunitc') + 0));
		$meunitp = (empty($this->request->getVar('meunitp')) ? 0 : ($this->request->getVar('meunitp') + 0));
		$meunitpack = $this->request->getVar('meunitpack');
		$meuom = $this->request->getVar('meuom');
		$megweight = (empty($this->request->getVar('megweight')) ? 0 : ($this->request->getVar('megweight') + 0));
		$meconvf = (empty($this->request->getVar('meconvf')) ? 0 : ($this->request->getVar('meconvf') + 0));
		
		//updating of records
		if(!empty($mtkn_etr)) { 
			$str = "select recid,ART_CODE from {$this->db_erp}.`mst_article` aa where sha2(concat(aa.recid,'{$mpw_tkn}'),384) = '$mtkn_etr'";
			$q = $this->myusermod->mylibzdb->myoa_sql_exec($str,'URI: ' . $_SERVER['PHP_SELF'] . chr(13) . chr(10) . 'File: ' . __FILE__  . chr(13) . chr(10) . 'Line Number: ' . __LINE__  . chr(13) . chr(10) . 'User: ' . $cuser);
			if($q->getNumRows() > 0) { 
				$rw = $q->getRowArray();
				if($mematcode == $rw['ART_CODE']) { 
					$adataz = array();
					$adataz[] = "ART_DESCxOx'{$mematdesc}'";
					$adataz[] = "ART_PARTNOxOx'{$mepartnumber}'";
					$adataz[] = "ART_HIERC1xOx'{$meprodcat}'";
					$adataz[] = "ART_HIERC2xOx'{$meprodt}'";
					$adataz[] = "ART_HIERC3xOx'{$meprodscat}'";
					$adataz[] = "ART_SKUxOx'{$meunitpack}'";
					$adataz[] = "ART_UOMxOx'{$meuom}'";
					$adataz[] = "ART_BARCODE1xOx'{$mebarcode}'";
					$adataz[] = "ART_ISDISABLExOx'{$flexSwitchCheckArtRecActive}'";
					$adataz[] = "ART_PRODLxOx'{$meprodlc}'";
					$adataz[] = "ART_NCONVFxOx'{$meconvf}'";
					$adataz[] = "ART_GWEIHGTxOx'{$megweight}'";
					$adataz[] = "ART_UPPRICExOx'{$meunitp}'";
					$adataz[] = "ART_UCOSTxOx'{$meunitc}'";
					$str = " recid = {$rw['recid']} ";
					$this->mylibzdb->logs_modi_audit($adataz,$this->db_erp,'`mst_article`','MATITEM_UREC',$mematcode,$str);
					$str = "update {$this->db_erp}.`mst_article` set ART_DESC = '$mematdesc',
					`ART_PARTNO` = '$mepartnumber',
					`ART_HIERC1` = '$meprodcat',
					`ART_HIERC2` = '$meprodt',
					`ART_HIERC3` = '$meprodscat',
					`ART_SKU` = '$meunitpack',
					`ART_UOM` = '$meuom',
					`ART_BARCODE1` = '$mebarcode',
					`ART_ISDISABLE` = '$flexSwitchCheckArtRecActive',
					`ART_PRODL` = '$meprodlc',
					`ART_NCONVF` = '$meconvf',
					`ART_GWEIHGT` = '$megweight',
					`ART_UPPRICE` = '$meunitp',
					`ART_UCOST` = '$meunitc'
					where recid = {$rw['recid']} ";
					$this->mylibzdb->myoa_sql_exec($str,'URI: ' . $_SERVER['PHP_SELF'] . chr(13) . chr(10) . 'File: ' . __FILE__  . chr(13) . chr(10) . 'Line Number: ' . __LINE__  . chr(13) . chr(10) . 'User: ' . $cuser);
					$this->mylibzdb->user_logs_activity_module($this->db_erp,'MATITEM_UREC',$mematcode,$mematcode,$str,'');
					echo "Changes successfuly done!!!";
				} else { 
					echo "Material Code conflict for update!!!";
				}
			} 
		} else { 
			//adding of records
			$str = "select recid,ART_CODE from {$this->db_erp}.`mst_article` aa where `ART_CODE` = '$mematcode'";
			$q = $this->myusermod->mylibzdb->myoa_sql_exec($str,'URI: ' . $_SERVER['PHP_SELF'] . chr(13) . chr(10) . 'File: ' . __FILE__  . chr(13) . chr(10) . 'Line Number: ' . __LINE__  . chr(13) . chr(10) . 'User: ' . $cuser);
			if($q->getNumRows() > 0) { 
				$rw = $q->getRowArray();
				echo "Material Code already EXISTS!!!";
				die();
			} else { 
				if($maction == 'A_REC') { 
					$adataz = array();
					$adataz[] = "ART_CODExOx'{$mematcode}'";
					$adataz[] = "ART_DESCxOx'{$mematdesc}'";
					$adataz[] = "ART_PARTNOxOx'{$mepartnumber}'";
					$adataz[] = "ART_HIERC1xOx'{$meprodcat}'";
					$adataz[] = "ART_HIERC2xOx'{$meprodt}'";
					$adataz[] = "ART_HIERC3xOx'{$meprodscat}'";
					$adataz[] = "ART_SKUxOx'{$meunitpack}'";
					$adataz[] = "ART_UOMxOx'{$meuom}'";
					$adataz[] = "ART_BARCODE1xOx'{$mebarcode}'";
					$adataz[] = "ART_ISDISABLExOx'{$flexSwitchCheckArtRecActive}'";
					$adataz[] = "ART_PRODLxOx'{$meprodlc}'";
					$adataz[] = "ART_NCONVFxOx'{$meconvf}'";
					$adataz[] = "ART_GWEIHGTxOx'{$megweight}'";
					$adataz[] = "ART_UPPRICExOx'{$meunitp}'";
					$adataz[] = "ART_UCOSTxOx'{$meunitc}'";
					$str = " ART_CODE = '$mematcode' ";
					$this->mylibzdb->logs_modi_audit($adataz,$this->db_erp,'`mst_article`','MATITEM_AREC',$mematcode,$str);
					$str = "
					insert into {$this->db_erp}.`mst_article` (
					`ART_CODE`,`ART_DESC`,`ART_HIERC1`,`ART_HIERC2`,`ART_HIERC3`,`ART_PRODL`,
					`ART_SKU`,`ART_UOM`,`ART_BARCODE1`,`ART_ISDISABLE`,`ART_NCONVF`,`ART_PARTNO`,
					`ART_GWEIHGT`,`ART_UPPRICE`,`ART_UCOST`,`MUSER`,`ENCD`
					) values (
					'$mematcode','$mematdesc','$meprodcat','$meprodt','$meprodscat','$meprodlc',
					'$meunitpack','$meuom','$mebarcode','$flexSwitchCheckArtRecActive','$meconvf','$mepartnumber',
					'$megweight','$meunitp','$meunitc','$cuser',now()
					)
					";
					$this->mylibzdb->myoa_sql_exec($str,'URI: ' . $_SERVER['PHP_SELF'] . chr(13) . chr(10) . 'File: ' . __FILE__  . chr(13) . chr(10) . 'Line Number: ' . __LINE__  . chr(13) . chr(10) . 'User: ' . $cuser);
					$this->mylibzdb->user_logs_activity_module($this->db_erp,'MATITEM_AREC',$mematcode,$mematcode,$str,'');
					echo "Records successfuly added!!!";
				} else { //end A_REC validation 
					echo "INVALID OPERATION!!!";
				}
			}
		} //end mtkn_etr validation 
		
	} //end profile_save
	
	public function md_dload() { 
		
	} //end md_dload
	
	public function Artm_Branches() { 
		$adata = array();
		$adata[] = "DEPSTORExOxDEPARTMENT STORE";
		$str = "select `recid`,`BRNCH_MBCODE`,`BRNCH_NAME`,concat('E',trim(`BRNCH_OCODE2`)) B_CODE,`BRNCH_OCODE2` from {$this->db_erp}.mst_companyBranch where `BRNCH_MAT_FLAG` = 'G' order by `BRNCH_NAME`";
		$q = $this->myusermod->mylibzdb->myoa_sql_exec($str,'URI: ' . $_SERVER['PHP_SELF'] . chr(13) . chr(10) . 'File: ' . __FILE__  . chr(13) . chr(10) . 'Line Number: ' . __LINE__  . chr(13) . chr(10) . 'User: ' . $this->cuser);
		foreach($q->getResultArray() as $rw):
			$adata[] = $rw['B_CODE'] . 'xOx' . $rw['BRNCH_NAME'];
		endforeach;
		$q->freeResult();
		return $adata;
	} //end Artm_Branches
	
	public function Artm_Branch_recs($npages = 1,$npagelimit = 30,$msearchrec='') { 
		$data = array();
		$cuser = $this->cuser;
		$mebcode = $this->myusermod->request->getVar('mebcode');
		$metmptkn = $this->myusermod->request->getVar('metmptkn');
		$data = array();
		$strqry = '';
		$str_optn = "";
		
		if (!empty($msearchrec)): 
			$msearchrec = $this->myusermod->mylibzdb->me_escapeString($msearchrec);
			$str_optn = " and (aa.`ART_CODE` = '$msearchrec'  or aa.`ART_BARCODE1` = '$msearchrec' or  aa.`ART_DESC` like '%{$msearchrec}%') ";
		endif;
		$lperbr = 0;
		if(!empty($mebcode) && $mebcode !== 'DEPSTORE') { 
			
			if(!$this->myusermod->ua_mod_access_verify($this->db_erp,$cuser,'04','0001','00010302')) { 
				echo "
				<div class=\"alert alert-danger mb-0\" role=\"alert\"><strong>Restricted.<br/></strong><strong>Access DENIED!!!</strong></div>
				";
				die();
			}			
			
			$str = "select recid,BRNCH_NAME,trim(BRNCH_OCODE2) B_OCODE2,BRNCH_MAT_FLAG,BRNCH_MBCODE   
			from {$this->db_erp}.`mst_companyBranch` aa where concat('E',trim(BRNCH_OCODE2)) = '$mebcode'";
			$q = $this->myusermod->mylibzdb->myoa_sql_exec($str,'URI: ' . $_SERVER['PHP_SELF'] . chr(13) . chr(10) . 'File: ' . __FILE__  . chr(13) . chr(10) . 'Line Number: ' . __LINE__);
			$this->myusermod->mylibzdb->user_logs_activity_module($this->db_erp,'HO_MDATAPOSLINK_GEN','',$cuser,$str,'URI: ' . $_SERVER['PHP_SELF'] . chr(13) . chr(10) . 'File: ' . __FILE__  . chr(13) . chr(10) . 'Line Number: ' . __LINE__);
			
			if($q->getNumRows() == 0) { 
				echo "<div class=\"alert alert-danger mb-0\" role=\"alert\"><strong>Info.<br/></strong><strong>Error</strong> Invalid Branch Data!!!</div>";
				die();
			}
			
			$rw = $q->getRowArray();
			$B_MBCODE = $rw['BRNCH_MBCODE'];
			$br_id = $rw['recid'];
			$br_ocode2 = $rw['B_OCODE2'];
			$lperbr = 0;
			if($rw['BRNCH_MAT_FLAG'] == 'G') { 
				$lperbr = 1;
			}
			$q->freeResult();
			//END BRANCH
		} elseif ($mebcode == 'DEPSTORE') { 
			if(!$this->myusermod->ua_mod_access_verify($this->db_erp,$cuser,'04','0001','00010301')) { 
				echo "
				<div class=\"alert alert-danger mb-0\" role=\"alert\"><strong>Restricted.<br/></strong><strong>Access DENIED!!!</strong></div>
				";
				die();
			}			
			//set default for all deptstore since dept store branches are being handled by one master data 
			$B_MBCODE = 'E0023';
		} else { 
			echo "<div class=\"alert alert-danger mb-0\" role=\"alert\"><strong>Info.<br/></strong><strong>Error</strong> Branch is REQUIRED!!!</div>";
			die();
		} // end if	
		$lcreate = 0;
		if(empty($metmptkn)):
			$metmptkn = $this->mylibzsys->random_string(15);
			$metbltmp = "{$this->db_temp}.`tmp_data_mposprice_{$metmptkn}`";
			$mescript = ROOTPATH . 'app/ThirdParty/me-python/dload-pos-pricing.py';
			exec("/usr/bin/python3 $mescript $B_MBCODE /tmp/ {$metmptkn}",$output);
			$lcreate = 1;
		endif;
		$metbltmp = "{$this->db_temp}.`tmp_data_mposprice_{$metmptkn}`";
		
		if($lperbr) { 
			if($lcreate):
				$metmpvnditem = "{$this->db_temp}.`tmp_vnditems_{$metmptkn}`";
				$str = "
				CREATE TABLE if not exists {$metmpvnditem} (
				  `ART_CODE` varchar(35) DEFAULT '',
				  `VEND_NAME` longtext,
				  UNIQUE KEY `idx01` (`ART_CODE`)
				) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci
				";
				$this->myusermod->mylibzdb->myoa_sql_exec($str,'URI: ' . $_SERVER['PHP_SELF'] . chr(13) . chr(10) . 'File: ' . __FILE__  . chr(13) . chr(10) . 'Line Number: ' . __LINE__);
				
				$str = "insert into {$metmpvnditem} (`ART_CODE`,`VEND_NAME`) 
				SELECT me.ART_CODE,GROUP_CONCAT(VEND_NAME) VEND_NAME FROM (
				SELECT 	va.ART_CODE,vd.VEND_NAME FROM {$this->db_erp}.mst_vend_artm va JOIN {$this->db_erp}.mst_vendor vd ON(va.ART_VCODE = vd.VEND_CODE) 
				JOIN (SELECT supplier_id FROM {$this->db_erp}.trx_manrecs_hd WHERE branch_id = {$br_id} GROUP BY supplier_id) br ON (vd.recid = br.supplier_id) 
				GROUP BY va.ART_CODE,vd.VEND_NAME
				) me GROUP BY ART_CODE
				";
				$this->myusermod->mylibzdb->myoa_sql_exec($str,'URI: ' . $_SERVER['PHP_SELF'] . chr(13) . chr(10) . 'File: ' . __FILE__  . chr(13) . chr(10) . 'Line Number: ' . __LINE__);
			endif;
			$metmpvnditem = "{$this->db_temp}.`tmp_vnditems_{$metmptkn}`";

			$strqry = "
			SELECT '{$B_MBCODE}' `Branch Code`,
			        REPLACE(REPLACE(REPLACE(aa.`ART_CODE`,'\t',''),'\n',''),'\r','') `Article Code`,
			        REPLACE(REPLACE(REPLACE(aa.`ART_DESC`,'\t',''),'\n',''),'\r','') `Product Description`,
			        SUBSTR(REPLACE(REPLACE(REPLACE(aa.`ART_DESC`,'\t',''),'\n',''),'\r',''),1,20) `Short Description`,
			        REPLACE(REPLACE(REPLACE(aa.`ART_BARCODE1`,'\t',''),'\n',''),'\r','') `Barcode`,
			        REPLACE(REPLACE(REPLACE(aa.`ART_UOM`,'\t',''),'\n',''),'\r','') ART_UOM,
			        aa.`ART_NCONVF`,
			        IFNULL(kk.`art_cost`,0) `Cost`,
			        REPLACE(REPLACE(REPLACE(IFNULL(gg.`MAT_CATG1_DESC`,''),'\t',''),'\n',''),'\r','') `PRODUCT CATEGORY`,
			        REPLACE(REPLACE(REPLACE(IFNULL(hh.`MAT_CATG2_DESC`,''),'\t',''),'\n',''),'\r','') `PRODUCT GROUP`,
			        REPLACE(REPLACE(REPLACE(IFNULL(ii.`MAT_CATG3_DESC`,''),'\t',''),'\n',''),'\r','') `PRODUCT CLASS`,
			        REPLACE(REPLACE(REPLACE(IFNULL(jj.`MAT_CATG4_DESC`,''),'\t',''),'\n',''),'\r','') `PRODUCT SUB GROUP`,
					IF(gg.`MAT_CATG1_CODE` = '0600','Grocery Store','Department Store') `PRODUCT TYPE`,
					IF((aa.`ART_CODE` LIKE '%SPROMO%' OR aa.`ART_CODE` LIKE '%QDAMAGE%'),0,0) __DMG,
			        IFNULL(kk.`art_uprice`,0) `SRP`,
			        IFNULL(pp.`MPROD_PRICE`,0) `POS SRP`,
			        '1' __B_VATABLE,
			        IF(gg.`MAT_CATG1_CODE` = '0600',0,IF((aa.`ART_CODE` LIKE '%SPROMO%' OR aa.`ART_CODE` LIKE '%QDAMAGE%'),0,1)) __MEMB,
			        IFNULL(mm.`B_PWDDISC`,0) __B_PWDDISC,
			        IFNULL(mm.`B_PWDDISC_VAL`,0) __B_PWDDISC_VAL,
			        IFNULL(dd.`B_SCDISC`,0) __B_SCDISC,
			        IFNULL(dd.`B_SCDISC_VAL`,0) __B_SCDISC_VAL,
			        IFNULL(ee.`B_SSPT`,0) __B_SSPT,
			        IFNULL(cc.`B_PNTS_ALLWD`,1) __B_PNTS_ALLWD,
			        IFNULL(aa.`ART_PCODE`,'SRP') __PRICING_CODE,
			        IFNULL(aa.`ART_ISDISABLE`,0) __ART_ISDISABLE,
			        REPLACE(REPLACE(REPLACE(IFNULL(vd.VEND_NAME,''),'\t',''),'\n',''),'\r','') `Supplier`,
			        IFNULL(nn.`MPROD_ID`,0) POS_MPRODID 
			        FROM {$this->db_erp}.`mst_article` aa 
			        JOIN {$this->db_erp}.`mst_article_per_branch` kk
			        ON (aa.`recid` = kk.`artID`) 
			        LEFT JOIN {$metmpvnditem} vd ON(aa.ART_CODE = vd.ART_CODE) 
			        JOIN {$this->db_erp}.`mst_companyBranch` xx 
			        ON (kk.`brnchID` = xx.`recid`) 
			        LEFT JOIN {$this->db_erp}.`mst_article_ptsallwd` cc
			        ON (aa.`ART_CODE`=cc.`B_ITEMCODE`)
			        LEFT JOIN {$this->db_erp}.`mst_article_scdisc` dd
			        ON (aa.`ART_CODE`=dd.`B_ITEMCODE`)
			        LEFT JOIN {$this->db_erp}.`mst_article_sspt` ee
			        ON (aa.`ART_CODE`=ee.`B_ITEMCODE`)
			        LEFT JOIN {$this->db_erp}.`mst_article_vatable` ff
			        ON (aa.`ART_CODE`=ff.`B_ITEMCODE`)
			        LEFT JOIN {$this->db_erp}.`mst_article_pwddisc` mm
			        ON (aa.`ART_CODE`=mm.`B_ITEMCODE`)
			        LEFT JOIN {$this->db_erp}.`mst_mat_catg1_hd` gg
				ON (aa.`ART_HIERC1`=gg.`MAT_CATG1_CODE`)
				LEFT JOIN {$this->db_erp}.`mst_mat_catg2_hd` hh
				ON (aa.`ART_HIERC2`=hh.`MAT_CATG2_CODE`)
				LEFT JOIN {$this->db_erp}.`mst_mat_catg3_hd` ii
				ON (aa.`ART_HIERC3`=ii.`MAT_CATG3_CODE`)
				LEFT JOIN {$this->db_erp}.`mst_mat_catg4_hd` jj
				ON (aa.`ART_HIERC4`=jj.`MAT_CATG4_CODE`) 
				left join {$this->db_erp}.`mst_pos_prod_ids` nn on(aa.ART_CODE = nn.ART_CODE) 
				left join {$metbltmp} pp on(nn.MPROD_ID = pp.MPROD_ID) 
				WHERE aa.`ART_HIERC1` = '0600' AND kk.brnchID = {$br_id}  
				and !(trim(aa.ART_DESC) = '' or aa.ART_DESC is null or trim(aa.ART_BARCODE1) = '' or aa.ART_BARCODE1 is null or trim(aa.ART_BARCODE1) = '0' ) 
				and (aa.ART_POS_PROD_ID != 0 OR aa.ART_POS_PROD_ID IS NOT NULL) {$str_optn}
				GROUP BY kk.`recid` 
			";
		} else { 
			$strqry = "
			SELECT 'E0023' `Branch Code`,
			        REPLACE(REPLACE(REPLACE(aa.`ART_CODE`,'\t',''),'\n',''),'\r','') `Article Code`,
			        REPLACE(REPLACE(REPLACE(aa.`ART_DESC`,'\t',''),'\n',''),'\r','') `Product Description`,
			        SUBSTR(REPLACE(REPLACE(REPLACE(aa.`ART_DESC`,'\t',''),'\n',''),'\r',''),1,20) `Short Description`,
			        0 __IN_STOCK,
			        REPLACE(REPLACE(REPLACE(aa.`ART_BARCODE1`,'\t',''),'\n',''),'\r','') `Barcode`,
			        REPLACE(REPLACE(REPLACE(aa.`ART_UOM`,'\t',''),'\n',''),'\r','') ART_UOM,
			        aa.`ART_NCONVF`,
			        aa.`ART_UCOST` `Cost`,
			        REPLACE(REPLACE(REPLACE(IFNULL(gg.`MAT_CATG1_DESC`,''),'\t',''),'\n',''),'\r','') `PRODUCT CATEGORY`,
			        REPLACE(REPLACE(REPLACE(IFNULL(hh.`MAT_CATG2_DESC`,''),'\t',''),'\n',''),'\r','') `PRODUCT GROUP`,
			        REPLACE(REPLACE(REPLACE(IFNULL(ii.`MAT_CATG3_DESC`,''),'\t',''),'\n',''),'\r','') `PRODUCT CLASS`,
			        REPLACE(REPLACE(REPLACE(IFNULL(jj.`MAT_CATG4_DESC`,''),'\t',''),'\n',''),'\r','') `PRODUCT SUB GROUP`,
					IF(gg.`MAT_CATG1_CODE` = '0600','Grocery Store','Department Store') `PRODUCT TYPE`,
					IF((aa.`ART_CODE` LIKE '%SPROMO%' OR aa.`ART_CODE` LIKE '%QDAMAGE%'),0,0) __DMG,
			        aa.`ART_UPRICE` `SRP`,
			        IFNULL(pp.`MPROD_PRICE`,0) `POS SRP`,
			        '1' __B_VATABLE,
			        IF(gg.`MAT_CATG1_CODE` = '0600',0,IF((aa.`ART_CODE` LIKE '%SPROMO%' OR aa.`ART_CODE` LIKE '%QDAMAGE%'),0,1)) __MEMB,
			        IFNULL(mm.`B_PWDDISC`,0) __B_PWDDISC,
			        IFNULL(mm.`B_PWDDISC_VAL`,0) __B_PWDDISC_VAL,
			        IFNULL(dd.`B_SCDISC`,0) __B_SCDISC,
			        IFNULL(dd.`B_SCDISC_VAL`,0) __B_SCDISC_VAL,
			        IFNULL(ee.`B_SSPT`,0) __B_SSPT,
			        IFNULL(cc.`B_PNTS_ALLWD`,1) __B_PNTS_ALLWD,
			        IFNULL(aa.`ART_PCODE`,'SRP') __PRICING_CODE,
			        IFNULL(aa.`ART_ISDISABLE`,0) __ART_ISDISABLE,
					IFNULL(nn.`MPROD_ID`,0) POS_MPRODID 
			        FROM {$this->db_erp}.`mst_article` aa 
			        LEFT JOIN {$this->db_erp}.`mst_article_ptsallwd` cc
			        ON (aa.`ART_CODE`=cc.`B_ITEMCODE`)
			        LEFT JOIN {$this->db_erp}.`mst_article_scdisc` dd
			        ON (aa.`ART_CODE`=dd.`B_ITEMCODE`)
			        LEFT JOIN {$this->db_erp}.`mst_article_sspt` ee
			        ON (aa.`ART_CODE`=ee.`B_ITEMCODE`)
			        LEFT JOIN {$this->db_erp}.`mst_article_vatable` ff
			        ON (aa.`ART_CODE`=ff.`B_ITEMCODE`)
			        LEFT JOIN {$this->db_erp}.`mst_article_pwddisc` mm
			        ON (aa.`ART_CODE`=mm.`B_ITEMCODE`)
			        LEFT JOIN {$this->db_erp}.`mst_mat_catg1_hd` gg
				ON (aa.`ART_HIERC1`=gg.`MAT_CATG1_CODE`)
				LEFT JOIN {$this->db_erp}.`mst_mat_catg2_hd` hh
				ON (aa.`ART_HIERC2`=hh.`MAT_CATG2_CODE`)
				LEFT JOIN {$this->db_erp}.`mst_mat_catg3_hd` ii
				ON (aa.`ART_HIERC3`=ii.`MAT_CATG3_CODE`) 
				LEFT JOIN {$this->db_erp}.`mst_mat_catg4_hd` jj 
				ON (aa.`ART_HIERC4`=jj.`MAT_CATG4_CODE`) 
				left join {$this->db_erp}.`mst_pos_prod_ids` nn on(aa.ART_CODE = nn.ART_CODE) 
				left join {$metbltmp} pp on(nn.MPROD_ID = pp.MPROD_ID) 
				WHERE !(aa.`ART_CODE` LIKE '%ASSTD%') and !(aa.ART_HIERC1 = '0600') 
				and aa.ART_ISDISABLE = 0 and (aa.ART_POS_PROD_ID != 0 OR aa.ART_POS_PROD_ID IS NOT NULL) {$str_optn} 
				GROUP BY aa.`recid` 
			";
		} //end if
		
		$str = "
		select count(*) __nrecs from ({$strqry}) oa 
		";
		$qry = $this->myusermod->mylibzdb->myoa_sql_exec($str,'URI: ' . $_SERVER['PHP_SELF'] . chr(13) . chr(10) . 'File: ' . __FILE__  . chr(13) . chr(10) . 'Line Number: ' . __LINE__);
		$rw = $qry->getRowArray();
		$npagelimit = ($npagelimit > 0 ? $npagelimit : 30);
		$nstart = ($npagelimit * (($npages - 1) > 0 ? ($npages - 1) : 0));
		
		
		$npage_count = ceil(($rw['__nrecs'] + 0) / $npagelimit);
		$data['npage_count'] = $npage_count;
		$data['npage_curr'] = $npages;
		$str = "
		SELECT * from ({$strqry}) oa limit {$nstart},{$npagelimit} ";
		$qry = $this->myusermod->mylibzdb->myoa_sql_exec($str,'URI: ' . $_SERVER['PHP_SELF'] . chr(13) . chr(10) . 'File: ' . __FILE__  . chr(13) . chr(10) . 'Line Number: ' . __LINE__);
		
		if($qry->resultID->num_rows > 0) { 
			$data['rlist'] = $qry->getResultArray();
			$data['rfieldnames'] = $qry->getFieldNames();
			$data['metmptkn'] = $metmptkn;
		} else { 
			$data = array();
			$data['npage_count'] = 1;
			$data['npage_curr'] = 1;
			$data['rlist'] = '';
			$data['rfieldnames'] = '';
			$data['metmptkn'] = '';
		}
		$qry->freeResult();
		return $data;
		
	} //end Artm_Branch_recs
	
	public function Artm_Branch_dload() { 
		$mebcode = $this->myusermod->request->getVar('mdl_mebcode');
		$cuser = $this->myusermod->mysys_user();
		$lperbr = 0;
		if(!empty($mebcode) && $mebcode !== 'DEPSTORE') { 
			$str = "select recid,BRNCH_NAME,trim(BRNCH_OCODE2) B_OCODE2,BRNCH_MAT_FLAG,BRNCH_MBCODE   
			from {$this->db_erp}.`mst_companyBranch` aa where concat('E',trim(BRNCH_OCODE2)) = '$mebcode'";
			$q = $this->myusermod->mylibzdb->myoa_sql_exec($str,'URI: ' . $_SERVER['PHP_SELF'] . chr(13) . chr(10) . 'File: ' . __FILE__  . chr(13) . chr(10) . 'Line Number: ' . __LINE__);
			$this->myusermod->mylibzdb->user_logs_activity_module($this->db_erp,'HO_MDATAPOSLINK_DWNLOAD','',$cuser,$str,'URI: ' . $_SERVER['PHP_SELF'] . chr(13) . chr(10) . 'File: ' . __FILE__  . chr(13) . chr(10) . 'Line Number: ' . __LINE__);
			
			if($q->getNumRows() == 0) { 
				echo "<div class=\"alert alert-danger mb-0\" role=\"alert\"><strong>Info.<br/></strong><strong>Error</strong> Invalid Branch Data!!!</div>";
				die();
			}
			
			$rw = $q->getRowArray();
			$B_MBCODE = $rw['BRNCH_MBCODE'];
			$br_id = $rw['recid'];
			$br_ocode2 = $rw['B_OCODE2'];
			$lperbr = 0;
			if($rw['BRNCH_MAT_FLAG'] == 'G') { 
				$lperbr = 1;
				
			}
			
			$q->freeResult();
			$mefilepart = "GROCERY-{$mebcode}"; 
			//END BRANCH
		} elseif ($mebcode == 'DEPSTORE') { 
			//set default for all deptstore since dept store branches are being handled by one master data 
			$B_MBCODE = 'E0023';
			$mefilepart = "DEPTSTORE";
			
		} else { 
			echo "<div class=\"alert alert-danger mb-0\" role=\"alert\"><strong>Info.<br/></strong><strong>Error</strong> Branch is REQUIRED!!!</div>";
			die();
		} // end if			

		$metmptkn = $this->mylibzsys->random_string(15);
		$dloadpath = ROOTPATH . 'public/downloads/me/';
		$mefileexport = "master-data-{$mefilepart}_{$metmptkn}.csv";
		$mefile = $dloadpath . $mefileexport;
		if (file_exists($mefile)) { 
			unlink($mefile);
		}
		
		$metbltmp = "{$this->db_temp}.`tmp_data_mposprice_{$metmptkn}`";
		$mescript = ROOTPATH . 'app/ThirdParty/me-python/dload-pos-pricing.py';
		exec("/usr/bin/python3 $mescript $B_MBCODE /tmp/ {$metmptkn}",$output);
		if($lperbr) { 
			$metmpvnditem = "{$this->db_temp}.`tmp_vnditems_{$metmptkn}`";
			$str = "
			CREATE TABLE if not exists {$metmpvnditem} (
			  `ART_CODE` varchar(35) DEFAULT '',
			  `VEND_NAME` longtext,
			  UNIQUE KEY `idx01` (`ART_CODE`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci
			";
			$this->myusermod->mylibzdb->myoa_sql_exec($str,'URI: ' . $_SERVER['PHP_SELF'] . chr(13) . chr(10) . 'File: ' . __FILE__  . chr(13) . chr(10) . 'Line Number: ' . __LINE__);
			
			$str = "insert into {$metmpvnditem} (`ART_CODE`,`VEND_NAME`) 
			SELECT me.ART_CODE,GROUP_CONCAT(VEND_NAME) VEND_NAME FROM (
			SELECT 	va.ART_CODE,vd.VEND_NAME FROM {$this->db_erp}.mst_vend_artm va JOIN {$this->db_erp}.mst_vendor vd ON(va.ART_VCODE = vd.VEND_CODE) 
			JOIN (SELECT supplier_id FROM {$this->db_erp}.trx_manrecs_hd WHERE branch_id = {$br_id} GROUP BY supplier_id) br ON (vd.recid = br.supplier_id) 
			GROUP BY va.ART_CODE,vd.VEND_NAME
			) me GROUP BY ART_CODE
			";
			$this->myusermod->mylibzdb->myoa_sql_exec($str,'URI: ' . $_SERVER['PHP_SELF'] . chr(13) . chr(10) . 'File: ' . __FILE__  . chr(13) . chr(10) . 'Line Number: ' . __LINE__);
			//echo $metmpvnditem;
			//die();
			
			$strqry = "
			SELECT * INTO OUTFILE '{$mefile}'
			  FIELDS TERMINATED BY '\t' 
			  LINES TERMINATED BY '\n'
			FROM (  		
			select 'Branch Code',
			'Item No.',
			'Item Description',
			'Item Short Desc',
			'In Stock',
			'Barcode',
			'UoM',
			'quantity_per_unit',
			'Item Cost',
			'PRODUCT CATEGORY',
			'PRODUCT GROUPS',
			'PRODUCT CLASS',
			'PRODUCT SUB GROUP',
			'PRODUCT TYPE',
			'DAMAGE',
			'SRP',
			'POS SRP',
			'Vatable',
			'membership',
			'pwd_allowed',
			'pwd_discount',
			'sc_discount',
			'sc_discount_value',
			'sspt',
			'points_allowed',
			'Pricing Code',
			'Disabled',
			'MPOD_ID',
			'Supplier'
			union all 			
			SELECT '{$B_MBCODE}' `Branch Code`,
			        REPLACE(REPLACE(REPLACE(aa.`ART_CODE`,'\t',''),'\n',''),'\r','') `Article Code`,
			        REPLACE(REPLACE(REPLACE(aa.`ART_DESC`,'\t',''),'\n',''),'\r','') `Product Description`,
			        SUBSTR(REPLACE(REPLACE(REPLACE(aa.`ART_DESC`,'\t',''),'\n',''),'\r',''),1,20) `Short Description`,
			        0 __IN_STOCK,
			        REPLACE(REPLACE(REPLACE(aa.`ART_BARCODE1`,'\t',''),'\n',''),'\r','') `Barcode`,
			        REPLACE(REPLACE(REPLACE(aa.`ART_UOM`,'\t',''),'\n',''),'\r','') ART_UOM,
			        aa.`ART_NCONVF`,
			        IFNULL(kk.`art_cost`,0) `Cost`,
			        REPLACE(REPLACE(REPLACE(IFNULL(gg.`MAT_CATG1_DESC`,''),'\t',''),'\n',''),'\r','') `PRODUCT CATEGORY`,
			        REPLACE(REPLACE(REPLACE(IFNULL(hh.`MAT_CATG2_DESC`,''),'\t',''),'\n',''),'\r','') `PRODUCT GROUP`,
			        REPLACE(REPLACE(REPLACE(IFNULL(ii.`MAT_CATG3_DESC`,''),'\t',''),'\n',''),'\r','') `PRODUCT CLASS`,
			        REPLACE(REPLACE(REPLACE(IFNULL(jj.`MAT_CATG4_DESC`,''),'\t',''),'\n',''),'\r','') `PRODUCT SUB GROUP`,
					IF(gg.`MAT_CATG1_CODE` = '0600','Grocery Store','Department Store') `PRODUCT TYPE`,
					IF((aa.`ART_CODE` LIKE '%SPROMO%' OR aa.`ART_CODE` LIKE '%QDAMAGE%'),0,0) __DMG,
			        IFNULL(kk.`art_uprice`,0) `SRP`,
			        IFNULL(pp.`MPROD_PRICE`,0) `POS SRP`,
			        '1' __B_VATABLE,
			        IF(gg.`MAT_CATG1_CODE` = '0600',0,IF((aa.`ART_CODE` LIKE '%SPROMO%' OR aa.`ART_CODE` LIKE '%QDAMAGE%'),0,1)) __MEMB,
			        IFNULL(mm.`B_PWDDISC`,0) __B_PWDDISC,
			        IFNULL(mm.`B_PWDDISC_VAL`,0) __B_PWDDISC_VAL,
			        IFNULL(dd.`B_SCDISC`,0) __B_SCDISC,
			        IFNULL(dd.`B_SCDISC_VAL`,0) __B_SCDISC_VAL,
			        IFNULL(ee.`B_SSPT`,0) __B_SSPT,
			        IFNULL(cc.`B_PNTS_ALLWD`,1) __B_PNTS_ALLWD,
			        IFNULL(aa.`ART_PCODE`,'SRP') __PRICING_CODE,
			        IFNULL(aa.`ART_ISDISABLE`,0) __ART_ISDISABLE,
			        IFNULL(nn.`MPROD_ID`,0) POS_MPRODID,
			        REPLACE(REPLACE(REPLACE(IFNULL(vd.VEND_NAME,''),'\t',''),'\n',''),'\r','') `Supplier` 
			        FROM {$this->db_erp}.`mst_article` aa 
			        JOIN {$this->db_erp}.`mst_article_per_branch` kk
			        ON (aa.`recid` = kk.`artID`) 
			        LEFT JOIN {$metmpvnditem} vd ON(aa.ART_CODE = vd.ART_CODE) 
			        JOIN {$this->db_erp}.`mst_companyBranch` xx 
			        ON (kk.`brnchID` = xx.`recid`) 
			        LEFT JOIN {$this->db_erp}.`mst_article_ptsallwd` cc
			        ON (aa.`ART_CODE`=cc.`B_ITEMCODE`)
			        LEFT JOIN {$this->db_erp}.`mst_article_scdisc` dd
			        ON (aa.`ART_CODE`=dd.`B_ITEMCODE`)
			        LEFT JOIN {$this->db_erp}.`mst_article_sspt` ee
			        ON (aa.`ART_CODE`=ee.`B_ITEMCODE`)
			        LEFT JOIN {$this->db_erp}.`mst_article_vatable` ff
			        ON (aa.`ART_CODE`=ff.`B_ITEMCODE`)
			        LEFT JOIN {$this->db_erp}.`mst_article_pwddisc` mm
			        ON (aa.`ART_CODE`=mm.`B_ITEMCODE`)
			        LEFT JOIN {$this->db_erp}.`mst_mat_catg1_hd` gg
				ON (aa.`ART_HIERC1`=gg.`MAT_CATG1_CODE`)
				LEFT JOIN {$this->db_erp}.`mst_mat_catg2_hd` hh
				ON (aa.`ART_HIERC2`=hh.`MAT_CATG2_CODE`)
				LEFT JOIN {$this->db_erp}.`mst_mat_catg3_hd` ii
				ON (aa.`ART_HIERC3`=ii.`MAT_CATG3_CODE`)
				LEFT JOIN {$this->db_erp}.`mst_mat_catg4_hd` jj
				ON (aa.`ART_HIERC4`=jj.`MAT_CATG4_CODE`) 
				left join {$this->db_erp}.`mst_pos_prod_ids` nn on(aa.ART_CODE = nn.ART_CODE) 
				left join {$metbltmp} pp on(nn.MPROD_ID = pp.MPROD_ID) 
				WHERE aa.`ART_HIERC1` = '0600' AND kk.brnchID = {$br_id}  
				and !(trim(aa.ART_DESC) = '' or aa.ART_DESC is null or trim(aa.ART_BARCODE1) = '' or aa.ART_BARCODE1 is null or trim(aa.ART_BARCODE1) = '0' ) 
				and (aa.ART_POS_PROD_ID != 0 OR aa.ART_POS_PROD_ID IS NOT NULL) 
				GROUP BY kk.`recid` 
			) oa 
			";
		} else { 
			$strqry = "
			SELECT * INTO OUTFILE '{$mefile}'
			  FIELDS TERMINATED BY '\t' 
			  LINES TERMINATED BY '\n'
			FROM (  		
			select 'Branch Code',
			'Item No.',
			'Item Description',
			'Item Short Desc',
			'In Stock',
			'Barcode',
			'UoM',
			'quantity_per_unit',
			'Item Cost',
			'PRODUCT CATEGORY',
			'PRODUCT GROUPS',
			'PRODUCT CLASS',
			'PRODUCT SUB GROUP',
			'PRODUCT TYPE',
			'DAMAGE',
			'SRP',
			'POS SRP',
			'Vatable',
			'membership',
			'pwd_allowed',
			'pwd_discount',
			'sc_discount',
			'sc_discount_value',
			'sspt',
			'points_allowed',
			'Pricing Code',
			'Disabled',
			'MPOD_ID' 
			union all 						
			SELECT 'E0023' `Branch Code`,
			        REPLACE(REPLACE(REPLACE(aa.`ART_CODE`,'\t',''),'\n',''),'\r','') `Article Code`,
			        REPLACE(REPLACE(REPLACE(aa.`ART_DESC`,'\t',''),'\n',''),'\r','') `Product Description`,
			        SUBSTR(REPLACE(REPLACE(REPLACE(aa.`ART_DESC`,'\t',''),'\n',''),'\r',''),1,20) `Short Description`,
			        0 __IN_STOCK,
			        REPLACE(REPLACE(REPLACE(aa.`ART_BARCODE1`,'\t',''),'\n',''),'\r','') `Barcode`,
			        REPLACE(REPLACE(REPLACE(aa.`ART_UOM`,'\t',''),'\n',''),'\r','') ART_UOM,
			        aa.`ART_NCONVF`,
			        aa.`ART_UCOST` `Cost`,
			        REPLACE(REPLACE(REPLACE(IFNULL(gg.`MAT_CATG1_DESC`,''),'\t',''),'\n',''),'\r','') `PRODUCT CATEGORY`,
			        REPLACE(REPLACE(REPLACE(IFNULL(hh.`MAT_CATG2_DESC`,''),'\t',''),'\n',''),'\r','') `PRODUCT GROUP`,
			        REPLACE(REPLACE(REPLACE(IFNULL(ii.`MAT_CATG3_DESC`,''),'\t',''),'\n',''),'\r','') `PRODUCT CLASS`,
			        REPLACE(REPLACE(REPLACE(IFNULL(jj.`MAT_CATG4_DESC`,''),'\t',''),'\n',''),'\r','') `PRODUCT SUB GROUP`,
					IF(gg.`MAT_CATG1_CODE` = '0600','Grocery Store','Department Store') `PRODUCT TYPE`,
					IF((aa.`ART_CODE` LIKE '%SPROMO%' OR aa.`ART_CODE` LIKE '%QDAMAGE%'),0,0) __DMG,
			        aa.`ART_UPRICE` `SRP`,
			        IFNULL(pp.`MPROD_PRICE`,0) `POS SRP`,
			        '1' __B_VATABLE,
			        IF(gg.`MAT_CATG1_CODE` = '0600',0,IF((aa.`ART_CODE` LIKE '%SPROMO%' OR aa.`ART_CODE` LIKE '%QDAMAGE%'),0,1)) __MEMB,
			        IFNULL(mm.`B_PWDDISC`,0) __B_PWDDISC,
			        IFNULL(mm.`B_PWDDISC_VAL`,0) __B_PWDDISC_VAL,
			        IFNULL(dd.`B_SCDISC`,0) __B_SCDISC,
			        IFNULL(dd.`B_SCDISC_VAL`,0) __B_SCDISC_VAL,
			        IFNULL(ee.`B_SSPT`,0) __B_SSPT,
			        IFNULL(cc.`B_PNTS_ALLWD`,1) __B_PNTS_ALLWD,
			        IFNULL(aa.`ART_PCODE`,'SRP') __PRICING_CODE,
			        IFNULL(aa.`ART_ISDISABLE`,0) __ART_ISDISABLE,
					IFNULL(nn.`MPROD_ID`,0) POS_MPRODID 
			        FROM {$this->db_erp}.`mst_article` aa 
			        LEFT JOIN {$this->db_erp}.`mst_article_ptsallwd` cc
			        ON (aa.`ART_CODE`=cc.`B_ITEMCODE`)
			        LEFT JOIN {$this->db_erp}.`mst_article_scdisc` dd
			        ON (aa.`ART_CODE`=dd.`B_ITEMCODE`)
			        LEFT JOIN {$this->db_erp}.`mst_article_sspt` ee
			        ON (aa.`ART_CODE`=ee.`B_ITEMCODE`)
			        LEFT JOIN {$this->db_erp}.`mst_article_vatable` ff
			        ON (aa.`ART_CODE`=ff.`B_ITEMCODE`)
			        LEFT JOIN {$this->db_erp}.`mst_article_pwddisc` mm
			        ON (aa.`ART_CODE`=mm.`B_ITEMCODE`)
			        LEFT JOIN {$this->db_erp}.`mst_mat_catg1_hd` gg
				ON (aa.`ART_HIERC1`=gg.`MAT_CATG1_CODE`)
				LEFT JOIN {$this->db_erp}.`mst_mat_catg2_hd` hh
				ON (aa.`ART_HIERC2`=hh.`MAT_CATG2_CODE`)
				LEFT JOIN {$this->db_erp}.`mst_mat_catg3_hd` ii
				ON (aa.`ART_HIERC3`=ii.`MAT_CATG3_CODE`) 
				LEFT JOIN {$this->db_erp}.`mst_mat_catg4_hd` jj 
				ON (aa.`ART_HIERC4`=jj.`MAT_CATG4_CODE`) 
				left join {$this->db_erp}.`mst_pos_prod_ids` nn on(aa.ART_CODE = nn.ART_CODE) 
				left join {$metbltmp} pp on(nn.MPROD_ID = pp.MPROD_ID) 
				WHERE !(aa.`ART_CODE` LIKE '%ASSTD%') and !(aa.ART_HIERC1 = '0600') 
				and aa.ART_ISDISABLE = 0 and (aa.ART_POS_PROD_ID != 0 OR aa.ART_POS_PROD_ID IS NOT NULL) 
				GROUP BY aa.`recid` 
			) oa 
			";
		} //end if
		$str = $strqry;
		$this->myusermod->mylibzdb->myoa_sql_exec($str,'URI: ' . $_SERVER['PHP_SELF'] . chr(13) . chr(10) . 'File: ' . __FILE__  . chr(13) . chr(10) . 'Line Number: ' . __LINE__);

		//Define header information
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		//header('Content-Type: application/zip');
		//header("Cache-Control: no-cache, must-revalidate");
		header("Expires: 0");
		header('Content-disposition: attachment; filename="' . $mefileexport . '"');
		header("Content-Transfer-Encoding: binary");
		header('Content-Length: ' . filesize($mefile));
		header("Pragma: no-cache"); 
		//header('Pragma: public');
		//Clear system output buffer
		//flush();
		//ob_end_flush();
		
		//Read the size of the file
		@readfile($mefile);
		
		
	} //end Artm_Branch_dload
	
	public function import_data_template_proc() { 
		
		$mefiles_path = ROOTPATH . 'public/uploads/artm_csv/';
		$mefiles_upath = 'uploads/artm_csv/';
		
		
		if(!is_dir($mefiles_path)) mkdir($mefiles_path, '0755', true);
		
		//file uploading 
		$lfileupld = 0;
		if ($mefiles = $this->myusermod->request->getFiles()) { 
			foreach ($mefiles['mefiles'] as $mfile) { 
				if ($mfile->isValid() && ! $mfile->hasMoved()) { 
					$newName = $mfile->getRandomName();
					$itisfilename = $mfile->getName();
					$itisfilename = $this->myusermod->mylibzdb->me_escapeString(str_replace(' ','_',$itisfilename));
					$itisfilename = $this->myusermod->mylibzdb->me_escapeString(str_replace(',','_',$itisfilename));
					
					$__upld_filename = $this->cuser . '_' . $itisfilename;
					
					$__upld_filename = $this->myusermod->mylibzdb->me_escapeString(str_replace(' ','_',$__upld_filename));
					$__upld_filename = $this->myusermod->mylibzdb->me_escapeString(str_replace(',','',$__upld_filename));
					$mfileMimeType = $mfile->getMimeType();
					
					if($mfileMimeType == 'text/plain'): 
						//$str = "select `ira_hd_ctrlno` from {$this->db_erp}.trx_ivty_reconadj_upld_files where `ira_filename` like '%$itisfilename%'";
						//$qf = $this->myusermod->mylibzdb->myoa_sql_exec($str,'URI: ' . $_SERVER['PHP_SELF'] . chr(13) . chr(10) . 'File: ' . __FILE__  . chr(13) . chr(10) . 'Line Number: ' . __LINE__);
						//if($qf->getNumRows() > 0):
						//	echo "<div class=\"alert alert-danger mb-0 mt-2 fw-bold\" role=\"alert\">Attachement File Adjustment already uploaded<br/>{$__upld_filename}</div>";
						//	die();
						//endif;
						//$qf->freeResult();
						
						if (file_exists($mefiles_path . $__upld_filename)) { 
							unlink($mefiles_path . $__upld_filename);
						} 
						
						$mfile->move($mefiles_path, $__upld_filename);
						
						if (file_exists($mefiles_path . $__upld_filename)) { 
							$lfileupld = 1;
							$cfile = $mefiles_path . $__upld_filename;
							$str = "SELECT CONCAT(DATE_FORMAT(NOW(),'%Y%m%d%H%i%s'),LPAD(MICROSECOND(NOW(6)),8,'0')) mectrlno";
							$q = $this->myusermod->mylibzdb->myoa_sql_exec($str,'URI: ' . $_SERVER['PHP_SELF'] . chr(13) . chr(10) . 'File: ' . __FILE__  . chr(13) . chr(10) . 'Line Number: ' . __LINE__);
							$rw = $q->getRow();
							$cseqn = $rw->mectrlno;
							$q->freeResult();
							
							$arrfield = array();
							$arrfield[] = "ira_filename" . "xOx'" . $__upld_filename . "'";
							$arrfield[] = "muser" . "xOx'" . $this->cuser . "'";
							$str = " `ira_hd_ctrlno` = '{$cseqn}' ";
							//$this->myusermod->mylibzdb->logs_modi_audit($arrfield,$this->db_erp,'`trx_ivty_reconadj_upld_files`','IVTY_RECONADJ_FILE_FORMAT',$cseqn,$str);
							
							
						}
					endif;
				}
			}  //end foreach 
		} //end if 
		
		//file uploading end 
		if($lfileupld) {
			$tbltemp = $this->db_temp . ".`artm_upld_temp_" . $this->mylibzsys->random_string(15) . "`";
			$str = "drop table if exists {$tbltemp}";
			$this->myusermod->mylibzdb->myoa_sql_exec($str,'URI: ' . $_SERVER['PHP_SELF'] . chr(13) . chr(10) . 'File: ' . __FILE__  . chr(13) . chr(10) . 'Line Number: ' . __LINE__);
			
			$str = "
			create table if not exists {$this->db_erp}.trx_artm_upld_logs ( 
			`recid` int(25) NOT NULL AUTO_INCREMENT,
			`sysctrlno` varchar(30) NOT NULL,
			M_ITEMC varchar(35) default '',
			M_ITEMD varchar(200) default '',
			M_QTY varchar(15) default '',
			M_ITEM_BARCDE varchar(35) default '',
			M_ITEM_UoM varchar(15) default '',
			M_ITEM_CBM varchar(15) default '',
			M_ITEM_PKG varchar(15) default '',
			M_ITEM_COST varchar(15) default '',
			M_ITEM_KG varchar(15) default '',
			M_ITEM_CONVF varchar(15) default '',
			M_PROD_TYP varchar(35) default '',
			M_PROD_CAT varchar(35) default '',
			M_PROD_GRP varchar(35) default '',
			M_PROD_CLS varchar(35) default '',
			M_PROD_SGRP varchar(35) default '',
			M_ITEM_SAP_P varchar(15) default '',
			M_ITEM_SXN_P varchar(15) default '',
			M_COMPANY varchar(50) default '',
			M_ITEM_PP varchar(15) default '',
			M_ITEM_CURR varchar(15) default '',
			M_ITEM_DESC_CODE varchar(15) default '',
			M_ITEM_LOCDESC varchar(150) DEFAULT '',
			M_MARK varchar(1) default '',
			`muser` varchar(20) default NULL,
			`mproc_date` datetime default NULL,
			PRIMARY KEY (`recid`),
			key `idx01` (`M_ITEMC`),
			key `idx02` (`M_MARK`),
			key `idx03` (`sysctrlno`),
			key `idx04` (`muser`,`mproc_date`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
			";
			
			$this->myusermod->mylibzdb->myoa_sql_exec($str,'URI: ' . $_SERVER['PHP_SELF'] . chr(13) . chr(10) . 'File: ' . __FILE__  . chr(13) . chr(10) . 'Line Number: ' . __LINE__);
			
			$str = "
			create table {$tbltemp} ( 
			M_ITEMC varchar(35) default '',
			M_ITEMD varchar(200) default '',
			M_QTY varchar(15) default '',
			M_ITEM_BARCDE varchar(35) default '',
			M_ITEM_UoM varchar(15) default '',
			M_ITEM_CBM varchar(15) default '',
			M_ITEM_PKG varchar(15) default '',
			M_ITEM_COST varchar(15) default '',
			M_ITEM_KG varchar(15) default '',
			M_ITEM_CONVF varchar(15) default '',
			M_PROD_CAT varchar(35) default '',
			M_PROD_GRP varchar(35) default '',
			M_PROD_CLS varchar(35) default '',
			M_PROD_SGRP varchar(35) default '',
			M_ITEM_SAP_P varchar(15) default '',
			M_ITEM_SXN_P varchar(15) default '',
			M_COMPANY varchar(50) default '',
			M_ITEM_PP varchar(15) default '',
			M_ITEM_CURR varchar(15) default '',
			M_ITEM_DESC_CODE varchar(15) default '',
			M_ITEM_LOCDESC varchar(150) DEFAULT '',
			muser varchar(20) default NULL,
			key `idx01` (`M_ITEMC`) 
			)
			";
			
			$this->myusermod->mylibzdb->myoa_sql_exec($str,'URI: ' . $_SERVER['PHP_SELF'] . chr(13) . chr(10) . 'File: ' . __FILE__  . chr(13) . chr(10) . 'Line Number: ' . __LINE__);
						
			$str = "
			LOAD DATA LOCAL INFILE '$cfile' INTO TABLE {$tbltemp} 
			FIELDS TERMINATED BY '\t' 
			  LINES TERMINATED BY '\n' 
			  IGNORE 1 LINES 
			(
			M_ITEMC,M_ITEMD,M_QTY,M_ITEM_BARCDE,M_ITEM_UoM,M_ITEM_CBM,M_ITEM_PKG,M_ITEM_COST,M_ITEM_KG,M_ITEM_CONVF,M_PROD_CAT,M_PROD_GRP,
			M_PROD_CLS,M_PROD_SGRP,M_ITEM_SAP_P,M_ITEM_SXN_P,M_COMPANY,M_ITEM_PP,M_ITEM_CURR,M_ITEM_DESC_CODE,`M_ITEM_LOCDESC`
			) 
			 ";			
			$this->myusermod->mylibzdb->myoa_sql_exec($str,'URI: ' . $_SERVER['PHP_SELF'] . chr(13) . chr(10) . 'File: ' . __FILE__  . chr(13) . chr(10) . 'Line Number: ' . __LINE__);
			
			$str = "select count(*) __nrecs from {$tbltemp}";
			$q = $this->myusermod->mylibzdb->myoa_sql_exec($str,'URI: ' . $_SERVER['PHP_SELF'] . chr(13) . chr(10) . 'File: ' . __FILE__  . chr(13) . chr(10) . 'Line Number: ' . __LINE__);
			$rw = $q->getRow();
			$nrec = (($rw->__nrecs + 0) > 0 ? ($rw->__nrecs + 0) : 0);
			if($nrec == 0) { 
				$str = "
				LOAD DATA LOCAL INFILE '$cfile' INTO TABLE {$tbltemp} 
				FIELDS TERMINATED BY '\t' 
				  LINES TERMINATED BY '\r\n' 
				  IGNORE 1 LINES 
				(
				M_ITEMC,M_ITEMD,M_QTY,M_ITEM_BARCDE,M_ITEM_UoM,M_ITEM_CBM,M_ITEM_PKG,M_ITEM_COST,M_ITEM_KG,M_ITEM_CONVF,M_PROD_CAT,M_PROD_GRP,
			M_PROD_CLS,M_PROD_SGRP,M_ITEM_SAP_P,M_ITEM_SXN_P,M_COMPANY,M_ITEM_PP,M_ITEM_CURR,M_ITEM_DESC_CODE,`M_ITEM_LOCDESC`
				) 
				 ";			
				$this->myusermod->mylibzdb->myoa_sql_exec($str,'URI: ' . $_SERVER['PHP_SELF'] . chr(13) . chr(10) . 'File: ' . __FILE__  . chr(13) . chr(10) . 'Line Number: ' . __LINE__);
				
				$str = "select count(*) __nrecs from {$tbltemp}";
				$qq = $this->myusermod->mylibzdb->myoa_sql_exec($str,'URI: ' . $_SERVER['PHP_SELF'] . chr(13) . chr(10) . 'File: ' . __FILE__  . chr(13) . chr(10) . 'Line Number: ' . __LINE__);
				$rw = $qq->getRow();
				$nrec = (($rw->__nrecs + 0) > 0 ? ($rw->__nrecs + 0) : 0);
				if($nrec == 0) { 
					$str = "
					LOAD DATA LOCAL INFILE '$cfile' INTO TABLE {$tbltemp} 
					FIELDS TERMINATED BY '\t' 
					  LINES TERMINATED BY '\r' 
					  IGNORE 1 LINES 
					(
					M_ITEMC,M_ITEMD,M_QTY,M_ITEM_BARCDE,M_ITEM_UoM,M_ITEM_CBM,M_ITEM_PKG,M_ITEM_COST,M_ITEM_KG,M_ITEM_CONVF,M_PROD_CAT,M_PROD_GRP,
			M_PROD_CLS,M_PROD_SGRP,M_ITEM_SAP_P,M_ITEM_SXN_P,M_COMPANY,M_ITEM_PP,M_ITEM_CURR,M_ITEM_DESC_CODE,`M_ITEM_LOCDESC`
					) 
					 ";	
					$this->myusermod->mylibzdb->myoa_sql_exec($str,'URI: ' . $_SERVER['PHP_SELF'] . chr(13) . chr(10) . 'File: ' . __FILE__  . chr(13) . chr(10) . 'Line Number: ' . __LINE__);
				}
				$qq->freeResult();
				
				
			}
			$q->freeResult();
			
			
			$str = "select count(*) __nrecs from {$tbltemp}";
			$q = $this->myusermod->mylibzdb->myoa_sql_exec($str,'URI: ' . $_SERVER['PHP_SELF'] . chr(13) . chr(10) . 'File: ' . __FILE__  . chr(13) . chr(10) . 'Line Number: ' . __LINE__);
			$rw = $q->getRow();
			$nrecs = $rw->__nrecs;
			$q->freeResult();
			
			$str = "update {$tbltemp} set 
			M_ITEMC = trim(M_ITEMC),
			M_ITEMD = trim(M_ITEMD),
			M_ITEM_BARCDE = trim(M_ITEM_BARCDE),
			M_ITEM_UoM = trim(M_ITEM_UoM),
			M_ITEM_PKG= trim(M_ITEM_PKG),
			M_PROD_CAT = trim(replace(M_PROD_CAT,' ','_')),
			M_PROD_GRP = trim(replace(M_PROD_GRP,' ','_')),
			M_PROD_CLS = trim(replace(M_PROD_CLS,' ','_')),
			M_PROD_SGRP = trim(replace(M_PROD_SGRP,' ','_')),
			M_ITEM_CBM = (M_ITEM_CBM + 0),
			M_QTY = (M_QTY + 0),
			M_ITEM_COST = (M_ITEM_COST + 0),
			M_ITEM_SAP_P = (M_ITEM_SAP_P + 0),
			M_ITEM_SXN_P = (M_ITEM_SXN_P + 0),
			M_ITEM_KG = trim(M_ITEM_KG),
			M_ITEM_CONVF = trim(M_ITEM_CONVF),
			M_COMPANY = trim(M_COMPANY),
			M_ITEM_PP = (M_ITEM_PP + 0),
			M_ITEM_CURR = REPLACE(REPLACE(M_ITEM_CURR, '\r', ''), '\n', ''),
			M_ITEM_DESC_CODE =  trim(replace(M_ITEM_DESC_CODE,' ','_')),
			M_ITEM_LOCDESC =  trim(replace(M_ITEM_LOCDESC,' ','_')),
			muser = '{$this->cuser}' 
			";
			$this->myusermod->mylibzdb->myoa_sql_exec($str,'URI: ' . $_SERVER['PHP_SELF'] . chr(13) . chr(10) . 'File: ' . __FILE__  . chr(13) . chr(10) . 'Line Number: ' . __LINE__);
			//$cseqn = $this->mydataz->get_ctr($this->db_erp,'CTRL_NO19');
			
			
			echo "$tbltemp";
			die();
			
			$str = "INSERT INTO 
			{$this->db_erp}.trx_artm_upld_posting_logs (
			`ML_CTRLNO`,
			`ML_RECS`,
			`ML_TEMPTBL`,
			`ML_PRODT`,
			`ML_USER`
			)
			VALUES(
			'$cseqn',
			'$nrecs',
			'$tbltemp',
			'$mprodt_code',
			'{$this->cuser}'
			)
			";
			$this->myusermod->mylibzdb->myoa_sql_exec($str,'URI: ' . $_SERVER['PHP_SELF'] . chr(13) . chr(10) . 'File: ' . __FILE__  . chr(13) . chr(10) . 'Line Number: ' . __LINE__);
			//$this->mylibz->user_logs_activity_module($this->db_erp,'ART_UPLD_TEMP_TBL','',$cuser,$str,'URI: ' . $_SERVER['PHP_SELF'] . chr(13) . chr(10) . 'File: ' . __FILE__  . chr(13) . chr(10) . 'Line Number: ' . __LINE__);
			//$this->mymdartm->upldproc_dl($cseqn,$tbltemp,$nrecs);
			
			
		} //endif
		
		
	} // end import_data_template_proc
	
} //end main class
