<section class="content">
    <div class="container-fluid">
        
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2 style="text-transform: uppercase;">
                            <?= $title_detail; ?>
                        </h2>
                        <a href="<?= base_url("bantal/add"); ?>" class="btn btn-primary waves-effect" style="margin-top: 15px;" id="btnAddBantal"><i class="material-icons">playlist_add</i>&nbsp;Tambah Jenis Bantal</a>


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
                        <?php $this->load->view('pages/bantal/table'); ?>

                    </div>
                </div>
            </div>
        </div>



    </div>

    <div class="wadah-modal"></div>
</section>