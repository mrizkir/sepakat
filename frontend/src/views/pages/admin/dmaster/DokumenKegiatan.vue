<template>
  <AdminLayout>
    <ModuleHeader>
      <template v-slot:icon>
        mdi-account
      </template>
      <template v-slot:name>
        DOKUMEN KEGIATAN
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
          dokumen - dokumen yang dibutuhkan setiap jenis kegiatan paralegal
        </v-alert>
      </template>
    </ModuleHeader>
    <v-container fluid>
      <v-row class="mb-4" no-gutters>
        <v-col cols="12">
          <v-card>
            <v-card-text>
              <v-text-field
                v-model="search"
                append-icon="mdi-database-search"
                label="Search"
                single-line
                hide-details
              ></v-text-field>
            </v-card-text>
          </v-card>
        </v-col>
      </v-row>
      <v-row class="mb-4" no-gutters>
        <v-col cols="12">
          <v-data-table
            :headers="headers"
            :items="datatable"
            :search="search"
            item-key="id"
            sort-by="name"
            show-expand
            :expanded.sync="expanded"
            :single-expand="true"
            @click:row="dataTableRowClicked"
            class="elevation-1"
            :loading="datatableLoading"
            loading-text="Loading... Please wait"
          >
            <template v-slot:top>
              <v-toolbar flat color="white">
                <v-toolbar-title>DAFTAR DOKUMEN</v-toolbar-title>
                <v-divider class="mx-4" inset vertical></v-divider>
                <v-spacer></v-spacer>
                <v-btn
                  color="primary"
                  class="mb-2"
                  :loading="btnLoading"
                  :disabled="btnLoading"
                  @click.stop="showDialog"
                >
                  TAMBAH
                </v-btn>
                <v-dialog v-model="dialog" max-width="500px" persistent>
                  <v-form ref="frmdata" v-model="form_valid" lazy-validation>
                    <v-card>
                      <v-card-title>
                        <span class="headline">{{ formTitle }}</span>
                      </v-card-title>
                      <v-card-text>
                        <v-text-field
                          v-model="editedItem.nama_dokumen"
                          label="NAMA DOKUMEN"
                          outlined
                          :rules="rule_nama_dokumen"
                        />
                        <v-autocomplete
                          :items="daftar_jenis_kegiatan"
                          v-model="editedItem.id_jenis_kegiatan"
                          label="JENIS KEGIATAN"
                          multiple
                          small-chips
                          :rules="rule_jenis_kegiatan"
                          item-text="nama_jenis"
                          item-value="id_jenis"
                          outlined
                        />
                      </v-card-text>
                      <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="blue darken-1" text @click.stop="close">
                          BATAL
                        </v-btn>
                        <v-btn
                          color="blue darken-1"
                          text
                          @click.stop="save"
                          :loading="btnLoading"
                          :disabled="!form_valid || btnLoading"
                        >
                          SIMPAN
                        </v-btn>
                      </v-card-actions>
                    </v-card>
                  </v-form>
                </v-dialog>
              </v-toolbar>
            </template>
            <template v-slot:item.actions="{ item }">
              <v-icon
                small
                :loading="btnLoading"
                :disabled="btnLoading"
                @click.stop="deleteItem(item)"
              >
                mdi-delete
              </v-icon>
            </template>
            <template v-slot:expanded-item="{ headers, item }">
              <td :colspan="headers.length" class="text-center">
                <v-col cols="12">
                  <strong>ID:</strong>{{ item.id }}
                  <strong>created_at:</strong>
                  {{ $date(item.created_at).format('DD/MM/YYYY HH:mm') }}
                  <strong>updated_at:</strong>
                  {{ $date(item.updated_at).format('DD/MM/YYYY HH:mm') }}
                </v-col>
              </td>
            </template>
            <template v-slot:no-data>
              Data belum tersedia
            </template>
          </v-data-table>
        </v-col>
      </v-row>
    </v-container>
  </AdminLayout>
