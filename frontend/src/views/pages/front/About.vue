<template>
  <FrontLayout>
    <v-container fluid>
      <v-row>
        <v-col cols="8">
          <h2 class="subheading text-uppercase font-weight-medium mb-3">
            About
          </h2>
          <p class="font-weight-regular">
            Aplikasi Sistem Elektronik Paralegal Masyarakat (SEPAKAT) merupakan rancangan aksi perubahan Pendidikan Kepemimpinan Pengawas Angkatan CXCII Tahun Anggaran 2020,yang disusun oleh Kasubid Penyuluhan Hukum Bantuan Hukum dan JDIH Kanwil Kemenkumham Kepulauan Riau bekerjasama dengan  Sekolah Tinggi Teknologi Indonesia Tanjungpinang.                   
          </p>
          <p>
            SEPAKAT merupakan wujud komitmen Kanwil Kemenkumham Kepulauan Riau dalam meningkatkan pembinaan hukum dan kesadaran hukum masyarakat Provinsi Kepulauan Riau melalui pemberdayaan masyarakat dengan peran paralegal masyarakat yang dibina oleh Kanwil KemenkumhamKepulauan Riau dan stakeholder terkait yaitu Pemerintah Daerah dan LBH Terakreditasi.  SEPAKAT adalah solusi terbaik dalam menjawab kendala pelayanan publik yang terbatas dari sisi kondisi geografis dan juga sumber daya manusia pelaksana pelayanan publik, khususnya dalam hal perluasan informasi hukum dan peningkatan kesadaran hukum di masyarakat. 
          </p>
        </v-col>
        <v-col cols="8">
          <h2 class="subheading text-uppercase font-weight-medium mb-3">
            Dowload
          </h2>
          <table width="600">
            <thead>
              <th>Nama</th>
              <th>Versi</th>
              <th>Tanggal</th>
              <th>&nbsp;</th>
            </thead>
            <tbody>
              <tr>
                <td>Sepakat Mobile</td>
                <td>Versi 1.0</td>
                <td>08/06/2022</td>
                <td>
                  <v-btn
                    text
                    color="primary"
                    :href="this.$api.storageURL + '/storage/files/sepakat_v1.apk'"
                  >
                    Download
                  </v-btn>
                </td>
              </tr>
              <tr>
                <td>Template Formulir</td>
                <td>Versi 1.0</td>
                <td>06/06/2022</td>
                <td>
                  <v-btn
                    text
                    color="primary"
                    :href="this.$api.storageURL + '/storage/files/formulir.zip'"
                  >
                    Download
                  </v-btn>
                </td>
              </tr>
            </tbody>
          </table> 
        </v-col>
      </v-row>
    </v-container>
    
  </FrontLayout>
</template>
<script>
  import FrontLayout from '@/views/layouts/FrontLayout'
  export default {
    name: 'About',
    components: {
      FrontLayout,
    },
  }
</script>
