<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Beranda | SIPO</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

<!-- CSS
================================================== -->
<link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
<link href="<?php echo base_url('assets/plug/css/bootstrap.css');?>" rel="stylesheet"/>
<link href="<?php echo base_url('assets/plug/css/bootstrap-responsive.css');?>" rel="stylesheet"/>
<link href="<?php echo base_url('assets/plug/css/prettyPhoto.css');?>" rel="stylesheet"/>
<link href="<?php echo base_url('assets/plug/css/flexslider.css');?>" rel="stylesheet"/>
<link href="<?php echo base_url('assets/plug/css/custom-styles.css');?>" rel="stylesheet"/>

<!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <link rel="stylesheet" href="css/style-ie.css"/>
<![endif]--> 

<!-- Favicons
================================================== -->

<!-- JS
================================================== -->
<script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
<script src='".base_url('assets/plug/js/bootstrap.js')."'></script>
<script src='".base_url('assets/plug/js/jquery.prettyPhoto.js')."'></script>
<script src='".base_url('assets/plug/js/jquery.flexslider.js')."'></script>
<script src='".base_url('assets/plug/js/jquery.custom.js')."'></script>
<script type="text/javascript">
$(document).ready(function () {

    $("#btn-blog-next").click(function () {
      $('#blogCarousel').carousel('next')
    });
     $("#btn-blog-prev").click(function () {
      $('#blogCarousel').carousel('prev')
    });

     $("#btn-client-next").click(function () {
      $('#clientCarousel').carousel('next')
    });
     $("#btn-client-prev").click(function () {
      $('#clientCarousel').carousel('prev')
    });
    
});

 $(window).load(function(){

    $('.flexslider').flexslider({
        animation: "slide",
        slideshow: true,
        start: function(slider){
          $('body').removeClass('loading');
        }
    });  
});

</script>

</head>

<body class="home">
    <!-- Color Bars (above header)-->
	<div class="color-bar-1"></div>
    <div class="color-bar-2 color-bg"></div>
    
    <div class="container">
    
      <div class="row header"><!-- Begin Header -->
      
        <!-- Logo
        ================================================== -->
        <div class="span5 logo">
        	<h2>Bergabung bersama SIPO</h2>
        </div>
        
        <!-- Main Navigation
        ================================================== -->
        
      </div><!-- End Header -->
     
    <div class="row headline"><!-- Begin Headline -->
    
     	<!-- Slider Carousel
        ================================================== -->
       
        
        <!-- Headline Text
        ================================================== -->
        <div class="span6 sidebar page-right-sidebar"><!-- Begin sidebar column -->

            <!--User Login-->
            <h5 class="title-bg">Daftar SIPO</h5>
            <div class="alert alert-info">
		                            Silakan masukkan data anda!
		                        </div>
							<?php echo validation_errors();?>
								<?php
									if($this->session->flashdata('pesan')){
										echo "<p><font color='red'>".$this->session->flashdata('pesan')."</font></p>";
									}
								?>
							<?php echo form_open_multipart('sipo/proses_daftar');?>

							 <form class="form-horizontal" action="index.html" method="post">
		                            <fieldset>
		                                <div class="input-group input-group-lg">
		                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user red"></i></span>
		                                   	<input type="text" class="form-control" name="email" value="<?php echo form_error('email');?>" placeholder="E-mail" required/>
		                                </div>
		                                <div class="clearfix"></div><br>

		                                <div class="input-group input-group-lg">
		                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
											<input type="text" class="form-control" name="nama" value="<?php echo form_error('nama'); ?>" placeholder="Nama" required/>
		                                </div>
		                                <div class="input-group input-group-lg">
		                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
											<input type="file" class="form-control" name="foto" value="<?php echo form_error('foto'); ?>" placeholder="Foto" required/>
		                                </div>
		                                <div class="input-group input-group-lg">
		                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
											<input type="text" class="form-control" name="username" value="<?php echo form_error('username'); ?>" placeholder="Username" required/>
		                                </div>
		                                <div class="input-group input-group-lg">
		                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
											<input type="password" class="form-control" name="password" value="<?php echo form_error('password'); ?>" placeholder="Password" required/>
		                                </div>
		                                <div class="input-group input-group-lg">
		                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
											<input type="password" class="form-control" name="ulang_password" value="<?php echo form_error('ulang_password'); ?>" placeholder="Ulang Password" required/>
		                                </div>	
											

		                                <div class="clearfix"></div>

		                                <p class="center col-md-5">
		                                    <button type="submit" class="btn btn-primary" name="submit" value="Daftar">Daftar</button>
		                                </p>
		                            </fieldset>
		                        </form>
		                    <?php
								echo form_close();
							?>
        </div>

    </div><!-- End Headline -->

    
    </div> <!-- End Container -->

    <!-- Footer Area
        ================================================== -->
    
    <!-- Scroll to Top -->  
    <div id="toTop" class="hidden-phone hidden-tablet">Back to Top</div>
    
</body>
</html>