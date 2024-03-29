<?php 
/**
 *	File        : masterdata/md-article-recs.php
 *  Auhtor      : Oliver V. Sta Maria
 *  Date Created: Apr 06, 2022
 * 	last update : Apr 06, 2022
 * 	description : Article Records
 */
 
$request = \Config\Services::request();
$this->myusermod = model('App\Models\MyUserModel');
$mylibzdb = model('App\Models\MyLibzDBModel');
$mylibzsys = model('App\Models\MyLibzSysModel');

$cuser = $this->myusermod->mysys_user();
$mpw_tkn = $this->myusermod->mpw_tkn();

$mytxtsearchrec = $request->getVar('txtsearchedrec');

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
<div class="row ms-1">
	<?=form_open('md-article/recs','class="row g-3 for-validation" id="myfrmsrec_artm" ');?>
		<div class="input-group input-group-sm">
			<span class="input-group-text fw-bold" id="mebtnGroupAddon">Search:</span>
			<input type="text" class="form-control form-control-sm" name="mytxtsearchrec" placeholder="Search Material Code/Description/Item Barcode" id="mytxtsearchrec" aria-label="Input group example" aria-describedby="mebtnGroupAddon" placeholder="Search Material Code/Description/Item Barcode" value="<?=$mytxtsearchrec;?>" required/>
			<div class="invalid-feedback">Please fill out this field.</div>
			<button type="submit" class="btn btn-primary"><i class="bi bi-search"></i></button>
			<?=anchor('mymd-item-materials', 'Reset',' class="btn btn-primary" ');?>
		</div>
	<?=form_close();?> <!-- end of ./form -->
</div>	
<div class="row ms-1 mt-1">
	<?=$mylibzsys->mypagination($npage_curr,$npage_count,'__myredirected_rsearch','');?>
</div>	
	<!-- <div class="box box-primary"> -->
		<!-- <div class="box-body"> -->
			<div class="table-responsive">
					<table class="metblentry-font table-bordered" id="metblarticle">
						<thead>
							<tr>
								<th class="text-center">
									<?=anchor('mymd-item-materials/?maction=A_REC', '<i class="bi bi-plus-lg"></i>',' class="btn btn-success btn-sm p-1 pb-0 mebtnpt1" ');?>
								</th>
								<th>Material Code</th>
								<th nowrap>Material Description</th>
								<th nowrap>Category</th>
								<th nowrap>Product Type</th>
								<th nowrap>Part Number</th>
								<th>Barcode</th>
								<th>U/M</th>
								<th>U/P</th>
								<th>User</th>
								<th>Date Created</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							if($rlist !== ''):
								$nn = 1;
								foreach($rlist as $row): 
									
									// $bgcolor = ($nn % 2) ? "#EAEAEA" : "#F2FEFF";
									$on_mouse = " onmouseover=\"this.style.backgroundColor='#5cb85cb8';\" onmouseout=\"this.style.backgroundColor='';\"";	
									$mtkn_arttr = hash('sha384', $row['recid'] . $mpw_tkn);
								?>
								<tr <?=$on_mouse;?>>
									<td class="text-center" nowrap>
										<?=anchor('mymd-item-materials/?mtkn_etr=' . $mtkn_arttr, '<i class="bi bi-pencil-square"></i>',' class="btn btn-primary btn-sm p-1 pb-0 mebtnpt1" ');?>
									</td>
									<td nowrap><?=$row['ART_CODE'];?></td>
									<td nowrap><?=$row['ART_DESC'];?></td>
									<td nowrap><?=$row['ART_HIERC1'];?></td>
									<td nowrap><?=$row['ART_HIERC2'];?></td>
									<td nowrap><?=$row['ART_PARTNO'];?></td>
									<td nowrap><?=$row['ART_BARCODE1'];?></td>
									<td nowrap><?=$row['ART_UOM'];?></td>
									<td nowrap><?=$row['ART_UPRICE'];?></td>
									<td nowrap><?=$row['MUSER'];?></td>
									<td nowrap><?=$row['ENCD'];?></td>
								</tr>
								<?php 
								$nn++;
								endforeach;
							else:
								?>
								<tr>
									<td colspan="10">No data was found.</td>
								</tr>
							<?php 
							endif; ?>
						</tbody>
					</table>
			</div>
		<!-- </div>  -->
		<!-- end box body -->
	<!-- </div>  -->
	<!-- end box --> 

	<div class="row" style="padding: 10px 10px 0px 15px !important;">
		<?=$mylibzsys->mypagination($npage_curr,$npage_count,'__myredirected_rsearch','');?>
  </div>	

