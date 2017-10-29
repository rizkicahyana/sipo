<html>
	<head>
		<title>Ubah Data Akun | SIPO</title>
	</head>
	<body>
		<h2>Form Ubah Data Mahasiswa</h2>
		<?php
			echo form_open('mahasiswa/edit_data_mahasiswa');
			echo "
				NIM: <input type='text' name='nim' value='$mahasiswa->nim' readonly/><br/>
				Nama: <input type='text' name='nama' value='$mahasiswa->nama' required/><br/>
				E-Mail: <input type='email' name='email' value='$mahasiswa->email' required/><br/><br/>
				<input type='submit' name='submit' value='Perbaharui'/>
			";
			echo form_close();
		?>
	</body>
</html>