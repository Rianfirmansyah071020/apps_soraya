<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2 style="text-transform: uppercase;">
                            <?= $title_detail; ?>
                        </h2>
                        <a href="<?= base_url("user/add"); ?>" class="btn btn-primary waves-effect" style="margin-top: 15px;" id="btnAddMitra"><i class="material-icons">person_add</i>&nbsp;Tambah User</a>
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
                        <form action="<?= base_url("user/multipleDel"); ?>" method="POST" id="form-multiple=del">
                            <button class="btn btn-danger waves-effect" style="margin-top: 15px; margin-bottom: 20px;" id="btnMulDel" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i class="material-icons">delete</i>&nbsp;Hapus Data</button>
                            <?php $this->load->view('layouts/_alert'); ?>
                            <?php $this->load->view('pages/user/table'); ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>