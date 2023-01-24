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
                        <form action="<?= base_url("report/requestDistStore") ?>" method="POST" id="form_report_dist_store">
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <h2 class="card-inside-title" style="margin-top: 20px;">Tanggal</h2>
                                    <div class="input-daterange input-group" id="bs_datepicker_range_container">
                                        <div class="form-line">
                                            <input type="text" class="form-control" placeholder="Date start..." name="fromDateDistStore" id="from_date_dist_store" value="" autocomplete="off">
                                        </div>
                                        <span class="input-group-addon">s/d</span>
                                        <div class="form-line">
                                            <input type="text" class="form-control" placeholder="Date end..." name="toDateDistStore" id="to_date_dist_store" value="" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <button type="submit" class="btn btn-primary btn-lg waves-effect" id="btnDistStoreReport" style="margin-top: 50px;">SUBMIT <img src="<?= base_url("assets/img/load.gif") ?>" alt="load-icon" style="width: 18px;" id="loadIcon"></button>
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
                            Result
                        </h2>
                    </div>
                    <div class="body">
                        <div class="result-data-dist-store">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="wadah-modal">
    </div>
</section>