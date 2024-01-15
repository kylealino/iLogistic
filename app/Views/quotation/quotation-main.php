<?php
$request = \Config\Services::request();

$mylibzsys = model('App\Models\MyLibzSysModel');
echo view('templates/meheader01');

?>


<main id="main" class="main">
    <div class="pagetitle">
		<h1>Dashboard</h1>
		<nav>
        <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?=site_url();?>">Home</a></li>
                <li class="breadcrumb-item active">Quotation Dashboard</li>
            </ol>
		</nav>
	</div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">

                    <div class="col-xxl-3 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <div class="row text-center">
                                    <div class="col-6 text-start">
                                        <h5 class="card-title">New Order</h5>
                                    </div>
                                    <div class="col-6 text-end">
                                        <div class="filter">
                                            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                                <li class="dropdown-header text-start">
                                                    <h6>Filter</h6>
                                                </li>
                                                <li><a class="dropdown-item" href="javascript:mywg_pouttob();">Latest Records</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-file-earmark-text"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>5124</h6>
                                        <span class="small pt-2 ps-1 text-success">Total New Order</span>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <button type="button" id="btn-process" class="btn btn-outline-success btn-sm m-0 rounded px-3" >More Info <span><i class="bi bi-arrow-bar-right"></i></span></button>
                                </div>
                            </div>
                        </div>
                    </div>  
                    <div class="col-xxl-3 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <div class="row text-center">
                                    <div class="col-6 text-start">
                                        <h5 class="card-title">Processed</h5>
                                    </div>
                                    <div class="col-6 text-end">
                                        <div class="filter">
                                            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                                <li class="dropdown-header text-start">
                                                    <h6>Filter</h6>
                                                </li>
                                                <li><a class="dropdown-item" href="javascript:mywg_pouttob();">Latest Records</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-file-earmark-arrow-down"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>2314</h6>
                                        <span class="small pt-2 ps-1 text-danger">Total Processed</span>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <button type="button" id="btn-intransit" class="btn btn-outline-success btn-sm m-0 rounded px-3" >More Info <span><i class="bi bi-arrow-bar-right"></i></span></button>
                                </div>
                            </div>
                        </div>
                    </div>  
                    <div class="col-xxl-3 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <div class="row text-center">
                                    <div class="col-6 text-start">
                                        <h5 class="card-title text-nowrap">Delivery</h5>
                                    </div>
                                    <div class="col-6 text-end">
                                        <div class="filter">
                                            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                                <li class="dropdown-header text-start">
                                                    <h6>Filter</h6>
                                                </li>
                                                <li><a class="dropdown-item" href="javascript:mywg_pouttob();">Latest Records</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-truck"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6 id="txt-receive">2314</h6>
                                        <span class="text-success small pt-2 ps-1">Total Delivery</span>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <button type="button" id="btn-received" class="btn btn-outline-success btn-sm m-0 rounded px-3" >More Info <span><i class="bi bi-arrow-bar-right"></i></span></button>
                                </div>
                            </div>
                        </div>
                    </div>  
                    
                    <div class="col-xxl-3 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <div class="row text-center">
                                    <div class="col-6 text-start">
                                        <h5 class="card-title text-nowrap">Arrived</h5>
                                    </div>
                                    <div class="col-6 text-end">
                                        <div class="filter">
                                            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                                <li class="dropdown-header text-start">
                                                    <h6>Filter</h6>
                                                </li>
                                                <li><a class="dropdown-item" href="javascript:mywg_pouttob();">Latest Records</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-flag-fill"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6 id="txt-receivedwoclaims">0</h6>
                                        <span class="text-success small pt-2 ps-1">Total Arrived</span>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <button type="button" id="btn-receivedwoclaims" class="btn btn-outline-success btn-sm m-0 rounded px-3" >More Info <span><i class="bi bi-arrow-bar-right"></i></span></button>
                                </div>
                            </div>
                        </div>
                    </div>  					
                </div> 
            </div> 
        </div> 
    </section>
    
    <section class="section dashboard">
        <div class="row mb-3 me-form-font"> 
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header mb-3">
                        <div class="row">
                            <div class="col-6 text-start">
                                <h3 class="h4 mb-0"> <i class="bi bi-diagram-3"></i> Quotation Monitoring</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body bg-light">
                        <div class="row">
                            <div class="col-sm-6 mx-auto p-4 rounded">
                                <div class="mt-3">
                                    <input type="hidden" id="rtp_type" value="">
                                    <h6 class="card-title p-0">Services:</h6>
                                    <input type="text"  id="branch_name" name="branch_name" class="branch_name form-control form-control-sm " required/>
                                </div>
                                <div class="mt-3">
                                    <h6 class="card-title p-0">Quotation No:</h6>
                                    <input type="text"  id="branch_area" name="branch_area" class="branch_area form-control form-control-sm " required/>
                                </div>
                                <div class="mt-3">
                                    <h6 class="card-title p-0">Quoted By:</h6>
                                    <input type="text"  id="branch_area" name="branch_area" class="branch_area form-control form-control-sm " required/>
                                </div>
                                <div class="mt-3">
                                    <h6 class="card-title p-0">Quoted to:</h6>
                                    <input type="text"  id="branch_area" name="branch_area" class="branch_area form-control form-control-sm " required/>
                                </div>
                            </div> 
                            <div class="col-sm-6 mx-auto p-4 rounded">
                                <div class="mt-3">
                                    <input type="hidden" id="rtp_type" value="">
                                    <h6 class="card-title p-0">Show:</h6>
                                    <input type="text"  id="branch_name" name="branch_name" class="branch_name form-control form-control-sm " required/>
                                </div>
                                <div class="mt-3">
                                    <h6 class="card-title p-0">Status:</h6>
                                    <input type="text"  id="branch_area" name="branch_area" class="branch_area form-control form-control-sm " required/>
                                </div>
                                <div class="mt-3">
                                    <h6 class="card-title p-0">Date:</h6>
                                    <input type="date"  placeholder="Date from" id="date_from" name="date_from" class="branch_name form-control form-control-sm " required/>
                                </div>

                            </div> 
                            <div class="text-center mt-3">
                                <button type="button" id="btn-processrecs" class="btn btn-success btn-sm m-0 rounded px-3 btn-processrecs" >SEARCH</button>
                                <button type="button" id="btn-processrecs" class="btn btn-primary btn-sm m-0 rounded px-3 btn-processrecs" >CLEAR</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <section class="section dashboard">

    <section class="section dashboard">
        <div class="row mb-3 me-form-font"> 
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header mb-3">
                        <div class="row">
                            <div class="col-6 text-start">
                                <h3 class="h4 mb-0"> <i class="bi bi-journals"></i> Records </h3>
                            </div>
                            <div class="col-6 text-end">
                                <button type="button" id="btn-processrecs" class="btn btn-success btn-sm mb-1 rounded px-3 btn-processrecs" onclick="redirectToURL()"><i class="bi bi-plus"></i> Add New Quotation </button>
                                <button type="button" id="btn-processrecs" class="btn btn-danger btn-sm mb-1     rounded px-3 btn-processrecs" ><i class="bi bi-trash3"></i> Delete Quotation </button>
                                <div class="w-100 d-sm-none"></div>
                                <button type="button" id="btn-processrecs" class="btn btn-warning btn-sm mb-1    rounded px-3 btn-processrecs" ><i class="bi bi-printer"></i> Print Quotation </button>
                                <button type="button" id="btn-processrecs" class="btn btn-info btn-sm mb-1   rounded px-3 btn-processrecs" ><i class="bi bi-arrow-clockwise"></i> Reset </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body bg-light">
                        <div id="mydshbrdrecs" class="text-center p-0 rounded-3 border-dotted p-4 ">
                            <div class="box box-primary ">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="table-responsive ">
                                                <table class="table table-striped  table-hover table-sm text-center" id="tbl-transfer-verify-items-recs">
                                                    <thead class="thead-dark">
                                                        <tr>
                                                            <th class="text-center">
                                                            </th>
                                                            <th>Quotation No.</th>
                                                            <th>Date</th>
                                                            <th>Quoted To</th>
                                                            <th>Quoted By</th>
                                                            <th>Lead Date</th>
                                                            <th>Valid Til</th>
                                                            <th>Valid From</th>
                                                            <th>Cargo Type</th>
                                                            <th>Services</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td colspan="18">No data was found.</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    <section class="section dashboard">
</main>


<?php
echo view('templates/mefooter01');
?>

<script type="text/javascript">
    function redirectToURL() {
        window.location.href = '<?= site_url("mycrm-quotation-entry"); ?>';
    }
</script>