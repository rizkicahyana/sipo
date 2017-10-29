<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Masuk | SIPO</title>
		<link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet" />
	</head>
	<body>
	<div class="fullscreen landing parallax" style="background-image:url('assets/img/1.jpg');"  data-img-width="2000"  data-img-height="1333" data-diff="100">
		<div class="container">
			<div class="row">
			    <div class="box col-md-12">
			        <div class="box-inner">
		                <center>
		                    <div class="col-lg-7 col-md-10">
		                    </br>
		                    <align="center">	
							<h2>Selamat Datang di Sistem Pembelajaran Online!</h2><br/>
								<div class="alert alert-info">
		                            Silahkan masukkan username dan password anda.
		                        </div>
							<?php echo validation_errors();?>
								<?php
									if($this->session->flashdata('pesan')){
										echo "<p><font color='red'>".$this->session->flashdata('pesan')."</font></p>";
									}
								?>
							<?php
								echo form_open('sipo/proses_login');
							?>

							 <form class="form-horizontal" action="index.html" method="post">
		                            <fieldset>
		                                <div class="input-group input-group-lg">
		                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user red"></i></span>
		                                   	<input type="text" class="form-control" name="username" value="<?php echo set_value('username');?>" required/>
		                                </div>
		                                <div class="clearfix"></div><br>

		                                <div class="input-group input-group-lg">
		                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
											<input type="password" class="form-control" name="password" value="<?php echo set_value('password');?>" required/>
		                                </div>

		                                	<?php echo $image;?><br/>
		                                <div class="input-group input-group-lg">
		                                   <input type="text" class="form-control" name="security_code" required/>		
		                                </div>
											

		                                <div class="clearfix"></div>

		                                <p class="center col-md-5">
		                                    <button type="submit" class="btn btn-primary" name="submit" value="Masuk">Masuk</button>
		                                   <a href="<?php echo site_url('sipo/daftar');?>">Daftar</a>
		                                </p>
		                            </fieldset>
		                        </form>
		                    <?php
								echo form_close();
							?>
		                    </div>
		                </center>
			        </div>
		    	</div>
			</div>
		</div>
		</div>
	</body>
</html>