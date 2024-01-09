<?php

$request = \Config\Services::request();
$mydbname = model('App\Models\MyDBNamesModel');
$mylibzdb = model('App\Models\MyLibzDBModel');
$mylibzsys = model('App\Models\MyLibzSysModel');
$mymdcustomer = model('App\Models\MyMDCustomerModel');
$mydataz = model('App\Models\MyDatumModel');
$mydatazua = model('App\Models\MyDatauaModel');

$mytxtsearchrec = $request->getVar('txtsearchedrec');
$mtkn_whse = $request->getVar('mtkn_whse');
$data = array();
$mpages = (empty($mylibzsys->oa_nospchar($request->getVar('mpages'))) ? 0 : $mylibzsys->oa_nospchar($request->getVar('mpages')));
$mpages = ($mpages > 0 ? $mpages : 1);
$apages = array();
$mpages = $npage_curr;
$npage_count = $npage_count;
for($aa = 1; $aa <= $npage_count; $aa++) {
	$apages[] = $aa . "xOx" . $aa;
}

?>

<style>
	table.memetable, th.memetable, td.memetable {
		border: 1px solid #F6F5F4;
		border-collapse: collapse;
	}
	thead.memetable, th.memetable, td.memetable {
		padding: 6px;
	}
</style>

<?=form_open('warehouse-out-recs-vw','class="needs-validation-search" id="myfrmsearchrec" ');?>

    <div class="col-md-12 mb-1">
        <div class="input-group input-group-sm">
            <label class="input-group-text fw-bold" for="search">Search:</label>
            <input type="text" id="mytxtsearchrec" class="form-control form-control-sm" name="mytxtsearchrec" placeholder="Search" value="<?=$mytxtsearchrec;?>"/>
            <button type="submit" class="btn btn-dgreen btn-sm" style="background-color:#167F92; color:#fff;"><i class="bi bi-search"></i></button>
        </div>
    </div>
<?=form_close();?> <!-- end of ./form -->
<div class="col-md-8">
    <?=$mylibzsys->mypagination($npage_curr,$npage_count,'__myredirected_vsearch','');?>
</div>

<div class="box box-primary">
	<div class="box-body">
		<div class="row pt-3">
			<div class="col-md-12">
				<div class="table-responsive">
		          	<table class="table table-bordered table-hover table-sm text-center" id="tbl-out-recs">
		            	<thead class="thead-light">
				          	<tr class="text-dgreen">
                                <th nowrap="nowrap"><i class="bi bi-pencil"></i></th>
					            <th nowrap="nowrap">Organization</th>
					            <th nowrap="nowrap">Service</th>
				          	</tr>
		            	</thead>
			            <tbody id="tbody-inv-items-recs">
			              	<?php 
			              		if($rlist != ""):
                                    $nn = 1;
                                    foreach($rlist as $row):
                                    $mtkn_org = $row['org_desc'];
                                    $mtkn_serv = $row['service_desc'];
			              	?>
			              	<tr>
                                <td nowrap="nowrap"><?=anchor('mymaintenance-coa/?mtkn_org=' . $mtkn_org . '&mtkn_serv=' . $mtkn_serv, 'UPDATE',' class="btn btn-info p-1 pb-0 btn-md"');?></td>
			              		<td nowrap="nowrap"><?=$row['org_desc']?></td>
			              		<td nowrap="nowrap"><?=$row['service_desc']?></td>
			              	</tr>
			              	<?php $nn++; endforeach; else: ?>
			              	<tr>
			              		<td nowrap="nowrap" colspan="13">No data was found.</td>
			              	</tr>
			              	<?php endif; ?>
			            </tbody>
		          	</table>
	            </div>	      
		    </div>
	    </div>
    </div>
</div>

<script type="text/javascript">


</script>