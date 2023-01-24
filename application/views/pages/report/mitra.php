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
                        <form action="<?= base_url("report/requestMitraReport") ?>" method="POST" id="form_report_mitra">
                            <div class="row clearfix">
                                <div class="col-xs-12">
                                    <h2 class="card-inside-title">Pilih Mitra</h2>
                                    <div class="form-select"></div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <h2 class="card-inside-title" style="margin-top: 20px;">Tanggal</h2>
                                    <div class="input-daterange input-group" id="bs_datepicker_range_container">
                                        <div class="form-line">
                                            <input type="text" class="form-control" placeholder="Date start..." name="fromDate" id="from_date" value="" autocomplete="off">
                                        </div>
                                        <span class="input-group-addon">s/d</span>
                                        <div class="form-line">
                                            <input type="text" class="form-control" placeholder="Date end..." name="toDate" id="to_date" value="" autocomplete="off">
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
                            DATA MITRA
                        </h2>
                    </div>
                    <div class="body">
                        <div class="result-data-mitra">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-7 col-md-7 ">
                <div class="card">
                    <div class="header">
                        <h2 style="text-transform: uppercase;">
                            Progress mitra
                        </h2>
                    </div>
                    <div class="body">
                        <p>Result :</p>
                        <?php $this->load->view('layouts/_alert'); ?>
                        <?php //$this->load->view('pages/mitra/table'); 
                        ?>
                        <div class="result-report-mitra">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-5 ">
                <div class="card">
                    <div class="header">
                        <h2 style="text-transform: uppercase;">
                            Performa Mitra
                        </h2>
                    </div>
                    <div class="body">
                        <div class="row clearfix">
                            <div class="col-xs-12">
                                <div id="chart_place">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>