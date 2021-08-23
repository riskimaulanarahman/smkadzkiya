<!DOCTYPE html>
<html>
<head>
	<title>Bukti Daftar Ulang PDF</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
	<center>
		<h3><u>SMK ADZKIYA BALIKPAPAN</u></h3>
		<h5><u>Bukti Daftar Ulang</u></h5><br><br>
	</center>

	<div class="row">

		<div style="font-size: 12px;">
            <ol>
                <li><b>No Daftar Ulang</b> : {{$data->nodu}}</li><br>
                <li><b>No Induk Siswa</b> : {{$data->users->nis}}</li><br>
                <li><b>Nama</b> : {{$data->users->nama_lengkap}}</li><br>
                <li><b>Kelas</b> : {{$data->users->kelas->nama_kelas}}</li><br>
                <li><b>Jurusan</b> : {{$data->users->jurusan->nama_jurusan}}</li><br>
                <li><b>Tahun Ajaran</b> : {{$data->users->tahunajaran->tahun_ajaran}}</li><br><br><br>
            </ol>
            <div style="font-size: 12px; float:right; padding-right: 50px;">
                <label>Balikpapan, {{ date_format($data->updated_at,"d-m-Y")}}</label><br>
                <label>Tanda Tangan Siswa,Ybs </label><br><br><br><br><br><br><img src="https://snipstock.com/assets/cdn/png/a0a8475b883eaf3900675886b63c1dad.png" width="190" height="100" style="position: absolute; z-index:-1;" alt=""><br>
                <label><b>( {{$data->users->nama_lengkap}} )</b></label><br>
            </div>
		</div>

		

	</div>

</body>
</html>