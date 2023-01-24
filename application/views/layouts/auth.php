<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title><?= isset($title) ? $title : 'Soraya Factory' ?></title>

    <?php $this->load->view('layouts/_style'); ?>
</head>

<body class="login-page">

    <?php $this->load->view($page); ?>

    <?php $this->load->view('layouts/_script'); ?>

</body>

</html>