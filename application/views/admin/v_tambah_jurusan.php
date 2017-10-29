<?php
	$pesan = $this->session->flashdata('pesan');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Tambah Jurusan | SIPO</title>
    <link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

     <!-- Custom CSS -->
    <link href="<?php echo base_url('assets/plugin/dist/css/sb-admin-2.css');?>" rel="stylesheet">

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url('assets/plugin/bower_components/bootstrap/dist/css/bootstrap.min.css');?>" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url('assets/plugin/bower_components/metisMenu/dist/metisMenu.min.css');?>" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="<?php echo base_url('assets/plugin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css');?>" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="<?php echo base_url('assets/plugin/bower_components/datatables-responsive/css/dataTables.responsive.css');?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url('assets/plugin/bower_components/font-awesome/css/font-awesome.min.css');?>" rel="stylesheet" type="text/css">
</head>
<body>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                
                <a class="navbar-brand" href="index.html">Dasboard Admin</a>

            </div>

            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="<?php echo site_url('sipo/dashboard_admin/keluar');?>"><i class="fa fa-sign-out fa-fw"></i>Keluar</a></li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i>Akun<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo site_url('sipo/dashboard_admin/lihat_akun');?>">Lihat Data Akun</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
                 <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i>Guru<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo site_url('sipo/dashboard_admin/lihat_guru');?>">Lihat Data Guru</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('sipo/dashboard_admin/tambah_guru');?>">Tambah Guru</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
                 <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i>Siswa<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo site_url('sipo/dashboard_admin/lihat_siswa');?>">Lihat Data Siswa</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('sipo/dashboard_admin/tambah_siswa');?>">Tambah Siswa</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i>Mata Pelajaran<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo site_url('sipo/dashboard_admin/lihat_mapel');?>">Lihat Data Mata Pelajaran</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('sipo/dashboard_admin/tambah_mapel');?>">Tambah Mata Pelajaran</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i>Jurusan<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo site_url('sipo/dashboard_admin/lihat_jurusan');?>">Lihat Data Jurusan</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('sipo/dashboard_admin/tambah_jurusan');?>">Tambah Jurusan</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i>Kelas<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo site_url('sipo/dashboard_admin/lihat_kelas');?>">Lihat Data Kelas</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('sipo/dashboard_admin/tambah_kelas');?>">Tambah Kelas</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
                 <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i>Semester<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo site_url('sipo/dashboard_admin/lihat_semester');?>">Lihat Data Semester</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('sipo/dashboard_admin/tambah_semester');?>">Tambah Semester</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
                 <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i>Spesialisasi<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo site_url('sipo/dashboard_admin/lihat_spesialisasi');?>">Lihat Data Spesialisasi Guru</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('sipo/dashboard_admin/tambah_spesialisasi');?>">Tambah Spesialisasi Guru</a>
                                </li>
								<li>
                                    <a href="<?php echo site_url('sipo/dashboard_admin/lihat_spesialisasi_siswa');?>">Lihat Data Spesialisasi Siswa</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('sipo/dashboard_admin/tambah_spesialisasi_siswa');?>">Tambah Spesialisasi Siswa</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>


        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Tambah Data Jurusan</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
             <div class="row">
                <div class="col-lg-12">
                    <div>
                        <a href="<?php echo site_url('sipo/dashboard_admin/beranda');?>">Home</a> -> Tambah Data Jurusan
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                        </div>
                        <!-- /.panel-heading -->
                         <div class="panel-body">
                         <div class="dataTable_wrapper">
                       <?php
							echo $pesan."<br/><br/>";
							echo form_open('sipo/dashboard_admin/proses_tambah_jurusan');
						?>
						<table>
							<tr valign="top">
								<td>Nama Jurusan</td>
								<td>:</td>
								<td>
									<input type="text" name="nama" required/>
									<?php
										echo form_error('nama', '<div style="color:red">','</div>');
									?>
								</td>
							</tr>
							<tr>
								<td colspan="3">
									<br/>
									<input type="submit" name="submit" value="Tambah"/>
								</td>
							</tr>
						</table>
						<?php echo form_close();?>
					</div>
					</div>
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
        </div>
        <!-- /#page-wrapper -->
         <!-- /#wrapper -->
    <link href="<?php echo base_url('assets/plugin/dist/css/sb-admin-2.css');?>" rel="stylesheet">

    <!-- jQuery -->
    <script src="<?php echo base_url('assets/plugin/bower_components/jquery/dist/jquery.min.js');?>"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url('assets/plugin/bower_components/bootstrap/dist/js/bootstrap.min.js');?>"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url('assets/plugin/bower_components/metisMenu/dist/metisMenu.min.js');?>"></script>

    <!-- DataTables JavaScript -->
    <script src="<?php echo base_url('assets/plugin/bower_components/DataTables/media/js/jquery.dataTables.min.js');?>"></script>
    <script src="<?php echo base_url('assets/plugin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js');?>"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url('assets/plugin/dist/js/sb-admin-2.js');?>"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
    </script>
</body>
</html>