</template>
<script>
  import { mapGetters } from 'vuex'
  import AdminLayout from '@/views/layouts/AdminLayout'
  import ModuleHeader from '@/components/ModuleHeader'
  export default {
    name: 'DokumenKegiatan',
    created() {
      this.breadcrumbs = [
        {
          text: 'HOME',
          disabled: false,
          href: '/dashboard/' + this.ACCESS_TOKEN,
        },
        {
          text: 'DATA MASTER',
          disabled: false,
          href: '#',
        },
        {
          text: 'DOKUMEN KEGIATAN',
          disabled: true,
          href: '#',
        },
      ]
      this.initialize()
    },
    data: () => ({
      role_id: 0,
      datatableLoading: false,
      selectLoadingKec: false,
      btnLoading: false,
      //tables
      headers: [
        { text: 'JENIS KEGIATAN', value: 'nama_jenis', sortable: true },
        { text: 'NAMA DOKUMEN', value: 'nama_dokumen', sortable: true },
        { text: 'STATUS', value: 'status', sortable: true },
        { text: 'AKSI', value: 'actions', sortable: false, width: 100 },
      ],
      expanded: [],
      search: null,
      datatable: [],

      //form
      form_valid: true,
      daftar_jenis_kegiatan: [],
      dialog: false,
      editedIndex: -1,
      editedItem: {
        dokumen_id: null,
        id_jenis_kegiatan: null,
        nama_dokumen: null,
        status: null,
        created_at: null,
        updated_at: null,
      },
      defaultItem: {
        dokumen_id: null,
        id_jenis_kegiatan: null,
        nama_dokumen: null,
        status: null,
        created_at: null,
        updated_at: null,
      },
      //form rules
      rule_nama_dokumen: [
        value => !!value || 'Mohon untuk di isi nama User !!!',
        value =>
          /^[A-Za-z\s]*$/.test(value) ||
          'Nama User hanya boleh string dan spasi',
      ],
      rule_jenis_kegiatan: [
        value => !!value || 'Mohon untuk dipilih jenis kegiatan ini !!!',
      ],
    }),
    methods: {
      initialize: async function() {
        this.datatableLoading = true
        await this.$ajax
          .get('/datamaster/dokumenkegiatan', {
            headers: {
              Authorization: this.TOKEN,
            },
          })
          .then(({ data }) => {
            this.datatable = data.dokumen_kegiatan
            this.datatableLoading = false
          })
      },
      dataTableRowClicked(item) {
        if (item === this.expanded[0]) {
          this.expanded = []
        } else {
          this.expanded = [item]
        }
      },
      async showDialog() {
        this.dialog = true
        await this.$ajax
          .get('/datamaster/jeniskegiatan', {
            headers: {
              Authorization: this.TOKEN,
            },
          })
          .then(({ data }) => {
            this.daftar_jenis_kegiatan = data.id_jenis_kegiatan
          })
      },
      close() {
        this.btnLoading = false
        this.dialog = false
        setTimeout(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
          this.$refs.frmdata.reset()
        }, 300)
      },
      save() {
        if (this.$refs.frmdata.validate()) {
          this.btnLoading = true
          this.$ajax
            .post(
              '/datamaster/dokumenkegiatan/store',
              {
                id_jenis_kegiatan: this.editedItem.id_jenis_kegiatan,
                nama_dokumen: this.editedItem.nama_dokumen,
              },
              {
                headers: {
                  Authorization: this.TOKEN,
                },
              }
            )
            .then(() => {
              this.$router.go()
            })
            .catch(() => {
              this.btnLoading = false
            })
        }
      },
      deleteItem(item) {
        this.$root.$confirm
          .open(
            'Delete',
            'Apakah Anda ingin menghapus dokumen ' + item.nama_dokumen + ' ?',
            { color: 'red', width: '400px' }
          )
          .then(confirm => {
            if (confirm) {
              this.btnLoading = true
              this.$ajax
                .post(
                  '/datamaster/dokumenkegiatan/' + item.dokumen_id,
                  {
                    _method: 'DELETE',
                  },
                  {
                    headers: {
                      Authorization: this.TOKEN,
                    },
                  }
                )
                .then(() => {
                  this.$router.go()
                  this.btnLoading = false
                })
                .catch(() => {
                  this.btnLoading = false
                })
            }
          })
      },
    },
    computed: {
      formTitle() {
        return this.editedIndex === -1 ? 'TAMBAH DOKUMEN' : 'EDIT DOKUMEN'
      },
      ...mapGetters('auth', {
        ACCESS_TOKEN: 'AccessToken',
        TOKEN: 'Token',
      }),
    },

    watch: {
      dialog(val) {
        val || this.close()
      },
    },
    components: {
      AdminLayout,
      ModuleHeader,
    },
  }
</script>
