<template>
    <AdminLayout>
        <ModuleHeader>
            <template v-slot:icon>
                mdi-google-classroom
            </template>
            <template v-slot:name>
                JENIS KEGIATAN
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
                    Halaman untuk menampilkan daftar jenis-jenis kegiatan.
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
                        item-key="idkelas"
                        sort-by="idkelas"
                        show-expand
                        :expanded.sync="expanded"
                        :single-expand="true"
                        @click:row="dataTableRowClicked"
                        class="elevation-1"
                        :loading="datatableLoading"
                        loading-text="Loading... Please wait">

                        <template v-slot:top>
                            <v-toolbar flat color="white">
                                <v-toolbar-title>DAFTAR JENIS KEGIATAN</v-toolbar-title>
                                <v-divider
                                    class="mx-4"
                                    inset
                                    vertical
                                ></v-divider>
                                <v-spacer></v-spacer>                                
                                <v-dialog v-model="dialogdetailitem" max-width="500px" persistent>
                                    <v-card>
                                        <v-card-title>
                                            <span class="headline">DETAIL DATA</span>
                                        </v-card-title>
                                        <v-card-text>
                                            <v-row no-gutters>
                                                <v-col xs="12" sm="6" md="6">
                                                    <v-card flat>
                                                        <v-card-title>KODE JENIS KEGIATAN:</v-card-title>
                                                        <v-card-subtitle>
                                                            {{formdata.idkelas}}
                                                        </v-card-subtitle>
                                                    </v-card>
                                                </v-col>
                                                <v-responsive width="100%" v-if="$vuetify.breakpoint.xsOnly"/>
                                                <v-col xs="12" sm="6" md="6">
                                                    <v-card flat>
                                                        <v-card-title>NAMA JENIS KEGIATAN :</v-card-title>
                                                        <v-card-subtitle>
                                                            {{formdata.nkelas}}
                                                        </v-card-subtitle>
                                                    </v-card>
                                                </v-col>
                                                <v-responsive width="100%" v-if="$vuetify.breakpoint.xsOnly"/>
                                            </v-row>
                                        </v-card-text>
                                        <v-card-actions>
                                            <v-spacer></v-spacer>
                                            <v-btn color="blue darken-1" text @click.stop="closedialogdetailitem">KELUAR</v-btn>
                                        </v-card-actions>
                                    </v-card>
                                </v-dialog>
                            </v-toolbar>
                        </template>
                        <template v-slot:item.actions="{ item }">
                            <v-icon
                                small
                                class="mr-2"
                                @click.stop="viewItem(item)">
                                mdi-eye
                            </v-icon>                            
                        </template>
                        <template v-slot:expanded-item="{ headers, item }">
                            <td :colspan="headers.length" class="text-center">
                                <v-col cols="12">
                                    <strong>ID:</strong>{{ item.idkelas }}
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
import {mapGetters} from 'vuex';
import AdminLayout from '@/views/layouts/AdminLayout';
import ModuleHeader from '@/components/ModuleHeader';
export default {
    name:'JenisKegiatan',
    created () {
        this.breadcrumbs = [
            {
                text:'HOME',
                disabled:false,
                href:'/dashboard/'+this.ACCESS_TOKEN
            },
            {
                text:'DATA MASTER',
                disabled:false,
                href:'#'
            },
            {
                text:'JENIS KEGIATAN',
                disabled:true,
                href:'#'
            }
        ];
        this.initialize()
    },
    data: () => ({
        btnLoading:false,
        datatableLoading:false,
        expanded:[],
        datatable:[],
        headers: [
            { text: 'KODE JENIS KEGIATAN', value: 'idkelas',width:250 },
            { text: 'NAMA JENIS KEGIATAN', value: 'nkelas' },
            { text: 'AKSI', value: 'actions', sortable: false,width:100 },
        ],
        search:'',

        //dialog
        dialogfrm:false,
        dialogdetailitem:false,

        //form data
        old_idkelas:'',
        form_valid:true,
        formdata: {
            idkelas:'',
            nkelas:'',
        },
        formdefault: {
           idkelas:'',
            nkelas:'',
        },
        editedIndex: -1,

        //form rules
        rule_kode_kelas:[
            value => !!value||"ID Kelas mohon untuk diisi !!!",
            value => /^[A-Z]*$/.test(value) || 'Name hanya boleh string dan huruf besar',
            value => (value && value.length == 1) || 'Kode kelas hanya boleh 1 karakter'
        ],
        rule_nama_kelas:[
            value => !!value||"Mohon untuk di isi nama kelas !!!",            
        ],
    }),
    methods: {
        initialize:async function ()
        {
            this.datatableLoading=true;
            await this.$ajax.get('/datamaster/kelas',{
                headers: {
                    Authorization:this.TOKEN
                }
            }).then(({data})=>{
                this.datatable = data.kelas;
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
        },
        editItem (item) {
            this.editedIndex = this.datatable.indexOf(item);
            this.formdata = Object.assign({}, item);
            this.old_idkelas=item.idkelas;
            this.dialogfrm = true
        },
        save:async function () {
            if (this.$refs.frmdata.validate())
            {
                this.btnLoading=true;
                if (this.editedIndex > -1)
                {
                    await this.$ajax.post('/datamaster/kelas/'+this.old_idkelas,
                        {
                            '_method':'PUT',
                            idkelas:this.formdata.idkelas,
                            nkelas:this.formdata.nkelas,
                        },
                        {
                            headers:{
                                Authorization:this.TOKEN
                            }
                        }
                    ).then(({data})=>{
                        Object.assign(this.datatable[this.editedIndex], data.kelas);
                        this.closedialogfrm();
                        this.btnLoading=false;
                    }).catch(()=>{
                        this.btnLoading=false;
                    });

                } else {
                    await this.$ajax.post('/datamaster/kelas/store',
                        {
                            idkelas:this.formdata.idkelas,
                            nkelas:this.formdata.nkelas,
                        },
                        {
                            headers:{
                                Authorization:this.TOKEN
                            }
                        }
                    ).then(({data})=>{
                        this.datatable.push(data.kelas);
                        this.closedialogfrm();
                        this.btnLoading=false;
                    }).catch(()=>{
                        this.btnLoading=false;
                    });
                }
            }
        },
        deleteItem (item) {
            this.$root.$confirm.open('Delete', 'Apakah Anda ingin menghapus data dengan ID '+item.idkelas+' ?', { color: 'red' }).then((confirm) => {
                if (confirm)
                {
                    this.btnLoading=true;
                    this.$ajax.post('/datamaster/kelas/'+item.idkelas,
                        {
                            '_method':'DELETE',
                        },
                        {
                            headers:{
                                Authorization:this.TOKEN
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
        closedialogdetailitem () {
            this.dialogdetailitem = false;
            setTimeout(() => {
                this.formdata = Object.assign({}, this.formdefault)
                this.editedIndex = -1
                }, 300
            );
        },
        closedialogfrm () {
            this.dialogfrm = false;
            setTimeout(() => {
                this.formdata = Object.assign({}, this.formdefault);
                this.$refs.frmdata.reset();
                this.editedIndex = -1
                }, 300
            );
        },
    },
    computed: {
        ...mapGetters('auth',{
            ACCESS_TOKEN:'AccessToken',
            TOKEN:'Token',
        }),
        formTitle () {
            return this.editedIndex === -1 ? 'TAMBAH DATA' : 'UBAH DATA'
        },
    },
    components:{
        AdminLayout,
        ModuleHeader,
    },

}
</script>
