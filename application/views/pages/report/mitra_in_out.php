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
                        <form action="<?= base_url("report/requestMitraInOut") ?>" method="POST" id="form_report_mitra_in_out">
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <h2 class="card-inside-title" style="margin-top: 20px;">Tanggal</h2>
                                    <div class="input-daterange input-group" id="bs_datepicker_range_container">
                                        <div class="form-line">
                                            <input type="text" class="form-control from_date" placeholder="Date start..." name="fromDate" id="from_date" value="" autocomplete="off">
                                        </div>
                                        <span class="input-group-addon">s/d</span>
                                        <div class="form-line">
                                            <input type="text" class="form-control to_date" placeholder="Date end..." name="toDate" id="to_date" value="" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <button type="submit" class="btn btn-primary btn-lg waves-effect" id="btnMitraReport" style="margin-top: 50px;">SUBMIT <img src="<?= base_url("assets/img/load.gif") ?>" alt="load-icon" style="width: 18px;" id="loadIcon"></button>
                                </div>
                            </div>
                        </form>
                        <form action="<?= base_url("report/exportToExcelMitraInOut") ?>" method="POST" id="form_export_to_excel_in_out">
                            <input type="hidden" name="fromDate" id="from_date_hidden" value="">
                            <input type="hidden" name="toDate" id="to_date_hidden" value="">
                            <button type="submit" class="btn btn-success" id="btnExportExcelInOut"><i class="material-icons">description</i>&nbsp;Export To Excel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="result-data-mitra-in-out">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2 style="text-transform: uppercase;">
                                DATA MITRA IN
                            </h2>
                        </div>
                        <div class="body">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2 style="text-transform: uppercase;">
                                DATA MITRA OUT
                            </h2>
                        </div>
                        <div class="body">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>