<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>DASHBOARD</h2>
        </div>

        <!-- Widgets -->
        <div class="row clearfix">
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="info-box bg-pink hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">web_asset</i>
                    </div>
                    <div class="content">
                        <div class="text" style="text-transform: uppercase;">Proses&nbsp;<strong>(<?= date("M"); ?>)</strong></div>
                        <div class="number count-to" data-from="0" data-to="<?= $countProgress; ?>" data-speed="500" data-fresh-interval="10"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="info-box bg-cyan hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">local_shipping</i>
                    </div>
                    <div class="content" style="text-transform: uppercase;">
                        <div class="text">Total Distribusi</div>
                        <div style="display: flex;">
                            <div class="number count-to" data-from="0" data-to="<?= array_sum(array_column($countDist, 'jumlah_set')); ?>" data-speed="500" data-fresh-interval="10"></div>
                            <span style="margin-left: 5px; margin-top: 5px;">Set</span>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="info-box bg-light-green hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">done_all</i>
                    </div>
                    <div class="content" style="text-transform: uppercase;">
                        <div class="text">Total Store</div>
                        <div style="display: flex;">
                            <div class="number count-to" data-from="0" data-to="<?= array_sum(array_column($countStore, 'jumlah_store')); ?>" data-speed="500" data-fresh-interval="10"></div>
                            <span style="margin-left: 5px; margin-top: 5px;">Set</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="info-box bg-orange hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">person_add</i>
                    </div>
                    <div class="content" style="text-transform: uppercase;">
                        <div class="text">Mitra</div>
                        <div class="number count-to" data-from="0" data-to="<?= $countMitra; ?>" data-speed="500" data-fresh-interval="10"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <!-- Line Chart -->
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>PROGRESS STORE & DISTRIBUSI MITRA (<?= date("Y"); ?>)</h2>
                    </div>
                    <div class="body" id="dashboard_chart_place">

                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2 style="text-transform: uppercase;">GRAFIK PROGRESS (<?= date("M"); ?>) </h2>

                    </div>
                    <div class="body" id="progress_chart_place">
                    </div>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <div class="card">
                    <div class="header">
                        <h2>GRAFIK MITRA BERDASARKAN RENTANG DURASI KERJA</h2>
                    </div>
                    <div class="body" id="durasi_kerja_place">
                    </div>
                </div>
            </div>
            <!-- #END# Task Info -->

            <!-- Task Info -->
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <div class="card">
                    <div class="header">
                        <h2>GRAFIK MITRA BERDASARKAN RENTANG USIA</h2>

                    </div>
                    <div class="body" id="usia_place">

                    </div>
                </div>
            </div>
            <!-- #END# Task Info -->

        </div>
    </div>
</section>