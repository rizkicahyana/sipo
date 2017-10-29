<?php
	foreach($siswa as $data){
		$nis = $data->nis;
		$nama = $data->nama;
		$email = $data->email;
		$tempat = $data->tempat;
		$tanggal_lahir = $data->tanggal_lahir;
		$alamat = $data->alamat;
	}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Data Bahan Ajar | SIPO</title>
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
                
                <a class="navbar-brand" href="<?php echo site_url('sipo/dashboard_siswa/beranda');?>">Dasboard Siswa</a>

            </div>

            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="<?php echo site_url('sipo/dashboard_siswa/lihat_siswa');?>"><i class=""></i>Lihat Data Akun</a></li>
                        <li><a href="<?php echo site_url('sipo/dashboard_siswa/keluar');?>"><i class="fa fa-sign-out fa-fw"></i> Keluar</a></li>
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
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i>Data Akun Siswa<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
									<a href="<?php echo site_url('sipo/dashboard_siswa/lihat_siswa');?>">Lihat Data Akun</a><br/><br/>
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
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i>Data Bahan Ajar<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
									<a href="<?php echo site_url('sipo/dashboard_siswa/pre_lihat_bahan_ajar/');?>">Lihat Bahan Ajar</a><br/>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Tabel Data Bahan Ajar</h1>
                    Mata Pelajaran yang diambil
                </div>
                <!-- /.col-lg-12 -->
            </div>
             <div class="row">
                <div class="col-lg-12">
                    <div>
                        <a href="<?php echo site_url('sipo/dashboard_siswa/beranda');?>">Dashboard Siswa</a> -> Lihat Data Bahan Ajar
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
									foreach($spesialisasi_siswa as $data){
										echo "<a href='".site_url('sipo/dashboard_siswa/lihat_bahan_ajar/'.$data->id_spesialisasi)."'>".$data->nama_mapel."</a><br/>";
									}
								?>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
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