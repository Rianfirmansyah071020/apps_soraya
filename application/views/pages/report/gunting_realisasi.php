<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2 style="text-transform: uppercase;">
                            <?= $title_detail; ?>
                        </h2>
                    </div>
                    <div class="body">
                        <form action="<?= base_url("report/requestGuntingRealisasiReport") ?>" method="POST" id="form_report_gunting_realisasi">
                            <div class="row clearfix">
                                <div class="col-xs-12">
                                    <h2 class="card-inside-title">Pilih Mitra</h2>

                                    <div class="form-select"></div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <h2 class="card-inside-title" style="margin-top: 20px;">Tanggal</h2>
                                    <div class="input-daterange input-group" id="bs_datepicker_range_container">
                                        <div class="form-line">
                                            <input type="text" class="form-control" placeholder="Date start..." name="fromDateGuntingRealisasi" id="from_date_gunting_realisasi" value="" autocomplete="off">
                                        </div>
                                        <span class="input-group-addon">s/d</span>
                                        <div class="form-line">
                                            <input type="text" class="form-control" placeholder="Date end..." name="toDateGuntingRealisasi" id="to_date_gunting_realisasi" value="" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <button type="submit" class="btn btn-primary btn-lg waves-effect" id="btnMitraReport" style="margin-top: 50px;">SUBMIT <img src="<?= base_url("assets/img/load.gif") ?>" alt="load-icon" style="width: 18px;" id="loadIcon"></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2 style="text-transform: uppercase;">
                            RESULT
                        </h2>
                    </div>
                    <div class="body">
                        <div class="result-laporan-gunting-realisasi">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>