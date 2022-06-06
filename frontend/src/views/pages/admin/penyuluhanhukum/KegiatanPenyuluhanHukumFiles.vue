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
          Halaman ini berisi daftar kegiatan penyuluhan hukum yang dilakukan oleh paralegal
        </v-alert>
      </template>
    </ModuleHeader>
    <v-container fluid v-if="Object.keys(data_kegiatan).length">
      <v-row>
        <v-col cols="12">
          <DK :datakegiatan="data_kegiatan" path="/kegiatan/penyuluhanhukum" />
        </v-col>
      </v-row>
      <v-row>
        <v-col xs="12" sm="6" md="4">
          <v-form v-model="form_valid_daftar_hadir" ref="frmuploaddaftarhadir" lazy-validation>
            <v-card>
              <v-card-title>
                DAFTAR HADIR
              </v-card-title>
              <v-card-text>
                <v-file-input 
                  accept="application/pdf,image/jpeg,image/png" 
                  label="(.pdf, .png, atau .jpg)"
                  :rules="rule_filedaftarhadir"
                  show-size
                  v-model="filedaftarhadir"
                  v-if="dashboard=='paralegal'||dashboard=='kumham'||dashboard=='superadmin'">
                </v-file-input>
              </v-card-text>
              <v-card-actions>
                <v-btn
                  color="green"
                  text
                  :href="this.$api.storageURL+'/'+data_kegiatan.file_daftar_hadir"
                  v-if="data_kegiatan.file_daftar_hadir"
                >
                  Lihat
                </v-btn>
                <v-spacer/>
                <v-btn
                  color="orange"
                  text
                  @click="uploadDaftarHadir"
                  :loading="btnLoadingUploadDaftarHadir"
                  :disabled="!form_valid_daftar_hadir||btnLoadingUploadDaftarHadir"
                  v-if="dashboard=='paralegal'||dashboard=='kumham'||dashboard=='superadmin'"
                >
                  Upload
                </v-btn>
                <v-btn
                  color="orange"
                  text
                  @click="hapusDaftarHadir"
                  :loading="btnLoadingHapusDaftarHadir"
                  :disabled="btnLoadingHapusDaftarHadir"
                  v-if="false"
                >
                  Hapus
                </v-btn>
              </v-card-actions>
            </v-card>
          </v-form>
        </v-col>
        <v-responsive width="100%" v-if="$vuetify.breakpoint.xsOnly" />
        <v-col xs="12" sm="6" md="4">
          <v-form v-model="form_valid_dokumentasi_kegiatan" ref="frmuploaddokumentasikegiatan" lazy-validation>
            <v-card>
              <v-card-title>
                DOKUMENTASI KEGIATAN
              </v-card-title>
              <v-card-text>
                <v-file-input 
                  accept="application/pdf,image/jpeg,image/png" 
                  label="(.pdf, .png, atau .jpg)"
                  :rules="rule_filedokumentasikegiatan"
                  show-size
                  v-model="filedokumentasikegiatan"
                  v-if="dashboard=='paralegal'||dashboard=='kumham'||dashboard=='superadmin'"
                >
                </v-file-input>
              </v-card-text>
              <v-card-actions>
                <v-btn
                  color="green"
                  text
                  :href="this.$api.storageURL+'/'+data_kegiatan.file_dokumentasi_kegiatan"
                  v-if="data_kegiatan.file_dokumentasi_kegiatan"
                >
                  Lihat
                </v-btn>
                <v-spacer/>
                <v-btn
                  color="orange"
                  text
                  @click="uploadDokumentasiKegiatan"
                  :loading="btnLoadingUploadDokumentasiKegiatan"
                  :disabled="!form_valid_dokumentasi_kegiatan||btnLoadingUploadDokumentasiKegiatan"
                  v-if="dashboard=='paralegal'||dashboard=='kumham'||dashboard=='superadmin'"
                >
                  Upload
                </v-btn>
                <v-btn
                  color="orange"
                  text
                  @click="hapusDokumentasiKegiatan"
                  :loading="btnLoadingHapusDokumentasiKegiatan"
                  :disabled="btnLoadingHapusDokumentasiKegiatan"
                  v-if="false"
                >
                  Hapus
                </v-btn>
              </v-card-actions>
            </v-card>
          </v-form>
        </v-col>
        <v-responsive width="100%" v-if="$vuetify.breakpoint.xsOnly" />
        <v-col xs="12" sm="6" md="4">
          <v-form v-model="form_valid_surat_permohonan" ref="frmsuratpermohonan" lazy-validation>
            <v-card class="mx-auto" max-width="400">            
              <v-card-title>
                PERMOHONAN NARA SUMBER
              </v-card-title>
              <v-card-text>
                <v-file-input 
                  accept="application/pdf,image/jpeg,image/png" 
                  label="(.pdf, .png, atau .jpg)"
                  :rules="rule_surat_permohonan"
                  show-size
                  v-model="file_surat_permohonan"
                  v-if="dashboard=='paralegal'||dashboard=='kumham'||dashboard=='superadmin'"
                >
                </v-file-input>
              </v-card-text>
              <v-card-actions>
                <v-btn
                  color="green"
                  text
                  :href="this.$api.storageURL+'/'+data_kegiatan.file_surat_permohonan"
                  v-if="data_kegiatan.file_surat_permohonan"
                >
                  Lihat
                </v-btn>
                <v-spacer/>
                <v-btn
                  color="orange"
                  text
                  @click="uploadSuratPermohonan"
                  :loading="btnLoadingSuratPermohonan"
                  :disabled="!form_valid_surat_permohonan||btnLoadingSuratPermohonan"
                  v-if="dashboard=='paralegal'||dashboard=='kumham'||dashboard=='superadmin'"
                >
                  Upload
                </v-btn>
                <v-btn
                  color="orange"
                  text
                  @click="hapusSuratPermohonan"
                  :loading="btnLoadingHapusSuratPermohonan"
                  :disabled="btnLoadingHapusSuratPermohonan"
                  v-if="false"
                >
                  Hapus
                </v-btn>
              </v-card-actions>
            </v-card>
          </v-form>
        </v-col>
        <v-responsive width="100%" v-if="$vuetify.breakpoint.xsOnly" />
      </v-row>
    </v-container>
  </AdminLayout>
