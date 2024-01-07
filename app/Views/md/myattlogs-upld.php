<?php
$this->mylibzsys = model('App\Models\MyLibzSysModel');
echo view('templates/meheader01');

?>
<?=link_tag('assets/vendor/jquery/miniuploadform/assets/css/style.css'); ?>

<main id="main" class="main">
	<div class="pagetitle">
		<h1>Dashboard</h1>
		<nav>
			<ol class="breadcrumb">
			  <li class="breadcrumb-item"><a href="<?=site_url();?>">Home</a></li>
			  <li class="breadcrumb-item active">AttLogs Uploading</li>
			</ol>
		</nav>
	</div><!-- End Page Title -->
	<div class="row">
		<div class="col-lg-6">
			<div class="card">
				<div class="card-header">
					<h5>TK Biometrics Attlogs Uploading....</h5>
				</div>
				<div class="card-body">
					<!-- <span class="label label-success pull-right">NEW</span> -->
					<div class="row mt-2">
						<div class="col-sm-8">
							<p>
								Handle Biometrics Attlogs Uploading
							</p>
								<?php echo form_open_multipart('md-attlogs-upld-data', ' id="upload" ');?>
									<div id="drop">
										Drop Here
										<a>Browse</a>
										<input type="file" name="upl" multiple />
									</div>
									<div>
										<?=anchor('md-attlogs-upld','Clear All',' style="color: #78DE3C; " ');?>
									</div>
									<ul>
										<!-- The file uploads will be shown here -->
									</ul>
								</form>
										
						</div>
					</div>
				</div>
				<div class="card-footer">
					Additional information about project in footer
				</div>
			</div>
		</div>
		<!-- end col-lg-6 -->
		<div class="col-lg-6">
			<div class="row">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-sm-12">
								<h4><a href="javascript:void(0);"> Attlogs Files Uploaded</a></h4>
								<p>
									Attlogs Uploaded by the current User
								</p>
								<div class="row" id="wg_attlogs_files_uploaded">
								</div>
							</div>
						</div>
						<!-- end row -->
					</div>
					<div class="card-footer">
						Additional information about project in footer
					</div>
				</div>
			</div>
			<div class="row">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-sm-12">
								<h4><a href="javascript:void(0);"> Attlogs In/Out Processing</a></h4>
								<p>
									Attlogs In/Out Posting....
								</p>
								<div class="row" id="wg_attlogs_InOut_procz">
								</div>
							</div>
						</div>
						<!-- end row -->
					</div>
					<div class="card-footer">
						Additional information about project in footer
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end row -->
</main>
<?php
echo $this->mylibzsys->memypreloader01('mepreloaderme');
echo view('templates/mefooter01');
?>
<script src="<?=base_url('assets/vendor/jquery/miniuploadform/assets/js/jquery.knob.js');?>"></script>

<!-- jQuery File Upload Dependencies -->
<script src="<?=base_url('assets/vendor/jquery/miniuploadform/assets/js/jquery.ui.widget.js');?>"></script>
<script src="<?=base_url('assets/vendor/jquery/miniuploadform/assets/js/jquery.iframe-transport.js');?>"></script>
<script src="<?=base_url('assets/vendor/jquery/miniuploadform/assets/js/jquery.fileupload.js');?>"></script>

<script type="text/javascript"> 
	__mysys_apps.mepreloader('mepreloaderme',false);
	
	function mywg_attlogs_files_uploaded() {
	} //end mywg_attlogs_files_uploaded
	 	
		$(function() { 
			var ul = $('#upload ul');
			$('#drop a').click(function(){
				// Simulate a click on the file input button
				// to show the file browser dialog
				jQuery(this).parent().find('input').click();
			});
			// Initialize the jQuery File Upload plugin
			$('#upload').fileupload({ 
				// This element will accept file drag/drop uploading
				dropZone: jQuery('#drop'),
				// This function is called when a file is added to the queue;
				// either via the browse button, or via drag/drop:
				add: function (e, data) { 
					var tpl = jQuery('<li class="working"><input type="text" value="0" data-width="48" data-height="48"'+
						' data-fgColor="#0788a5" data-readOnly="1" data-bgColor="#3e4043" /><p></p><span></span></li>');

					// Append the file name and file size
					tpl.find('p').text(data.files[0].name)
								 .append('<i>' + formatFileSize(data.files[0].size) + '</i>');
					// Add the HTML to the UL element
					data.context = tpl.appendTo(ul);
					// Initialize the knob plugin
					tpl.find('input').knob();
					// Listen for clicks on the cancel icon
					tpl.find('span').click(function(){
						if(tpl.hasClass('working')){
							jqXHR.abort();
						}
						tpl.fadeOut(function(){
							tpl.remove();
						});
					});
					// Automatically upload the file once it is added to the queue
					var jqXHR = data.submit();
				},
				progress: function(e, data){

					// Calculate the completion percentage of the upload
					var progress = parseInt(data.loaded / data.total * 100, 10);

					// Update the hidden input field and trigger a change
					// so that the jQuery knob plugin knows to update the dial
					data.context.find('input').val(progress).change();

					if(progress == 100){
						data.context.removeClass('working');
						$.each(data.files, function (index, file) { 
							var mparam = { 
								__mfile: file.name
							}
							mywg_attlogs_files_uploaded();
						});
						
					}
				},
				done: function (e, data) {	
					//data.textStatus
					//data.result
					//alert(data.files[1].name);
					//alert(data.files[data.index].name);
					$.each(data.files, function (index, file) {
						//alert('Selected file: ' + file.type);
						var fextension = file.name.substr( (file.name.lastIndexOf('.') + 1) );
						if(fextension == 'dat' || fextension == 'DAT') { 
						} else { 
							alert(file.name + ' is not valid source file...');
						}				
						switch(fextension) { 
							case 'jpg':
							case 'png':
							case 'gif':
							break;                         // the alert ended with pdf instead of gif.
							case 'zip':
							case 'rar':
							break;
							case 'pdf':
							break;
							default:
						} 
					}); 
				},
				fail:function(e, data){
					// Something has gone wrong!
					data.context.addClass('error');
				},
			});
			// Prevent the default action when a file is dropped on the window
			$(document).on('drop dragover', function (e) {
				e.preventDefault();
			});
			// Helper function that formats the file sizes
			function formatFileSize(bytes) {
				if (typeof bytes !== 'number') {
					return '';
				}
				if (bytes >= 1000000000) {
					return (bytes / 1000000000).toFixed(2) + ' GB';
				}
				if (bytes >= 1000000) {
					return (bytes / 1000000).toFixed(2) + ' MB';
				}
				return (bytes / 1000).toFixed(2) + ' KB';
			}
		});	 //end function 
</script>
