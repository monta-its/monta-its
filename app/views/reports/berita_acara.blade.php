<!-- 
    Styling CSS di file yang dicetak dengan DOMPDF 
    sedikit berbeda dengan CSS biasa. Tag 'table'
    merupakan elemen yang paling sering digunakan
    untuk mengatur layout halaman yang hendak
    dicetak.

    Bootstrap 3 tidak bekerja di DOMPDF ini. Oleh
    karena itu, untuk setiap jenis report harus
    memiliki format file/view HTML yang berbeda.
 -->
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="{{URL::to('assets/styles/normalize.css')}}" />
<style>
table{
    margin-left: auto !important;
    margin-right: auto !important;
    max-width: 700px;
}
table.bordered, table.bordered th, table.bordered td {
    border: 1px solid black;
}
h4 {
    padding-top: 15px;
    padding-bottom: 0px;
    margin-bottom: 0px;
}
.clear{
    clear: both;
}
.center{
    text-align: center !important;
}
.no-margin{
    margin: 0;
}
.no-margin-bottom{
    margin-bottom: 0;
}
#kop{
    height: 100px;
}
#logo-mesin{
    width: 100px;
}
#logo-its{
    width: 150px;
}
#departemen{
    text-align: center;
}
#departemen *{
    margin: 0;
}
#jenjang-jenis{
    text-align: center;
    margin: auto;
    margin-bottom: 10px;
    display: table;
}
#jenjang-jenis strong{
    padding: 5px;
    background: #B5E7FF;
    display: block;
    max-width: 80px;
}
#tugas-akhir{
    border: solid 1px black;
}
#tugas-akhir * {
    text-align: left;
    vertical-align: top;
    padding: 3px;
}
#daftar-penguji * {
    padding: 3px;
    vertical-align: middle;
}
#daftar-penguji tbody td {
    text-align: left;
}
</style>
</head>
<body>
<div id="page">
    
<table id="kop" class="center">
    <tbody>
        <tr>
            <td style="width: 9em;">
                <!-- {{URL::to('assets/images/logo-its-biru-transparan.png')}} -->
                <img id="logo-its" src="{{URL::to('assets/images/logo-its-biru-transparan-200.png')}}" alt="Logo ITS">
            </td>
            <td style="width: 20em;">
                <div id="departemen">
                    <h3>DEPARTEMEN PENDIDIKAN NASIONAL</h3>
                    <h3>INSTITUT TEKNOLOGI SEPULUH NOPEMBER</h3>
                    <h3>FAKULTAS TEKNOLOGI INDUSTRI</h3>
                    <h2>JURUSAN TEKNIK MESIN</h2>
                </div>
            </td>
            <td style="width: 9em;">
                <!-- {{URL::to('assets/images/logo-teknik-mesin.jpg')}} -->
                <img id="logo-mesin" src="{{URL::to('assets/images/logo-teknik-mesin-200.jpg')}}" alt="Logo Mesin">
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <p>Kampus ITS Keputih - Sukolilo Surabaya 60111, Telp. 5946230, Fax. 5922941</p>
            </td>
        </tr>
    </tbody>
</table>
<hr />
<h3 class="center" style="margin-bottom: 0; padding-bottom: 0;">Seminar Proposal Tugas Akhir Periode Semester Genap 2013 - 2014</h3>

<table class="center">
    <tbody>
        <tr>
            <td>
                <strong id="jenjang-jenis"><strong>S1-REG</strong></strong>
            </td>
        </tr>
    </tbody>
</table>
<br />
<table id="jadwal" class="bordered">
    <thead>
        <tr>
            <th style="width: 6em;">Hari</th>
            <th style="width: 10em;">Tanggal</th>
            <th style="width: 7em;">Jam</th>
            <th style="width: 5em;">Ruangan</th>
            <th style="width: 7em;">Bidang</th>
            <th style="width: 7em;">Seminar ke</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="center">Rabu</td>
            <td class="center">28 Mei 2014</td>
            <td class="center">09:00</td>
            <td class="center">A.210A</td>
            <td class="center">MT</td>
            <td class="center">1</td>
        </tr>
    </tbody>
</table>
<br />
<table id="tugas-akhir">
    <tbody>
        <tr>
            <td style="width: 8em;"><strong>Topik Proposal</strong></td>
            <td style="width: 1em;"><strong>:</strong></td>
            <td></td>
        </tr>
        <tr>
            <td><strong>Judul Proposal</strong></td>
            <td><strong>:</strong></td>
            <td>Analisa Pengaruh Perilaku Panas Austempering Terhadap Ketangguhan, Kekerasan dan Struktur Mikro FCD 600</td>
        </tr>
    </tbody>
