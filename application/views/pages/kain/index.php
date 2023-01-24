<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2 style="text-transform: uppercase;">
                            <?= $title_detail; ?>
                        </h2>
                        <a href="<?= base_url("kain/add"); ?>" class="btn btn-primary waves-effect" style="margin-top: 15px;" id="btnAddKain"><i class="material-icons">playlist_add</i>&nbsp;Tambah Kain</a>
                        <a href="#>" class="btn btn-success waves-effect" style="margin-top: 15px;" id="btnImportExcel"><i class="material-icons">description</i>&nbsp;Import Data dengan Excel</a>
                        <a href="#" class="btn btn-warning waves-effect" style="margin-top: 15px;" id="btnAddStock"><i class="material-icons">add_box</i>&nbsp;Tambah Stok</a>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="javascript:void(0);">Action</a></li>
                                    <li><a href="javascript:void(0);">Another action</a></li>
                                    <li><a href="javascript:void(0);">Something else here</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <?php $this->load->view('layouts/_alert'); ?>
                        <?php $this->load->view('pages/kain/table'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="wadah-modal"></div>
</section>