</template>
<script>
  import AdminLayout from '@/views/layouts/AdminLayout'
  import ModuleHeader from '@/components/ModuleHeader'
  import DK from '@/views/pages/admin/penyuluhanhukum/DataKegiatanPenyuluhanHukum';
  export default {
    name: 'KegiatanPenyuluhanHukumFiles',
    created() {
      this.dashboard = this.$store.getters['uiadmin/getDefaultDashboard']
      this.kegiatan_id=this.$route.params.kegiatan_id;
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
          href: '/kegiatan/penyuluhanhukum/' + this.kegiatan_id+'/detail'
        },
        {
          text: 'FILES',
          disabled: true,
          href: '#',
        }
      ];
      this.initialize()    
    },
    data: () => ({ 
      dashboard: null,

      kegiatan_id: null,
      data_kegiatan: {},

      btnLoadingUploadDaftarHadir: false,
      btnLoadingHapusDaftarHadir: false,

      btnLoadingUploadDokumentasiKegiatan: false,
      btnLoadingHapusDokumentasiKegiatan: false,

      btnLoadingSuratPermohonan: false,
      btnLoadingHapusSuratPermohonan: false,

      //formdata
      form_valid_surat_permohonan: true,
      form_valid_daftar_hadir: true,
      form_valid_dokumentasi_kegiatan: true,

      image_prev: null,
      filedaftarhadir: null,
      filedokumentasikegiatan: null,
      file_surat_permohonan: null,
      
      rule_filedaftarhadir: [
        value => !!value || "Mohon pilih file daftar hadir !!!",
        value =>!value || value.size < 9000000 || 'File daftar hadir harus kurang dari 9MB.'                
      ],
      rule_filedokumentasikegiatan: [
        value => !!value || "Mohon pilih file dokumentasi kegiatan !!!",
        value =>!value || value.size < 9000000 || 'File dokumentasi kegiatan harus kurang dari 9MB.'                
      ],
      rule_surat_permohonan: [
        value => !!value || "Mohon pilih file ktp pemohon !!!",
        value =>!value || value.size < 2000000 || 'File ktp pemohon harus kurang dari 2MB.'                
      ],
    }),
    methods: {
      initialize: async function() {
        await this.$ajax.get('/kegiatan/penyuluhanhukum/' + this.kegiatan_id,{
          headers: {
            Authorization: this.$store.getters['auth/Token']
          }
        })
        .then(({ data }) => {
          this.data_kegiatan=data.kegiatan;
          this.ktpPemohon=this.$api.storageURL+'/'+data.kegiatan.file_fotocopy_ktp
        })
      },
      async uploadSuratPermohonan() {
        if (this.$refs.frmsuratpermohonan.validate())
        {
          if (typeof this.file_surat_permohonan !== 'undefined' && this.file_surat_permohonan !== null){
            this.btnLoadingSuratPermohonan = true;
            var formdata = new FormData()
            formdata.append('filesuratpermohonan', this.file_surat_permohonan)
            await this.$ajax.post('/kegiatan/penyuluhanhukum/uploadsuratpermohonan/' + this.kegiatan_id,formdata,
              {
                headers: {
                  Authorization: this.$store.getters['auth/Token'],
                  'Content-Type': 'multipart/form-data'
                }
              }
            ).then(() => {
              this.btnLoadingSuratPermohonan = false
              this.btnLoadingHapusSuratPermohonan = false
              this.$router.go() 
            }).catch(() => {
              this.btnLoadingSuratPermohonan = false
              this.btnLoadingHapusSuratPermohonan = false
            })
          }
        }
      }, 
      async hapusSuratPermohonan()
      {

      },
      async uploadDaftarHadir()
      {
        if (this.$refs.frmuploaddaftarhadir.validate())
        {
          if (typeof this.filedaftarhadir !== 'undefined' && this.filedaftarhadir !== null )
          {
            this.btnLoadingUploadDaftarHadir=true;
            var formdata = new FormData()
            formdata.append('filedaftarhadir', this.filedaftarhadir)
            await this.$ajax.post('/kegiatan/penyuluhanhukum/uploaddaftarhadir/' + this.kegiatan_id,formdata,
              {
                headers: {
                  Authorization: this.$store.getters['auth/Token'],
                  'Content-Type': 'multipart/form-data'
                }
              }
            ).then(() => {
              this.btnLoadingUploadDaftarHadir = false
              this.btnLoadingHapusDaftarHadir = false
              this.$router.go() 
            }).catch(() => {
              this.btnLoadingUploadDaftarHadir = false
              this.btnLoadingHapusDaftarHadir = false
            })
          }
        }
      },
      async hapusDaftarHadir() {},
      async uploadDokumentasiKegiatan() {
        if (this.$refs.frmuploaddokumentasikegiatan.validate()) {
          if (typeof this.filedokumentasikegiatan !== 'undefined' && this.filedokumentasikegiatan !== null )
          {
            this.btnLoadingUploadDokumentasiKegiatan=true;
            var formdata = new FormData()
            formdata.append('filedokumentasikegiatan', this.filedokumentasikegiatan)
            await this.$ajax
              .post(
                '/kegiatan/penyuluhanhukum/uploaddokumentasikegiatan/' +
                  this.kegiatan_id,
                formdata,
                {
                  headers: {
                    Authorization: this.$store.getters['auth/Token'],
                    'Content-Type': 'multipart/form-data',
                  },
                }
              )
              .then(() => {
                this.btnLoadingUploadDokumentasiKegiatan = false
                this.btnLoadingHapusDokumentasiKegiatan = false
                this.$router.go()
              })
              .catch(() => {
                this.btnLoadingUploadDokumentasiKegiatan = false
                this.btnLoadingHapusDokumentasiKegiatan = false
              })
          }
        }
      },
      async hapusDokumentasiKegiatan() {},
    },
    computed: {
      ktpPemohon: {
        get() {
          if (this.image_prev == null) {
            return require('@/assets/no-image.png')
          } else {
            return this.image_prev
          }
        },
        set(val) {
          this.image_prev = val
        },
      },
    },
    components: {
      AdminLayout,
      ModuleHeader,
      DK,
    },
  }
</script>
