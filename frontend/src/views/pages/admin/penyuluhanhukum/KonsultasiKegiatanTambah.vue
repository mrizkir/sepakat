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
        <v-form ref="frmdata" v-model="form_valid" lazy-validation>
            <v-container fluid>   
                <v-row>  
                    <v-col cols="12"> 
                        <v-card>
                            <v-card-title>
                                <span class="headline">TAMBAH KEGIATAN</span>
                            </v-card-title>
                            <v-card-text>
                                <v-select
                                    label="PARALEGAL"
                                    :items="daftar_paralegal"
                                    v-model="formdata.user_id"
                                    item-text="name"
                                    item-value="id"                                                                        
                                    filled
                                />
                                <v-select
                                    label="JENIS KEGIATAN"
                                    :items="daftar_jenis_kegiatan"
                                    v-model="formdata.id_jenis_kegiatan"
                                    item-text="nama_jenis"
                                    item-value="id_jenis"
                                    filled
                                    return-object
                                />   
                                <v-text-field
                                    label="NAMA KEGIATAN"                                        
                                    v-model="formdata.nama_kegiatan"
                                    :rules="rule_nama_kegiatan"
                                    filled
                                />
                                <v-textarea
                                    label="URAIAN / KRONOLOGIS KEGIATAN"                                        
                                    v-model="formdata.uraian_kegiatan"
                                    :rules="rule_uraian_kegiatan"
                                    filled
                                />
                                <v-menu
                                    ref="menuTanggalKonsultasi"
                                    v-model="menuTanggalKonsultasi"
                                    :close-on-content-click="false"
                                    :return-value.sync="formdata.tanggal_konsultasi"
                                    transition="scale-transition"
                                    offset-y
                                    max-width="290px"
                                    min-width="290px"
                                >
                                    <template v-slot:activator="{ on }">
                                        <v-text-field
                                            v-model="formdata.tanggal_konsultasi"
                                            label="TANGGAL"                                            
                                            readonly
                                            filled
                                            :rules="rule_tanggal_konsultasi"
                                            v-on="on"                                            
                                        ></v-text-field>
                                    </template>
                                    <v-date-picker
                                        v-model="formdata.tanggal_konsultasi"                                        
                                        no-title                                
                                        scrollable
                                        >
                                        <v-spacer></v-spacer>
                                        <v-btn text color="primary" @click="menuTanggalKonsultasi = false">Cancel</v-btn>
                                        <v-btn text color="primary" @click="$refs.menuTanggalKonsultasi.save(formdata.tanggal_konsultasi)">OK</v-btn>
                                    </v-date-picker>                        
                                </v-menu>
                                <v-menu
                                    ref="menuJamKonsultasi"
                                    v-model="menuJamKonsultasi"
                                    :close-on-content-click="false"
                                    :nudge-right="40"
                                    :return-value.sync="formdata.jam_konsultasi"
                                    transition="scale-transition"
                                    offset-y
                                    max-width="290px"
                                    min-width="290px">
                                    <template v-slot:activator="{ on, attrs }">
                                        <v-text-field
                                            v-model="formdata.jam_konsultasi"
                                            label="WAKTU"                                                            
                                            readonly
                                            filled
                                            :rules="rule_jam_konsultasi"
                                            v-bind="attrs"
                                            v-on="on"
                                        ></v-text-field>
                                    </template>
                                    <v-time-picker
                                        v-if="menuJamKonsultasi"
                                        v-model="formdata.jam_konsultasi"
                                        full-width
                                        format="24hr"
                                        @click:minute="$refs.menuJamKonsultasi.save(formdata.jam_konsultasi)"
                                    ></v-time-picker>
                                </v-menu>
                                <v-text-field
                                    label="TEMPAT (ALAMAT PEMOHON)"                                        
                                    v-model="formdata.tempat"
                                    :rules="rule_tempat"
                                    filled
                                />                    
                                <v-text-field
                                    label="PESERTA / PEMOHON"                                        
                                    v-model="formdata.pemohon"
                                    :rules="rule_pemohon"
                                    filled
                                />   
                                <v-textarea
                                    label="REKOMENDASI YANG DIBERIKAN"                                        
                                    v-model="formdata.rekomendasi_kegiatan"
                                    :rules="rule_rekomendasi_kegiatan"
                                    filled
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
                                    :disabled="!form_valid||btnLoading">
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
import AdminLayout from '@/views/layouts/AdminLayout';
import ModuleHeader from '@/components/ModuleHeader';
export default {
    name: 'KonsultasiKegiatanTambah',
    created () {
        this.dashboard = this.$store.getters['uiadmin/getDefaultDashboard']; 
        this.breadcrumbs = [
            {
                text: 'HOME',
                disabled: false,
                href: '/dashboard/' + this.$store.getters['auth/AccessToken']
            },
            {
                text: 'KONSULTASI',
                disabled: false,
                href: '#'
            },
            {
                text: 'KEGIATAN',
                disabled: false,
                href: '/konsultasi/kegiatan'
            },
            {
                text: 'TAMBAH',
                disabled: true,
                href: '#'
            }
        ];
        this.initialize()
    },  
    data: () => ({ 
        dashboard: null,
        
        btnLoading: false,
        form_valid: true, 
        daftar_paralegal: [], 
        menuTanggalKonsultasi: false,
        menuJamKonsultasi: false,
        daftar_jenis_kegiatan: [],
        formdata: {
            id_jenis_kegiatan: '',
            user_id: '',
            nama_kegiatan: '',
            uraian_kegiatan: '',
            tanggal_konsultasi: '',
            jam_konsultasi: '',
            tempat: '',   
            pemohon: '',
            rekomendasi_kegiatan: '',
        },
        formdefault: {
            id_jenis_kegiatan: '',
            user_id: '',
            nama_kegiatan: '',
            uraian_kegiatan: '',
            tanggal_konsultasi: '',
            jam_konsultasi: '',
            tempat: '',   
            pemohon: '',
            rekomendasi_kegiatan: '',
        },
        rule_user_id:[
            value => !!value||"Mohon untuk dipilih paralegal !!!",     
        ],
        rule_nama_kegiatan:[
            value => !!value||"Mohon untuk diisi nama kegiata konsultasi !!!",    
        ],
        rule_uraian_kegiatan:[
            value => !!value||"Mohon untuk diisi uraian kegiatan konsultasi !!!",    
        ],
        rule_tanggal_konsultasi:[
            value => !!value||"Mohon untuk diisi tanggal kegiatan !!!",    
        ],
        rule_jam_konsultasi:[
            value => !!value||"Mohon untuk diisi waktu kegiatan !!!",    
        ],
        rule_tempat:[
            value => !!value||"Mohon untuk diisi tempat kegiatan konsultasi !!!",    
        ],  
        rule_pemohon:[
            value => !!value||"Mohon untuk diisi pemohon / peserta kegiatan konsultasi !!!",    
        ],
        rule_rekomendasi_kegiatan:[
            value => !!value||"Mohon untuk diisi rekomendasi kegiatan konsultasi !!!",    
        ],
        
    }),
    methods: {
        initialize: async function () 
        {
            await this.$ajax.get('/datamaster/jeniskegiatan',{
                headers: {
                    Authorization:this.$store.getters['auth/Token']
                }
            }).then(({data})=>{
                this.daftar_jenis_kegiatan = data.jenis_kegiatan;                
            });
            await this.$ajax.get('/system/usersparalegal',{
                headers: {
                    Authorization:this.$store.getters['auth/Token']
                }
            }).then(({ data }) => {
                this.daftar_paralegal = data.users;                
            });          
        },
        save: async function () {
            if (this.$refs.frmdata.validate())
            {
                this.btnLoading=true;                
                await this.$ajax.post('/konsultasi/kegiatan/store',
                    {
                        user_id:this.formdata.user_id,
                        tanggal_konsultasi:this.formdata.tanggal_konsultasi,
                        jam_konsultasi:this.formdata.jam_konsultasi,
                        tempat:this.formdata.tempat,
                        id_jenis:this.formdata.id_jenis_kegiatan.id_jenis,
                        nama_jenis:this.formdata.id_jenis_kegiatan.nama_jenis,
                        nama_kegiatan:this.formdata.nama_kegiatan,
                        pemohon:this.formdata.pemohon,               
                        uraian_kegiatan:this.formdata.uraian_kegiatan,
                        rekomendasi_kegiatan:this.formdata.rekomendasi_kegiatan,
                    },
                    {
                        headers: {
                            Authorization:this.$store.getters['auth/Token']
                        }
                    }
                ).then(({data})=>{        
                    this.btnLoading = false               
                    setTimeout(() => {
                        this.formdata = Object.assign({}, this.formdefault);                                
                        this.$router.push('/konsultasi/kegiatan/'+data.kegiatan.kegiatan_id+'/files')
                        }, 300
                    );
                }).catch(()=>{
                    this.btnLoading = false
                });                
            }
        },
        closedialogfrm () {            
            setTimeout(() => {
                this.formdata = Object.assign({}, this.formdefault);                                
                this.$router.push('/konsultasi/kegiatan')
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