<div class="login-box">
    <div class="logo">
        <div class="text-center" style="margin-bottom: 20px;">
            <a href="<?= base_url(); ?>"><img src="<?= base_url("assets/img/logo_soraya2.png"); ?>" style="width: 120px;"></a>
        </div>
        <small style="color: #555;">Soraya Bedsheet - Pabrik Soraya Bedsheet</small>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="body">
                    <?php $this->load->view('layouts/_alert'); ?>
                    <form id="formCheckMitra" action="#!" method="POST">
                        <div class="msg">Isikan ID Mitra Anda Pada Form Di bawah ini</div>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">person</i>
                            </span>
                            <div class="form-line">
                                <input type="text" class="form-control" name="id_mitra" id="id_check_mitra" placeholder="ID Mitra" required autofocus autocomplete="off">
                            </div>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons" style="margin-top: -10px;">date_range</i>
                            </span>
                            <div class="input-daterange input-group" id="bs_datepicker_range_container">
                                <div class="form-line">
                                    <input type="text" class="form-control" placeholder="Tgl Awal..." name="fromDate" id="from_date" value="" autocomplete="off">
                                </div>
                                <span class="input-group-addon">s/d</span>
                                <div class="form-line">
                                    <input type="text" class="form-control" placeholder="Tgl Akhir..." name="toDate" id="to_date" value="" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="" style="float: right; margin-right: 20px;">
                                <button class="btn btn-block bg-deep-orange waves-effect" type="submit">KIRIM</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>
    <div class="check-mitra-result" style="display: none;">
        <div class="row">
            <div class="col-md-12">
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
    </div>
    <div class="check-mitra-chart" style="display: none;">
        <div class="row">
            <div class="col-md-5">
                <div class="card">
                    <div class="header">
                        <h2 style="text-transform: uppercase;">
                            Performa Mitra
                        </h2>
                    </div>
                    <div class="body">
                        <div class="row clearfix">
                            <div class="col-xs-12">
                                <div id="mitra_chart">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="card">
                    <div class="header">
                        <h2 style="text-transform: uppercase;">
                            Progress mitra
                        </h2>
                    </div>
                    <div class="body">
                        <?php $this->load->view('layouts/_alert'); ?>
                        <?php //$this->load->view('pages/mitra/table'); 
                        ?>
                        <div class="result-check-mitra">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>