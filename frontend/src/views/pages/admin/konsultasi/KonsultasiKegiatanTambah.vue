<template>
    <AdminLayout>
        <ModuleHeader>
            <template v-slot:icon>
                mdi-calendar-blank-multiple
            </template>
            <template v-slot:name>
                KONSULTASI KEGIATAN
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
        <v-container>               
            <v-row class="mb-4" no-gutters>               
                <v-form ref="frmdata" v-model="form_valid" lazy-validation>
                    <v-card>
                        <v-card-title>
                            <span class="headline">TAMBAH KEGIATAN</span>
                        </v-card-title>
                        <v-card-text>
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
                                        label="TANGGAL ONSET"                                            
                                        readonly
                                        filled
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
                                        label="JAM MULAI UJIAN"                                                            
                                        readonly
                                        outlined
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
                                label="TEMPAT"                                        
                                v-model="formdata.tempat"
                                :rules="rule_kasus_ke"
                                filled
                            />
                            <v-select
                                label="JENIS KEGIATAN"
                                :items="daftar_jenis_kegiatan"
                                v-model="formdata.id_jenis_kegiatan"
                                item-text="nama_jenis"
                                item-value="id_jenis"
                                outlined
                            />
                            <v-text-field
                                label="NAMA KEIGATAN"                                        
                                v-model="formdata.nama_kegiatan"
                                :rules="rule_kasus_ke"
                                filled
                            />
                            <v-text-field
                                label="PESERTA /PEMOHON"                                        
                                v-model="formdata.pemohon"
                                :rules="rule_kasus_ke"
                                filled
                            />
                            
                            <v-text-field
                                label="URAIAN KEGIATAN"                                        
                                v-model="formdata.uraian_kegiatan"
                                :rules="rule_kasus_ke"
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
                </v-form>
            </v-row>
        </v-container>
    </AdminLayout>
</template>
<script>
import AdminLayout from '@/views/layouts/AdminLayout';
import ModuleHeader from '@/components/ModuleHeader';
export default {
    name:'KonsultasiKegiatanTambah',
    created () {
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
                href:'/konsultasi/kegiatan'
            },
            {
                text:'TAMBAH',
                disabled:true,
                href:'#'
            }
        ];
        this.initialize()
    },  
    data: () => ({ 
        btnLoading:false,
    }),
    methods: {
        initialize:async function () 
        {
            
        },
    },  
    components:{
        AdminLayout,
        ModuleHeader,        
    },

}
</script>