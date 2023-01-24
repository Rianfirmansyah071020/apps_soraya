 <!-- Favicon-->
 <link rel="icon" href="<?= base_url('assets/'); ?>img/favicon.png">

 <!-- Google Fonts -->
 <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
 <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

 <!-- Bootstrap Core Css -->
 <link href="<?= base_url('assets'); ?>/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

 <!-- Waves Effect Css -->
 <link href="<?= base_url('assets'); ?>/plugins/node-waves/waves.css" rel="stylesheet" />

 <!-- Animation Css -->
 <link href="<?= base_url('assets'); ?>/plugins/animate-css/animate.css" rel="stylesheet" />

 <!-- Bootstrap Material Datetime Picker Css -->
 <link href="<?= base_url('assets'); ?>/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />

 <!-- Bootstrap DatePicker Css -->
 <link href="<?= base_url('assets'); ?>/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />

 <!-- Wait Me Css -->
 <link href="<?= base_url('assets'); ?>/plugins/waitme/waitMe.css" rel="stylesheet" />

 <!-- Bootstrap Select Css -->
 <link href="<?= base_url('assets'); ?>/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />


 <!-- JQuery DataTable Css -->
 <link href="<?= base_url('assets'); ?>/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

 <!-- Dropzone.js -->
 <link href="<?= base_url('assets'); ?>/plugins/dropzone/dropzone.css" rel="stylesheet">

 <!-- Custom Css -->
 <link href="<?= base_url('assets'); ?>/css/style.css" rel="stylesheet">

 <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
 <link href="<?= base_url('assets'); ?>/css/themes/all-themes.css" rel="stylesheet" />
 <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
 <link href="<?= base_url('assets'); ?>/css/select2-bootstrap4.css" rel="stylesheet" />
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.css" integrity="sha512-2eMmukTZtvwlfQoG8ztapwAH5fXaQBzaMqdljLopRSA0i6YKM8kBAOrSSykxu9NN9HrtD45lIqfONLII2AFL/Q==" crossorigin="anonymous" />

 <link rel="stylesheet" href="<?= base_url('assets/css/sweetalert2/sweetalert2.min.css'); ?>">

 <style>
     .select2 {
         width: 100% !important;
     }

     .bg-custom {
         background-color: #f9f7f7;

     }

     .large-font p {
         font-size: 14px;
     }

     .content-block {
         background-color: #fff;
         width: 500px;
         margin: auto;

         border-radius: 3px;
     }

     .loader-wrapper {
         height: 300px;
         padding: 12px;
     }

     .loader-animation {
         background: #f5f6f7;
         height: 104px;
         overflow: hidden;
         position: relative;
     }

     .loader-animation>div {
         background: #fff;
         height: 6px;
         left: 0;
         position: absolute;
         right: 0;
     }

     .loader-animation::before {
         background-color: #f5f6f7;
         background-image: url(https://i.postimg.cc/VLC3WF9t/3pk-Fb-IT7-rn.gif);
         background-repeat: repeat-y;
         background-size: 100% 1px;
         content: ' ';
         display: block;
         height: 100%;
     }


     /*
  Below we position the mask divs
*/

     .block-a.block-a

     /* 
Have no idea why this written like this, without it the ui breaks works, can anyone explain this ?
*/
         {
         background-color: transparent;
         border: 8px solid #fff;
         border-radius: 70%;
         height: 60px;
         left: -10px;
         top: -10px;
         width: 60px;
     }


     div.block-b {
         height: 40px;
         left: 40px;
         right: auto;
         top: 0;
         width: 8px;
     }

     div.block-c {
         height: 8px;
         left: 48px;
         top: 0;
     }

     div.block-d {
         left: 136px;
         top: 8px;
     }

     div.block-e {
         height: 12px;
         left: 48px;
         top: 14px;
     }

     div.block-f {
         left: 100px;
         top: 26px;
     }

     div.block-g {
         height: 10px;
         left: 48px;
         top: 32px;
     }

     div.block-h {
         height: 20px;
         top: 40px;
     }

     div.block-i {
         left: 410px;
         top: 60px
     }

     div.block-j {
         height: 13px;
         top: 66px
     }

     div.block-k {
         left: 440px;
         top: 79px
     }

     div.block-l {
         height: 13px;
         top: 85px
     }

     div.block-m {
         left: 178px;
         top: 98px
     }

     .dropdown-menu {
         padding-left: 20px !important;
     }

     /* .modal-ku {
         width: 1100px !important;
         margin: 30px auto !important;
     } */


     @media (min-width: 992px) {
         .modal-ku {
             width: 1140px !important;
         }
     }

     @media (min-width: 768px) {
         .modal-ku {
             width: 900px;
             margin: 30px auto;
         }
     }

     @media (max-width: 1186px) {

         .navbar>.container .navbar-brand,
         .navbar>.container-fluid .logo-brand {
             margin-left: 40px;
             width: 73%;
         }
     }

     @media (max-width: 1199px) {
         .btn-filter {
             margin-top: 0px;
             margin-bottom: 25px;
             margin-left: 21px;
         }
     }
 </style>