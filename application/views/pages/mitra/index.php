<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2 style="text-transform: uppercase;">
                            <?= $title_detail; ?>
                        </h2>
                        <?php if ($this->session->userdata('role') == 'admin') : ?>
                            <a href="<?= base_url("mitra/add"); ?>" class="btn btn-primary waves-effect" style="margin-top: 15px;" id="btnAddMitra"><i class="material-icons">person_add</i>&nbsp;Tambah Mitra</a>
                        <?php endif ?>
                        <a href="<?= base_url("mitra/exportToExcel/$nav_title"); ?>" class="btn bg-green waves-effect" style="margin-top: 15px; margin-left: 10px;" id="btnAddMitra"><i class="material-icons">description</i>&nbsp;Export to Excel</a>
                        <a href="<?= base_url("mitra/generateIdCard"); ?>" class="btn bg-orange waves-effect" style="margin-top: 15px; margin-left: 10px;" id="btnGenerateIdCard" target="_blank"><i class="material-icons">assignment_ind</i>&nbsp;Generate Id Card</a>
                        <a href="#" class="btn btn-info waves-effect" style="margin-top: 15px; margin-left: 10px;" id="btnShowModalGenerateIdCard"><i class="material-icons">assignment_ind</i>&nbsp;Pilih Mitra untuk Generate Id Card</a>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="javascript:void(0);">Action</a></li>
                                    <li><a href="javascript:void(0);">Another action</a></li>
                                    <li><a href="javascript:void(0);">Something else here</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <?php $this->load->view('layouts/_alert'); ?>
                        <?php $this->load->view('pages/mitra/table'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div id="uploadimageModal" class="modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalImage">Unggah & Resize Gambar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div id="image_demo" class="text-center mx-auto" style="width:350px; margin-top:30px;"></div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary waves-effect crop_image" id="crop_image">Crop & Upload Image<img src="<?= base_url("assets/img/load.gif") ?>" id="loadIcon" style="width: 18px; margin-left: 5px; display: none;"></button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="tambahFoto" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row">
                    <div class="col-xs-6">
                        <h4>Upload Foto Mitra</h4>
                    </div>
                </div>
            </div>
            <form action="#" method="POST" id="formAddImageMitra">
                <div class="modal-body">
                    <input type="hidden" id="id_mitra_img" name="id_mitra_img" value="">
                    <input type="hidden" id="image_mitra_temp" name="image_mitra_temp" value="">
                    <input type="hidden" name="image_mitra" id="image_mitra" value="">
                    <div class="text-center wadah-image-mitra">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/7/7c/Profile_avatar_placeholder_large.png" id="imgMitra" class="img-fluid" style="width: 200px; border-radius: 50%;">
                    </div>
                    <input type="file" class="form-control m-t-5" id="image" name="image" accept="image/*">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">TUTUP</button>
                    <button type="submit" class="btn btn-primary waves-effect">KIRIM <img src="<?= base_url("assets/img/load.gif") ?>" id="loadIcon2" style="width: 18px; margin-left: 5px; display: none;"></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="wadah-modal"></div>