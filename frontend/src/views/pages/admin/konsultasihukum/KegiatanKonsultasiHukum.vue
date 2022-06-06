<template>
  <AdminLayout>
    <ModuleHeader>
      <template v-slot:icon>
        mdi-calendar-blank-multiple
      </template>
      <template v-slot:name>
        KEGIATAN KONSULTASI HUKUM
      </template>
      <template v-slot:breadcrumbs>
        <v-breadcrumbs :items="breadcrumbs" class="pa-0">
          <template v-slot:divider>
            <v-icon>mdi-chevron-right</v-icon>
          </template>
        </v-breadcrumbs>
      </template>
      <template v-slot:desc>
        <v-alert                                        
          color="cyan"
          border="left"
          colored-border
          type="info"
          >
          Halaman ini berisi daftar kegiatan konsultasi hukum yang dilakukan oleh paralegal
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
            loading-text="Loading... Please wait">

            <template v-slot:top>
              <v-toolbar flat color="white">
                <v-toolbar-title>DAFTAR KEGIATAN</v-toolbar-title>
                <v-divider
                  class="mx-4"
                  inset
                  vertical
                ></v-divider>
                <v-spacer></v-spacer>
                <v-btn color="primary" dark class="mb-2" to="/kegiatan/konsultasihukum/tambah" v-if="dashboard=='paralegal'||dashboard=='kumham'||dashboard=='superadmin'">TAMBAH</v-btn>
              </v-toolbar>
            </template>
            <template v-slot:item.id="{ item }">  
               {{item.id}}
            </template>
            <template v-slot:item.id_status="{ item }"> 
              <v-chip :color="item.id_status==1?'success': 'blue-grey lighten-3'" dark>
                {{item.id_status==1?'SETUJU': 'DRAFT'}}
              </v-chip>
            </template>
            <template v-slot:item.actions="{ item }">
              <v-btn
                small
                icon
                @click.stop="$router.push('/kegiatan/konsultasihukum/'+item.id+'/detail')">
                <v-icon>
                  mdi-eye
                </v-icon>
              </v-btn> 
              <v-btn
                small      
                icon                          
                :to="{path: '/kegiatan/konsultasihukum/'+item.id+'/ubah'}"
                v-if="item.id_status==0 && (dashboard=='paralegal'||dashboard=='kumham'||dashboard=='superadmin')">
                <v-icon>
                  mdi-pencil
                </v-icon>
              </v-btn>                 
              <v-btn
                small
                icon
                :loading="btnLoading"
                :disabled="btnLoading"
                @click.stop="deleteItem(item)"
                v-if="item.id_status==0 && (dashboard=='paralegal'||dashboard=='kumham'||dashboard=='superadmin')">
                <v-icon>
                  mdi-delete
                </v-icon>
              </v-btn>
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
import AdminLayout from '@/views/layouts/AdminLayout'
import ModuleHeader from '@/components/ModuleHeader';
export default {
  name: 'KegiatanKonsultasiHukumMediasi',
  created () {
    this.dashboard = this.$store.getters['uiadmin/getDefaultDashboard'];        
    this.breadcrumbs = [
      {
        text: 'HOME',
        disabled: false,
        href: '/dashboard/' + this.$store.getters['auth/AccessToken']
      },
      {
        text: 'KEGIATAN',
        disabled: false,
        href: '#'
      },
      {
        text: 'KONSULTASI HUKUM',
        disabled: true,
        href: '#'
      }
    ];
    this.initialize()
  },
  data: () => ({ 
    dashboard: null,

    btnLoading: false,
    datatableLoading: false,
    expanded: [],
    datatable: [],
    headers: [                        
      { text: 'PARALEGAL', value: 'name' },
      { text: 'PEMOHON', value: 'nama_pemohon' },
      { text: 'NAMA KEGIATAN', value: 'nama_kegiatan' },
      { text: 'STATUS', value: 'id_status', sortable: false, width:100 },
      { text: 'AKSI', value: 'actions', sortable: false,width:150 },
    ],
    search: '', 

  }),
  methods: {
    initialize: async function() 
    {
      this.datatableLoading=true;
      await this.$ajax.get('/kegiatan/konsultasihukum', {
        headers: {
          Authorization:this.$store.getters['auth/Token']
        }
      }).then(({ data }) => {
        this.datatable = data.daftar_kegiatan;
        this.datatableLoading=false;
      }).catch(()=>{
        this.datatableLoading=false;
      });  
    },
    dataTableRowClicked(item)
    {
      if ( item === this.expanded[0])
      {
        this.expanded=[];                
      }
      else
      {
        this.expanded=[item];
      }               
    },
    viewItem (item) {
      this.formdata=item;      
      this.dialogdetailitem=true;              
      // this.$ajax.get('/kegiatan/konsultasihukum'+item.id,{
      //     headers: {
      //         Authorization:this.$store.getters['auth/Token']
      //     }
      // }).then(({ data }) => {
                       
      // });                      
    },
    deleteItem (item) {   
      this.$root.$confirm.open('Delete', 'Apakah Anda ingin menghapus data kegiatan konsultasi hukum dengan ID '+item.id+' ?', { color: 'red',width:600 }).then((confirm) => {
        if (confirm)
        {
          this.btnLoading = true
          this.$ajax.post('/kegiatan/konsultasihukum/' + item.id,
            {
              '_method': 'DELETE',
            },
            {
              headers: {
                Authorization:this.$store.getters['auth/Token']
              }
            }
          ).then(()=>{   
            const index = this.datatable.indexOf(item);
            this.datatable.splice(index, 1);
            this.btnLoading = false
          })
          .catch(()=>{
            this.btnLoading = false
          });
        }                
      });
    },
  },
  components: {
    AdminLayout,
    ModuleHeader,
  },

}
</script>