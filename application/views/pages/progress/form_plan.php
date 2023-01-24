<section class="content">
    <div class="container-fluid">
        <!-- Input -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h1><?= $content->id; ?></h1>
                        <h2>
                            TAMBAH DATA PERENCANAAN BARU
                            <small>Isi form di bawah ini, untuk menambahkan perencanaan baru.</small>
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
                        <button class="btn btn-warning waves-effect" id="tambahForm">Tambah Form</button>
                        <?= form_open_multipart('progress/insert_plan', ['method' => 'POST']); ?>
                        <br>
                        <h4 class="card-inside-title">Penggunting</h4>
                        <div class="penggunting">
                        </div>
                        <?= isset($content->id) ? '<input type="hidden" name="id" value="' . $content->id . '" id="idProgress">' : ''; ?>
                        <div class="row clearfix">
                            <div class="form-baru">
                            </div>
                            <div class="col-sm-12">
                                <button class="btn btn-primary btn-lg waves-effect" style="float: right;" type="submit">SUBMIT</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>