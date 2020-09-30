<html>
    <head>

    </head>
    <body>
        <h1>LAPORAN KEGIATAN</h1>
        <table>
            <tbody>
                <tr>
                    <td width="150">
                        <strong>PARALEGAL</strong>
                    </td>
                    <td>{{$kegiatan->name}}</td>
                </tr>
                <tr>
                    <td width="150">
                        <strong>PEMOHON</strong>
                    </td>
                    <td>{{$kegiatan->pemohon}}</td>
                </tr>
                <tr>
                    <td>
                        <strong>JENIS KEGIATAN</strong>
                    </td>
                    <td>{{$kegiatan->nama_jenis}}</td>
                </tr>
                <tr>
                    <td>
                        <strong>NAMA KEGIATAN</strong>
                    </td>
                    <td>{{$kegiatan->nama_kegiatan}}</td>
                </tr>
                <tr>
                    <td>
                        <strong>REKOMENDASI KEGIATAN</strong>
                    </td>
                    <td>{{$kegiatan->rekomendasi_kegiatan}}</td>
                </tr>
                <tr>
                    <td>
                        <strong>TEMPAT</strong>
                    </td>
                    <td>{{$kegiatan->tempat}}</td>
                </tr>
                <tr>
                    <td>
                        <strong>TANGGAL</strong>
                    </td>
                    <td>{{$kegiatan->tanggal}}</td>
                </tr>
            </tbody>
        </table>        
    </body>
</html>