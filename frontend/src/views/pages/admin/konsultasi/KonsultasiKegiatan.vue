<template>
    <AdminLayout>
        <ModuleHeader>
            <template v-slot:icon>
                mdi-calendar-blank-multiple
            </template>
            <template v-slot:name>
                KONSULTASI KEGIATAN PARALEGAL
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
                    Halaman ini berisi daftar kegiatan konsultasi hukum paralegal
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
                        item-key="kegiatan_id"
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
                                <v-btn color="primary" dark class="mb-2" to="/konsultasi/kegiatan/tambah" v-if="dashboard=='paralegal'||dashboard=='kumham'||dashboard=='superadmin'">TAMBAH</v-btn>
                            </v-toolbar>
                        </template>
                        <template v-slot:item.id="{ item }">    
                           {{item.id}}
                        </template>
                        <template v-slot:item.actions="{ item }">
                            <v-btn
                                small
                                icon
                                @click.stop="$router.push('/konsultasi/kegiatan/'+item.kegiatan_id+'/detail')">
                                <v-icon>
                                    mdi-eye
                                </v-icon>
                            </v-btn>                               
                            <v-btn
                                small      
                                icon                          
                                :to="{path:'/konsultasi/kegiatan/'+item.kegiatan_id+'/ubah'}"
                                v-if="dashboard=='paralegal'||dashboard=='kumham'||dashboard=='superadmin'">
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
                                v-if="dashboard=='paralegal'||dashboard=='kumham'||dashboard=='superadmin'">
                                <v-icon>
                                    mdi-delete
                                </v-icon>
                            </v-btn>  
                        </template>
                        <template v-slot:expanded-item="{ headers, item }">
                            <td :colspan="headers.length" class="text-center">
                                <v-col cols="12">
                                    <strong>ID:</strong>{{ item.kegiatan_id }}
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
import AdminLayout from '@/views/layouts/AdminLayout';
import ModuleHeader from '@/components/ModuleHeader';
export default {
    name:'KonsultasiKegiatan',
    created () {
        this.dashboard = this.$store.getters['uiadmin/getDefaultDashboard'];        
        this.breadcrumbs = [
            {
                text:'HOME',
                disabled:false,
                href:'/dashboard/'+this.$store.getters['auth/AccessToken']
            },
            {
                text:'KONSULTASI',
                disabled:false,
                href:'#'
            },
            {
                text:'KEGIATAN',
                disabled:true,
                href:'#'
            }
        ];
        this.initialize()
    },  
    data: () => ({ 
        dashboard:null,

        btnLoading:false,
        datatableLoading:false,
        expanded:[],
        datatable:[],
        headers: [                        
            { text: 'PEMOHON', value: 'pemohon' },   
            { text: 'JENIS KEGIATAN', value: 'nama_jenis' },   
            { text: 'NAMA KEGIATAN', value: 'nama_kegiatan' },               
            { text: 'AKSI', value: 'actions', sortable: false,width:150 },
        ],
        search:'', 

    }),
    methods: {
        initialize:async function () 
        {
            this.datatableLoading=true;
            await this.$ajax.get('/konsultasi/kegiatan',{
                headers: {
                    Authorization:this.$store.getters['auth/Token']
                }
            }).then(({data})=>{               
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
            // this.$ajax.get('/konsultasi/kegiatan/'+item.id,{
            //     headers: {
            //         Authorization:this.$store.getters['auth/Token']
            //     }
            // }).then(({data})=>{               
                                           
            // });                      
        },            
        deleteItem (item) {           
            this.$root.$confirm.open('Delete', 'Apakah Anda ingin menghapus data konsultasi kegiatan dengan ID '+item.kegiatan_id+' ?', { color: 'red',width:600 }).then((confirm) => {
                if (confirm)
                {
                    this.btnLoading=true;
                    this.$ajax.post('/konsultasi/kegiatan/'+item.kegiatan_id,
                        {
                            '_method':'DELETE',
                        },
                        {
                            headers:{
                                Authorization:this.$store.getters['auth/Token']
                            }
                        }
                    ).then(()=>{   
                        const index = this.datatable.indexOf(item);
                        this.datatable.splice(index, 1);
                        this.btnLoading=false;
                    }).catch(()=>{
                        this.btnLoading=false;
                    });
                }                
            });
        },        
    },  
    components:{
        AdminLayout,
        ModuleHeader,        
    },

}
</script>