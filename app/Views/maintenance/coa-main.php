<?php
$request = \Config\Services::request();

$mylibzsys = model('App\Models\MyLibzSysModel');
echo view('templates/meheader01');

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
                                <div class="col-4  mt-3">
                                    <h6 class="card-title p-0">Transaction No.:</h6>
                                    <input type="text" id="txt_fg_code" name="txt_fg_code" placeholder="Generated Transaction No." class="form-control form-control-sm thick-border " value="<?=$fg_code;?>" readonly/>
                                </div>
                                <div class="col-4  mt-3">
                                    <h6 class="card-title p-0">Select Organization: <span class="text-danger"> *</span></h6>
                                    <input type="text" id="txt_fg_code" name="txt_fg_code" placeholder="Please select the organization" class="form-control form-control-sm thick-border" value="<?=$fg_code;?>"/>
                                </div>
                                <div class="col-4  mt-3">
                                    <h6 class="card-title p-0">Select Service: <span class="text-danger"> *</span></h6>
                                    <input type="text" id="txt_fg_code" name="txt_fg_code" placeholder="Please select a service" class="form-control form-control-sm thick-border" value="<?=$fg_code;?>"/>
                                </div>
                                <div class="col-12 mt-3">
                                    <h6 class="card-title p-0">Assign Charges:</h6>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover table-sm text-center" id="tbl-item-comp-recs">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th><input class="mycheckbox green-cb fs-2" id="checkAll" type="checkbox" style="scale: 1.3"></th>
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
                                                    <td nowrap="nowrap"><input type="checkbox"  class="mycheckbox green-cb fs-2" style="scale:1.3" data-id="<?=$row[recid];?>"></td>
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
                                <div class="col-6">
                                    <input type="text" id="txt_fg_code" name="txt_fg_code" class="form-control form-control-sm thick-border" value="<?=$fg_code;?>"/>
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
echo $mylibzsys->memsgbox1('meprofsavemsg','System Message','...');
?>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        // Check/uncheck all checkboxes when the "checkAll" checkbox is clicked
        $('#checkAll').change(function () {
            $('input:checkbox').prop('checked', $(this).prop('checked'));
        });

    });

    $('#btn-save').click(function () {
        // Get an array of objects with 'id' and 'value' properties from checked checkboxes
        var checkedValues = $('input:checkbox:checked').map(function () {
            return { id: $(this).data('id'), value: this.value };
        }).get();

        // Perform your Ajax request
        $.ajax({
            url: 'coa-sv',
            type: 'POST',
            data: { checkedValues: checkedValues },
            success: function (response) {
                jQuery('#meprofsavemsg_bod').html(data);
				jQuery('#meprofsavemsg').modal('show');
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


</script>