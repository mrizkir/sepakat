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
        <v-container fluid v-if="Object.keys(data_kegiatan).length">   
            <v-row>
                <v-col cols="12">
                    <DK :datakegiatan="data_kegiatan"/>
                </v-col>
            </v-row>
            <v-row>
                <v-col cols="12">
                    <v-bottom-navigation
                        v-model="bottomNav"
                        dark
                        class="indigo darken-4">
                        <v-btn
                            @click.stop="verifikasi"
                            v-if="data_kegiatan.id_status==0 && dashboard!='paralegal'&&dashboard!='kades'"
                        >
                            <span>Verifikasi</span>
                            <v-icon>mdi-lock-open</v-icon>
                        </v-btn>
                        <v-btn :to="{path:'/konsultasi/kegiatan/'+kegiatan_id+'/files'}">
                            <span>Files</span>
                            <v-icon>mdi-file-document</v-icon>
                        </v-btn>
                        <v-btn @click.stop="dialogkronologis=true">
                            <span>Kronologis</span>
                            <v-icon>mdi-history</v-icon>
                        </v-btn>
                        <v-btn  @click.stop="dialogrekomendasi=true">
                            <span>Rekomendasi</span>
                            <v-icon>mdi-information</v-icon>
                        </v-btn>
                    </v-bottom-navigation>
                    <v-dialog v-model="dialogkronologis" max-width="500px" persistent>                        
                        <v-card>
                            <v-card-title>
                                <span class="headline">Kronologis Kegiatan</span>
                            </v-card-title>
                            <v-card-text>
                                {{data_kegiatan.uraian_kegiatan}}
                            </v-card-text>
                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="blue darken-1" text @click.stop="closedialogkronologis">CLOSE</v-btn>                                    
                            </v-card-actions>
                        </v-card>                        
                    </v-dialog>
                    <v-dialog v-model="dialogrekomendasi" max-width="500px" persistent>                        
                        <v-card>
                            <v-card-title>
                                <span class="headline">Rekomendasi Konsultasi</span>
                            </v-card-title>
                            <v-card-text>
                                {{data_kegiatan.rekomendasi_kegiatan}}
                            </v-card-text>
                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="blue darken-1" text @click.stop="closedialogrekomendasi">CLOSE</v-btn>                                    
                            </v-card-actions>
                        </v-card>                        
                    </v-dialog>
                </v-col>
            </v-row>
            <v-row>
                <v-col cols="12">                    
                    <v-card class="grey lighten-4">
                        <v-card-title>
                            <v-icon>mdi-comment</v-icon> Komentar
                        </v-card-title>
                        <v-card-text v-if="daftar_komentar.length">
                            <v-card 
                                class="mx-auto mb-2"
                                max-width="500"
                                outlined
                                v-for="items in daftar_komentar" v-bind:key="items.id">                                    
                                    <v-card-title>
                                        {{items.name}}
                                        <v-spacer/>
                                        <v-chip color="info" outlined>{{items.default_role}}</v-chip>
                                    </v-card-title>                                    
                                    <v-card-text>                                            
                                        {{items.isi_komentar}}
                                    </v-card-text>'
                                    <v-divider class="mx-4"></v-divider>
                                    <v-card-text>
                                        <v-chip color="info">{{$date(items.created_at).format('DD/MM/YYYY HH:mm')}}</v-chip>
                                    </v-card-text>

                                    <v-card-actions>
                                        <v-spacer></v-spacer>
                                        <v-btn
                                            small
                                            icon
                                            :loading="btnLoading"
                                            :disabled="btnLoading"
                                            @click.stop="deleteItem(items)"
                                            v-if="$store.getters['auth/AttributeUser']('id')==items.user_id && data_kegiatan.id_status==0">
                                            <v-icon color="red">
                                                mdi-delete
                                            </v-icon>
                                        </v-btn>
                                    </v-card-actions>
                            </v-card>
                        </v-card-text>  
                        <v-card-text v-else>
                            <v-alert
                                text
                                outlined
                                color="info"
                                >
                                BELUM ADA KOMENTAR
                            </v-alert>
                        </v-card-text>  
                        <v-form ref="frmdata" v-model="form_valid" lazy-validation v-if="data_kegiatan.id_status==0">                                
                            <v-card-actions>                            
                                <v-textarea
                                    class="mr-2"
                                    label="KOMENTAR"                                        
                                    v-model="formdata.komentar"
                                    :rules="rule_komentar"
                                    outlined
                                />
                                <v-btn 
                                    @click.stop="savekomentar" 
                                    :loading="btnLoading"
                                    :disabled="!form_valid||btnLoading"
                                    large>                                    
                                    KIRIM
                                    <v-icon>
                                        mdi-send
                                    </v-icon> 
                                </v-btn>                                
                            
                            </v-card-actions>
                        </v-form>
                    </v-card>                    
                </v-col>
            </v-row>
        </v-container>
    </AdminLayout>
