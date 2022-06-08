<template>
  <AdminLayout>		                   
    <v-container fluid>
      <v-row>
        <v-col cols="6">
          <v-card color="#1F7087" dark class="mb-2">
            <div class="d-flex flex-no-wrap justify-space-between">
              <div>
                <v-card-title class="headline">
                  JUMLAH PARALEGAL
                </v-card-title>
                <v-card-subtitle>Total : {{jumlah_paralegal}} Orang, Melaporkan Kegiatan: {{jumlah_paralegal_laporan}} Orang</v-card-subtitle>
                <v-card-actions>
                  <v-btn										
                    class="ml-2 mt-5"
                    outlined
                    rounded
                    small>
                    DETAIL
                  </v-btn>
                </v-card-actions>
              </div>
              <v-avatar
                class="ma-3"
                size="125"
                tile>
                <v-img src="https://cdn.vuetifyjs.com/images/cards/foster.jpg"></v-img>
              </v-avatar>
            </div>
          </v-card>
          <v-card color="#1F7087" dark class="mb-2">
            <div class="d-flex flex-no-wrap justify-space-between">
              <div>
                <v-card-title class="headline">
                  JUMLAH OBH
                </v-card-title>
                <v-card-subtitle>{{jumlah_obh}}</v-card-subtitle>
                <v-card-actions>
                  <v-btn										
                    class="ml-2 mt-5"
                    outlined
                    rounded
                    small>
                    DETAIL
                  </v-btn>
                </v-card-actions>
              </div>
              <v-avatar
                class="ma-3"
                size="125"
                tile>
                <v-img src="https://cdn.vuetifyjs.com/images/cards/foster.jpg"></v-img>
              </v-avatar>
            </div>
          </v-card>
          <v-card color="#1F7087" dark class="mb-2">
            <div class="d-flex flex-no-wrap justify-space-between">
              <div>
                <v-card-title class="headline">
                  JUMLAH KEPALA DESA
                </v-card-title>
                <v-card-subtitle>{{jumlah_kades}}</v-card-subtitle>
                <v-card-actions>
                  <v-btn										
                    class="ml-2 mt-5"
                    outlined
                    rounded
                    small>
                    DETAIL
                  </v-btn>
                </v-card-actions>
              </div>
              <v-avatar
                class="ma-3"
                size="125"
                tile>
                <v-img src="https://cdn.vuetifyjs.com/images/cards/foster.jpg"></v-img>
              </v-avatar>
            </div>
          </v-card>
        </v-col>
        <v-responsive width="100%" v-if="$vuetify.breakpoint.xsOnly"/>
        <v-col cols="6">
          <v-simple-table>
            <template v-slot:default>
              <thead>
                <tr>
                  <th class="text-left">
                    Jenis Kegiatan
                  </th>
                  <th class="text-left">
                    Jumlah
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr
                  v-for="item in data_jenis_kegiatan" :key="item.id_jenis"
                  >
                  <td>{{ item.nama_jenis }}</td>
                  <td>{{ item.jumlah }}</td>
                </tr>
              </tbody>
              <tfoot class="orange">
                <tr>
                  <td>Total Kegiatan</td>
                  <td>{{totalJenisKegiatan}}</td>
                </tr>
              </tfoot>
            </template>
          </v-simple-table>
        </v-col>
        <v-responsive width="100%" v-if="$vuetify.breakpoint.xsOnly"/>
      </v-row>
    </v-container>
  </AdminLayout>
</template>
<script>
import AdminLayout from '@/views/layouts/AdminLayout'
export default {
  name: 'Dashboard',
  created()
  {
    this.TOKEN = this.$route.params.token
    this.breadcrumbs = [
      {
        text: 'HOME',
        disabled: false,
        href: '/dashboard/' + this.TOKEN
      },
      {
        text: 'DASHBOARD',
        disabled: true,
        href: '#',
      }
    ]		
    this.initialize()
    this.fetchData();

  },
  data: () => ({
    breadcrumbs: [],
    TOKEN: null,
    dashboard: null,

    tahun_pendaftaran: null,

    data_jenis_kegiatan: [],
    jumlah_paralegal: 0,
    jumlah_paralegal_laporan: 0,
    jumlah_obh: 0,
    jumlah_kades: 0,
  }),
  methods : {
    initialize: async function()
    {	
      
      await this.$ajax.get('/auth/me',
      {
        headers: {
          Authorization: 'Bearer '+this.TOKEN
        }
      }).then(({ data }) => {
        this.dashboard = data.role[0]
        this.$store.dispatch('uiadmin/changeDashboard',this.dashboard)
      })
      this.$store.dispatch('uiadmin/init',this.$ajax)
      this.tahun_pendaftaran = this.$store.getters['uiadmin/getTahunPendaftaran']
      
    },
    async fetchData ()
    {
      await this.$ajax.get('/dashboard',
      {
        headers: {
          Authorization: 'Bearer '+this.TOKEN
        }
      }).then(({ data }) => {
        this.data_jenis_kegiatan=data.jenis_kegiatan;
        this.jumlah_paralegal=data.jumlah_paralegal;
        this.jumlah_paralegal_laporan=data.jumlah_paralegal_laporan;
        this.jumlah_obh=data.jumlah_obh;
        this.jumlah_kades=data.jumlah_kades;
        
      })
    }
  },
  computed: {
    totalJenisKegiatan ()
    {
      var total=0;
      var index;
      for (index in this.data_jenis_kegiatan)
      {
        total = total + parseInt(this.data_jenis_kegiatan[index].jumlah);
      }
      return total;
    }
  },
  components: {
    AdminLayout,
  }
}
</script>