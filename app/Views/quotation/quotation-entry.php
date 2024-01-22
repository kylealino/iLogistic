<?php
$request = \Config\Services::request();

$mylibzsys = model('App\Models\MyLibzSysModel');
echo view('templates/meheader01');

?>
  <style>
    .timeline {
      position: relative;
      padding: 20px 0;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }


    .timeline-item:before {
      content: '';
      position: absolute;
      top: 50%;
      left: 0;
      width: 100%;
      height: 2px;
      background: #007bff;
      transform: translateY(-50%);
    }

    .badge {
      background-color: #007bff;
      color: #fff;
      border-radius: 50%;
      padding: 10px;
    }
 /* Add this style to the existing styles */
    .card-body {
        overflow-x: auto; /* or overflow-x: scroll; */
    }

    /* Additional styles to ensure the timeline fits within the card body */
    .timeline {
        white-space: nowrap;
        overflow: auto;
        position: relative; /* Added position: relative */
    }

    .timeline:before {
        content: '';
        position: absolute;
        top: 50%;
        left: 0;
        width: 100%;
        height: 2px;
        background: #007bff;
        transform: translateY(-50%);
    }

    .timeline-item {
        display: inline-block;
        white-space: normal;
    }
  </style>

<main id="main">

    <div class="pagetitle">
        <h1>Entry</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?=site_url();?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?=site_url();?>mycrm-quotation-dashb">Dashboard</a>
                <li class="breadcrumb-item active">Entry</li>
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
                                    <input type="text"  id="quotation_trxno" name="quotation_trxno" class="quotation_trxno form-control form-control-sm disabled" />
                                </div>
                                <div class="mt-3">
                                    <h6 class="card-title p-0">Organization:</h6>
                                    <input type="text"  id="organization" name="organization" class="form-control form-control-sm " required/>
                                </div>
                                <div class="mt-3">
                                    <h6 class="card-title p-0">Address:</h6>
                                    <input type="text"  id="org_address" name="org_address" class="org_address form-control form-control-sm " required/>
                                </div>
                                <div class="mt-3">
                                    <h6 class="card-title p-0">Contact Person:</h6>
                                    <input type="text"  id="contact_prsn" name="contact_prsn" class="contact_prsn form-control form-control-sm " required/>
                                </div>
                                <div class="mt-3">
                                    <div class="row">
                                        <div class="col-sm-6 mb-1">
                                            <h6 class="card-title p-0">Quoted By:</h6>
                                            <select id="optn_quotedby" class="form-control form-control-sm mb-1">
                                                <option value=""></option>
                                                <option value="">Mae Turingan</option>
                                            </select>
                                        </div> 
                                        <div class="col-sm-6 mb-1">
                                            <h6 class="card-title p-0">Sales Coor:</h6>
                                            <select id="optn_salescoor" class="form-control form-control-sm mb-1">
                                                <option value=""></option>
                                                <option value="">Mae Turingan</option>
                                            </select>
                                        </div>
                                    </div> 
                                </div>
                                <div class="mt-3">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h6 class="card-title p-0">Lead:</h6>
                                            <div class="d-flex">
                                                <div class="col-sm-8">
                                                    <input type="text" id="quotation_trxno" name="quotation_trxno" class="quotation_trxno form-control form-control-sm" />
                                                </div>
                                                <form action="<?=site_url();?>mycrm-lead" method="get" target="_blank">
                                                    <div class="col-sm-4">
                                                        <button type="submit" class="btn btn-info btn-sm m-0 rounded px-3 btn-processrecs">New</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            <div class="col-sm-6 mx-auto p-4 rounded">
                                <div class="mt-3">
                                    <div class="row">
                                        <div class="col-sm-6 mb-1">
                                            <h6 class="card-title p-0 mb-1">Valid From:</h6>
                                            <input type="date"  placeholder="Date from" id="validfrm_date" name="validfrm_date" class="form-control form-control-sm mb-1" required/>
                                        </div>
                                        <div class="col-sm-6 mb-1">
                                            <h6 class="card-title p-0 mb-1">Valid Till:</h6>
                                            <input type="date"  placeholder="Date from" id="validto_date" name="validto_date" class="form-control form-control-sm mb-1" required/>
                                        </div> 
                                    </div> 
                                </div>
                                <div class="mt-3">
                                    <div class="row">
                                        <div class="col-sm-6 mb-1">
                                            <h6 class="card-title p-0">Usability:</h6>
                                            <select id="optn_usability" class="form-control form-control-sm mb-1">
                                                <option value=""></option>
                                                <option value="single">Single</option>
                                                <option value="multiple">Multiple</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-6 mb-1">
                                            <h6 class="card-title p-0">Version:</h6>
                                            <select id="optn_version" class="form-control form-control-sm disabled">
                                                <option value=""></option>
                                                <option value="org1">Test</option>
                                            </select>
                                        </div> 
                                    </div> 
                                </div>
                                <div class="mt-3">
                                    <input type="hidden" id="rtp_type" value="">
                                    <h6 class="card-title p-0">Party Role:</h6>
                                    <select id="optn_partyrole" class="form-control form-control-sm disabled">
                                        <option value=""></option>
                                        <option value="shipper">Shipper</option>
                                        <option value="consignee">Consignee</option>
                                        <option value="dest_agent">Dest. Agent</option>
                                        <option value="origin_agent">Origin Agent</option>
                                        <option value="customer">Customer</option>
                                    </select>
                                </div>
                                <div class="mt-3">
                                    <div class="row">
                                        <div class="col-sm-6 mb-1">
                                            <h6 class="card-title p-0 mb-1">Cargo Status:</h6>
                                            <select id="optn_cargostatus" class="form-control form-control-sm mb-1">
                                                <option value="ready_by">Ready By</option>
                                                <option value="ready">Ready</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-6 mb-1">
                                            <h6 class="card-title p-0">Ready Date:</h6>
                                            <input type="date"  placeholder="Date from" id="ready_date" name="ready_date" class=" form-control form-control-sm " required/>
                                        </div> 
                                    </div> 
                                </div>
                                <div class="mt-3">
                                    <input type="hidden" id="rtp_type" value="">
                                    <h6 class="card-title p-0">Location:</h6>
                                    <select id="organizationSelect" class="form-control form-control-sm">
                                        <option value=""></option>
                                        <option value="admin">Admin</option>
                                        <option value="brokerage">Brokerage</option>
                                        <option value="forwarding">Forwarding</option>
                                        <option value="trucking">Trucking</option>
                                        <option value="warehouse">Warehouse</option>
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
                            <div class="row">
                                <div class="col-md-4 col-sm-12">
                                    <h6 class="card-title d-flex justify-content-center">Line of Business:</h6>
                                    <h6 class="card-title d-flex justify-content-center">Sea Import</h6>
                                </div>
                                <div class="col-md-8 col-sm-12">
                                    <h6 class="card-title d-flex justify-content-center">Description:</h6>
                                    <div class="timeline">
                                        <div class="timeline-item">
                                            <span class="badge my-3">ORIGIN</span>
                                            <p>Yokohama(JPYOK)</p>
                                        </div>
                                        <div class="timeline-item">
                                            <span class="badge my-3">PLR</span>
                                            <p>Yokohama(JPYOK)</p>
                                        </div>
                                        <div class="timeline-item">
                                            <span class="badge my-3">POL</span>
                                            <p>Yokohama(JPYOK)</p>
                                        </div>
                                        <div class="timeline-item">
                                            <span class="badge my-3">POD</span>
                                            <p>Manila North Harbour(PH/MNH)</p>
                                        </div>
                                        <div class="timeline-item">
                                            <span class="badge my-3">PLD</span>
                                            <p>Manila North Harbour(PH/MNH)</p>
                                        </div>
                                        <div class="timeline-item">
                                            <span class="badge my-3">DESTINATION</span>
                                            <p>Manila North Harbour(PH/MNH)</p>
                                        </div>
                                        <!-- Add more timeline items as needed -->
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
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script type="text/javascript">

    $(document).ready(function () {
        jQuery('#organization')
            // don't navigate away from the field on tab when selecting an item
            .bind( 'keydown', function( event ) {
                if ( event.keyCode === jQuery.ui.keyCode.TAB &&
                    jQuery( this ).data( 'ui-autocomplete' ).menu.active ) { 
                    event.preventDefault();
                }
                if( event.keyCode === jQuery.ui.keyCode.TAB ) {
                    event.preventDefault();
                }
            })
            .autocomplete({
                minLength: 0,
                source: '<?= site_url(); ?>mycrm-quotation-org-search',
                focus: function() {
                    // prevent value inserted on focus
                    return false;
                },
                search: function(oEvent, oUi) {
                    var sValue = jQuery(oEvent.target).val();

                },
                select: function( event, ui ) {
                    var terms = ui.item.value;
                    jQuery('#organization').val(terms);
                    jQuery(this).autocomplete('search', jQuery.trim(terms));
                    return false;
                }
            })
            .click(function() {
                var terms = this.value;
                jQuery(this).autocomplete('search', jQuery.trim(terms));
        });	//end organization
    });
    
</script>