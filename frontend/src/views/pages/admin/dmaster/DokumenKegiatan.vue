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
                <v-toolbar-title>DAFTAR USERS PEMDA</v-toolbar-title>
                <v-divider
                  class="mx-4"
                  inset
                  vertical
                ></v-divider>
                <v-spacer></v-spacer>                
                <v-btn color="primary"
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
                          outlined
                        />                         
                        <v-text-field 
                          v-model="editedItem.email" 
                          label="EMAIL"
                          outlined
                          :rules="rule_user_email">
                        </v-text-field>
                        <v-text-field 
                          v-model="editedItem.nomor_hp" 
                          label="NOMOR HP"
                          outlined
                          :rules="rule_user_nomorhp">
                        </v-text-field>
                        <v-text-field 
                          v-model="editedItem.username" 
                          label="USERNAME"
                          outlined
                          :rules="rule_user_username">
                        </v-text-field>
                        <v-text-field 
                          v-model="editedItem.password" 
                          label="PASSWORD"
                          :type="'password'"
                          outlined
                          :rules="rule_user_password">
                        </v-text-field>                        
                      </v-card-text>
                      <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="blue darken-1" text @click.stop="close">BATAL</v-btn>
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
                class="mr-2"
                :loading="btnLoading"
                :disabled="btnLoading"
                @click.stop="setPermission(item)"
              >
                mdi-axis-arrow-lock
              </v-icon>
              <v-icon
                small
                class="mr-2"
                :loading="btnLoading"
                :disabled="btnLoading"
                @click.stop="editItem(item)"
              >
                mdi-pencil
              </v-icon>
              <v-icon
                small
                :loading="btnLoading"
                :disabled="btnLoading"
                @click.stop="deleteItem(item)"
              >
                mdi-delete
              </v-icon>
            </template>
            <template v-slot:item.foto="{ item }">
              <v-avatar size="30">
                <v-img :src="$api.storageURL + '/' + item.foto" />
              </v-avatar>
            </template>
            <template v-slot:expanded-item="{ headers, item }">
              <td :colspan="headers.length" class="text-center">
                <v-col cols="12">
                  <strong>ID:</strong>{{ item.id }}
                  <strong>created_at:</strong>{{ $date(item.created_at).format('DD/MM/YYYY HH:mm') }}
                  <strong>updated_at:</strong>{{ $date(item.updated_at).format('DD/MM/YYYY HH:mm') }}
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
        }
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
      daftar_permissions: [],
      permissions_selected: [],

      //form
      form_valid: true,
      daftar_jenis_kegiatan: [],
      dialog: false,
      dialogEdit: false,
      firstShowDialogEdit: true,
      dialogUserPermission: false,
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
        value => !!value || "Mohon untuk di isi nama User !!!",
        value => /^[A-Za-z\s]*$/.test(value) || 'Nama User hanya boleh string dan spasi',
      ],
      rule_user_email: [
        value => !!value || "Mohon untuk di isi email User !!!",
        value => /.+@.+\..+/.test(value) || 'Format E-mail harus benar', 
      ],
      rule_user_nomorhp: [
        value => !!value || "Nomor HP mohon untuk diisi !!!",
        value => /^\+[1-9]{1}[0-9]{1,14}$/.test(value) || 'Nomor HP hanya boleh angka dan gunakan kode negara didepan seperti +6281214553388',
      ],
      rule_user_username: [
        value => !!value || "Mohon untuk di isi username User !!!",
        value => /^[A-Za-z_]*$/.test(value) || 'Username hanya boleh string dan underscore',
      ],
      rule_jenis_kegiatan: [
        value => !!value || "Mohon untuk dipilih jenis kegiatan ini !!!",
      ]
    }),
    methods: {
      initialize: async function() {
        this.datatableLoading = true
        await this.$ajax.get('/datamaster/dokumenkegiatan', {
          headers: {
            Authorization: this.TOKEN,
          }
        }).then(({ data }) => {
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
      syncPermission: async function()
      {
        this.btnLoading = true
        await this.$ajax.post('/system/users/syncallpermissions',
          {
            role_name: 'pmb',
          },
          {
            headers: {
              Authorization: this.$store.getters['auth/Token'],
            }
          }
        )
        .then(() => {
          this.btnLoading = false
        })
        .catch(() => {
          this.btnLoading = false
        })
      },
      showDialog() {
        this.dialog = true        
      },
      editItem: async function(item) {
        this.editedIndex = this.datatable.indexOf(item)
        item.password = ''
        this.editedItem = Object.assign({}, item)

        await this.$ajax.get('/system/setting/roles', {
          headers: {
            Authorization: this.TOKEN,
          }
        }).then(({ data }) => {
          let roles = data.roles
          var daftar_jenis_kegiatan = []
          roles.forEach(element => {
            if (element.name == 'pmb')
            {
              daftar_jenis_kegiatan.push({
                text: element.name,
                disabled: true,
              })
            }
          })
          this.daftar_jenis_kegiatan = daftar_jenis_kegiatan
        })

        this.btnLoading = true
        await this.$ajax.get('/system/users/' + item.id + '/roles',
        {
          headers: {
            Authorization: this.TOKEN,
          }
        }).then(({ data }) => {
          this.editedItem.role_id = data.roles
          this.btnLoading = false
          this.dialogEdit = true
        })

        this.firstShowDialogEdit=false
      },
      setPermission: async function(item) {
        this.btnLoading = true  
        this.$ajax.get('/system/setting/roles/' + this.role_id + '/permission', {
          headers: {
            Authorization: this.TOKEN,
          }
        }).then(({ data }) => {
          this.daftar_permissions = data.permissions
        }).catch(() => {
          this.btnLoading = false
        })

        await this.$ajax.get('/system/users/' + item.id + '/permission', {
          headers: {
            Authorization: this.TOKEN,
          }
        }).then(({ data }) => {
          this.permissions_selected = data.permissions;
          this.btnLoading = false
            
        }).catch(() => {
          this.btnLoading = false
        })
        this.dialogUserPermission = true
        this.editedItem=item;
      
      },
      close() {
        this.btnLoading = false
        this.dialog = false
        this.dialogEdit = false
        this.firstShowDialogEdit=true
        setTimeout(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
          this.$refs.frmdata.reset()
          }, 300
        );
      },
      closeUserPermissions () {
        this.btnLoading = false
        this.permissions_selected=[]
        this.dialogUserPermission = false
      },
      save() {
        if (this.$refs.frmdata.validate())
        {
          this.btnLoading = true
          if (this.editedIndex > -1) 
          {
            this.$ajax.post('/datamaster/dokumenkegiatan/' + this.editedItem.id,
              {
                _method: 'PUT',
                name: this.editedItem.name,
                email: this.editedItem.email,
                nomor_hp: this.editedItem.nomor_hp,
                username: this.editedItem.username,
                password: this.editedItem.password,
                role_id: JSON.stringify(Object.assign({}, this.editedItem.role_id)),
              },
              {
                headers: {
                  Authorization: this.TOKEN,
                }
              }
            ).then(({ data }) => {
              Object.assign(this.datatable[this.editedIndex], data.user)
              this.close()
            }).catch(() => {
              this.btnLoading = false
            })
            
          } else {
            this.$ajax.post('/datamaster/dokumenkegiatan/store',
              {
                name: this.editedItem.name,
                email: this.editedItem.email,
                nomor_hp: this.editedItem.nomor_hp,
                username: this.editedItem.username,
                password: this.editedItem.password,
                role_id: JSON.stringify(Object.assign({}, this.editedItem.role_id)),
              },
              {
                headers: {
                  Authorization: this.TOKEN,
                }
              }
            ).then(({ data }) => {
              this.datatable.push(data.user)
              this.close()
            }).catch(() => {
              this.btnLoading = false
            })
          }
        }
      },
      deleteItem(item) {
        this.$root.$confirm.open('Delete', 'Apakah Anda ingin menghapus username ' + item.username + ' ?', { color: 'red' }).then(confirm => {
          if (confirm)
          {
            this.btnLoading = true
            this.$ajax.post('/datamaster/dokumenkegiatan/' + item.id,
              {
                _method: 'DELETE',
              },
              {
                headers: {
                  Authorization: this.TOKEN,
                }
              }
            ).then(() => {
              const index = this.datatable.indexOf(item)
              this.datatable.splice(index, 1)
              this.btnLoading = false
            }).catch(() => {
              this.btnLoading = false
            })
          }
        })
      },
    },
    computed: {
      formTitle() {
        return this.editedIndex === -1 ? 'TAMBAH USER PEMDA' : 'EDIT USER PEMDA'
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
      dialogEdit(val) {
        val || this.close()
      },
    },
    components: {
      AdminLayout,
      ModuleHeader,
    },
  }
</script>