</template>
<script>
import AdminLayout from '@/views/layouts/AdminLayout';
import ModuleHeader from '@/components/ModuleHeader';
import DK from '@/views/pages/admin/konsultasi/DataKegiatan';

export default {
    name:'KonsultasiKegiatanFiles',
    created () {
        this.dashboard = this.$store.getters['uiadmin/getDefaultDashboard']; 
        this.kegiatan_id=this.$route.params.kegiatan_id;
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
                disabled:false,
                href:'/konsultasi/kegiatan/'+this.kegiatan_id+'/detail'
            },           
            {
                text:'DETAIL',
                disabled:true,
                href:'#'
            }
        ];
        this.initialize();
        this.fetchKomentar();
    },  
    data: () => ({ 
        dashboard:null,

        dialogkronologis:false,
        dialogrekomendasi:false,

        kegiatan_id:null,
        data_kegiatan:{},
        bottomNav: 3,
        
        daftar_komentar:[],

        //formdata
        form_valid:true, 
        btnLoading:false,
        formdata:{
            komentar:''
        },
        rule_komentar:[
            value => !!value||"Mohon untuk diisi komentar !!!",              
        ]
    }),
    methods: {
        initialize:async function () 
        {
            await this.$ajax.get('/konsultasi/kegiatan/'+this.kegiatan_id,{
                headers: {
                    Authorization:this.$store.getters['auth/Token']
                }
            }).then(({data})=>{                               
                this.data_kegiatan=data.kegiatan;                
            });
        },   
        async fetchKomentar ()
        {
            await this.$ajax.get('/konsultasi/komentar/'+this.kegiatan_id,{
                headers: {
                    Authorization:this.$store.getters['auth/Token']
                }
            }).then(({data})=>{                               
                this.daftar_komentar=data.daftar_komentar;
            })
        },
        savekomentar:async function () {
            if (this.$refs.frmdata.validate())
            {
                this.btnLoading=true;      

                await this.$ajax.post('/konsultasi/komentar/store',
                {
                    kegiatan_id:this.kegiatan_id,                    
                    isi_komentar:this.formdata.komentar,                    
                },
                {
                    headers:{
                        Authorization:this.$store.getters['auth/Token']
                    }
                }
                ).then(( )=>{        
                    this.btnLoading=false;     
                    this.formdata.isi_komentar='';          
                    this.$refs.frmdata.reset();
                    this.fetchKomentar();
                }).catch(()=>{
                    this.btnLoading=false;
                });                
            }
        },  
        verifikasi ()
        {
            this.$root.$confirm.open('Verifikasi', 'Setelah diverifikasi, tidak bisa diberi komentar, diubah, atau dihapus ?', { color: 'green',width:600 }).then((confirm) => {
                if (confirm)
                {
                    this.btnLoading=true;
                    this.$ajax.post('/konsultasi/kegiatan/verifikasi/'+this.kegiatan_id,
                        {
                            '_method':'put',
                        },
                        {
                            headers:{
                                Authorization:this.$store.getters['auth/Token']
                            }
                        }
                    ).then(()=>{   
                        this.$router.go();
                        this.btnLoading=false;
                    }).catch(()=>{
                        this.btnLoading=false;
                    });
                }                
            });
        },
        closedialogkronologis()
        {
            this.dialogkronologis=false;
        },
        closedialogrekomendasi()
        {
            this.dialogrekomendasi=false;
        },
        deleteItem (item) {           
            this.$root.$confirm.open('Delete', 'Apakah Anda ingin menghapus komentar kegiatan dengan ID '+item.kegiatan_id+' ?', { color: 'red',width:600 }).then((confirm) => {
                if (confirm)
                {
                    this.btnLoading=true;
                    this.$ajax.post('/konsultasi/komentar/'+item.id,
                        {
                            '_method':'DELETE',
                        },
                        {
                            headers:{
                                Authorization:this.$store.getters['auth/Token']
                            }
                        }
                    ).then(()=>{   
                        this.fetchKomentar();
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
        DK
    },

}
</script>