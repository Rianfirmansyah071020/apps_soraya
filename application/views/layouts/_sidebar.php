<section>
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
        <!-- User Info -->
        <div class="user-info">
            <div class="image">
                <img src="<?= base_url('assets'); ?>/images/user.png" width="48" height="48" alt="User" />
            </div>
            <div class="info-container">
                <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= $this->session->userdata('name'); ?></div>
                <div class="email"><?= $this->session->userdata('username'); ?></div>
                <div class="btn-group user-helper-dropdown">
                    <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                    <ul class="dropdown-menu pull-right" style="padding-left: 0px !important;">
                        <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="<?= base_url("user"); ?>"><i class="material-icons">group</i>Another Admin</a></li>

                        <li role="separator" class="divider"></li>
                        <li><a href="<?= base_url("logout"); ?>"><i class="material-icons">input</i>Sign Out</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- #User Info -->
        <!-- Menu -->
        <div class="menu">
            <ul class="list">
                <li class="header">MAIN NAVIGATION</li>
                <li class="<?= $nav_title == "home" ? "active" : "" ?>">
                    <a href="<?= base_url("home"); ?>">
                        <i class="material-icons">dashboard</i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="<?= $nav_title == "mitra" ? "active" : "" ?>">
                    <a href="<?= base_url('mitra'); ?>">
                        <i class="material-icons">person</i>
                        <span>Mitra</span>
                    </a>
                </li>

                <li class="<?= $nav_title == "mitra_out" ? "active" : "" ?>">
                    <a href="<?= base_url('mitra/out'); ?>">
                        <i class="material-icons">error</i>
                        <span>Mitra Out</span>
                    </a>
                </li>

                <li class="<?= $nav_title == "user" ? "active" : "" ?>">
                    <a href="<?= base_url('user'); ?>">
                        <i class="material-icons">group</i>
                        <span>Kelola Pengguna</span>
                    </a>
                </li>
                <?php if ($this->session->userdata('name') == 'Rio Pambudhi') : ?>
                    <li class="header">DATA KAIN</li>
                    <li class="<?= $nav_title == "kain" ? "active" : "" ?>">
                        <a href="<?= base_url('kain'); ?>">
                            <i class="material-icons">crop_3_2</i>
                            <span>Daftar Kain</span>
                        </a>
                    </li>
                <?php endif ?>

                <!-- <li class="header">PREORDER</li>
                <li class="<?= $nav_title == "preoder" ? "active" : "" ?>">
                    <a href="<?= base_url('toko'); ?>">
                        <i class="material-icons">inbox</i>
                        <span>Preorder</span>
                    </a>
                </li> -->

                <li class="header">PROGRESS NAVIGATION</li>
                <li class="<?= $nav_title == "progress" || $nav_title == "realisasi" ? "active" : "" ?>">
                    <a href="javascript:void(0);" class="menu-toggle waves-effect waves-block">
                        <i class="material-icons">content_cut</i>
                        <span>Progress & Gunting</span>
                    </a>
                    <ul class="ml-menu" style="<?= $nav_title == "progress" ? "display: block;" : "display: none;" ?>">
                        <li class="">
                            <a href="<?= base_url('progress'); ?>">

                                <span style="<?= $nav_title == "progress" ? "font-weight: 600; color: #F44336;" : "" ?>">Perencanaan Gunting</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="<?= base_url('progress/realisasi'); ?>">

                                <span style="<?= $nav_title == "realisasi" ? "font-weight: 600; color: #F44336;" : "" ?>">Realisasi Perencanaan Gunting</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="<?= $nav_title == "distribusi" ? "active" : "" ?>">
                    <a href="<?= base_url('distribusi'); ?>">
                        <i class="material-icons">local_shipping</i>
                        <span>Pendistribusian</span>
                    </a>
                </li>

                <li class="<?= $nav_title == "store" ? "active" : "" ?>">
                    <a href="<?= base_url('store'); ?>">
                        <i class="material-icons">work</i>
                        <span>Setor Barang Jadi</span>
                    </a>
                </li>


                <li class="header">DATA NAVIGATION</li>
                <li class="<?= $nav_title == "jenis_pekerjaan" ? "active" : "" ?>">
                    <a href="<?= base_url('work'); ?>">
                        <i class="material-icons">assignment</i>
                        <span>Jenis Produk</span>
                    </a>
                </li>
                <li class="<?= $nav_title == "jenis_bantal" ? "active" : "" ?>">
                    <a href="<?= base_url('bantal'); ?>">
                        <i class="material-icons">airline_seat_individual_suite</i>
                        <span>Jenis Bantal</span>
                    </a>
                </li>

                <li class="<?= $nav_title == "mitrawork" ? "active" : "" ?>">
                    <a href="<?= base_url('mitrawork'); ?>">
                        <i class="material-icons">directions_walk</i>
                        <span>Jenis Pekerjaan Mitra</span>
                    </a>
                </li>


                <li class="header">REPORT</li>

                <li class="<?= $nav_title == "laporan-mitra" ? "active" : "" ?>">
                    <a href="<?= base_url('report/mitra'); ?>">
                        <i class="material-icons">description</i>
                        <span>Laporan Mitra</span>
                    </a>
                </li>
                <li class="<?= $nav_title == "laporan-mitra-in-out" ? "active" : "" ?>">
                    <a href="<?= base_url('report/outin'); ?>">
                        <i class="material-icons">description</i>
                        <span>Laporan Mitra In Out</span>
                    </a>
                </li>

                <li class="<?= $nav_title == "laporan-gunting-realisasi" ? "active" : "" ?>">
                    <a href="<?= base_url('report/guntingRealisasi'); ?>">
                        <i class="material-icons">description</i>
                        <span>Laporan Gunting Dan Realisasi</span>
                    </a>
                </li>

                <li class="<?= $nav_title == "laporan-dist-store" ? "active" : "" ?>">
                    <a href="<?= base_url('report/distStore'); ?>">
                        <i class="material-icons">description</i>
                        <span>Laporan Distribusi Dan Store</span>
                    </a>
                </li>

                <li class="header">Toko</li>
                <li class="<?= $nav_title == "toko" ? "active" : "" ?>">
                    <a href="<?= base_url('toko'); ?>">
                        <i class="material-icons">store</i>
                        <span>Toko</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- #Menu -->
        <!-- Footer -->
        <div class="legal">
            <div class="copyright">
                &copy; <?= date("Y"); ?> <a href="<?= base_url(); ?>">Pabrik Soraya Bedsheet</a>.
            </div>
            <div class="version">
                <b>Version: </b> 1.0.1
            </div>
        </div>
        <!-- #Footer -->
    </aside>
    <!-- #END# Left Sidebar -->
    <!-- Right Sidebar -->
    <aside id="rightsidebar" class="right-sidebar">
        <ul class="nav nav-tabs tab-nav-right" role="tablist">
            <li role="presentation" class="active"><a href="#skins" data-toggle="tab">SKINS</a></li>
            <li role="presentation"><a href="#settings" data-toggle="tab">SETTINGS</a></li>
        </ul>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active in active" id="skins">
                <ul class="demo-choose-skin">
                    <li data-theme="red" class="active">
                        <div class="red"></div>
                        <span>Red</span>
                    </li>
                    <li data-theme="pink">
                        <div class="pink"></div>
                        <span>Pink</span>
                    </li>
                    <li data-theme="purple">
                        <div class="purple"></div>
                        <span>Purple</span>
                    </li>
                    <li data-theme="deep-purple">
                        <div class="deep-purple"></div>
                        <span>Deep Purple</span>
                    </li>
                    <li data-theme="indigo">
                        <div class="indigo"></div>
                        <span>Indigo</span>
                    </li>
                    <li data-theme="blue">
                        <div class="blue"></div>
                        <span>Blue</span>
                    </li>
                    <li data-theme="light-blue">
                        <div class="light-blue"></div>
                        <span>Light Blue</span>
                    </li>
                    <li data-theme="cyan">
                        <div class="cyan"></div>
                        <span>Cyan</span>
                    </li>
                    <li data-theme="teal">
                        <div class="teal"></div>
                        <span>Teal</span>
                    </li>
                    <li data-theme="green">
                        <div class="green"></div>
                        <span>Green</span>
                    </li>
                    <li data-theme="light-green">
                        <div class="light-green"></div>
                        <span>Light Green</span>
                    </li>
                    <li data-theme="lime">
                        <div class="lime"></div>
                        <span>Lime</span>
                    </li>
                    <li data-theme="yellow">
                        <div class="yellow"></div>
                        <span>Yellow</span>
                    </li>
                    <li data-theme="amber">
                        <div class="amber"></div>
                        <span>Amber</span>
                    </li>
                    <li data-theme="orange">
                        <div class="orange"></div>
                        <span>Orange</span>
                    </li>
                    <li data-theme="deep-orange">
                        <div class="deep-orange"></div>
                        <span>Deep Orange</span>
                    </li>
                    <li data-theme="brown">
                        <div class="brown"></div>
                        <span>Brown</span>
                    </li>
                    <li data-theme="grey">
                        <div class="grey"></div>
                        <span>Grey</span>
                    </li>
                    <li data-theme="blue-grey">
                        <div class="blue-grey"></div>
                        <span>Blue Grey</span>
                    </li>
                    <li data-theme="black">
                        <div class="black"></div>
                        <span>Black</span>
                    </li>
                </ul>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="settings">
                <div class="demo-settings">
                    <p>GENERAL SETTINGS</p>
                    <ul class="setting-list">
                        <li>
                            <span>Report Panel Usage</span>
                            <div class="switch">
                                <label><input type="checkbox" checked><span class="lever"></span></label>
                            </div>
                        </li>
                        <li>
                            <span>Email Redirect</span>
                            <div class="switch">
                                <label><input type="checkbox"><span class="lever"></span></label>
                            </div>
                        </li>
                    </ul>
                    <p>SYSTEM SETTINGS</p>
                    <ul class="setting-list">
                        <li>
                            <span>Notifications</span>
                            <div class="switch">
                                <label><input type="checkbox" checked><span class="lever"></span></label>
                            </div>
                        </li>
                        <li>
                            <span>Auto Updates</span>
                            <div class="switch">
                                <label><input type="checkbox" checked><span class="lever"></span></label>
                            </div>
                        </li>
                    </ul>
                    <p>ACCOUNT SETTINGS</p>
                    <ul class="setting-list">
                        <li>
                            <span>Offline</span>
                            <div class="switch">
                                <label><input type="checkbox"><span class="lever"></span></label>
                            </div>
                        </li>
                        <li>
                            <span>Location Permission</span>
                            <div class="switch">
                                <label><input type="checkbox" checked><span class="lever"></span></label>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </aside>
    <!-- #END# Right Sidebar -->
</section>