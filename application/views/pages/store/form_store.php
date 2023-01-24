<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h1><?= $id; ?></h1>
                        <h2>
                            TAMBAH STORE KERJA MITRA
                            <small>Isi form di bawah ini, untuk menambahkan store pekerjaan mitra.</small>
                        </h2>
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
                        <input type="hidden" value="" id="countDist">
                        <button class="btn btn-warning waves-effect" id="tambahFormStore">Tambah Form</button>
                        <?= form_open_multipart('store/insert_store/' . $id, ['method' => 'POST']); ?>
                        <?= isset($id) ? '<input type="hidden" name="id" value="' . $id . '" id="idProgress">' : ''; ?>
                        <div class="row clearfix">
                            <div class="form-baru-store">
                            </div>
                            <div class="col-sm-12">
                                <button class="btn btn-primary btn-lg waves-effect" style="float: right;" type="submit">SUBMIT</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Input -->


    </div>
</section>