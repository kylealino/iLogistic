<?php
$request = \Config\Services::request();
$mymdarticle = model('App\Models\MyMDArticleModel');
$mylibzsys = model('App\Models\MyLibzSysModel');
//var_dump($mymdarticle);
$maction = $request->getVar('maction');
$mtkn_etr = $request->getVar('mtkn_etr');

echo view('templates/meheader01');

?>

<main id="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?=site_url();?>">Home</a></li>
                <li class="breadcrumb-item active">Item - Materials Master Data</li>
            </ol>
            </nav>
    </div><!-- End Page Title -->

    <div class="row mb-4">
        <div class="col-lg-12 col-md-12 mb-md-0 mb-4">
            <div class="card">
                <ul class="nav nav-tabs nav-tabs-bordered" id="myTabArticle" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="artclist-tab" data-bs-toggle="tab" data-bs-target="#artclist" type="button" role="tab" aria-controls="artclist" aria-selected="true">Item/Materials Records</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="artprofile-tab" data-bs-toggle="tab" data-bs-target="#artcprofile" type="button" role="tab" aria-controls="artcprofile" aria-selected="false">Item/Materials Profile</button>
                    </li>
					<li class="nav-item" role="presentation">
						<button class="nav-link" id="artm-importdata-tmpl-tab" data-bs-toggle="tab" data-bs-target="#artm-importdata-tmpl" type="button" role="tab" aria-controls="artm-importdata-tmpl" aria-selected="false">Import Data from Template</button>
					</li>
                </ul>
                <div class="tab-content" id="myTabArticleContent">
                    <div class="tab-pane fade show active" id="artclist" role="tabpanel" aria-labelledby="artclist-tab">
                    <?php
                        $data = $mymdarticle->view_recs(1,20);
                        echo view('md/md-article-recs',$data);
                    ?>
                    </div>
                    <div class="tab-pane fade" id="artcprofile" role="tabpanel" aria-labelledby="artprofile-tab">...</div>
					<div class="tab-pane fade" id="artm-importdata-tmpl" role="tabpanel" aria-labelledby="artm-importdata-tmpl-tab">---</div>
                </div>
            </div>
        </div>
    </div>

    <?php
    echo $mylibzsys->memypreloader01('mepreloaderme');
    ?>

</div>  <!-- end main -->
<?php
echo view('templates/mefooter01');
?>
<script src="<?=base_url('assets/js/mymd-article.js');?>"></script>
<script type="text/javascript"> 
    __mysys_md_artm.mywg_art_profile_load('<?=$mtkn_etr;?>');
    __mysys_md_artm.mywg_artm_import_data();
	
<?php
if($maction == 'A_REC' || !empty($mtkn_etr)) { 
?>
set_artcprofile();
<?php
}
?>

</script>
