<template>
  <AdminLayout>
    <ModuleHeader>
      <template v-slot:icon>
        mdi-calendar-blank-multiple
      </template>
      <template v-slot:name>
        KEGIATAN INVESTIGASI PERKARA
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
          Halaman ini berisi daftar kegiatan investigasi perkara yang dilakukan oleh paralegal
        </v-alert>
      </template>
    </ModuleHeader>
    <v-container fluid v-if="Object.keys(data_kegiatan).length">
      <v-row>
        <v-col cols="12">
          <DK :datakegiatan="data_kegiatan" :path="'/kegiatan/investigasiperkara/' + kegiatan_id + '/detail'" />
        </v-col>
      </v-row>
      <v-row>
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
                  :href="this.$api.storageURL + '/' + data_kegiatan.file_dokumentasi_kegiatan"
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
          <v-form v-model="form_valid_sktm" ref="frmuploadsktm" lazy-validation>
            <v-card class="mx-auto" max-width="400">
              <v-img class="white--text align-end" height="200px" :src="sktmPemohon"></v-img>
              <v-card-title>
                SKTM PEMOHON
              </v-card-title>
              <v-card-text>
                <v-file-input 
                  accept="image/jpeg,image/png" 
                  label="(.png atau .jpg)"
                  :rules="rule_filesktm"
                  show-size
                  v-model="filesktmpemohon"
                  @change="previewImage"
                  v-if="dashboard=='paralegal'||dashboard=='kumham'||dashboard=='superadmin'"
                >
                </v-file-input>
              </v-card-text>
              <v-card-actions>
                <v-spacer/>
                <v-btn
                  color="orange"
                  text
                  @click="uploadSKTMPemohon"
                  :loading="btnLoadingUploadSKTM"
                  :disabled="!form_valid_sktm||btnLoadingUploadSKTM"
                  v-if="dashboard=='paralegal'||dashboard=='kumham'||dashboard=='superadmin'"
                >
                  Upload
                </v-btn>
                <v-btn
                  color="orange"
                  text
                  @click="hapusSKTMPemohon"
                  :loading="btnLoadingHapusSKTM"
                  :disabled="btnLoadingHapusSKTM"
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
          <v-form v-model="form_valid_ktp" ref="frmuploadktp" lazy-validation>
            <v-card class="mx-auto" max-width="400">
              <v-img class="white--text align-end" height="200px" :src="ktpPemohon"></v-img>
              <v-card-title>
                KTP PEMOHON
              </v-card-title>
              <v-card-text>
                <v-file-input 
                  accept="image/jpeg,image/png" 
                  label="(.png atau .jpg)"
                  :rules="rule_filektp"
                  show-size
                  v-model="filektppemohon"
                  @change="previewImageKTP"
                  v-if="dashboard=='paralegal'||dashboard=='kumham'||dashboard=='superadmin'"
                >
                </v-file-input>
              </v-card-text>
              <v-card-actions>
                <v-btn
                  color="green"
                  text
                  :href="this.$api.storageURL + '/' + data_kegiatan.file_fotocopy_ktp"
                  v-if="data_kegiatan.file_fotocopy_ktp"
                >
                  Lihat
                </v-btn>
                <v-spacer/>
                <v-btn
                  color="orange"
                  text
                  @click="uploadKtpPemohon"
                  :loading="btnLoadingUploadKTP"
                  :disabled="!form_valid_ktp||btnLoadingUploadKTP"
                  v-if="dashboard=='paralegal'||dashboard=='kumham'||dashboard=='superadmin'"
                >
                  Upload
                </v-btn>
                <v-btn
                  color="orange"
                  text
                  @click="hapusKtpPemohon"
                  :loading="btnLoadingHapusKTP"
                  :disabled="btnLoadingHapusKTP"
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
  import DK from '@/views/pages/admin/investigasiperkara/DataKegiatanInvestigasiPerkara';
  export default {
    name: 'KegiatanInvestigasiPerkaraFiles',
    created() {
      this.dashboard = this.$store.getters['uiadmin/getDefaultDashboard']
      this.kegiatan_id=this.$route.params.kegiatan_id
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
          text: 'INVESTIGASI PERKARA',
          disabled: false,
          href: '/kegiatan/investigasiperkara/' + this.kegiatan_id + '/detail'
        },
        {
          text: 'FILES',
          disabled: true,
          href: '#',
        }
      ]
      this.initialize()
    },
    data: () => ({
      dashboard: null,

      kegiatan_id: null,
      data_kegiatan: {},

      btnLoadingUploadKTP: false,
      btnLoadingHapusKTP: false,

      btnLoadingUploadDokumentasiKegiatan: false,
      btnLoadingHapusDokumentasiKegiatan: false,

      btnLoadingUploadSKTM: false,
      btnLoadingHapusSKTM: false,

      //formdata
      form_valid_sktm: true,
      form_valid_ktp: true,
      form_valid_dokumentasi_kegiatan: true,

      image_prev_ktp: null,
      image_prev: null,
      filektppemohon: null,
      filedokumentasikegiatan: null,
      filesktmpemohon: null,
      
      rule_filektp: [
        value => !!value || "Mohon pilih file ktp pemohon !!!",  
        value => {
          if (value && typeof value !== 'undefined' && value.length > 0) {
            return value.size < 2000000 || 'File ktp pemohon harus kurang dari 2MB.'
          } else {
            return true
          }
        }
      ],
      rule_filedokumentasikegiatan: [
        value => !!value || "Mohon pilih file dokumentasi kegiatan !!!",
        value =>!value || value.size < 9000000 || 'File dokumentasi kegiatan harus kurang dari 9MB.'                
      ],
      rule_filesktm: [
        value => !!value || "Mohon pilih file sktm pemohon !!!",
        value => {
          if (value && typeof value !== 'undefined' && value.length > 0) {
            return value.size < 2000000 || 'File sktm pemohon harus kurang dari 2MB.'
          } else {
            return true
          }
        }
      ],
    }),
    methods: {
      initialize: async function() {
        await this.$ajax.get('/kegiatan/investigasiperkara/' + this.kegiatan_id, {
          headers: {
            Authorization: this.$store.getters['auth/Token'],
          }
        })
        .then(({ data }) => {
          this.data_kegiatan = data.kegiatan          
          this.sktmPemohon=this.$api.storageURL + '/' + data.kegiatan.file_fotocopy_sktm
          this.filektppemohon=this.$api.storageURL + '/' + data.kegiatan.file_fotocopy_ktp
          this.ktpPemohon=this.$api.storageURL + '/' + data.kegiatan.file_fotocopy_ktp
        })
      },
      previewImageKTP(e) {
        if (typeof e === 'undefined') {
          this.image_prev_ktp = null
        } else {
          let reader = new FileReader()
          reader.readAsDataURL(e)
          reader.onload = img => {
            this.image_prev_ktp = img.target.result;
          }
        }
      }, 
      previewImage(e) {
        if (typeof e === 'undefined') {
          this.image_prev = null
        } else {
          let reader = new FileReader()
          reader.readAsDataURL(e)
          reader.onload = img => {
            this.image_prev = img.target.result
          }
        }
      }, 
      async uploadSKTMPemohon() {
        if (this.$refs.frmuploadsktm.validate())
        {
          if (typeof this.filesktmpemohon !== 'undefined' && this.filesktmpemohon !== null){
            this.btnLoadingUploadSKTM = true
            var formdata = new FormData()
            formdata.append('filesktmpemohon', this.filesktmpemohon)
            await this.$ajax.post('/kegiatan/investigasiperkara/uploadsktmpemohon/' + this.kegiatan_id,formdata,
              {
                headers: {
                  Authorization: this.$store.getters['auth/Token'],
                  'Content-Type': 'multipart/form-data',
                }
              }
            ).then(() => {
              this.btnLoadingUploadSKTM = false
              this.btnLoadingHapusSKTM = false
              this.$router.go() 
            }).catch(() => {
              this.btnLoadingUploadSKTM = false
              this.btnLoadingHapusSKTM = false
            })
          }
        }
      }, 
      async hapusSKTMPemohon()
      {

      },
     async uploadKtpPemohon() {
        if (this.$refs.frmuploadktp.validate())
        {
          if (typeof this.filektppemohon !== 'undefined' && this.filektppemohon !== null){
            this.btnLoadingUploadKTP = true
            var formdata = new FormData()
            formdata.append('filektppemohon', this.filektppemohon)
            await this.$ajax.post('/kegiatan/investigasiperkara/uploadktppemohon/' + this.kegiatan_id,formdata,
              {
                headers: {
                  Authorization: this.$store.getters['auth/Token'],
                  'Content-Type': 'multipart/form-data',
                }
              }
            ).then(() => {
              this.btnLoadingUploadKTP = false
              this.btnLoadingHapusKTP = false
              this.$router.go() 
            }).catch(() => {
              this.btnLoadingUploadKTP = false
              this.btnLoadingHapusKTP = false
            })
          }
        }
      }, 
      async hapusKtpPemohon() {},
      async uploadDokumentasiKegiatan() {
        if (this.$refs.frmuploaddokumentasikegiatan.validate()) {
          if (typeof this.filedokumentasikegiatan !== 'undefined' && this.filedokumentasikegiatan !== null )
          {
            this.btnLoadingUploadDokumentasiKegiatan=true
            var formdata = new FormData()
            formdata.append('filedokumentasikegiatan', this.filedokumentasikegiatan)
            await this.$ajax
              .post(
                '/kegiatan/investigasiperkara/uploaddokumentasikegiatan/' +
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
          if (this.image_prev_ktp == null) {
            return require('@/assets/no-image.png')
          } else {
            return this.image_prev_ktp
          }
        },
        set(val) {
          this.image_prev_ktp = val
        },
      },
      sktmPemohon: {
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
