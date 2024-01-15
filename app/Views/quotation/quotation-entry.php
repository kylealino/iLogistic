<?php
$request = \Config\Services::request();

$mylibzsys = model('App\Models\MyLibzSysModel');
echo view('templates/meheader01');

?>

<main id="main">

    <div class="pagetitle">
        <h1>Entry</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?=site_url();?>">Home</a></li>
                <li class="breadcrumb-item active">Quotation Entry</li>
            </ol>
            </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard mb-3">
        <div class="row mb-3 me-form-font"> 
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header mb-3">
                        <div class="row">
                            <div class="col-6 text-start">
                                <h3 class="h4 mb-0"> <i class="bi bi-diagram-3"></i> Entry</h3>
                            </div>
                            <div class="col-6 text-end">
                                <button type="button" id="btn-processrecs" class="btn btn-success btn-sm m-0 rounded px-3 btn-processrecs"> SAVE </button>
                                <button type="button" id="btn-processrecs" class="btn btn-primary btn-sm m-0 rounded px-3 btn-processrecs" > RESET </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body bg-light">
                        <div class="row">
                            <div class="col-sm-6 mx-auto p-4 rounded">
                                <div class="mt-3">
                                    <input type="hidden" id="rtp_type" value="">
                                    <h6 class="card-title p-0">Quotation No:</h6>
                                    <input type="text"  id="branch_name" name="branch_name" class="branch_name form-control form-control-sm disabled" />
                                </div>
                                <div class="mt-3">
                                    <h6 class="card-title p-0">Organization:</h6>
                                    <input type="text"  id="branch_area" name="branch_area" class="branch_area form-control form-control-sm " required/>
                                </div>
                                <div class="mt-3">
                                    <h6 class="card-title p-0">Contact Person:</h6>
                                    <input type="text"  id="branch_area" name="branch_area" class="branch_area form-control form-control-sm " required/>
                                </div>
                                <div class="mt-3">
                                    <div class="row">
                                        <div class="col-sm-6 mb-1">
                                            <h6 class="card-title p-0">Quoted By:</h6>
                                            <input type="text"  id="branch_area" name="branch_area" class="branch_area form-control form-control-sm mb-1" required/>
                                        </div> 
                                        <div class="col-sm-6 mb-1">
                                            <h6 class="card-title p-0">Sales Coor:</h6>
                                            <select id="organizationSelect" class="form-control form-control-sm mb-1">
                                                <option value="">Select Coordinator</option>
                                                <option value="org1">Test</option>
                                            </select>
                                        </div>
                                    </div> 
                                </div>
                            </div> 
                            <div class="col-sm-6 mx-auto p-4 rounded">
                                <div class="mt-3">
                                    <div class="row">
                                        <div class="col-sm-6 mb-1">
                                            <h6 class="card-title p-0 mb-1">Valid From:</h6>
                                            <input type="date"  placeholder="Date from" id="date_from" name="date_from" class="branch_name form-control form-control-sm mb-1" required/>
                                        </div>
                                        <div class="col-sm-6 mb-1">
                                            <h6 class="card-title p-0 mb-1">Valid Till:</h6>
                                            <input type="date"  placeholder="Date from" id="date_from" name="date_from" class="branch_name form-control form-control-sm mb-1" required/>
                                        </div> 
                                    </div> 
                                </div>
                                <div class="mt-3">
                                    <div class="row">
                                        <div class="col-sm-6 mb-1">
                                            <h6 class="card-title p-0">Usability:</h6>
                                            <select id="organizationSelect" class="form-control form-control-sm mb-1">
                                                <option value="">Single</option>
                                                <option value="org1">Test</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-6 mb-1">
                                            <h6 class="card-title p-0">Version:</h6>
                                            <select id="organizationSelect" class="form-control form-control-sm disabled">
                                                <option value="" class="disabled"></option>
                                                <option value="org1">Test</option>
                                            </select>
                                        </div> 
                                    </div> 
                                </div>
                                <div class="mt-3">
                                    <input type="hidden" id="rtp_type" value="">
                                    <h6 class="card-title p-0">Party Role:</h6>
                                    <select id="organizationSelect" class="form-control form-control-sm disabled">
                                        <option value="" class="disabled">Select Role</option>
                                        <option value="org1">Test</option>
                                    </select>
                                </div>
                                <div class="mt-3">
                                    <div class="row">
                                        <div class="col-sm-6 mb-1">
                                            <h6 class="card-title p-0 mb-1">Cargo Status:</h6>
                                            <select id="organizationSelect" class="form-control form-control-sm mb-1">
                                                <option value="">Ready By</option>
                                                <option value="org1">Test</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-6 mb-1">
                                            <h6 class="card-title p-0">Ready Date:</h6>
                                            <input type="date"  placeholder="Date from" id="date_from" name="date_from" class="branch_name form-control form-control-sm " required/>
                                        </div> 
                                    </div> 
                                </div>
                                <div class="mt-3">
                                    <input type="hidden" id="rtp_type" value="">
                                    <h6 class="card-title p-0">Location:</h6>
                                    <select id="organizationSelect" class="form-control form-control-sm">
                                        <option value="">Select Location</option>
                                        <option value="org1">Test</option>
                                    </select>
                                </div>
                            </div> 

                        </div>
                    </div>
                </div>
            </div>
        </div>
    <section class="section dashboard">

    <div class="row mb-4">
        <div class="col-lg-12 col-md-12 mb-md-0 mb-4">
            <div class="card">
                <div class="card-body bg-light">
                    <ul class="nav nav-tabs nav-tabs-bordered" id="myTabArticle" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="artclist-tab" data-bs-toggle="tab" data-bs-target="#artclist" type="button" role="tab" aria-controls="artclist" aria-selected="true"> Services </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="artprofile-tab" data-bs-toggle="tab" data-bs-target="#artcprofile" type="button" role="tab" aria-controls="artcprofile" aria-selected="false"> Entity </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="artm-importdata-tmpl-tab" data-bs-toggle="tab" data-bs-target="#artm-importdata-tmpl" type="button" role="tab" aria-controls="artm-importdata-tmpl" aria-selected="false"> Printing Info </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="artm-importdata-tmp2-tab" data-bs-toggle="tab" data-bs-target="#artm-importdata-tmp2" type="button" role="tab" aria-controls="artm-importdata-tmpl" aria-selected="false"> T & C </button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabArticleContent">
                        <div class="tab-pane fade show active" id="artclist" role="tabpanel" aria-labelledby="artclist-tab">
                            <div id="mydshbrdrecs" class="text-center p-0 rounded-3 border-dotted p-4 ">
                                <div class="box box-primary ">
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="table-responsive ">
                                                    <table class="table table-striped  table-hover table-sm text-center" id="tbl-transfer-verify-items-recs">
                                                        <thead class="thead-dark">
                                                            <tr>
                                                                <th>Service Type</th>
                                                                <th>Charges</th>
                                                                <th>Charge Name</th>
                                                                <th>Charge Type</th>
                                                                <th>Basis</th>
                                                                <th>Rate Type</th>
                                                                <th>Currency</th>
                                                                <th>Rate</th>
                                                                <th>Amount</th>
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
                        <div class="tab-pane fade" id="artcprofile" role="tabpanel" aria-labelledby="artprofile-tab">...</div>
                        <div class="tab-pane fade" id="artm-importdata-tmpl" role="tabpanel" aria-labelledby="artm-importdata-tmpl-tab">---</div>
                        <div class="tab-pane fade" id="artm-importdata-tmp2" role="tabpanel" aria-labelledby="artm-importdata-tmp2-tab">+++</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
echo view('templates/mefooter01');
?>