</table>
<br />
<strong class="center" style="display: block; padding-top: 1px;">Daftar Hadir Mahasiswa</strong>
<table id="daftar-mahasiswa" class="bordered center">
    <thead>
        <tr>
            <th style="width: 9em;">NRP</th>
            <th style="width: 20em;">Nama Mahasiswa</th>
            <th style="width: 10em;">Tanda Tangan</th>
        </tr>
    </thead>
    <tbody>
        <tr style="line-height: 2.5;">
            <td>5111100098</td>
            <td>Ifan Iqbal</td>
            <td></td>
        </tr>
    </tbody>
</table>
<br />
<strong class="center" style="display: block; padding-top: 1px;">Daftar Hadir Tim Penguji</strong>
<table id="daftar-penguji" class="bordered">
    <thead>
        <tr>
            <th style="width: 2em;">No.</th>
            <th style="width: 25em;">Anggota Tim Penguji</th>
            <th style="width: 10em;">Tanda Tangan</th>
        </tr>
    </thead>
    <tbody>
        <tr style="line-height: 2.5;">
            <td class="center">#.</td>
            <td style="padding-left: 8px;">Nama Dosen Penguji, S.Gelar</td>
            <td><strong>#.</strong> </td>
        </tr>
        <tr style="line-height: 2.5;">
            <td class="center">#.</td>
            <td style="padding-left: 8px;">Nama Dosen Penguji, S.Gelar</td>
            <td><strong>#.</strong> </td>
        </tr>
        <tr style="line-height: 2.5;">
            <td class="center">#.</td>
            <td style="padding-left: 8px;">Nama Dosen Penguji, S.Gelar</td>
            <td><strong>#.</strong> </td>
        </tr>
        <tr style="line-height: 2.5;">
            <td class="center">#.</td>
            <td style="padding-left: 8px;">Nama Dosen Penguji, S.Gelar</td>
            <td><strong>#.</strong> </td>
        </tr>
    </tbody>
</table>
<br />
<strong class="center" style="display: block; padding-top: 1px;">Hasil Evaluasi Nilai Proposal Tugas Akhir</strong>
<table id="daftar-mahasiswa" class="bordered center">
    <thead>
        <tr>
            <th style="width: 9em;">NRP</th>
            <th style="width: 12em;">Nama Mahasiswa</th>
            <th style="width: 4em;">NA</th>
            <th style="width: 4em;">NH</th>
            <th style="width: 6em;">Kategori</th>
        </tr>
    </thead>
    <tbody>
        <tr style="line-height: 2;">
            <td>5111100098</td>
            <td>Ifan Iqbal</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </tbody>
</table>
<br />
<table class="center">
    <tbody>
        <tr>
            <td style="width: 15em;">
                <br />
                <br />
                <small>Nilai Pembimbing dan Penguji</small><br/>
                <br />
                <table class="center bordered">
                    <tbody>
                        <tr style="line-height: 1.8;">
                            <td style="width: 2em;">&nbsp;</td>
                            <td style="width: 2em;">&nbsp;</td>
                            <td style="width: 2em;">&nbsp;</td>
                            <td style="width: 2em;">&nbsp;</td>
                            <td style="width: 2em;">&nbsp;</td>
                        </tr>
                    </tbody>
                </table>
            </td>
            <td style="width: 6em;">&nbsp;</td>
            <td style="width: 20em;">
                Surabaya, 10 November 2014<br />
                <strong>Moderator / Pembimbing Proposal TA,</strong><br />
                <br />
                <br />
                <br />
                <br />
                <strong><u>Nama Moderator, S.Gelar</u></strong><br />
            </td>
        </tr>
    </tbody>
</table>
<br />
<table>
    <tbody>
        <tr style="vertical-align: center;">
            <td style="width: 25em;">
                <small><strong><u>Catatan:</u></strong></small><br />
                <small>- Absen dan Penilaian dikembalikan ke Pengajaran</small><br />
            </td>
            <td>
                <small><strong>Keterangan Kategori:</strong></small><br />
                <small>I. Lulus Proposal TA</small><br />
                <small>II. Tidak Lulus Proposal TA</small><br />
            </td>
        </tr>
    </tbody>
</table>
</div> <!-- #page -->
</body>
</html>