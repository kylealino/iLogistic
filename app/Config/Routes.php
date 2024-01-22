<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//$routes->get('/', 'Home::index');

$routes->get('mylogin', 'Mylogin::index');
$routes->add('mylogin-auth', 'Mylogin::auth');
$routes->get('melogout', 'Mylogin::logout');

$routes->get('mymd-item-materials', 'Md_article::index',['filter' => 'myauthuser']);
$routes->post('search-mymd-item-materials', 'Md_article::recs',['filter' => 'myauthuser']);
$routes->post('mymd-item-materials-profile', 'Md_article::profile',['filter' => 'myauthuser']);

$routes->get('mymd-customer', 'Md_customer::index',['filter' => 'myauthuser']);
$routes->post('search-mymd-customer', 'Md_customer::recs',['filter' => 'myauthuser']);
$routes->post('mymd-customer-profile', 'Md_customer::profile',['filter' => 'myauthuser']);
$routes->post('mymd-customer-profile-save', 'Md_customer::profile_save',['filter' => 'myauthuser']);

$routes->get('mymd-supplier', 'Md_supplier::index',['filter' => 'myauthuser']);
$routes->post('search-mymd-supplier', 'Md_supplier::recs',['filter' => 'myauthuser']);
$routes->post('mymd-supplier-profile', 'Md_supplier::profile',['filter' => 'myauthuser']);
$routes->post('mymd-supplier-profile-save', 'Md_supplier::profile_save',['filter' => 'myauthuser']);

$routes->get('mymd-shipper', 'Md_shipper::index',['filter' => 'myauthuser']);
$routes->post('search-mymd-shipper', 'Md_shipper::recs',['filter' => 'myauthuser']);
$routes->post('mymd-shipper-profile', 'Md_shipper::profile',['filter' => 'myauthuser']);
$routes->post('mymd-shipper-profile-save', 'Md_shipper::profile_save',['filter' => 'myauthuser']);

$routes->get('mymd-consignee', 'Md_consignee::index',['filter' => 'myauthuser']);
$routes->post('search-mymd-consignee', 'Md_consignee::recs',['filter' => 'myauthuser']);
$routes->post('mymd-consignee-profile', 'Md_consignee::profile',['filter' => 'myauthuser']);
$routes->post('mymd-consignee-profile-save', 'Md_consignee::profile_save',['filter' => 'myauthuser']);

$routes->get('mymd-agent', 'Md_agent::index',['filter' => 'myauthuser']);
$routes->post('search-mymd-agent', 'Md_agent::recs',['filter' => 'myauthuser']);
$routes->post('mymd-agent-profile', 'Md_agent::profile',['filter' => 'myauthuser']);
$routes->post('mymd-agent-profile-save', 'Md_agent::profile_save',['filter' => 'myauthuser']);

$routes->get('mymd-acct-coa', 'Md_AcctCOA::index',['filter' => 'myauthuser']);
$routes->post('search-mymd-acct-coa', 'Md_AcctCOA::recs',['filter' => 'myauthuser']);

$routes->get('mysimul-geterrlogs', 'MyTestSimul::getlogsfromconsole');
$routes->get('/', 'Home::index',['filter' => 'myauthuser']);
$routes->get('md-attlogs-upld', 'MyAttLogsUpld::index',['filter' => 'myauthuser']);
$routes->post('md-attlogs-upld-data', 'MyAttLogsUpld::upld_data',['filter' => 'myauthuser']);
$routes->get('metest-pdf-import', 'MeTest::pdf_import');

//crm
$routes->get('mycrm-sales-rally', 'MyCRM_SalesRally::index',['filter' => 'myauthuser']);
$routes->get('mycrm-prospect', 'MyCRM_Prospect::index',['filter' => 'myauthuser']);

//Quotation flow mock
$routes->get('mycrm-quotation-dashb', 'MyQuotation::index');
$routes->get('mycrm-quotation-entry', 'MyQuotation::quotation_entry');
$routes->post('myquotation-sv', 'MyQuotation::quatation_sv');
$routes->get('mycrm-quotation-org-search', 'MyQuotation::quotation_org_search');

//Leads
$routes->get('mycrm-lead', 'MyLeads::index');

// Charges
$routes->get('mymd-charges', 'Md_charges::index',['filter' => 'myauthuser']);
$routes->post('search-mymd-charges', 'Md_charges::recs',['filter' => 'myauthuser']);
$routes->post('mymd-charges-profile', 'Md_charges::profile',['filter' => 'myauthuser']);
$routes->post('mymd-charges-profile-save', 'Md_charges::profile_save',['filter' => 'myauthuser']);

// COA Maintenance per company mymaintenance-coa
$routes->get('mymaintenance-coa', 'MyMaintenance::index',['filter' => 'myauthuser']);
$routes->post('mymaintenance-coa-sv', 'MyMaintenance::coa_sv',['filter' => 'myauthuser']);
$routes->post('mymaintenance-coa-recs', 'MyMaintenance::coa_recs',['filter' => 'myauthuser']);
$routes->post('mymaintenance-coa-recs-vw', 'MyMaintenance::coa_recs_vw',['filter' => 'myauthuser']);
$routes->get('mymaintenance-coa-getorg', 'MyMaintenance::coa_getorg',['filter' => 'myauthuser']);
$routes->get('mymaintenance-coa-getservice', 'MyMaintenance::coa_getservice',['filter' => 'myauthuser']);

// BOL
$routes->get('my-bol', 'MyBillofLading::index',['filter' => 'myauthuser']);
$routes->post('my-bol-sv', 'MyBillofLading::my_bol_sv',['filter' => 'myauthuser']);
$routes->post('my-bol-recs', 'MyBillofLading::my_bol_ecs',['filter' => 'myauthuser']);
$routes->post('my-bol-recs-vw', 'MyBillofLading::my_bol_vw',['filter' => 'myauthuser']);

$routes->get('mymd-units', 'MD_units::index',['filter' => 'myauthuser']);
$routes->post('search-mymd-units', 'MD_units::recs',['filter' => 'myauthuser']);
$routes->post('mymd-units-profile', 'MD_units::profile',['filter' => 'myauthuser']);
$routes->post('mymd-units-profile-save', 'MD_units::profile_save',['filter' => 'myauthuser']);

$routes->get('mymd-container', 'MD_container::index',['filter' => 'myauthuser']);
$routes->post('search-mymd-container', 'MD_container::recs',['filter' => 'myauthuser']);
$routes->post('mymd-container-profile', 'MD_container::profile',['filter' => 'myauthuser']);
$routes->post('mymd-container-profile-save', 'MD_container::profile_save',['filter' => 'myauthuser']);

$routes->get('mymd-vehicle-type', 'MD_vehicle_type::index',['filter' => 'myauthuser']);
$routes->post('search-mymd-vehicle-type', 'MD_vehicle_type::recs',['filter' => 'myauthuser']);
$routes->post('mymd-vehicle-type-profile', 'MD_vehicle_type::profile',['filter' => 'myauthuser']);
$routes->post('mymd-vehicle-type-profile-save', 'MD_vehicle_type::profile_save',['filter' => 'myauthuser']);

$routes->get('mymd-currency', 'MD_currency::index',['filter' => 'myauthuser']);
$routes->post('search-mymd-currency', 'MD_currency::recs',['filter' => 'myauthuser']);
$routes->post('mymd-currency-profile', 'MD_currency::profile',['filter' => 'myauthuser']);
$routes->post('mymd-currency-profile-save', 'MD_currency::profile_save',['filter' => 'myauthuser']);
