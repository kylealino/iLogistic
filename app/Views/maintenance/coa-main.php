<?php
$request = \Config\Services::request();

$mylibzsys = model('App\Models\MyLibzSysModel');
echo view('templates/meheader01');

$mtkn_org = $request->getVar('mtkn_org');
$mtkn_serv = $request->getVar('mtkn_serv');

?>


<main id="main" class="main">
    <div class="pagetitle">
		<h1>COA</h1>
		<nav>
        <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?=site_url();?>">Home</a></li>
                <li class="breadcrumb-item active">COA Maintenance</li>
            </ol>
		</nav>
	</div>

    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-sm-12 col-md-7">
                    <div class="card info-card sales-card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-6 text-start">
                                    <h3 class="h4 mb-0"> <i class="bi bi-pencil-square"></i> Entry </h3>
                                </div>
                                <div class="col-6 text-end">
                                    <button type="button" id="btn-save" class="btn btn-success btn-sm m-0 rounded px-3 btn-processrecs" ><i class="bi bi-box-arrow-down"></i> Save </button>
                                    <button type="button" id="btn-processrecs" class="btn btn-info btn-sm m-0 rounded px-3 btn-processrecs" ><i class="bi bi-arrow-clockwise"></i> Reset </button>
                                </div>
                            </div>
                            
                        </div>
                        <div class="card-body bg-light">
                            <div class="row">
                                <div class="col-6  mt-3">
                                    <h6 class="card-title p-0">Select Organization: <span class="text-danger"> *</span></h6>
                                    <input type="text" id="txt_org" name="txt_org" placeholder="Please select the organization" class="form-control form-control-sm thick-border" value="<?=$mtkn_org;?>"/>
                                </div>
                                <div class="col-6  mt-3">
                                    <h6 class="card-title p-0">Select Service: <span class="text-danger"> *</span></h6>
                                    <input type="text" id="txt_service" name="txt_service" placeholder="Please select a service" class="form-control form-control-sm thick-border" value="<?=$mtkn_serv;?>"/>
                                </div>
                                <div class="col-12 mt-3">
                                    <h6 class="card-title p-0">Assign Charges:</h6>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover table-sm text-center" id="tbl-item-comp-recs">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th><input class="green-cb fs-2" id="checkAll" type="checkbox" style="scale: 1.3"></th>
                                                    <th>Description</th>
                                                    <th>Charge Type</th>
                                                    <th>Basis</th>
                                                    <th>Currency</th>
                                                    <th>Rate</th>
                                                    <th>Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (is_array($rlist) && !empty($rlist)): ?>
                                                <?php $nn = 1; foreach($rlist as $row): ?>
                                                <tr>
                                                    
                                                    <td nowrap="nowrap"><input type="checkbox"  class="mycheckbox green-cb fs-2" style="scale:1.3" data-id="<?=$row['charge_desc'];?>" value="<?=$row['charge_desc'];?>"></td>
                                                    <td><?=$row['charge_desc'];?></td>
                                                    <td><?=$row['charge_type'];?></td>
                                                    <td><?=$row['charge_basis'];?></td>
                                                    <td><?=$row['charge_cur'];?></td>
                                                    <td><?=$row['charge_rate'];?></td>
                                                    <td><?=$row['charge_amount'];?></td>
                                                </tr>
                                                <?php $nn++; endforeach; ?>
                                                <?php else: ?>
                                                    <tr>
                                                        <td colspan="9">No data was found.</td>
                                                    </tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>                         
                                </div>
                            </div>
                        </div>
                    </div>
                </div>  
                <div class="col-sm-12 col-md-5">
                    <div class="card info-card sales-card">
                        <div class="card-header mb-3">
                                <h3 class="h4 mb-0"> <i class="bi bi-journals"></i> Records </h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div id="my-coa-vw"></div>
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

<?php
    echo $mylibzsys->memsgbox1('memsgtestent_danger','<i class="bi bi-exclamation-circle"></i> System Alert','...','bg-pdanger');
    echo $mylibzsys->memsgbox1('memsgtestent','System Alert','...');
?>  
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#checkAll').change(function () {
            $('#tbl-item-comp-recs tbody input:checkbox').prop('checked', $(this).prop('checked'));
        });

        jQuery('#txt_org')
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
                source: '<?= site_url(); ?>mymaintenance-coa-getorg',
                focus: function() {
                    // prevent value inserted on focus
                    return false;
                },
                search: function(oEvent, oUi) {
                    var sValue = jQuery(oEvent.target).val();

                },
                select: function( event, ui ) {
                    var terms = ui.item.value;
                    jQuery('#txt_org').val(terms);
                    jQuery(this).autocomplete('search', jQuery.trim(terms));
                    return false;
                }
            })
            .click(function() {
                var terms = this.value;
                jQuery(this).autocomplete('search', jQuery.trim(terms));
        });	//end txt_org


        jQuery('#txt_service')
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
                source: '<?= site_url(); ?>mymaintenance-coa-getservice',
                focus: function() {
                    // prevent value inserted on focus
                    return false;
                },
                search: function(oEvent, oUi) {
                    var sValue = jQuery(oEvent.target).val();

                },
                select: function( event, ui ) {
                    var terms = ui.item.value;
                    jQuery('#txt_service').val(terms);
                    jQuery(this).autocomplete('search', jQuery.trim(terms));
                    return false;
                }
            })
            .click(function() {
                var terms = this.value;
                jQuery(this).autocomplete('search', jQuery.trim(terms));
        });	//end txt_service

        

        $('#btn-save').click(function () {
            // Get an array of objects with 'id' and 'value' properties from checked checkboxes

            var organization = jQuery('#txt_org').val();
            var service = jQuery('#txt_service').val();
            var charge = $('input:checkbox.mycheckbox:checked').map(function () {
                return { id: $(this).data('id'), value: $(this).val() };
            }).get();
           

            var mparam = {
                organization:organization,
                service:service,
                charge:charge

            }; 

            // Perform your Ajax request
            $.ajax({
                url: 'mymaintenance-coa-sv',
                type: 'POST',
                data: eval(mparam),
                success: function (data) {
        			jQuery('#memsgtestent_bod').html(data);
        			jQuery('#memsgtestent').modal('show');
                    return false;
                },
                error: function (xhr, status, error) {
                    alert('error loading page...');
                    return false;
                }
            });
        });
        try {

        }catch(err) { 
            var mtxt = 'There was an error on this page.\n';
            mtxt += 'Error description: ' + err.message;
            mtxt += '\nClick OK to continue.';
            alert(mtxt);
            return false;
        }  //end try

    mymaintenance_coa_recs();
    function mymaintenance_coa_recs(mtkn_coa) { 
        var ajaxRequest;

        ajaxRequest = jQuery.ajax({
            url: "<?=site_url();?>mymaintenance-coa-recs",
            type: "post",
            data: {
                mtkn_coa: mtkn_coa
            }
        });

        // Deal with the results of the above ajax call
        ajaxRequest.done(function(response, textStatus, jqXHR) {
            jQuery('#my-coa-vw').html(response);
            });
        };
    });

</script>

