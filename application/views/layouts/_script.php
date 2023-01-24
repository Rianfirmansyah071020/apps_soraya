<!-- Jquery Core Js -->
<script src="<?= base_url('assets'); ?>/plugins/jquery/jquery.min.js"></script>
<!-- sweetalert2 -->
<script src="<?= base_url('assets/css/sweetalert2/sweetalert2.min.js') ?>"></script>
<script src="<?= base_url('assets/css/sweetalert2/sweetalert2.all.min.js') ?>"></script>
<!-- Bootstrap Core Js -->
<script src="<?= base_url('assets'); ?>/plugins/bootstrap/js/bootstrap.js"></script>
<!-- Select Plugin Js -->
<script src="<?= base_url('assets'); ?>/plugins/bootstrap-select/js/bootstrap-select.js"></script>
<!-- Slimscroll Plugin Js -->
<script src="<?= base_url('assets'); ?>/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
<!-- Waves Effect Plugin Js -->
<script src="<?= base_url('assets'); ?>/plugins/node-waves/waves.js"></script>
<!-- charjs -->
<script src="<?= base_url('assets'); ?>/plugins/chartjs/Chart.bundle.js"></script>
<script src="<?= base_url('assets'); ?>/plugins/jquery-countto/jquery.countTo.js"></script>
<!-- Sparkline Chart Plugin Js -->
<!-- <script src="<?= base_url('assets'); ?>/plugins/jquery-sparkline/jquery.sparkline.js"></script> -->
<!-- Autosize Plugin Js -->
<script src="<?= base_url('assets'); ?>/plugins/autosize/autosize.js"></script>
<!-- Moment Plugin Js -->
<script src="<?= base_url('assets'); ?>/plugins/momentjs/moment.js"></script>
<!-- Bootstrap Material Datetime Picker Plugin Js -->
<script src="<?= base_url('assets'); ?>/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
<!-- Bootstrap Datepicker Plugin Js -->
<script src="<?= base_url('assets'); ?>/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<!-- Jquery DataTable Plugin Js -->
<script src="<?= base_url('assets'); ?>/plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="<?= base_url('assets'); ?>/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<script src="<?= base_url('assets'); ?>/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
<script src="<?= base_url('assets'); ?>/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
<script src="<?= base_url('assets'); ?>/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
<script src="<?= base_url('assets'); ?>/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
<script src="<?= base_url('assets'); ?>/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
<script src="<?= base_url('assets'); ?>/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
<script src="<?= base_url('assets'); ?>/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

<!-- Dropzone Plugin Js -->
<script src="<?= base_url('assets'); ?>/plugins/dropzone/dropzone.js"></script>

<!-- Custom Js -->
<script src="<?= base_url('assets'); ?>/js/admin.js"></script>

<!-- <script src="<?= base_url('assets'); ?>/js/pages/charts/chartjs.js"></script> -->

<script src="<?= base_url('assets'); ?>/js/pages/forms/basic-form-elements.js"></script>

<script src="<?= base_url('assets'); ?>/js/pages/tables/jquery-datatable.js"></script>

<script src="<?= base_url('assets'); ?>/js/tata.js"></script>

<script src="<?= base_url('assets'); ?>/js/topbar.js"></script>

<!-- Demo Js -->
<!-- <script src="<?= base_url('assets'); ?>/js/demo.js"></script> -->

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.js" integrity="sha512-vUJTqeDCu0MKkOhuI83/MEX5HSNPW+Lw46BA775bAWIp1Zwgz3qggia/t2EnSGB9GoS2Ln6npDmbJTdNhHy1Yw==" crossorigin="anonymous"></script>
<script>
    let title_page2 = "<?= isset($title) ? $title : "" ?>";

    if (title_page2 == 'Tambah Pengguna') {
        Dropzone.autoDiscover = false;
        var myDropzone = new Dropzone("#my-dropzone", {
            url: "<?php echo base_url("user/uploadImage/") ?>",
            acceptedFiles: "image/*",
            maxFilesize: 2, // MB
            method: "post",
            maxFiles: 1,
            init: function() {
                this.on("success", function(file, response) {
                    var obj = jQuery.parseJSON(response);
                    $('#image_admin').val(obj.file_name);
                })
            }
        });
    }

    $('.count-to').countTo();

    topbar.config({
        barColors: {
            '0': 'rgba(255, 164, 38, .7)'
        },
        barThickness: 4
    });
</script>

