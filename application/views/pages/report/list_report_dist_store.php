<?php

$convFrom = explode("/", $fromDate);
$convTo   = explode("/", $toDate);

$FromDate = $convFrom[2] . "-" . $convFrom[0] . "-" . $convFrom[1];
$ToDate = $convTo[2] . "-" . $convTo[0] . "-" . $convTo[1];
?>
<div class="text-center">
    <h3>Laporan Distribusi & Store Pekerjaan Mitra</h3>
    <h5>Dari <?= date_format(new DateTime($FromDate . "00:00:00"), "d M Y"); ?> s/d <?= date_format(new DateTime($ToDate . "00:00:00"), "d M Y"); ?></h5>
</div>
<div class="table-responsive" style="margin-top: 30px;">
    <input type="hidden" value="<?= $FromDate; ?>" id="fromDateLaporanDistStore">
    <input type="hidden" value="<?= $ToDate; ?>" id="toDateLaporanDistStore">
    <button disabled type="button" class="btn btn-success" style="margin-bottom: 1rem;" onclick="exportDataTerpilih()" id="button-export-terpilih">Export Data Terpilih</button>
    <table class="table table-bordered table-striped table-hover myDatTab">
        <thead>
            <tr>
                <th>
                    <input type="checkbox" id="head-cb">
                </th>
                <th>Mitra ID</th>
                <th>Nama Mitra</th>
                <th>Jumlah Set</th>
                <th>Jumlah Store</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            foreach ($content as $row) : ?>
                <tr>
                    <td>
                        <input type="checkbox" id="cb<?= $i ?>" class="cb-element" name="id[]" value="<?= $row->id; ?>" />
                        <label for="cb<?= $i ?>"></label>
                    </td>
                    <td><?= $row->id; ?></td>
                    <td><?= $row->nama; ?></td>
                    <td><?= $row->jumlah_set; ?></td>
                    <td><?= $row->jumlah_store; ?></td>
                    <td style="text-align: center;">
                        <button type="button" class="btn btn-info waves-effect" id="btnDetailLaporanDistStore" data-id="<?= $row->id; ?>"><i class="material-icons">visibility</i>&nbsp;View</button>
                        <button type="button" class="btn btn-success waves-effect" id="btnDetailExcel" data-id="<?= $row->id; ?>"><i class="material-icons">description</i>&nbsp;Export</button>
                    </td>
                </tr>
            <?php $i++;
            endforeach ?>
        </tbody>
    </table>
</div>

<script type="text/javascript">
    $('#head-cb').on('click', function() {
        var isChecked = $("#head-cb").prop("checked");
        $("#button-export-terpilih").prop("disabled", !isChecked);
    });

    $('.cb-element').on('click', function() {
        var isChecked = $(".cb-element").prop("checked");
        var ids = [];
        $(".cb-element").each(function() {
            if ($(this).prop("checked")) {
                ids.push($(this).val());
            }
        });
        if (ids.length > 0) {
            $("#button-export-terpilih").prop("disabled", false);
        } else {
            $("#button-export-terpilih").prop("disabled", true);
        }

    });

    function exportDataTerpilih() {
        let checkbox_terpilih = $(".cb-element:checked");
        let ids = [];
        var fromDate = []
        var toDate = []

        checkbox_terpilih.each(function() {
            ids.push($(this).val());
        });

        console.log(ids)

        swal.fire({
            title: 'Menu ini sedang dalam uji coba oleh developer',
            type: 'warning',
            confirmButtonText: 'Ok'
        });
    }
</script>