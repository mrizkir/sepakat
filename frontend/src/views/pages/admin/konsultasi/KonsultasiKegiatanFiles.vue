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
                    <v-card color="grey lighten-4">
                        <v-toolbar elevation="2"> 
                            <v-toolbar-title>DATA KEGIATAN</v-toolbar-title>
                            <v-divider
                                class="mx-4"
                                inset
                                vertical
                            ></v-divider>
                            <v-spacer></v-spacer>
                            <v-icon                
                                @click.stop="$router.push('/konsultasi/kegiatan/'+kegiatan_id+'/detail')">
                                mdi-close-thick
                            </v-icon>
                        </v-toolbar>
                        <v-card-text>
                            <v-row>
                                <v-col xs="12" sm="6" md="4">                                    
                                    <v-card flat>
                                        <v-card-title>ID:</v-card-title>  
                                        <v-card-subtitle>
                                            {{data_kegiatan.kegiatan_id}}
                                        </v-card-subtitle>
                                    </v-card>
                                </v-col>
                                <v-responsive width="100%" v-if="$vuetify.breakpoint.xsOnly"/>
                                <v-col xs="12" sm="6" md="4">                                    
                                    <v-card flat>
                                        <v-card-title>JENIS KEGIATAN:</v-card-title>  
                                        <v-card-subtitle>
                                            {{data_kegiatan.nama_jenis}}
                                        </v-card-subtitle>
                                    </v-card>
                                </v-col>
                                <v-responsive width="100%" v-if="$vuetify.breakpoint.xsOnly"/>
                                <v-col xs="12" sm="6" md="4">                                    
                                    <v-card flat>
                                        <v-card-title>PEMOHON / PESERTA:</v-card-title>  
                                        <v-card-subtitle>
                                            {{data_kegiatan.pemohon}}
                                        </v-card-subtitle>
                                    </v-card>
                                </v-col>
                                <v-responsive width="100%" v-if="$vuetify.breakpoint.xsOnly"/>
                            </v-row>
                            <v-row>
                                <v-col xs="12" sm="6" md="4">                                    
                                    <v-card flat>
                                        <v-card-title>NAMA KEGIATAN:</v-card-title>  
                                        <v-card-subtitle>
                                            {{data_kegiatan.nama_kegiatan}}
                                        </v-card-subtitle>
                                    </v-card>
                                </v-col>
                                <v-responsive width="100%" v-if="$vuetify.breakpoint.xsOnly"/>
                                <v-col xs="12" sm="6" md="4">                                    
                                    <v-card flat>
                                        <v-card-title>STATUS:</v-card-title>  
                                        <v-card-subtitle>
                                            {{data_kegiatan.id_status}}
                                        </v-card-subtitle>
                                    </v-card>
                                </v-col>
                                <v-responsive width="100%" v-if="$vuetify.breakpoint.xsOnly"/>
                                <v-col xs="12" sm="6" md="4">                                    
                                    <v-card flat>
                                        <v-card-title>CREATED / UPDATED:</v-card-title>  
                                        <v-card-subtitle>
                                            {{$date(data_kegiatan.created_at).format('DD/MM/YYYY HH:mm')}} / {{$date(data_kegiatan.updated_at).format('DD/MM/YYYY HH:mm')}}
                                        </v-card-subtitle>
                                    </v-card>
                                </v-col>
                                <v-responsive width="100%" v-if="$vuetify.breakpoint.xsOnly"/>
                            </v-row>
                        </v-card-text>                        
                    </v-card>
                </v-col>
            </v-row>
            <v-row>
                <v-col xs="12" sm="6" md="4">                                    
                    <v-card>
                        <v-card-title>
                            DAFTAR HADIR
                        </v-card-title>
                    </v-card>   
                </v-col>
                <v-responsive width="100%" v-if="$vuetify.breakpoint.xsOnly"/>
                <v-col xs="12" sm="6" md="4">                                    
                    <v-card>
                        <v-card-title>
                            DOKUMENTASI KEGIATAN
                        </v-card-title>
                    </v-card>   
                </v-col>
                <v-responsive width="100%" v-if="$vuetify.breakpoint.xsOnly"/>
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
                                    @change="previewImage">
                                </v-file-input>
                            </v-card-text>
                            <v-card-actions>                            
                                <v-spacer/>                                      
                                <v-btn
                                    color="orange"
                                    text
                                    @click="uploadKtpPemohon"
                                    :loading="btnLoadingUploadKTP"                                
                                    :disabled="!form_valid_ktp||btnLoadingUploadKTP">                                   
                                    Upload
                                </v-btn>
                                <v-btn
                                    color="orange"
                                    text
                                    @click="hapusKtpPemohon"
                                    :loading="btnLoadingHapusKTP"                                
                                    :disabled="btnLoadingHapusKTP">                   
                                    Hapus
                                </v-btn>                            
                            </v-card-actions>
                        </v-card>   
                    </v-form>
                </v-col>
                <v-responsive width="100%" v-if="$vuetify.breakpoint.xsOnly"/>
            </v-row>
        </v-container>
    </AdminLayout>
</template>
<script>
import AdminLayout from '@/views/layouts/AdminLayout';
import ModuleHeader from '@/components/ModuleHeader';
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
                text:'FILES',
                disabled:true,
                href:'#'
            }
        ];
        this.initialize()
    },  
    data: () => ({ 
        kegiatan_id:null,
        data_kegiatan:{},
        btnLoadingUploadKTP:false,
        btnLoadingHapusKTP:false,

        //formdata
        form_valid_ktp:true,
        image_prev:null,
        filektppemohon:null,
        rule_filektp:[
            value => !!value||"Mohon pilih file ktp pemohon !!!",  
            value =>  !value || value.size < 2000000 || 'File ktp pemohon harus kurang dari 2MB.'                
        ],
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
                this.ktpPemohon=this.$api.url+'/'+data.kegiatan.file_fotocopy_ktp;
            })
        },   
        previewImage (e)
        {
            if (typeof e === 'undefined')
            {
                this.image_prev=null;                
            }
            else
            {
                let reader = new FileReader();
                reader.readAsDataURL(e);
                reader.onload = img => {                    
                    this.image_prev=img.target.result;
                }                
            }          
        }, 
        async uploadKtpPemohon ()
        {
            if (this.$refs.frmuploadktp.validate())
            {
                if (typeof this.filektppemohon !== 'undefined' && this.filektppemohon !== null )
                {
                    this.btnLoadingUploadKTP=true;
                    var formdata = new FormData();                                        
                    formdata.append('filektppemohon',this.filektppemohon);
                    await this.$ajax.post('/konsultasi/kegiatan/uploadktppemohon/'+this.kegiatan_id,formdata,                    
                        {
                            headers:{
                                Authorization:this.$store.getters['auth/Token'],
                                'Content-Type': 'multipart/form-data'                      
                            }
                        }
                    ).then(()=>{                                                                                            
                        this.btnLoadingHapusKTP=false;   
                        this.$router.go();                     
                    }).catch(()=>{
                        this.btnLoadingHapusKTP=false;
                    });                    
                }
            }
        },    
        async hapusKtpPemohon ()
        {

        },    
    },  
    computed: {
        ktpPemohon :{
            get ()
            {   
                if (this.image_prev==null)
                {
                    return require('@/assets/no-image.png');
                }
                else
                {
                    return this.image_prev;
                }
            },
            set (val)
            {
                this.image_prev=val;
            }
        }
    },
    components:{
        AdminLayout,
        ModuleHeader,        
    },

}
</script>