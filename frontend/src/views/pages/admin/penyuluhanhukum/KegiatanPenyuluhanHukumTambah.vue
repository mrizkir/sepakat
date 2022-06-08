<template>
  <AdminLayout>
    <ModuleHeader>
      <template v-slot:icon>
        mdi-calendar-blank-multiple
      </template>
      <template v-slot:name>
        KEGIATAN PENYULUHAN HUKUM
      </template>
      <template v-slot:breadcrumbs>
        <v-breadcrumbs :items="breadcrumbs" class="pa-0">
          <template v-slot:divider>
            <v-icon>mdi-chevron-right</v-icon>
          </template>
        </v-breadcrumbs>
      </template>
      <template v-slot:desc>
        <v-alert color="cyan" border="left" colored-border type="info">
          Halaman ini berisi daftar kegiatan penyuluhan hukum paralegal
        </v-alert>
      </template>
    </ModuleHeader> 
    <v-form ref="frmdata" v-model="form_valid" lazy-validation>
      <v-container fluid> 
        <v-row>
          <v-col cols="12"> 
            <v-card>
              <v-card-title>
                <span class="headline">TAMBAH KEGIATAN</span>
                <v-divider
                  class="mx-4"
                  inset
                  vertical
                ></v-divider>
                <v-spacer></v-spacer>
                <v-icon                
                  @click.stop="$router.push('/kegiatan/penyuluhanhukum/')">
                  mdi-close-thick
                </v-icon>
              </v-card-title>
              <v-card-text>
                <v-select
                  label="PARALEGAL"
                  :items="daftar_paralegal"
                  v-model="formdata.user_id"
                  item-text="name"
                  item-value="id"
                  outlined
                  dense
                />
                <v-text-field
                  label="TEMA PENYULUHAN HUKUM"
                  v-model="formdata.nama_kegiatan"
                  :rules="rule_nama_kegiatan"
                  outlined
                  dense
                />
                <v-text-field
                  label="TEMPAT PELAKSANAAN"
                  v-model="formdata.tempat_pelaksanaan"
                  :rules="rule_tempat"
                  outlined
                  dense
                />
                <v-menu
                  ref="menuTanggalPelaksanaan"
                  v-model="menuTanggalPelaksanaan"
                  :close-on-content-click="false"
                  :return-value.sync="formdata.tanggal_pelaksanaan"
                  transition="scale-transition"
                  offset-y
                  max-width="290px"
                  min-width="290px"
                >
                  <template v-slot:activator="{ on }">
                    <v-text-field
                      v-model="formdata.tanggal_pelaksanaan"
                      label="TANGGAL PELAKSANAAN"
                      readonly
                      outlined
                      dense
                      :rules="rule_tanggal_pelaksanaan"
                      v-on="on"
                    ></v-text-field>
                  </template>
                  <v-date-picker
                    v-model="formdata.tanggal_pelaksanaan"
                    no-title                                
                    scrollable
                    >
                    <v-spacer></v-spacer>
                    <v-btn text color="primary" @click="menuTanggalPelaksanaan = false">Cancel</v-btn>
                    <v-btn text color="primary" @click="$refs.menuTanggalPelaksanaan.save(formdata.tanggal_pelaksanaan)">OK</v-btn>
                  </v-date-picker>
                </v-menu>
                <v-menu
                  ref="menuJamPelaksanaan"
                  v-model="menuJamPelaksanaan"
                  :close-on-content-click="false"
                  :nudge-right="40"
                  :return-value.sync="formdata.jam_pelaksanaan"
                  transition="scale-transition"
                  offset-y
                  max-width="290px"
                  min-width="290px">
                  <template v-slot:activator="{ on, attrs }">
                    <v-text-field
                      v-model="formdata.jam_pelaksanaan"
                      label="WAKTU PELAKSANAAN"
                      readonly
                      outlined
                      dense
                      :rules="rule_jam_pelaksanaan"
                      v-bind="attrs"
                      v-on="on"
                    ></v-text-field>
                  </template>
                  <v-time-picker
                    v-if="menuJamPelaksanaan"
                    v-model="formdata.jam_pelaksanaan"
                    full-width
                    format="24hr"
                    @click:minute="$refs.menuJamPelaksanaan.save(formdata.jam_pelaksanaan)"
                  ></v-time-picker>
                </v-menu>
                <v-text-field
                  label="NARA SUMBER"
                  v-model="formdata.narasumber"
                  :rules="rule_nara_sumber"
                  outlined
                  dense
                />
                <v-textarea
                  label="PESERTA"
                  v-model="formdata.peserta"
                  :rules="rule_peserta"
                  outlined
                  dense
                /> 
                <v-text-field
                  label="JUMLAH PESERTA"
                  v-model="formdata.jumlah_peserta"
                  :rules="rule_jumlah_peserta"
                  outlined
                  dense
                />
                <v-textarea
                  label="RINGKASAN PENYULUHAN"
                  v-model="formdata.uraian_kegiatan"
                  :rules="rule_uraian_kegiatan"
                  outlined
                  dense
                />
                <v-textarea
                  label="REKOMENDASI PARALEGAL"
                  v-model="formdata.rekomendasi_kegiatan"
                  :rules="rule_rekomendasi_kegiatan"
                  outlined
                  dense
                />
              </v-card-text>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" text @click.stop="closedialogfrm">BATAL</v-btn>
                <v-btn 
                  color="blue darken-1" 
                  text 
                  @click.stop="save" 
                  :loading="btnLoading"
                  :disabled="!form_valid || btnLoading">
                    SIMPAN
                </v-btn>
              </v-card-actions>
            </v-card>
          </v-col>
        </v-row>
      </v-container>
    </v-form>
  </AdminLayout>
