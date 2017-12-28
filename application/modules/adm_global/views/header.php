<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Prime Mobile Dashboard | <?php echo isset($title) ? $title : "";?></title>

    <?php
        $this->load->view($headerassets);
    ?>
</head>
<body class="<?php echo $title == "Content Management System Login" ? "login" : "nav-md";?>">
<?php
    if($title !== "Content Management System Login"){
        ?>
        <div class="container body">
            <div class="main_container">
        <?php
    }
?>
    
