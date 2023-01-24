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
    <link rel="stylesheet" href="<?= base_url("assets"); ?>/css/idcard-horizontal.css?1233">
    <style>
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
    </style>
    <title>ID Card</title>
</head>

<body>
    <?php if (isset($mitra)) : ?>
        <button class="btn btn-lg btn-next" onclick="window.location.href='<?= base_url('mitra/generateIdCardHorizontal?index='); ?>' + '<?= $index + count($mitra); ?>'"><span>&raquo;</span></button>
    <?php endif ?>
    <div class="container-fluid mx-auto">
        <?php if (isset($mitra)) : ?>
            <?php foreach ($mitra as $key => $val) : ?>
                <?php if ($key < count($mitra) / 2) : ?>
                    <div class="row <?= $key % 3 == 0 ? "pagebreak" : "" ?>">
                        <div class="col-6">
                            <div class="card mb-3 pegawai" style="max-width: 70%;">
                                <div class="row no-gutters my-auto">
                                    <div class="col-md-4">
                                        <?php $image2 = $key == 0 ? $mitra[$key]->image : $mitra[$key + $key]->image; ?>
                                        <img src="<?= isset($image2) ? base_url("images/mitra/$image2") : "https://upload.wikimedia.org/wikipedia/commons/7/7c/Profile_avatar_placeholder_large.png" ?>" class="img-fluid rounded-circle pl-2 mitra-img" style="width:
                  200px; margin-top: 40px;">
                                        <?php $id_mitra = $key == 0 ? $mitra[$key]->id : $mitra[$key + $key]->id; ?>
                                        <img src="<?= base_url("code/qrcode/$id_mitra") ?>" width="50px" style="width: 35px; position: relative;
                    left: 5rem; top: -2rem;">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <div class="text-center">
                                                <img src="<?= base_url(); ?>assets/img/logo_soraya2.png" width="80" alt="" srcset="">
                                                <p style="font-weight: 700; font-size: 10px;" class="text-orange">PT.SORAYA BERJAYA INDONESIA</p>
                                            </div>
                                            <h5 class="text-orange" style="font-weight: 600;"><?= $key == 0 ? $mitra[$key]->nama : $mitra[$key + $key]->nama; ?></h5>
                                            <hr style="margin-top: -1px; color: #000 !important;">
                                            <h5 class="text-orange" style="font-weight: 500; margin-top:
                    -8px;"><?= $key == 0 ? $mitra[$key]->id : $mitra[$key + $key]->id; ?></h5>
                                            <span class="tagline">Happy Sleep Happy Life</span>
                                        </div>
                                    </div>
                                    <div class="col-12 footer">
                                        <div class="card-footer">
                                            <div class="text-center">
                                                <h2>MITRA</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php if (array_key_exists($key + $key + 1, $mitra)) :  ?>
                            <div class="col-6">
                                <div class="card mb-3 pegawai" style="max-width: 70%;">
                                    <div class="row no-gutters my-auto">
                                        <div class="col-md-4">
                                            <?php $image = $key == 0 ? $mitra[$key + 1]->image : $mitra[$key + $key + 1]->image; ?>
                                            <img src="<?= isset($image) ? base_url("images/mitra/$image") : "https://upload.wikimedia.org/wikipedia/commons/7/7c/Profile_avatar_placeholder_large.png" ?>" class="img-fluid rounded-circle pl-2 mitra-img" style="width:
                  200px; margin-top: 40px;">
                                            <?php $id_mitra2 = $key == 0 ? $mitra[$key + 1]->id : $mitra[$key + $key + 1]->id; ?>
                                            <img src="<?= base_url("code/qrcode/$id_mitra2") ?>" width="50px" style="width: 35px; position: relative;
                    left: 5rem; top: -2rem;">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <div class="text-center">
                                                    <img src="<?= base_url(); ?>assets/img/logo_soraya2.png" width="80" alt="" srcset="">
                                                    <p style="font-weight: 700; font-size: 10px;" class="text-orange">PT.SORAYA BERJAYA INDONESIA</p>
                                                </div>
                                                <h5 class="text-orange" style="font-weight: 600;"><?= $key == 0 ? $mitra[$key + 1]->nama : $mitra[$key + $key + 1]->nama; ?></h5>
                                                <hr style="margin-top: -1px; color: #000 !important;">
                                                <h5 class="text-orange" style="font-weight: 500; margin-top:
                    -8px;"><?= $key == 0 ? $mitra[$key + 1]->id : $mitra[$key + $key + 1]->id; ?></h5>
                                                <span class="tagline">Happy Sleep Happy Life</span>
                                            </div>
                                        </div>
                                        <div class="col-12 footer">
                                            <div class="card-footer">
                                                <div class="text-center">
                                                    <h2>MITRA</h2>
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
        <?php endif ?>

        <?php if (isset($getMitra)) : ?>
            <div class="row">
                <div class="col-6">
                    <div class="card mb-3 pegawai" style="max-width: 70%;">
                        <div class="row no-gutters my-auto">
                            <div class="col-md-4">
                                <?php $image3 = $getMitra->image; ?>
                                <img src="<?= isset($image3) ? base_url("images/mitra/$image3") : "https://upload.wikimedia.org/wikipedia/commons/7/7c/Profile_avatar_placeholder_large.png" ?>" class="img-fluid rounded-circle pl-2 mitra-img" style="width:
                  200px; margin-top: 40px;">

                                <?php $id_mitra3 = $getMitra->id;  ?>
                                <img src="<?= base_url("code/qrcode/$id_mitra3") ?>" width="50px" style="width: 35px; position: relative;
                    left: 5rem; top: -2rem;">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <div class="text-center">
                                        <img src="<?= base_url(); ?>assets/img/logo_soraya2.png" width="80" alt="" srcset="">
                                        <p style="font-weight: 700; font-size: 10px;" class="text-orange">PT.SORAYA BERJAYA INDONESIA</p>
                                    </div>
                                    <h5 class="text-orange" style="font-weight: 600;"><?= $getMitra->nama; ?></h5>
                                    <hr style="margin-top: -1px; color: #000 !important;">
                                    <h5 class="text-orange" style="font-weight: 500; margin-top:
                    -8px;"><?= $id_mitra3; ?></h5>
                                    <span class="tagline">Happy Sleep Happy Life</span>
                                </div>
                            </div>

                            <div class="col-12 footer">
                                <div class="card-footer">
                                    <div class="text-center">
                                        <h2>MITRA</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif ?>
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