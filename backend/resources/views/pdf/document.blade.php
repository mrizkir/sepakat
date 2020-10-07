<html>
    <head>

    </head>
    <body>
        <h3 style="text-align:center">LAPORAN KEGIATAN PARALEGAL</h3>
        <table>
            <tbody>
                <tr>
                    <td width="20" style="padding-bottom: 10px;">
                        <strong>1.</strong>
                    </td>
                    <td style="padding-bottom: 10px;">
                        <strong>PARALEGAL</strong>
                    </td>
                    <td style="padding-bottom: 10px;">:</td>
                    <td style="padding-bottom: 10px;">{{$kegiatan->name}}</td>
                </tr>
                <tr>
                    <td style="padding-bottom: 10px;">
                        <strong>2.</strong>
                    </td>
                    <td style="padding-bottom: 10px;">
                        <strong>PEMOHON</strong>
                    </td>
                    <td style="padding-bottom: 10px;">:</td>
                    <td style="padding-bottom: 10px;">{{$kegiatan->pemohon}}</td>
                </tr>
                <tr>
                    <td style="padding-bottom: 10px;">
                        <strong>3.</strong>
                    </td>
                    <td style="padding-bottom: 10px;">
                        <strong>ALAMAT</strong>
                    </td>
                    <td style="padding-bottom: 10px;">:</td>
                    <td style="padding-bottom: 10px;">{{$kegiatan->tempat}}</td>
                </tr>
                <tr>
                    <td style="padding-bottom: 10px;">
                        <strong>4.</strong>
                    </td>
                    <td style="padding-bottom: 10px;">
                        <strong>TANGGAL</strong>
                    </td>
                    <td style="padding-bottom: 10px;">:</td>
                    <td style="padding-bottom: 10px;">{{$kegiatan->tanggal}}</td>
                </tr>
                <tr>
                    <td style="padding-bottom: 10px;">
                        <strong>5.</strong>
                    </td>
                    <td style="padding-bottom: 10px;">
                        <strong>WAKTU</strong>
                    </td>
                    <td style="padding-bottom: 10px;">:</td>
                    <td style="padding-bottom: 10px;">{{$kegiatan->waktu}}</td>
                </tr>
                <tr>
                    <td style="padding-bottom: 10px;">
                        <strong>6.</strong>
                    </td>
                    <td style="padding-bottom: 10px;">
                        <strong>JENIS KEGIATAN</strong>
                    </td>
                    <td style="padding-bottom: 10px;">:</td>
                    <td style="padding-bottom: 10px;">{{$kegiatan->nama_jenis}}</td>
                </tr>
                <tr>
                    <td style="padding-bottom: 10px;">
                        <strong>7.</strong>
                    </td>
                    <td style="padding-bottom: 10px;">
                        <strong>NAMA KEGIATAN</strong>
                    </td>
                    <td style="padding-bottom: 10px;">:</td>
                    <td style="padding-bottom: 10px;">{{$kegiatan->nama_kegiatan}}</td>
                </tr>
                <tr>
                    <td style="padding-bottom: 10px;">
                        <strong>8.</strong>
                    </td>
                    <td style="padding-bottom: 10px;">
                        <strong>URAIAN / KRONOLOGIS KEGIATAN</strong>
                    </td>
                    <td style="padding-bottom: 10px;">:</td>
                    <td style="padding-bottom: 10px;">{{$kegiatan->uraian_kegiatan}}</td>
                </tr>  
                <tr>
                    <td style="padding-bottom: 10px;">
                        <strong>9.</strong>
                    </td>
                    <td style="padding-bottom: 10px;">
                        <strong>REKOMENDASI PARALEGAL</strong>
                    </td>
                    <td style="padding-bottom: 10px;">:</td>
                    <td style="padding-bottom: 10px;">{{$kegiatan->rekomendasi_kegiatan}}</td>
                </tr>  
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3"></td>
                    <td style="text-align:center;font-weight:bold;">Kabupaten Bintan, {{$kegiatan->tanggal_ubah}}</td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align:center;font-weight:bold;padding-bottom:40px">&nbsp;</td>
                    <td style="text-align:center;font-weight:bold;padding-bottom:40px">Paralegal</td>
                </tr>                
                <tr>
                    <td colspan="3" style="text-align:center;font-weight:bold;padding-bottom:40px">&nbsp;</td>
                    <td style="text-align:center;font-weight:bold;padding-bottom:40px">&nbsp;</td>
                </tr>                
                <tr>
                    <td colspan="4" style="text-align:center;font-weight:bold;padding-left:50px">Mengetahui, </td>                    
                </tr>                
                <tr>
                    <td colspan="2" style="text-align:center;font-weight:bold;">Pembina </td>                    
                    <td colspan="2" style="text-align:center;font-weight:bold;">Kepala Desa </td>                    
                </tr>
            </tfoot>
        </table>        
    </body>
</html>