</template>
<script>
import AdminLayout from '@/views/layouts/AdminLayout'
import ModuleHeader from '@/components/ModuleHeader'
export default {
  name: 'KegiatanPenyuluhanHukumTambah',
  created() {
    this.dashboard = this.$store.getters['uiadmin/getDefaultDashboard']
    this.breadcrumbs = [
      {
        text: 'HOME',
        disabled: false,
        href: '/dashboard/' + this.$store.getters['auth/AccessToken'],
      },
      {
        text: 'KEGIATAN',
        disabled: false,
        href: '#',
      },
      {
        text: 'PENYULUHAN HUKUM',
        disabled: false,
        href: '/kegiatan/penyuluhanhukum'
      },
      {
        text: 'TAMBAH',
        disabled: true,
        href: '#',
      }
    ];
    this.initialize()
  },
  data: () => ({ 
    dashboard: null,
    
    btnLoading: false,
    form_valid: true, 
    daftar_paralegal: [],
    menuTanggalPelaksanaan: false,
    menuJamPelaksanaan: false, 
    formdata: {
      user_id: null,
      nama_kegiatan: null,
      tempat_pelaksanaan: null,
      tanggal_pelaksanaan: null,
      jam_pelaksanaan: null,
      narasumber: null,
      peserta: null,
      jumlah_peserta: null,
      uraian_kegiatan: null,
      rekomendasi_kegiatan: null,
    },
    formdefault: {
      user_id: null,
      nama_kegiatan: null,
      tempat_pelaksanaan: null,
      tanggal_pelaksanaan: null,
      jam_pelaksanaan: null,
      narasumber: null,
      peserta: null,
      jumlah_peserta: null,
      uraian_kegiatan: null,
      rekomendasi_kegiatan: null,
    },
    rule_user_id: [
      value => !!value || "Mohon untuk dipilih paralegal !!!",
    ],
    rule_nama_kegiatan: [
      value => !!value || "Mohon untuk diisi nama tema penyuluhan hukum !!!", 
    ],
    rule_tempat: [
      value => !!value || "Mohon untuk diisi tempat kegiatan penyuluhan hukum !!!", 
    ],
    rule_tanggal_pelaksanaan: [
      value => !!value || "Mohon untuk diisi tanggal pelaksanaan kegiatan penyuluhan hukum !!!", 
    ],
    rule_jam_pelaksanaan: [
      value => !!value || "Mohon untuk diisi waktu kegiatan penyuluhan hukum !!!", 
    ],
    rule_nara_sumber: [
      value => !!value || "Mohon untuk diisi nama nara sumber penyuluhan hukum !!!", 
    ],
    rule_peserta: [
			value => !!value || "Daftar peserta pemohon mohon untuk diisi !!!"
		],
    rule_jumlah_peserta: [
			value => !!value || "Jumlah peserta mohon untuk diisi !!!"
		],
    rule_uraian_kegiatan: [
      value => !!value || "Mohon untuk diisi uraian kegiatan penyuluhan hukum !!!", 
    ],
    rule_rekomendasi_kegiatan: [
      value => !!value || "Mohon untuk diisi rekomendasi kegiatan penyuluhan hukum !!!", 
    ],
  }),
  methods: {
    initialize: async function() 
    {
      await this.$ajax.get('/system/usersparalegal', {
        headers: {
          Authorization: this.$store.getters['auth/Token'],
        }
      }).then(({ data }) => {
        this.daftar_paralegal = data.users
      })
    },
    save: async function() {
      if (this.$refs.frmdata.validate())
      {
        this.btnLoading = true
        await this.$ajax.post('/kegiatan/penyuluhanhukum/store',
          {
            user_id: this.formdata.user_id,
            nama_kegiatan: this.formdata.nama_kegiatan,
            tempat_pelaksanaan: this.formdata.tempat_pelaksanaan,
            tanggal_pelaksanaan: this.formdata.tanggal_pelaksanaan,
            jam_pelaksanaan: this.formdata.jam_pelaksanaan,
            narasumber: this.formdata.narasumber,
            peserta: this.formdata.peserta,
            jumlah_peserta: this.formdata.jumlah_peserta,
            uraian_kegiatan: this.formdata.uraian_kegiatan,
            rekomendasi_kegiatan: this.formdata.rekomendasi_kegiatan,
          },
          {
            headers: {
              Authorization: this.$store.getters['auth/Token'],
            }
          }
        ).then(({ data }) => {
          this.btnLoading = false
          setTimeout(() => {
            this.formdata = Object.assign({}, this.formdefault)
            this.$router.push('/kegiatan/penyuluhanhukum/' + data.kegiatan.id + '/files')
            }, 300
          );
        }).catch(() => {
          this.btnLoading = false
        })
      }
    },
    closedialogfrm() {
      setTimeout(() => {
        this.formdata = Object.assign({}, this.formdefault)
        this.$router.push('/kegiatan/penyuluhanhukum')
        }, 300
      );
    },
  },
  components: {
    AdminLayout,
    ModuleHeader,
  },
}
</script>
