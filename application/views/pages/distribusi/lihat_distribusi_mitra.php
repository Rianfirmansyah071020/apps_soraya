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
                        <form action="<?= base_url("distribusi/get_lihat_distribusi") ?>" method="POST" id="form_lihat_distribusi_mitra">
                            <div class="row clearfix">
                                <div class="col-xs-12">
                                    <h2 class="card-inside-title">Pilih Mitra</h2>
                                    <select class="form-control show-tick" data-live-search="true" name="id_mitra" id="lihat_distribusi_select_mitra">
                                        <option value=""></option>
                                        <?php foreach ($mitra as $row) : ?>
                                            <option value="<?= $row->id; ?>"><?= $row->id; ?>&nbsp;-&nbsp;<?= $row->nama; ?></option>
                                        <?php endforeach ?>
                                    </select>
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

                                        <!-- <input type="hidden" value="" id="tahun"> -->
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <button type="submit" class="btn btn-primary btn-lg waves-effect" id="btnLihatDistribusiMitra" style="margin-top: 50px;">SUBMIT <img src="<?= base_url("assets/img/load.gif") ?>" alt="load-icon" style="width: 18px;" id="loadIcon"></button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="result-space">

        </div>







    </div>
</section>