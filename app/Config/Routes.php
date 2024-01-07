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

$routes->get('mysimul-geterrlogs', 'MyTestSimul::getlogsfromconsole');
$routes->get('/', 'Home::index',['filter' => 'myauthuser']);
$routes->get('md-attlogs-upld', 'MyAttLogsUpld::index',['filter' => 'myauthuser']);
$routes->post('md-attlogs-upld-data', 'MyAttLogsUpld::upld_data',['filter' => 'myauthuser']);
$routes->get('metest-pdf-import', 'MeTest::pdf_import');

//Quotation flow mock
$routes->get('myquotation-dashb', 'MyQuotation::index');
$routes->get('myquotation-entry', 'MyQuotation::quotation_entry');
$routes->post('myquotation-sv', 'MyQuotation::quatation_sv');