<?php  ?>
<script>
    $(document).ready(function() {
        var title_page_new = "<?= isset($title) ? $title : "" ?>";
        $('.myTable').DataTable({
            "order": [
                [2, "desc"]
            ], //or asc 
            "columnDefs": [{
                "targets": 2,
                "type": "date-eu"
            }],
            stateSave: true,
            stateDuration: 300
        });

        $('.myDatTab').DataTable();

        function getChartJs(type, nilai) {
            var config = null;
            if (type === 'line') {
                config = {
                    type: 'line',
                    data: {
                        labels: [
                            "Jan",
                            "Feb",
                            "Mar",
                            "Apr",
                            "Mei",
                            "Jun",
                            "Jul",
                            "Aug",
                            "Sep",
                            "Okt",
                            "Nov",
                            "Dec"
                        ],
                        datasets: [{
                            label: "Selesai",
                            data: [
                                nilai.selesai1[0].jumlah,
                                nilai.selesai2[0].jumlah,
                                nilai.selesai3[0].jumlah,
                                nilai.selesai4[0].jumlah,
                                nilai.selesai5[0].jumlah,
                                nilai.selesai6[0].jumlah,
                                nilai.selesai7[0].jumlah,
                                nilai.selesai8[0].jumlah,
                                nilai.selesai9[0].jumlah,
                                nilai.selesai10[0].jumlah,
                                nilai.selesai11[0].jumlah,
                                nilai.selesai12[0].jumlah
                            ],
                            borderColor: 'rgba(0, 188, 212, 0.75)',
                            backgroundColor: 'rgba(0, 188, 212, 0.3)',
                            pointBorderColor: 'rgba(0, 188, 212, 0)',
                            pointBackgroundColor: 'rgba(0, 188, 212, 0.9)',
                            pointBorderWidth: 1
                        }, {
                            label: "Proses",
                            data: [
                                nilai.proses1[0].jumlah,
                                nilai.proses2[0].jumlah,
                                nilai.proses3[0].jumlah,
                                nilai.proses4[0].jumlah,
                                nilai.proses5[0].jumlah,
                                nilai.proses6[0].jumlah,
                                nilai.proses7[0].jumlah,
                                nilai.proses8[0].jumlah,
                                nilai.proses9[0].jumlah,
                                nilai.proses10[0].jumlah,
                                nilai.proses11[0].jumlah,
                                nilai.proses12[0].jumlah
                            ],
                            borderColor: 'rgba(233, 30, 99, 0.75)',
                            backgroundColor: 'rgba(233, 30, 99, 0.3)',
                            pointBorderColor: 'rgba(233, 30, 99, 0)',
                            pointBackgroundColor: 'rgba(233, 30, 99, 0.9)',
                            pointBorderWidth: 1
                        }, ]
                    },
                    options: {
                        responsive: true,
                        legend: false
                    }
                }
            } else if (type === 'bar') {
                config = {
                    type: 'bar',
                    data: {
                        labels: [
                            "Jan",
                            "Feb",
                            "Mar",
                            "Apr",
                            "Mei",
                            "Jun",
                            "Jul",
                            "Aug",
                            "Sep",
                            "Okt",
                            "Nov",
                            "Dec"
                        ],
                        datasets: [{
                            label: "Selesai",
                            data: [
                                nilai.selesai1[0].jumlah,
                                nilai.selesai2[0].jumlah,
                                nilai.selesai3[0].jumlah,
                                nilai.selesai4[0].jumlah,
                                nilai.selesai5[0].jumlah,
                                nilai.selesai6[0].jumlah,
                                nilai.selesai7[0].jumlah,
                                nilai.selesai8[0].jumlah,
                                nilai.selesai9[0].jumlah,
                                nilai.selesai10[0].jumlah,
                                nilai.selesai11[0].jumlah,
                                nilai.selesai12[0].jumlah
                            ],
                            backgroundColor: 'rgba(0, 188, 212, 0.8)'
                        }, {
                            label: "Proses",
                            data: [
                                nilai.proses1[0].jumlah,
                                nilai.proses2[0].jumlah,
                                nilai.proses3[0].jumlah,
                                nilai.proses4[0].jumlah,
                                nilai.proses5[0].jumlah,
                                nilai.proses6[0].jumlah,
                                nilai.proses7[0].jumlah,
                                nilai.proses8[0].jumlah,
                                nilai.proses9[0].jumlah,
                                nilai.proses10[0].jumlah,
                                nilai.proses11[0].jumlah,
                                nilai.proses12[0].jumlah
                            ],
                            backgroundColor: 'rgba(233, 30, 99, 0.8)'
                        }, ]
                    },
                    options: {
                        responsive: true,
                        legend: true
                    }
                }
            } else if (type === 'radar') {
                config = {
                    type: 'radar',
                    data: {
                        labels: ["January", "February", "March", "April", "May", "June", "July"],
                        datasets: [{
                            label: "My First dataset",
                            data: [65, 25, 90, 81, 56, 55, 40],
                            borderColor: 'rgba(0, 188, 212, 0.8)',
                            backgroundColor: 'rgba(0, 188, 212, 0.5)',
                            pointBorderColor: 'rgba(0, 188, 212, 0)',
                            pointBackgroundColor: 'rgba(0, 188, 212, 0.8)',
                            pointBorderWidth: 1
                        }, {
                            label: "My Second dataset",
                            data: [72, 48, 40, 19, 96, 27, 100],
                            borderColor: 'rgba(233, 30, 99, 0.8)',
                            backgroundColor: 'rgba(233, 30, 99, 0.5)',
                            pointBorderColor: 'rgba(233, 30, 99, 0)',
                            pointBackgroundColor: 'rgba(233, 30, 99, 0.8)',
                            pointBorderWidth: 1
                        }, ]
                    },
                    options: {
                        responsive: true,
                        legend: false
                    }
                }
            } else if (type === 'pie') {
                config = {
                    type: 'pie',
                    data: {
                        datasets: [{
                            data: [225, 50, 100, 40],
                            backgroundColor: [
                                "rgb(233, 30, 99)",
                                "rgb(255, 193, 7)",
                                "rgb(0, 188, 212)",
                                "rgb(139, 195, 74)"
                            ],
                        }],
                        labels: [
                            "Pink",
                            "Amber",
                            "Cyan",
                            "Light Green"
                        ]
                    },
                    options: {
                        responsive: true,
                        legend: false
                    }
                }
            }
            return config;
        }

        $('#loadIcon').hide();

        $('#loadIcon2').hide();

        let id_progress = $('#id_progress').val();

        let id_progress2 = $('#idProgress').val();

        $('#noOd').val(id_progress);

        var i = 0;

        $(document).on('click', '#tambahForm', function() {
            loadFormPlan();
            i++;
            //console.log(i);
        });

        $('#select2222').select2();

        if (title_page_new == 'Tambah Pembagian Kerja') {
            loadForm();
            $(document).on('click', '#tambahFormDistribusi', function() {
                loadForm();
            });
        }

        if (title_page_new == 'Laporan Mitra' || title_page_new == 'Laporan Gunting & Realisasi') {
            loadSelect2ReportMitra();
        }

        if (title_page_new == 'Tambah Perencanaan') {
            loadFormPlan();
            loadPenggunting();
        }

        if (title_page_new == 'Form Store Pekerjaan') {
            loadFormStore();
            let counterClick = 0;
            $(document).on('click', '#tambahFormStore', function() {
                let jumlahDist = $('#countDist').val();
                counterClick++;
                console.log(counterClick);

                if (jumlahDist != '' && counterClick < jumlahDist) {
                    loadFormStore();
                } else {
                    tata.error('Maaf', 'Tidak bisa menambah form lagi.', {
                        position: 'tm'
                    });
                }
            });
        }

        function loadFormStore() {
            $.ajax({
                url: "<?php echo base_url("store/showForm/") ?>" + id_progress2,
                method: "POST",
                success: function(response) {
                    var data = JSON.parse(response)
                    $('.form-baru-store').append(data.form);
                    $('#countDist').val(data.count);
                    $('.select2').select2({
                        placeholder: "- Select -",
                        allowClear: true
                    });
                }
            });
        }

        function loadForm() {
            $.ajax({
                url: "<?php echo base_url("distribusi/showForm/") ?>" + id_progress2,
                method: "POST",
                success: function(response) {
                    $('.form-baru-distribusi').append(response);
                    $('.select2').select2({
                        placeholder: "- Select -",
                        allowClear: true
                    });
                }
            });
        }

        function loadFormPlan() {
            $.ajax({
                url: "<?php echo base_url("progress/showFormPlan/") ?>" + id_progress2,
                method: "POST",
                success: function(response) {
                    //console.log(response);
                    $('.form-baru').append(response);
                    $('.select2').select2({
                        placeholder: "- Select -",
                        allowClear: true
                    });
                }
            });
        }

        function loadPenggunting() {
            $.ajax({
                url: "<?php echo base_url("progress/showPenggunting/") ?>" + id_progress2,
                method: "POST",
                success: function(response) {
                    $('.penggunting').html(response);
                    $('.select2').select2({
                        placeholder: "- Select -",
                        allowClear: true
                    });
                }
            })
        }

        function loadSelect2ReportMitra() {
            $.ajax({
                url: "<?php echo base_url("report/showSelect") ?>",
                method: "POST",
                success: function(response) {
                    $('.form-select').html(response);
                    $('.select2').select2({
                        placeholder: "- Select -",
                        allowClear: true,
                    });
                }
            });
        }

        $(document).on('submit', '#form_report_mitra', function(e) {
            e.preventDefault();
            var fromDate = $('#from_date').val();
            var toDate = $('#to_date').val();
            var id_mitra = $('#id_mitra').val();
            $.ajax({
                method: "POST",
                url: "<?php echo base_url("report/requestMitraReport") ?>",
                data: {
                    id_mitra: id_mitra,
                    fromDate: fromDate,
                    toDate: toDate
                },
                beforeSend: function() {
                    $('#loadIcon').show();
                },
                success: function(response) {
                    $('.result-report-mitra').html(response);
                    $('#loadIcon').hide();
                    // new Chart(document.getElementById("bar_chart").getContext("2d"), getChartJs('bar'));
                }
            });
        });

        $(document).on('submit', '#form_report_mitra', function(e) {
            var id_mitra = $('#id_mitra').val();
            $.ajax({
                method: "POST",
                url: "<?php echo base_url("report/requestMitraChart") ?>",
                data: {
                    id_mitra: id_mitra,
                },
                success: function(response) {
                    var data = JSON.parse(response);
                    var i;

                    console.log(data.selesai10);
                    //data.selesai11.length
                    //  if (data.bln11[0])
                    $('.chartjs-hidden-iframe').remove();
                    $('#bar_chart').remove();
                    $('#chart_place').html('<canvas id="bar_chart"></canvas>');
                    new Chart(document.getElementById("bar_chart").getContext("2d"), getChartJs('line', data));
                }
            });
        });

        $(document).on('submit', '#form_report_mitra', function(e) {
            var id_mitra = $('#id_mitra').val();
            $.ajax({
                method: "POST",
                url: "<?php echo base_url("report/requestDataMitra") ?>",
                data: {
                    id_mitra: id_mitra,
                },
                beforeSend: function() {
                    $('#loadIcon').show();
                },
                success: function(response) {
                    $('.result-data-mitra').html(response);
                    $('#loadIcon').hide();
                }
            });
        });

        $(document).on('submit', '#form_report_dist_store', function(e) {
            e.preventDefault();
            var fromDateDistStore = $('#from_date_dist_store').val();
            var toDateDistStore = $('#to_date_dist_store').val();
            $.ajax({
                method: "POST",
                url: "<?php echo base_url('report/requestDistStore') ?>",
                data: {
                    fromDateDistStore: fromDateDistStore,
                    toDateDistStore: toDateDistStore
                },
                beforeSend: function() {
                    $('#loadIcon').show();
                },
                success: function(response) {
                    $('.result-data-dist-store').html(response);
                    $('.myDatTab').DataTable();
                    $('#loadIcon').hide();
                }
            });
        });

        $(document).on('submit', '#formCheckMitra', function(e) {
            e.preventDefault();
            var id_mitra = $('#id_check_mitra').val();
            $.ajax({
                method: "POST",
                url: "<?php echo base_url("mymitra/requestDataMitra") ?>",
                data: {
                    id_mitra: id_mitra,
                },
                beforeSend: function() {
                    $('#loadIcon').show();
                },
                success: function(response) {
                    $('.result-data-mitra').html(response);
                    $('#loadIcon').hide();
                    $('.check-mitra-result').css('display', 'block');
                }
            });
        });

        $(document).on('submit', '#formCheckMitra', function(e) {
            var id_mitra = $('#id_check_mitra').val();
            $.ajax({
                method: "POST",
                url: "<?php echo base_url("mymitra/requestMitraChart") ?>",
                data: {
                    id_mitra: id_mitra,
                },
                success: function(response) {
                    var data = JSON.parse(response);
                    var i;
                    console.log(data.selesai10);
                    //data.selesai11.length
                    //  if (data.bln11[0])
                    //$('.chartjs-hidden-iframe').remove();
                    $('#bar_chart').remove();
                    $('#mitra_chart').html('<canvas id="bar_chart"></canvas>');
                    $('.check-mitra-chart').css('display', 'block');
                    new Chart(document.getElementById("bar_chart").getContext("2d"), getChartJs('line', data));
                }
            });
        });

        $(document).on('submit', '#formCheckMitra', function(e) {
            e.preventDefault();
            var fromDate = $('#from_date').val();
            var toDate = $('#to_date').val();
            var id_mitra = $('#id_check_mitra').val();
            $.ajax({
                method: "POST",
                url: "<?php echo base_url("mymitra/requestMitraReport") ?>",
                data: {
                    id_mitra: id_mitra,
                    fromDate: fromDate,
                    toDate: toDate
                },
                beforeSend: function() {
                    $('#loadIcon').show();
                },
                success: function(response) {
                    $('.result-check-mitra').html(response);
                    $('#loadIcon').hide();
                    $('.check-mitra-chart').css('display', 'block');
                    // new Chart(document.getElementById("bar_chart").getContext("2d"), getChartJs('bar'));
                }
            });
        });

        $(document).on('keyup change', '.valTglLahir', function() {
            let x = $(this).val();
            let explode = x.split("/");
            $('.tgl_lahir').addClass('focused');
            let konversiTglLahir = explode[2] + "-" + explode[0] + "-" + explode[1];
            $('#tglLahir').val(konversiTglLahir);
            // $(this).val(explode[3]+ "-" + changeMonth(explode[2]) + "-" + explode[1]);
            // //alert(changeMonth(explode[2]));
            // //0 = hari, 1 = tanggal, 2 = 
            // //alert(explode[2]);
        });

        $(document).on('keyup change', '.valTglKerja', function() {
            let x = $(this).val();
            let explode = x.split("/");
            $('.tgl_kerja').addClass('focused');
            let konversiTglKerja = explode[2] + "-" + explode[0] + "-" + explode[1];
            $('#tglKerja').val(konversiTglKerja);
        });

        // ubah format input tanggal estimasi 11/01/2022 menjadi 2022-01-11
        $(document).on('keyup change', '.valTglEstimasi', function() {
            let x = $(this).val();
            let explode = x.split("/");
            $('.tgl_estimasi').addClass('focused');
            let konversiTglEstimasi = explode[2] + "-" + explode[0] + "-" + explode[1];
            $('#tglEstimasi').val(konversiTglEstimasi);
        });

        $(document).on("click", ".view", function(e) {
            e.preventDefault();
            var id = $(this).data("id");
            $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('distribusi/detail/'); ?>" + id,
                    data: {
                        id: id
                    },
                    beforeSend: function() {
                        topbar.show();
                    },
                })
                .done(function(data) {
                    $('.wadah-modal').html(data);
                    $('#modal-detail-distribusi').modal('show');
                    topbar.hide();
                });
        });
        //hapus data dist
        $(document).on("click", "#btnHapusDistribusi", function() {
            var id = $(this).data("id");
            var id_progress = $(this).data("idprogress");
            $.ajax({
                type: "POST",
                url: "<?php echo base_url("distribusi/delete_work/"); ?>" + id,
                success: function(data) {
                    var data = JSON.parse(data)
                    if (data.status_code == 200) {
                        tata.success('Success', 'Berhasil menghapus data distribusi!');
                        loadTableDetailDist(id_progress);
                    } else {
                        tata.error('Error', 'Oops! Terjadi suatu kesalahan!');
                    }
                }
            });
        });

        $(document).on("click", ".view_store", function(e) {
            e.preventDefault();
            var id = $(this).data("id");
            $.ajax({
                    type: "GET",
                    url: "<?php echo base_url('store/detail/'); ?>" + id,
                    data: {
                        id: id
                    },
                    beforeSend: function() {
                        topbar.show();
                    }
                })
                .done(function(data) {
                    $('.wadah-modal').html(data);
                    $('#modal-detail-store').modal('show');
                    topbar.hide();
                });
        });

        function loadTableDetailDist(id) {
            $.ajax({
                method: "POST",
                url: "<?php echo base_url("distribusi/load_table_detail/") ?>" + id,
                success: function(response) {
                    $('.table-detail-dist').html(response);
                }
            });
        }

        function changeMonth(m) {
            var bln;
            switch (m) {
                case "January":
                    bln = "01";
                    break;
                case "February":
                    bln = "02";
                    break;
                case "March":
                    bln = "03";
                    break;
                case "April":
                    bln = "04";
                    break;
                case "May":
                    bln = "05";
                    break;
                case "June":
                    bln = "06";
                    break;
                case "July":
                    bln = "07";
                    break;
                case "August":
                    bln = "08";
                    break;
                case "September":
                    bln = "09";
                    break;
                case "October":
                    bln = "10";
                    break;
                case "November":
                    bln = "11";
                    break;
                case "December":
                    bln = "12";
                    break;
            }
            return bln;
        }

        let title_page = "<?= isset($title) ? $title : "" ?>"

        if (title_page == 'Dashboard') {
            loadChartDashboard();
            loadChartProgressDashboard();
            loadChartRentangKerja();
            loadChartUmurMitra();
        }

        function loadChartDashboard() {
            $.ajax({
                method: "POST",
                url: "<?php echo base_url("home/requestProgressChart") ?>",
                success: function(response) {
                    var data = JSON.parse(response);
                    //$('.chartjs-hidden-iframe').remove();
                    $('#store_chart').remove();
                    $('#dashboard_chart_place').html('<canvas id="store_chart"></canvas>');
                    new Chart(document.getElementById("store_chart").getContext("2d"), getChartDashboard('line', data));
                }
            });
        }

        function loadChartProgressDashboard() {
            $.ajax({
                method: "POST",
                url: "<?php echo base_url("home/requestCountDoneProgress") ?>",
                success: function(response) {
                    var data = JSON.parse(response);
                    //$('.chartjs-hidden-iframe').remove();
                    $('#progress_chart').remove();
                    $('#progress_chart_place').html('<canvas id="progress_chart"></canvas>');
                    new Chart(document.getElementById("progress_chart").getContext("2d"), getChartDashboard('bar', data));
                }
            });
        }

        function loadChartRentangKerja() {
            $.ajax({
                method: "POST",
                url: "<?php echo base_url("home/requestDurasiKerjaMitra") ?>",
                success: function(response) {
                    var data = JSON.parse(response);
                    //$('.chartjs-hidden-iframe').remove();
                    $('#durasi_kerja_chart').remove();
                    $('#durasi_kerja_place').html('<canvas id="durasi_kerja_chart"></canvas>');
                    new Chart(document.getElementById("durasi_kerja_chart").getContext("2d"), getChartDashboard('bar_durasi_kerja', data));
                }
            });
        }

        function loadChartUmurMitra() {
            $.ajax({
                method: "POST",
                url: "<?php echo base_url("home/requestUmurKerjaMitra") ?>",
                success: function(response) {
                    var data = JSON.parse(response);
                    //$('.chartjs-hidden-iframe').remove();
                    $('#usia_chart').remove();
                    $('#usia_place').html('<canvas id="usia_chart"></canvas>');
                    new Chart(document.getElementById("usia_chart").getContext("2d"), getChartDashboard('bar_usia', data));
                }
            });
        }
        // new Chart(document.getElementById("mitra_chart").getContext("2d"), getChartDashboard('bar_mitra'));
        // new Chart(document.getElementById("mitra_umur_chart").getContext("2d"), getChartDashboard('bar_mitra_umur'));

        function getChartDashboard(type, nilai = null) {
            var config = null;
            if (type === 'line') {
                config = {
                    type: 'line',
                    data: {
                        labels: [
                            "Jan",
                            "Feb",
                            "Mar",
                            "Apr",
                            "Mei",
                            "Jun",
                            "Jul",
                            "Aug",
                            "Sep",
                            "Okt",
                            "Nov",
                            "Dec"
                        ],
                        datasets: [{
                                label: "Selesai",
                                data: [
                                    nilai.selesai1[0].jumlah == null ? 0 : nilai.selesai1[0].jumlah,
                                    nilai.selesai2[0].jumlah == null ? 0 : nilai.selesai2[0].jumlah,
                                    nilai.selesai3[0].jumlah == null ? 0 : nilai.selesai3[0].jumlah,
                                    nilai.selesai4[0].jumlah == null ? 0 : nilai.selesai4[0].jumlah,
                                    nilai.selesai5[0].jumlah == null ? 0 : nilai.selesai5[0].jumlah,
                                    nilai.selesai6[0].jumlah == null ? 0 : nilai.selesai6[0].jumlah,
                                    nilai.selesai7[0].jumlah == null ? 0 : nilai.selesai7[0].jumlah,
                                    nilai.selesai8[0].jumlah == null ? 0 : nilai.selesai8[0].jumlah,
                                    nilai.selesai9[0].jumlah == null ? 0 : nilai.selesai9[0].jumlah,
                                    nilai.selesai10[0].jumlah == null ? 0 : nilai.selesai10[0].jumlah,
                                    nilai.selesai11[0].jumlah == null ? 0 : nilai.selesai11[0].jumlah,
                                    nilai.selesai12[0].jumlah == null ? 0 : nilai.selesai12[0].jumlah,
                                ],
                                borderColor: 'rgba(0, 188, 212, 0.75)',
                                backgroundColor: 'rgba(0, 188, 212, 0.3)',
                                pointBorderColor: 'rgba(0, 188, 212, 0)',
                                pointBackgroundColor: 'rgba(0, 188, 212, 0.9)',
                                pointBorderWidth: 1
                            }, {
                                label: "Dikerjakan",
                                data: [
                                    nilai.dikerjakan1[0].jumlah == null ? 0 : nilai.dikerjakan1[0].jumlah,
                                    nilai.dikerjakan2[0].jumlah == null ? 0 : nilai.dikerjakan2[0].jumlah,
                                    nilai.dikerjakan3[0].jumlah == null ? 0 : nilai.dikerjakan3[0].jumlah,
                                    nilai.dikerjakan4[0].jumlah == null ? 0 : nilai.dikerjakan4[0].jumlah,
                                    nilai.dikerjakan5[0].jumlah == null ? 0 : nilai.dikerjakan5[0].jumlah,
                                    nilai.dikerjakan6[0].jumlah == null ? 0 : nilai.dikerjakan6[0].jumlah,
                                    nilai.dikerjakan7[0].jumlah == null ? 0 : nilai.dikerjakan7[0].jumlah,
                                    nilai.dikerjakan8[0].jumlah == null ? 0 : nilai.dikerjakan8[0].jumlah,
                                    nilai.dikerjakan9[0].jumlah == null ? 0 : nilai.dikerjakan9[0].jumlah,
                                    nilai.dikerjakan10[0].jumlah == null ? 0 : nilai.dikerjakan10[0].jumlah,
                                    nilai.dikerjakan11[0].jumlah == null ? 0 : nilai.dikerjakan11[0].jumlah,
                                    nilai.dikerjakan12[0].jumlah == null ? 0 : nilai.dikerjakan12[0].jumlah,
                                ],
                                borderColor: 'rgba(233, 30, 99, 0.75)',
                                backgroundColor: 'rgba(233, 30, 99, 0.3)',
                                pointBorderColor: 'rgba(233, 30, 99, 0)',
                                pointBackgroundColor: 'rgba(233, 30, 99, 0.9)',
                                pointBorderWidth: 1
                            },
                            {
                                label: "Proses",
                                data: [
                                    nilai.proses1[0].jumlah == null ? 0 : nilai.proses1[0].jumlah,
                                    nilai.proses2[0].jumlah == null ? 0 : nilai.proses2[0].jumlah,
                                    nilai.proses3[0].jumlah == null ? 0 : nilai.proses3[0].jumlah,
                                    nilai.proses4[0].jumlah == null ? 0 : nilai.proses4[0].jumlah,
                                    nilai.proses5[0].jumlah == null ? 0 : nilai.proses5[0].jumlah,
                                    nilai.proses6[0].jumlah == null ? 0 : nilai.proses6[0].jumlah,
                                    nilai.proses7[0].jumlah == null ? 0 : nilai.proses7[0].jumlah,
                                    nilai.proses8[0].jumlah == null ? 0 : nilai.proses8[0].jumlah,
                                    nilai.proses9[0].jumlah == null ? 0 : nilai.proses9[0].jumlah,
                                    nilai.proses10[0].jumlah == null ? 0 : nilai.proses10[0].jumlah,
                                    nilai.proses11[0].jumlah == null ? 0 : nilai.proses11[0].jumlah,
                                    nilai.proses12[0].jumlah == null ? 0 : nilai.proses12[0].jumlah,
                                ],
                                borderColor: 'rgba(241, 238, 74, 0.75)',
                                backgroundColor: 'rgba(240, 239, 167, 0.3)',
                                pointBorderColor: 'rgba(241, 238, 74, 0)',
                                pointBackgroundColor: 'rgba(241, 238, 74, 0.9)',
                                pointBorderWidth: 1
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        legend: false
                    }
                }
            } else if (type === 'bar') {
                config = {
                    type: 'bar',
                    data: {
                        labels: [
                            "Selesai",
                            "Belum Selesai",
                            "Dikerjakan"
                        ],
                        datasets: [{
                            label: "Jumlah",
                            data: [
                                nilai.selesai,
                                nilai.belum_selesai,
                                nilai.dikerjakan
                            ],
                            backgroundColor: ['rgba(0, 188, 212, 0.6)', 'rgba(241, 238, 74, 0.6)', 'rgba(233, 30, 99, 0.6)'],
                        }]
                    },
                    options: {
                        responsive: true,
                        legend: true
                    },
                }
            } else if (type === 'radar') {
                config = {
                    type: 'radar',
                    data: {
                        labels: ["January", "February", "March", "April", "May", "June", "July"],
                        datasets: [{
                            label: "My First dataset",
                            data: [65, 25, 90, 81, 56, 55, 40],
                            borderColor: 'rgba(0, 188, 212, 0.8)',
                            backgroundColor: 'rgba(0, 188, 212, 0.5)',
                            pointBorderColor: 'rgba(0, 188, 212, 0)',
                            pointBackgroundColor: 'rgba(0, 188, 212, 0.8)',
                            pointBorderWidth: 1
                        }, {
                            label: "My Second dataset",
                            data: [72, 48, 40, 19, 96, 27, 100],
                            borderColor: 'rgba(233, 30, 99, 0.8)',
                            backgroundColor: 'rgba(233, 30, 99, 0.5)',
                            pointBorderColor: 'rgba(233, 30, 99, 0)',
                            pointBackgroundColor: 'rgba(233, 30, 99, 0.8)',
                            pointBorderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        legend: false
                    }
                }
            } else if (type === 'pie') {
                config = {
                    type: 'pie',
                    data: {
                        datasets: [{
                            data: [225, 50, 100, 40],
                            backgroundColor: [
                                "rgb(233, 30, 99)",
                                "rgb(255, 193, 7)",
                                "rgb(0, 188, 212)",
                                "rgb(139, 195, 74)"
                            ],
                        }],
                        labels: [
                            "Pink",
                            "Amber",
                            "Cyan",
                            "Light Green"
                        ]
                    },
                    options: {
                        responsive: true,
                        legend: false
                    }
                }
            } else if (type === 'bar_durasi_kerja') {
                config = {
                    type: 'bar',
                    data: {
                        labels: [
                            "Kurang dari Setahun",
                            "1 - 5 Tahun",
                            "Lebih dari 5 Tahun"
                        ],
                        datasets: [{
                            label: "Jumlah Mitra",
                            data: [
                                nilai.kurangsetahun,
                                nilai.rentang,
                                nilai.lebihdarirentang
                            ],
                            backgroundColor: ['rgba(0, 188, 212, 0.6)', 'rgba(241, 238, 74, 0.6)', 'rgba(233, 30, 99, 0.6)'],
                        }]
                    },
                    options: {
                        responsive: true,
                        legend: true
                    },
                }
            } else if (type === 'bar_usia') {
                config = {
                    type: 'bar',
                    data: {
                        labels: [
                            "17 - 29 Tahun",
                            "30 - 49 Tahun",
                            "Lebih dari 50 Tahun"
                        ],
                        datasets: [{
                            label: "Jumlah Mitra",
                            data: [
                                nilai.umur,
                                nilai.umur2,
                                nilai.umur3
                            ],
                            backgroundColor: ['rgba(0, 188, 212, 0.6)', 'rgba(241, 238, 74, 0.6)', 'rgba(233, 30, 99, 0.6)'],
                        }]
                    },
                    options: {
                        responsive: true,
                        legend: true
                    },
                }
            }
            return config;
        }

        $(document).on('click', '#btn_out', function(e) {



            e.preventDefault();

            var id = $(this).data("id");

            $.ajax({

                    type: "POST",

                    url: "<?php echo base_url('mitra/showModalToMitraOut/'); ?>" + id,

                    data: {

                        id: id

                    }



                })

                .done(function(data) {

                    $('#wadah_modal_to_mitra_out').html(data);

                    $('#modal-to-mitra-out').modal('show');

                    $('#alasan-lainnya').hide();

                    $('.show-tick').selectpicker();

                });

        });



        $(document).on('change', '#select_alasan', function() {

            var getVal = $("#select_alasan option:selected").val();



            if (getVal == "Lainnya") {

                $('#alasan-lainnya').show(500);

            } else {

                $('#alasan-lainnya').hide(500);

            }

        });



        $('mitra-select').select2();





        //filter progress gunting
        $(document).on('submit', '#formFilterProgress', function(e) {
            e.preventDefault();
            var getValMonth = $('#filter_by_month option:selected').val();
            var getValYear = $('#filter_by_year option:selected').val();
            var getValPo = $('#filter_po option:selected').val();
            $.ajax({
                type: "POST",
                url: '<?php echo base_url("progress/filter/") ?>' + getValMonth + '/' + getValYear + '/' + getValPo,
                beforeSend: function() {
                    $('#loadIcon').show();
                },
                success: function(response) {
                    $('.data-progress').html(response);
                    $('.myTable').DataTable({
                        "order": [
                            [2, "desc"]
                        ], //or asc 
                        "columnDefs": [{
                            "targets": 2,
                            "type": "date-eu"
                        }],
                    });
                    $('.myDatTab').DataTable();
                    $('#loadIcon').hide();
                }
            });
        });

        //filter progress realisasi

        $(document).on('submit', '#formFilterProgressRealisasi', function(e) {

            e.preventDefault();

            var getValMonth = $('#filter_by_month option:selected').val();

            var getValYear = $('#filter_by_year option:selected').val();



            $.ajax({

                type: "POST",

                url: '<?php echo base_url("progress/filterRealisasi/") ?>' + getValMonth + '/' + getValYear,

                beforeSend: function() {

                    //do load anim

                    $('#loadIcon').show();

                },

                success: function(response) {

                    $('.data-progress').html(response);



                    $('.myTable').DataTable({

                        "order": [

                            [2, "desc"]

                        ], //or asc 

                        "columnDefs": [{

                            "targets": 2,

                            "type": "date-eu"

                        }],

                    });





                    $('.myDatTab').DataTable();



                    $('#loadIcon').hide();

                }

            });

        });



        //filter realisasi gunting berdasarkan jenis pekerjaan

        $(document).on('submit', '#formFilterProgressRealisasiBasedOnJenisPekerjaan', function(e) {

            e.preventDefault();

            //alert('ok');



            var id_jenis_pekerjaan = $('#filter_by_jenis_pekerjaan option:selected').val();

            var month = $('#filter_by_month option:selected').val();

            var year = $('#filter_by_year option:selected').val();

            $.ajax({

                type: "POST",

                url: '<?php echo base_url("progress/filterRealisasiBasedOnJenisPekerjaan/") ?>' + id_jenis_pekerjaan,

                data: {

                    month: month,

                    year: year

                },

                beforeSend: function() {

                    //do load anim

                    $('#loadIcon2').show();

                },

                success: function(response) {

                    $('.data-progress').html(response);



                    $('.myTable').DataTable({

                        "order": [

                            [2, "desc"]

                        ], //or asc 

                        "columnDefs": [{

                            "targets": 2,

                            "type": "date-eu"

                        }],

                    });





                    $('.myDatTab').DataTable();



                    $('#loadIcon2').hide();

                }

            });

        });



        $(document).on('submit', '#formFilterProgressDistribusiBasedOnJenisPekerjaan', function(e) {

            e.preventDefault();

            //alert('ok');



            var id_jenis_pekerjaan = $('#filter_by_jenis_pekerjaan option:selected').val();

            var month = $('#filter_by_month option:selected').val();

            var year = $('#filter_by_year option:selected').val();

            $.ajax({

                type: "POST",

                url: '<?php echo base_url("distribusi/filterDistribusiBasedOnJenisPekerjaan/") ?>' + id_jenis_pekerjaan,

                data: {

                    month: month,

                    year: year

                },

                beforeSend: function() {

                    //do load anim

                    $('#loadIcon2').show();

                },

                success: function(response) {

                    $('.data-progress').html(response);



                    $('.myTable').DataTable({

                        "order": [

                            [2, "desc"]

                        ], //or asc 

                        "columnDefs": [{

                            "targets": 2,

                            "type": "date-eu"

                        }],

                    });





                    $('.myDatTab').DataTable();



                    $('#loadIcon2').hide();

                }

            });

        });



        $(document).on('submit', '#formFilterDist', function(e) {

            e.preventDefault();

            var getValMonth = $('#filter_by_month option:selected').val();

            var getValYear = $('#filter_by_year option:selected').val();



            $.ajax({

                type: "POST",

                url: '<?php echo base_url("distribusi/filter/") ?>' + getValMonth + '/' + getValYear,

                beforeSend: function() {

                    //do load anim

                    $('#loadIcon').show();

                },

                success: function(response) {

                    $('.data-progress').html(response);



                    $('.myTable').DataTable({

                        "order": [

                            [2, "desc"]

                        ], //or asc 

                        "columnDefs": [{

                            "targets": 2,

                            "type": "date-eu"

                        }],

                    });





                    $('.myDatTab').DataTable();



                    $('#loadIcon').hide();

                }

            });

        });



        $(document).on('submit', '#formFilterStore', function(e) {

            e.preventDefault();

            var getValMonth = $('#filter_by_month option:selected').val();

            var getValYear = $('#filter_by_year option:selected').val();



            $.ajax({

                type: "POST",

                url: '<?php echo base_url("store/filter/") ?>' + getValMonth + '/' + getValYear,

                beforeSend: function() {

                    //do load anim

                    $('#loadIcon').show();

                },

                success: function(response) {

                    $('.data-progress').html(response);



                    $('.myTable').DataTable({

                        "order": [

                            [2, "desc"]

                        ], //or asc 

                        "columnDefs": [{

                            "targets": 2,

                            "type": "date-eu"

                        }],

                    });





                    $('.myDatTab').DataTable();



                    $('#loadIcon').hide();

                }

            });

        });

    });



    $('#btnExportExcelInOut').hide();



    $(document).on('submit', '#form_report_mitra_in_out', function(e) {

        e.preventDefault();



        var fromDate = $('#from_date').val();

        var toDate = $('#to_date').val();



        $.ajax({

            method: "POST",

            url: "<?php echo base_url("report/requestMitraInOut") ?>",

            data: {



                fromDate: fromDate,

                toDate: toDate

            },

            beforeSend: function() {

                $('#loadIcon').show();

            },

            success: function(response) {

                $('.result-data-mitra-in-out').html(response);

                $('.myDatTab').DataTable();

                $('#btnExportExcelInOut').show();

                $('#loadIcon').hide();

                // new Chart(document.getElementById("bar_chart").getContext("2d"), getChartJs('bar'));



            }

        });



    });







    $(document).on('change', '.from_date', function() {

        var fromDate = $(this).val();



        $('#from_date_hidden').val(fromDate);

    });



    $(document).on('change', '.to_date', function() {

        var toDate = $(this).val();



        $('#to_date_hidden').val(toDate);

    });



    $(document).on('click', '#btnDetailLaporanDistStore', function() {

        var id = $(this).data('id');

        var from = $('#fromDateLaporanDistStore').val();

        var to = $('#toDateLaporanDistStore').val();



        $.ajax({

            method: "POST",

            url: '<?php echo base_url('report/requestDetailDistStore/'); ?>' + id + '/' + from + '/' + to,



            success: function(response) {

                $('.wadah-modal').html(response);

                $('#modal-detail-laporan-dist-store').modal('show');

                $('.myDatTab').DataTable();

            }

        });

    });



    //export to excel detail dist store

    $(document).on('click', '#btnDetailExcel', function() {

        var id = $(this).data('id');

        var from = $('#fromDateLaporanDistStore').val();

        var to = $('#toDateLaporanDistStore').val();



        window.location.href = '<?php echo base_url('report/excel_detail_dist_store') ?>' + '?id_mitra=' + id + '&fromDate=' + from + '&toDate=' + to;

    });



    //laporan gunting realisasi

    $(document).on('submit', '#form_report_gunting_realisasi', function(e) {

        e.preventDefault();

        var id_mitra = $('#id_mitra option:selected').val();

        var fromDateGuntingRealisasi = $('#from_date_gunting_realisasi').val();

        var toDateGuntingRealisasi = $('#to_date_gunting_realisasi').val();



        $.ajax({

            method: "POST",

            url: '<?php echo base_url('report/requestGuntingRealisasiReport') ?>',

            data: {

                id_mitra: id_mitra,

                fromDateGuntingRealisasi: fromDateGuntingRealisasi,

                toDateGuntingRealisasi: toDateGuntingRealisasi

            },

            beforeSend: function() {

                $('#loadIcon').show();

            },

            success: function(response) {

                $('.result-laporan-gunting-realisasi').html(response);

                $('.myDatTab').DataTable();

                $('#loadIcon').hide();

            }

        });

    });



    $(document).on('show.bs.modal', '.modal', function() {

        var zIndex = 1040 + (10 * $('.modal:visible').length);

        $(this).css('z-index', zIndex);

        setTimeout(function() {

            $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');

        }, 0);

    });



    $image_crop = $('#image_demo').croppie({

        enableExif: true,

        viewport: {

            width: 200,

            height: 200,

            type: 'square' //circle

        },

        boundary: {

            width: 300,

            height: 300

        }

    });



    //add mitra photo

    $(document).on('click', '#btnAddPhoto', function(e) {

        e.preventDefault();

        let idmitra = $(this).data('idmitra');

        let image = $(this).data('image');

        $("#tambahFoto").modal('show');



        if (image != "tidak_ada") {

            $('#imgMitra').attr('src', '<?= base_url('images/mitra/') ?>' + image);

            $('#image_mitra_temp').val(image);

        } else {

            $('#imgMitra').attr('src', 'https://upload.wikimedia.org/wikipedia/commons/7/7c/Profile_avatar_placeholder_large.png');

            $('#image_mitra_temp').val('');

        }



        $('#id_mitra_img').val(idmitra);

        //alert(idmitra);

    });



    $(document).on('change', '#image', function() {

        //alert('ok');

        var reader = new FileReader();

        reader.onload = function(event) {

            $image_crop.croppie('bind', {

                url: event.target.result

            }).then(function() {

                console.log('jQuery bind complete');

            });

        }

        reader.readAsDataURL(this.files[0]);

        $('#uploadimageModal').modal('show');

    });



    $('#crop_image').on('click', function() {

        var id_mitra = $('#id_mitra_img').val();

        var fileName = id_mitra == "" ? 'default' : id_mitra;

        $image_crop.croppie('result', {

            type: 'canvas',

            size: 'viewport'

        }).then(function(response) {

            $.ajax({

                url: '<?php echo base_url('mitra/uploadMitraImage/') ?>' + fileName,

                type: "POST",

                data: {

                    "image": response

                },

                beforeSend: function() {

                    $('#loadIcon').show();

                },

                success: function(data) {

                    var data = JSON.parse(data);

                    $('#uploadimageModal').modal('hide');

                    $('#image_mitra').val(data.image_name);

                    $('.wadah-image-mitra').html(data.show_image);

                    $('#loadIcon').hide();

                }

            });

        });



    });



    $(document).on('submit', '#formAddImageMitra', function(e) {

        e.preventDefault();

        let data = $(this).serialize();



        $.ajax({

            method: "POST",

            url: "<?php echo base_url("mitra/updateMitraImage") ?>",

            data: data,

            beforeSend: function() {

                $('#loadIcon2').show();

            },



            success: function(data) {

                var data = JSON.parse(data);



                if (data.statusCode == 200) {

                    $('#tambahFoto').modal('hide');

                    $("#image").val('');

                    tata.success('Success', 'Berhasil menambahkan foto mitra!');

                    $('#loadIcon2').hide();

                    loopBtnAddPhoto();



                }

            }

        });

    })



    $(document).on('show.bs.modal', '#tambahFoto', function() {

        $("#image").val('');

    });



    function loopBtnAddPhoto() {

        $(".btnAddPhoto").each(function(index) {

            let id_mitra_temp = $('#id_mitra_img').val();

            let id_mitra = $(this).data('idmitra');

            let image_mitra = $('#image_mitra').val();

            //console.log(id_mitra);

            if (id_mitra == id_mitra_temp) {

                $(this).attr('data-image', image_mitra);

            }

        });

    }



    //kain section

    $(document).on('click', '#btnImportExcel', function(e) {

        e.preventDefault();

        $.ajax({

            url: "<?= base_url("kain/show_modal_import"); ?>",

            method: "GET",

            beforeSend: function() {

                topbar.show();

            },

            success: function(response) {

                $('.wadah-modal').html(response);

                $('#modal-import-kain').modal('show');

                topbar.hide();

            },

            error: function(xhr, status, error) {

                topbar.hide();



            }

        });

    });



    $(document).on('click', '.btnSubmitImportKain', function() {

        $('#formImport').trigger('submit');

        $('#modal-import-kain').modal('hide');

    });



    $(document).on('click', '#btnAddStock', function(e) {

        e.preventDefault();



        $.ajax({

            url: '<?= base_url("kain/show_modal_add_stock"); ?>',

            method: "GET",

            beforeSend: function() {

                topbar.show();

            },

            success: function(response) {

                $('.wadah-modal').html(response);

                $('#modal-add-stock').modal('show');

                $('.select2').select2({

                    placeholder: "- Select -",

                    allowClear: true

                });

                topbar.hide();

            }

        });

    });



    $(document).on('change', '#data_kain', function() {

        let id_kain = $('#data_kain option:selected').val();

        $.ajax({

            url: '<?= base_url("kain/load_form_add_stock"); ?>',

            method: "GET",

            data: {

                id_kain: id_kain

            },

            beforeSend: function() {

                topbar.show();

            },

            success: function(response) {

                let id_kain_form = $('#id_kain_' + id_kain).val();

                if (id_kain_form != id_kain) {

                    $('.stock-form-space').append(response);

                }

                topbar.hide();

            }

        })

    });



    $(document).on('click', '.btnSubmitAddStock', function() {

        $('#formAddStock').trigger('submit');

        $('#modal-add-stock').modal('hide');

    });





    //generate id card with selected mitra

    $(document).on('click', '#btnShowModalGenerateIdCard', function(e) {

        e.preventDefault();



        $.ajax({

            url: '<?= base_url("mitra/show_modal_generate_card"); ?>',

            method: "GET",

            beforeSend: function() {

                topbar.show();

            },

            success: function(response) {

                $('.wadah-modal').html(response);

                $('#modal-generate-id-card').modal('show');

                $('.select2').select2({

                    placeholder: "- Select -",

                    allowClear: true

                });

                topbar.hide();

            }

        });

    });



    $(document).on('change', '#data_mitra', function() {

        let id_mitra = $('#data_mitra option:selected').val();



        if (id_mitra != '') {

            $.ajax({

                url: '<?= base_url("mitra/load_selected_mitra"); ?>',

                method: "GET",

                data: {

                    id_mitra: id_mitra

                },

                beforeSend: function() {

                    topbar.show();

                },

                success: function(response) {

                    let id_mitra_form = $('#id_mitra_' + id_mitra).val();

                    if (id_mitra_form != id_mitra) {

                        $('.selected-mitra').append(response);

                    }

                    topbar.hide();

                }

            });

        }



    });



    $(document).on('click', '.btnSubmitGenerateIdCard', function() {

        $('#formGenerateIdCard').trigger('submit');

        $('#modal-generate-id-card').modal('hide');

    });



    $(document).on('click', '.delete_selected_mitra_generate_id_card', function() {

        let id_mitra = $(this).data('id');

        $('#id_mitra_' + id_mitra).remove();

        $('#nama_mitra_' + id_mitra).remove();

        $('#del_' + id_mitra).remove();

    });





    $(document).on('submit', '#form_lihat_distribusi_mitra', function(e) {
        e.preventDefault();
        let form_data = $(this).serialize();
        $.ajax({
            url: '<?= base_url("distribusi/get_lihat_distribusi"); ?>',
            data: form_data,
            method: "POST",
            beforeSend: function() {
                $('#loadIcon').show();
            },
            success: function(response) {
                let data = JSON.parse(response);
                if (data.statusCode == 200) {
                    $('.result-space').html(data.html);
                    $('#frames').html(`<iframe src="${data.iframe}" id="distribusi_mitra" name="distribusi_mitra" frameborder="0" style="display: none;"></iframe>`)
                    $('.myDatTab').DataTable({
                        "order": [
                            [2, "asc"]
                        ], //or asc 
                        "columnDefs": [{
                            "targets": 2,
                            "type": "date-eu"
                        }],
                    });
                }
                $('#loadIcon').hide();
            }
        })
    });

    $(document).on('click', '#btnCetakDistribusiMitra', function() {
        window.frames['distribusi_mitra'].print();
    });

    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function() {
            $(this).remove();
        });
    }, 3000);
</script>