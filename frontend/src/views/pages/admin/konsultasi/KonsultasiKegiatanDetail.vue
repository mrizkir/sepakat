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
                        class="indigo darken-4"
                        shift
                    >
                        <v-btn>
                            <span>Verifikasi</span>
                            <v-icon>mdi-lock-open</v-icon>
                        </v-btn>
                    </v-bottom-navigation>
                </v-col>
            </v-row>
            <v-row>
                <v-col cols="12">
                    <v-form ref="frmdata" v-model="form_valid" lazy-validation>
                        <v-card class="grey lighten-4">
                            <v-card-title>
                                <v-icon>mdi-comment</v-icon> Komentar
                            </v-card-title>
                            <v-card-text v-if="daftar_komentar.length">
                                
                            </v-card-text>  
                            <v-card-text else>
                                <v-alert
                                    text
                                    outlined
                                    color="info"
                                    >
                                    BELUM ADA KOMENTAR
                                </v-alert>
                            </v-card-text>  
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
                        </v-card>
                    </v-form>
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
                console.log(data);
            })
        },
        savekomentar:async function () {
            if (this.$refs.frmdata.validate())
            {
                this.btnLoading=true;      

                await this.$ajax.post('/konsultasi/komentar/store',
                {
                    kegiatan_id:this.formdata.user_id,                    
                    isi_komentar:this.formdata.komentar,                    
                },
                {
                    headers:{
                        Authorization:this.$store.getters['auth/Token']
                    }
                }
                ).then(({data})=>{        
                    this.btnLoading=false;               
                    setTimeout(() => {
                        this.formdata = Object.assign({}, this.formdefault);                                
                        this.$router.push('/konsultasi/kegiatan/'+data.kegiatan.kegiatan_id+'/files')
                        }, 300
                    );
                }).catch(()=>{
                    this.btnLoading=false;
                });                
            }
        },  
    },
    components:{
        AdminLayout,
        ModuleHeader,        
        DK
    },

}
</script>