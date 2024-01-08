<?php
namespace App\Models;
use CodeIgniter\Model;
class MyMaintenanceModel extends Model
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
	
	public function coa_recs($npages = 1,$npagelimit = 30,$msearchrec='') { 
        $strqry="
            SELECT
                `recid`,
                `charge_desc`,
                `charge_type`,
                `charge_basis`,
                `charge_cur`,
                `charge_rate`,
                `charge_amount`
            FROM
                `mst_charges`
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
    } 
	
}
