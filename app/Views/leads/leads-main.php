<?php
$request = \Config\Services::request();

$mylibzsys = model('App\Models\MyLibzSysModel');
echo view('templates/meheader01');

?>


<main id="main" class="main">
    <div class="pagetitle">
		<h1>Leads Entry</h1>
		<nav>
        <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?=site_url();?>">Home</a></li>
                <li class="breadcrumb-item active">Leads Entry</li>
            </ol>
		</nav>
	</div><!-- End Page Title -->

    <div class="row">
        <div class="col-md-6 col-sm-12">
            <section class="section dashboard">
                <div class="row mb-3 me-form-font"> 
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-6 text-start">
                                        <h3 class="h4 mb-0"> <i class="bi bi-journal"></i> Cargo Details </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6 mx-auto p-4 rounded">
                                        <div class="mt-3">
                                            <input type="hidden" id="rtp_type" value="">
                                            <h6 class="card-title p-0">Transport Mode:</h6>
                                            <input type="text"  id="branch_name" name="branch_name" class="branch_name form-control form-control-sm " required/>
                                        </div>
                                        <div class="mt-3">
                                            <h6 class="card-title p-0">Shipment Type:</h6>
                                            <input type="text"  id="branch_area" name="branch_area" class="branch_area form-control form-control-sm " required/>
                                        </div>
                                        <div class="mt-3">
                                            <h6 class="card-title p-0">Business Dims:</h6>
                                            <input type="text"  id="branch_area" name="branch_area" class="branch_area form-control form-control-sm " required/>
                                        </div>
                                        <div class="mt-3">
                                            <h6 class="card-title p-0">Commodity:</h6>
                                            <input type="text"  id="branch_area" name="branch_area" class="branch_area form-control form-control-sm " required/>
                                        </div>
                                        <div class="mt-3">
                                            <h6 class="card-title p-0">Description:</h6>
                                            <input type="text"  id="branch_area" name="branch_area" class="branch_area form-control form-control-sm " required/>
                                        </div>
                                    </div> 
                                    <div class="col-sm-6 mx-auto p-4 rounded">
                                        <div class="mt-3">
                                            <input type="hidden" id="rtp_type" value="">
                                            <h6 class="card-title p-0">Transport Type:</h6>
                                            <input type="text"  id="branch_name" name="branch_name" class="branch_name form-control form-control-sm " required/>
                                        </div>
                                        <div class="mt-3">
                                            <h6 class="card-title p-0">Cargo Type:</h6>
                                            <input type="text"  id="branch_area" name="branch_area" class="branch_area form-control form-control-sm " required/>
                                        </div>
                                        <div class="mt-3">
                                            <h6 class="card-title p-0">De-stuff at:</h6>
                                            <input type="text"  id="branch_area" name="branch_area" class="branch_area form-control form-control-sm " required/>
                                        </div>
                                        <div class="mt-3">
                                            <h6 class="card-title p-0">Commodity Type:</h6>
                                            <input type="text"  id="branch_area" name="branch_area" class="branch_area form-control form-control-sm " required/>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <section class="section dashboard">
        </div>
        <div class="col-md-6 col-sm-12">
            <section class="section dashboard">
                <div class="row mb-3 me-form-font"> 
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-6 text-start">
                                        <h3 class="h4 mb-0"> <i class="bi bi-truck"></i> Freight </h3>
                                    </div>
                                    <div class="col-6 text-end">
                                        <input type="checkbox" class="mycheckbox green-cb fs-2" style="transform: scale(1.3);" id="serviceCheckbox" name="serviceCheckbox" value="Service Required" checked>
                                        <label class="ms-2 mb-0" for="serviceCheckbox">Service Required</label>
                                    </div>

                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6 mx-auto p-4 rounded">
                                        <div class="mt-3">
                                            <input type="hidden" id="rtp_type" value="">
                                            <h6 class="card-title p-0">Movement Type:</h6>
                                            <input type="text"  id="branch_name" name="branch_name" class="branch_name form-control form-control-sm " required/>
                                        </div>
                                        <div class="mt-3">
                                            <h6 class="card-title p-0">BL Issued By:</h6>
                                            <input type="text"  id="branch_area" name="branch_area" class="branch_area form-control form-control-sm " required/>
                                        </div>
                                        <div class="mt-3">
                                            <h6 class="card-title p-0">Carrier:</h6>
                                            <input type="text"  id="branch_area" name="branch_area" class="branch_area form-control form-control-sm " required/>
                                        </div>
                                    </div> 
                                    <div class="col-sm-6 mx-auto p-4 rounded">
                                        <div class="mt-3">
                                            <h6 class="card-title p-0">Transit/Dest/Days:</h6>
                                            <input type="text"  id="branch_name" name="branch_name" class="branch_name form-control form-control-sm " required/>
                                        </div>
                                        <div class="mt-3">
                                            <h6 class="card-title p-0">IncoTerms:</h6>
                                            <input type="text"  id="branch_area" name="branch_area" class="branch_area form-control form-control-sm " required/>
                                        </div>
                                        <div class="mt-3">
                                            <h6 class="card-title p-0">Remarks:</h6>
                                            <input type="text"  id="branch_area" name="branch_area" class="branch_area form-control form-control-sm " required/>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <section class="section dashboard">
        </div>
        <div class="col-sm-12">
            <div class="row mb-3 me-form-font"> 
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-6 text-start">
                                    <h3 class="h4 mb-0"> <i class="bi bi-truck-flatbed"></i> Freight-Movement </h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6 mx-auto p-4 rounded">
                                    <div class="mt-3">
                                        <input type="hidden" id="rtp_type" value="">
                                        <h6 class="card-title p-0">Origin:</h6>
                                        <input type="text"  id="branch_name" name="branch_name" class="branch_name form-control form-control-sm " required/>
                                    </div>
                                    <div class="mt-3">
                                        <h6 class="card-title p-0">Place of Receipt:</h6>
                                        <input type="text"  id="branch_area" name="branch_area" class="branch_area form-control form-control-sm " required/>
                                    </div>
                                    <div class="mt-3">
                                        <h6 class="card-title p-0">Port of Loading:</h6>
                                        <input type="text"  id="branch_area" name="branch_area" class="branch_area form-control form-control-sm " required/>
                                    </div>
                                </div> 
                                <div class="col-sm-6 mx-auto p-4 rounded">
                                    <div class="mt-3">
                                        <h6 class="card-title p-0">Port of Discharge:</h6>
                                        <input type="text"  id="branch_name" name="branch_name" class="branch_name form-control form-control-sm " required/>
                                    </div>
                                    <div class="mt-3">
                                        <h6 class="card-title p-0">Port of Delivery:</h6>
                                        <input type="text"  id="branch_area" name="branch_area" class="branch_area form-control form-control-sm " required/>
                                    </div>
                                    <div class="mt-3">
                                        <h6 class="card-title p-0">Final Destination:</h6>
                                        <input type="text"  id="branch_area" name="branch_area" class="branch_area form-control form-control-sm " required/>
                                    </div>
                                </div>
                                <div class="col-sm-12 text-end">
                                    <button type="button" id="btn-processrecs" class="btn btn-success btn-sm m-0 rounded px-3 btn-processrecs"> SAVE </button>
                                    <button type="button" id="btn-processrecs" class="btn btn-info btn-sm m-0 rounded px-3 btn-processrecs"> RESET </button>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>


<?php
echo view('templates/mefooter01');
?>

<script type="text/javascript">

</script>