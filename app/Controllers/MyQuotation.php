<?php namespace App\Controllers;
  
use CodeIgniter\Controller;
use App\Models\MyQuotationModel;

class MyQuotation extends BaseController
{

    public function __construct()
    {
        $this->mydbname = model('App\Models\MyDBNamesModel');
        $this->db_erp = $this->mydbname->medb(0);
        $this->mymdarticle =  new MyQuotationModel();
    }

    public function index()
    {
        echo view('quotation/quotation-main');
    } 

    public function quotation_entry()
    {
        echo view('quotation/quotation-entry');
    } 

} 
