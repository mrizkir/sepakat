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
          Halaman ini berisi daftar kegiatan investigasi perkara hukum paralegal
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
                  @click.stop="$router.push('/kegiatan/investigasiperkara/')">
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
                  label="NAMA PEMOHON"
                  v-model="formdata.nama_pemohon"
                  :rules="rule_nama_pemohon"
                  outlined
                  dense
                />
                <v-text-field
                  label="TEMPAT LAHIR"
                  v-model="formdata.tempat_lahir"
                  :rules="rule_tempat_lahir"
                  outlined
                  dense
                />
                <v-menu
									ref="menuTanggalLahir"
									v-model="menuTanggalLahir"
									:close-on-content-click="false"
									:return-value.sync="formdata.tanggal_lahir"
									transition="scale-transition"
									offset-y
									max-width="290px"
									min-width="290px"
								>
									<template v-slot:activator="{ on }">
										<v-text-field
											v-model="formdata.tanggal_lahir"
											label="TANGGAL LAHIR"
											readonly
											outlined
                      dense
											v-on="on"
											:rules="rule_tanggal_lahir"
										></v-text-field>
									</template>
									<v-date-picker
										v-model="formdata.tanggal_lahir"
										no-title                                
										scrollable
										>
										<v-spacer></v-spacer>
										<v-btn text color="primary" @click="menuTanggalLahir = false">Cancel</v-btn>
										<v-btn text color="primary" @click="$refs.menuTanggalLahir.save(formdata.tanggal_lahir)">OK</v-btn>
									</v-date-picker>
								</v-menu>
                <v-text-field
                  label="PENDIDIKAN"
                  v-model="formdata.pendidikan"
                  :rules="rule_pendidikan"
                  outlined
                  dense
                />
                <v-text-field
                  label="PEKERJAAN"
                  v-model="formdata.pekerjaan"
                  :rules="rule_pekerjaan"
                  outlined
                  dense
                />
                <v-text-field
                  label="ALAMAT"
                  v-model="formdata.alamat"
                  :rules="rule_alamat"
                  outlined
                  dense
                />
                <v-divider class="mb-4" />
                <v-text-field
                  label="NAMA KEGIATAN"
                  v-model="formdata.nama_kegiatan"
                  :rules="rule_nama_kegiatan"
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
                  label="TEMPAT PELAKSANAAN"
                  v-model="formdata.tempat_pelaksanaan"
                  :rules="rule_tempat"
                  outlined
                  dense
                />
                <v-textarea
                  label="URAIAN SINGKAT INVESTIGASI"
                  v-model="formdata.uraian_kegiatan"
                  :rules="rule_uraian_kegiatan"
                  outlined
                  dense
                />
                <v-textarea
                  label="HASIL INVESTIGASI"
                  v-model="formdata.hasil_investigasi"
                  :rules="rule_hasil_investigasi"
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
                <v-textarea
                  label="RENCANA TINDAK LANJUT PASCA INVESTIGASI"
                  v-model="formdata.tindak_lanjut"
                  :rules="rule_tindak_lanjut"
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
    name: 'KegiatanInvestigasiPerkaraTambah',
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
          text: 'KEGIATAN',
          disabled: false,
          href: '/kegiatan/investigasiperkara'
        },
        {
          text: 'TAMBAH',
          disabled: true,
          href: '#',
        }
      ]
      this.initialize()
    },
    data: () => ({
      dashboard: null,
      
      btnLoading: false,
      form_valid: true, 
      daftar_paralegal: [],
      menuTanggalLahir: false,
      menuTanggalPelaksanaan: false,
      menuJamPelaksanaan: false, 
      formdata: {
        user_id: null,
        nama_pemohon: null,
        tempat_lahir: null,
        tanggal_lahir: null,
        pendidikan: null,
        pekerjaan: null,
        alamat: null,
        nama_kegiatan: null,
        tanggal_pelaksanaan: null,
        jam_pelaksanaan: null,
        tempat_pelaksanaan: null,
        uraian_kegiatan: null,
        hasil_investigasi: null,
        rekomendasi_kegiatan: null,
        tindak_lanjut: null,
      },
      formdefault: {
        user_id: null,
        nama_pemohon: null,
        tempat_lahir: null,
        tanggal_lahir: null,
        pendidikan: null,
        pekerjaan: null,
        alamat: null,
        nama_kegiatan: null,
        tanggal_pelaksanaan: null,
        jam_pelaksanaan: null,
        tempat_pelaksanaan: null,
        uraian_kegiatan: null,
        hasil_investigasi: null,
        rekomendasi_kegiatan: null,
        tindak_lanjut: null,
      },
      rule_user_id: [
        value => !!value || "Mohon untuk dipilih paralegal !!!",
      ],
      rule_nama_pemohon: [
        value => !!value || "Mohon untuk diisi nama pemohon kegiatan investigasi perkara !!!", 
      ],
      rule_tempat_lahir: [
        value => !!value || "Tempat Lahir pemohon mohon untuk diisi !!!"
      ],
      rule_tanggal_lahir: [
        value => !!value || "Tanggal Lahir pemohon mohon untuk diisi !!!"
      ],
      rule_pendidikan: [
        value => !!value || "Tingkat pendidikan pemohon mohon untuk diisi !!!"
      ],
      rule_pekerjaan: [
        value => !!value || "Pekerjaan pemohon mohon untuk diisi !!!"
      ],
      rule_alamat: [
        value => !!value || "Alamat pemohon mohon untuk diisi !!!"
      ],
      rule_nama_kegiatan: [
        value => !!value || "Mohon untuk diisi nama kegiatan investigasi perkara !!!", 
      ],
      rule_tanggal_pelaksanaan: [
        value => !!value || "Mohon untuk diisi tanggal pelaksanaan kegiatan investigasi perkara !!!", 
      ],
      rule_jam_pelaksanaan: [
        value => !!value || "Mohon untuk diisi waktu kegiatan investigasi perkara !!!", 
      ],
      rule_tempat: [
        value => !!value || "Mohon untuk diisi tempat kegiatan investigasi perkara !!!", 
      ],
      rule_uraian_kegiatan: [
        value => !!value || "Mohon untuk diisi uraian kegiatan investigasi perkara !!!", 
      ],
      rule_hasil_investigasi: [
        value => !!value || "Mohon untuk diisi hasil investigasi perkara yang diberikan !!!", 
      ],
      rule_rekomendasi_kegiatan: [
        value => !!value || "Mohon untuk diisi rekomendasi kegiatan investigasi perkara !!!", 
      ],
      rule_tindak_lanjut: [
        value => !!value || "Mohon untuk diisi tindak lanjut investigasi perkara !!!", 
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
          await this.$ajax.post('/kegiatan/investigasiperkara/store',
            {
              user_id: this.formdata.user_id,
              nama_pemohon: this.formdata.nama_pemohon,
              tempat_lahir: this.formdata.tempat_lahir,
              tanggal_lahir: this.formdata.tanggal_lahir,
              pendidikan: this.formdata.pendidikan,
              pekerjaan: this.formdata.pekerjaan,
              alamat: this.formdata.alamat,
              nama_kegiatan: this.formdata.nama_kegiatan,
              tanggal_pelaksanaan: this.formdata.tanggal_pelaksanaan,
              jam_pelaksanaan: this.formdata.jam_pelaksanaan,
              tempat_pelaksanaan: this.formdata.tempat_pelaksanaan,
              uraian_kegiatan: this.formdata.uraian_kegiatan,
              hasil_investigasi: this.formdata.hasil_investigasi,
              rekomendasi_kegiatan: this.formdata.rekomendasi_kegiatan,
              tindak_lanjut: this.formdata.tindak_lanjut,
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
              this.$router.push('/kegiatan/investigasiperkara/' + data.kegiatan.id + '/files')
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
          this.$router.push('/kegiatan/investigasiperkara')
        }, 300)
      },
    },
    components: {
      AdminLayout,
      ModuleHeader,
    },
  }
</script>