<script type="text/javascript"> 

	(function () {
		'use strict'

		// Fetch all the forms we want to apply custom Bootstrap validation styles to
		var forms = document.querySelectorAll('.for-validation')
		// Loop over them and prevent submission
		Array.prototype.slice.call(forms)
		.forEach(function (form) {
			form.addEventListener('submit', function (event) {
				if (!form.checkValidity()) {
					event.preventDefault()
					event.stopPropagation()
				}
				form.classList.add('was-validated') 

				try {
					event.preventDefault();
          			event.stopPropagation();
					//jQuery('html,body').scrollTop(0);
					//jQuery.showLoading({name: 'line-pulse', allowHide: false });
					var txtsearchedrec = jQuery('#mytxtsearchrec').val();
					if(jQuery.trim(txtsearchedrec) == '') {
						return false;
					}
					__mysys_apps.mepreloader('mepreloaderme',true);

					var mparam = {
						txtsearchedrec: txtsearchedrec,
						mpages: 1 
					};	
					jQuery.ajax({ // default declaration of ajax parameters
					type: "POST",
					url: '<?=site_url();?>search-mymd-item-materials',
					context: document.body,
					data: eval(mparam),
					global: false,
					cache: false,
						success: function(data)  { //display html using divID
								__mysys_apps.mepreloader('mepreloaderme',false);
								jQuery('#artclist').html(data);
								
								return false;
						},
						error: function() { // display global error on the menu function 
							__mysys_apps.mepreloader('mepreloaderme',false);
							alert('error loading page...');
							return false;
						}	
					});	
				} catch(err) { 
					__mysys_apps.mepreloader('mepreloaderme',false);
					var mtxt = 'There was an error on this page.\n';
					mtxt += 'Error description: ' + err.message;
					mtxt += '\nClick OK to continue.';
					alert(mtxt);
					return false;
				}  //end try					
			}, false)
		})
	})();


    function meSetCellPadding () {
        var metable = document.getElementById ("metblarticle");
        metable.cellPadding = 5;
        metable.style.border = "1px solid #F6F5F4";
        var tabletd = metable.getElementsByTagName("td");
        //for(var i=0; i<tabletd.length; i++) {
        //    var td = tabletd[i];
        //    td.style.borderColor ="#F6F5F4";
        //}

    }
    meSetCellPadding();

	function __myredirected_rsearch(mobj) { 
		try { 
			__mysys_apps.mepreloader('mepreloaderme',true);
			var txtsearchedrec = jQuery('#mytxtsearchrec').val();
			var mparam = {
				txtsearchedrec: txtsearchedrec,
				mpages: mobj 
			};	
			jQuery.ajax({ // default declaration of ajax parameters
			type: "POST",
			url: '<?=site_url()?>search-mymd-item-materials',
			context: document.body,
			data: eval(mparam),
			global: false,
			cache: false,
				success: function(data)  { //display html using divID
						__mysys_apps.mepreloader('mepreloaderme',false);
						jQuery('#artclist').html(data);
						
						return false;
				},
				error: function() { // display global error on the menu function
					__mysys_apps.mepreloader('mepreloaderme',false);
					alert('error loading page...');
					return false;
				}	
			});	
		} catch(err) {
			__mysys_apps.mepreloader('mepreloaderme',false);
			var mtxt = 'There was an error on this page.\n';
			mtxt += 'Error description: ' + err.message;
			mtxt += '\nClick OK to continue.';
			alert(mtxt);
			return false;
		}  //end try
	}	
	
	
	jQuery('#mytxtsearchrec').keypress(function(event) { 
		if(event.which == 13) { 
			event.preventDefault(); 
			try { 
				var txtsearchedrec = jQuery('#mytxtsearchrec').val();
				if(jQuery.trim(txtsearchedrec) == '') {
					return false;
				}

				__mysys_apps.mepreloader('mepreloaderme',true);
				var mparam = {
					txtsearchedrec: txtsearchedrec,
					mpages: 1 
				};	
				jQuery.ajax({ // default declaration of ajax parameters
				type: "POST",
				url: '<?=site_url();?>search-mymd-item-materials',
				context: document.body,
				data: eval(mparam),
				global: false,
				cache: false,
					success: function(data)  { //display html using divID
							__mysys_apps.mepreloader('mepreloaderme',false);
							jQuery('#artclist').html(data);
							return false;
					},
					error: function() { // display global error on the menu function
						__mysys_apps.mepreloader('mepreloaderme',false);
						alert('error loading page...');
						return false;
					}	
				});	
			} catch(err) { 
				__mysys_apps.mepreloader('mepreloaderme',false);
				var mtxt = 'There was an error on this page.\n';
				mtxt += 'Error description: ' + err.message;
				mtxt += '\nClick OK to continue.';
				alert(mtxt);
				return false;
			}  //end try	
			
		}
	});
	


</script>
