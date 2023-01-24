<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,
      shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="<?= base_url("assets"); ?>/css/idcard.css?1227" rel="stylesheet">
    <style>
        .grid {
            display: grid;
            grid-template-columns: 200px 200px;
            grid-row: auto auto;
            grid-column-gap: 20px;
            grid-row-gap: 20px;
        }

        .btn-next {
            position: fixed;
            border-radius: 50%;
            z-index: 1;
            right: 3rem;
            bottom: 2rem;
            background-color: #777777;
            border-color: #777777;
        }

        .btn-next span {
            font-weight: 900;
            color: white;
        }

        @media print {
            .pagebreakk {
                clear: both;
                page-break-after: always;
            }

            .col-6::after {
                page-break-after: always;
                page-break-inside: avoid;
                page-break-before: avoid;
            }

            .btn-next {
                display: none;
            }

            /* page-break-after works, as well */
        }
    </style>
    <title>ID Card</title>
</head>

<body>
    <?php if (isset($mitra)) : ?>
        <?php if (isset($button_next) && $button_next == true) : ?>
            <button class="btn btn-lg btn-next" onclick="window.location.href='<?= base_url('mitra/generateIdCard?index='); ?>' + '<?= $index + count($mitra); ?>'"><span>&raquo;</span></button>
        <?php endif ?>
    <?php endif ?>
    <div class="container-fluid mx-auto">
        <?php foreach ($mitra as $key => $val) : ?>
            <?php if ($key < count($mitra) / 2) : ?>
                <div class="row <?= $key % 2 == 0 ? "pagebreak" : "" ?>">
                    <div class="col-6">
                        <div class="card card-custom" style="width: 22rem;">

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3 divisi" style="max-width: 21% !important;">
                                        <span class="nama-divisi">MITRA</span>
                                    </div>
                                    <div class="col-9 pegawai" style="width: 1px !important; max-width: 61.5% !important;">
                                        <div class="text-center mb-4">
                                            <img src="<?= base_url(); ?>assets/img/logo_soraya2.png" class="img-fluid
                      mt-3" style="width: 150px; margin-bottom: -7px; margin-top: 2rem !important;"><br>
                                            <span class="text-orange" style="font-size: 9.5px;
                      font-weight: bold;">PT.SORAYA BERJAYA INDONESIA</span>
                                        </div>
                                        <div class="text-center">
                                            <?php $image2 = $key == 0 ? $mitra[$key]->image : $mitra[$key + $key]->image; ?>
                                            <img src="<?= isset($image2) ? base_url("images/mitra/$image2") : "https://upload.wikimedia.org/wikipedia/commons/7/7c/Profile_avatar_placeholder_large.png" ?>" class="img-fluid rounded-circle" style="width: 150px;">
                                        </div>
                                        <?php $id_mitra = $key == 0 ? $mitra[$key]->id : $mitra[$key + $key]->id; ?>
                                        <img src="<?= base_url("code/qrcode/$id_mitra") ?>" class="img-fluid" style="width: 60px; position: relative;
                    left: 6rem; top: -3rem;">
                                        <?php $name = $key == 0 ? $mitra[$key]->nama : $mitra[$key + $key]->nama; ?>
                                        <div class="text-center mt-3 wadah-nama-mitra">
                                            <h4 class="nama_pegawai" style="font-size: <?= strlen($name) > 18 ? '13px' : '15px' ?>; margin-top:
                      20px; font-weight: bold;"><?= $name; ?></h4>
                                            <h6 style="font-size: 15px;"><?= $key == 0 ? $mitra[$key]->id : $mitra[$key + $key]->id; ?></h6>
                                        </div>
                                        <div class="text-center wadah-tagline mb-4">
                                            <span class="tagline" style="font-size: 11px;">Happy Sleep Happy Life</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if (array_key_exists($key + $key + 1, $mitra)) : ?>
                        <div class="col-6">
                            <div class="card card-custom" style="width: 22rem;">

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-3 divisi" style="max-width: 21% !important;">
                                            <span class="nama-divisi">MITRA</span>
                                        </div>
                                        <div class="col-9 pegawai" style="width: 1px !important; max-width: 61.5% !important;">
                                            <div class="text-center mb-4">
                                                <img src="<?= base_url(); ?>assets/img/logo_soraya2.png" class="img-fluid
                      mt-3" style="width: 150px; margin-bottom: -7px; margin-top: 2rem !important;"><br>
                                                <span class="text-orange" style="font-size: 9.5px;
                      font-weight: bold;">PT.SORAYA BERJAYA INDONESIA</span>
                                            </div>
                                            <div class="text-center">
                                                <?php $image = $key == 0 ? $mitra[$key + 1]->image : $mitra[$key + $key + 1]->image; ?>
                                                <img src="<?= isset($image) ? base_url("images/mitra/$image") : "https://upload.wikimedia.org/wikipedia/commons/7/7c/Profile_avatar_placeholder_large.png" ?>" class="img-fluid rounded-circle" style="width: 150px;">
                                            </div>
                                            <?php $id_mitra_2 = $key == 0 ? $mitra[$key + 1]->id : $mitra[$key + $key + 1]->id; ?>
                                            <img src="<?= base_url("code/qrcode/$id_mitra_2") ?>" class="img-fluid" style="width: 60px; position: relative;
                    left: 6rem; top: -3rem;">
                                            <?php $name = $key == 0 ? $mitra[$key + 1]->nama : $mitra[$key + $key + 1]->nama; ?>
                                            <div class="text-center mt-3 wadah-nama-mitra">
                                                <h4 class="nama_pegawai" style="font-size: <?= strlen($name) > 18 ? '13px' : '15px' ?>; margin-top:
                      20px; font-weight: bold;"><?= $name; ?></h4>
                                                <h6 style="font-size: 15px;"><?= $key == 0 ? $mitra[$key + 1]->id : $mitra[$key + $key + 1]->id; ?></h6>
                                            </div>
                                            <div class="text-center wadah-tagline mb-4">
                                                <span class="tagline" style="font-size: 11px;">Happy Sleep Happy Life</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif ?>
                </div>
            <?php endif ?>
        <?php endforeach ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script type="text/javascript">
        window.onload = function() {
            window.print();
        }
    </script>
</body>

</html>