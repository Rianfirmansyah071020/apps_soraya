<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2 style="text-transform: uppercase;">
                            <?= $title_detail; ?>
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
                        <form action="#" method="POST" id="formFilterStore">
                            <div class="row">
                                <div class="col-lg-4">
                                    <h2 class="card-inside-title">Bulan</h2>
                                    <select class="form-control show-tick" data-live-search="true" id="filter_by_month">
                                        <option value=""></option>
                                        <option value="01">Januari</option>
                                        <option value="02">Februari</option>
                                        <option value="03">Maret</option>
                                        <option value="04">April</option>
                                        <option value="05">Mei</option>
                                        <option value="06">Juni</option>
                                        <option value="07">Juli</option>
                                        <option value="08">Agustus</option>
                                        <option value="09">September</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">November</option>
                                        <option value="12">Desember</option>
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <h2 class="card-inside-title">Tahun</h2>
                                    <select class="form-control show-tick" data-live-search="true" id="filter_by_year">
                                        <option value=""></option>
                                        <?php for ($i = 2020; $i <= 2100; $i++) :  ?>
                                            <option value="<?= $i; ?>"><?= $i; ?></option>
                                        <?php endfor ?>

                                    </select>
                                </div>
                                <button type="submit" class="btn btn-info btn-filter" style="margin-top: 20px;">Filter <img src="<?= base_url("assets/img/load.gif") ?>" alt="load-icon" style="width: 18px;" id="loadIcon"></button>
                            </div>
                        </form>
                        <?php $this->load->view('layouts/_alert'); ?>
                        <div class="data-progress">
                            <?php $this->load->view('pages/store/table'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="wadah-modal"></div>
</section>