<template>
    <AdminLayout>
        <ModuleHeader>
            <template v-slot:icon>
                mdi-calendar-blank-multiple
            </template>
            <template v-slot:name>
                LAPORAN KEGIATAN PARALEGAL
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
                    Halaman ini berisi laporan kegiatan konsultasi hukum paralegal
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
                            </v-toolbar>
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
                                @click.stop="printpdf(item)"
                                :disabled="item.id_status==0"
                                :loading="btnLoading">
                                <v-icon>
                                    mdi-printer
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
            <v-dialog v-model="dialogprintpdf" max-width="500px" persistent>  
                <v-card>
                    <v-card-title>
                        <span class="headline">Print to PDF</span>
                    </v-card-title>
                    <v-card-text>
                        <v-btn
                            color="green"
                            text
                            :href="this.$api.storageURL+'/'+file_pdf">
                            Download
                        </v-btn>             
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="blue darken-1" text @click.stop="closedialogprintpdf">BATAL</v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
        </v-container>
    </AdminLayout>
</template>
<script>
import AdminLayout from '@/views/layouts/AdminLayout'
import ModuleHeader from '@/components/ModuleHeader'
export default {
    name: 'LaporanKegiatan',
    created () {
        this.dashboard = this.$store.getters['uiadmin/getDefaultDashboard']
        this.breadcrumbs = [
            {
                text: 'HOME',
                disabled: false,
                href: '/dashboard/' + this.$store.getters['auth/AccessToken'],
            },
            {
                text: 'KONSULTASI',
                disabled: false,
                href: '#',
            },
            {
                text: 'KEGIATAN',
                disabled: true,
                href: '#',
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
            { text: 'PEMOHON', value: 'pemohon' },
            { text: 'JENIS KEGIATAN', value: 'nama_jenis' },
            { text: 'NAMA KEGIATAN', value: 'nama_kegiatan' },
            { text: 'STATUS', value: 'id_status', sortable: false, width:100 },
            { text: 'AKSI', value: 'actions', sortable: false,width:80 },
        ],
        search: '', 

        dialogprintpdf: false,
        file_pdf: null

    }),
    methods: {
        initialize: async function() 
        {
            this.datatableLoading=true;
            await this.$ajax.get('/report/kegiatan', {
                headers: {
                    Authorization: this.$store.getters['auth/Token']
                }
            }).then(({ data }) => {
                this.datatable = data.daftar_kegiatan;
                this.datatableLoading=false
            }).catch(() => {
                this.datatableLoading=false
            })
        },
        dataTableRowClicked(item)
        {
            if ( item === this.expanded[0])
            {
                this.expanded=[]
            }
            else
            {
                this.expanded=[item];
            }               
        },
        async printpdf (item)
        {
            this.btnLoading = true
            await this.$ajax.post('/report/kegiatan/printpdf',
                {
                    kegiatan_id:item.kegiatan_id,
                },
                {
                    headers: {
                        Authorization: this.$store.getters['auth/Token']
                    },
                    
                }
            ).then(({ data }) => {
                this.file_pdf=data.pdf_file;
                this.dialogprintpdf=true;
                this.btnLoading = false
            }).catch(() => {
                this.btnLoading = false
            })
        },
        closedialogprintpdf () {
            setTimeout(() => {
                this.file_pdf=null;
                this.dialogprintpdf = false
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