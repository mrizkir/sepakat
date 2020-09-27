<template>
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
                @click.stop="$router.push(path)">
                mdi-close-thick
            </v-icon>
        </v-toolbar>
        <v-card-text>
            <v-row>
                <v-col xs="12" sm="6" md="4">                                    
                    <v-card flat>
                        <v-card-title>ID:</v-card-title>  
                        <v-card-subtitle>
                            {{datakegiatan.kegiatan_id}}
                        </v-card-subtitle>
                    </v-card>
                </v-col>
                <v-responsive width="100%" v-if="$vuetify.breakpoint.xsOnly"/>
                <v-col xs="12" sm="6" md="4">                                    
                    <v-card flat>
                        <v-card-title>JENIS KEGIATAN:</v-card-title>  
                        <v-card-subtitle>
                            {{datakegiatan.nama_jenis}}
                        </v-card-subtitle>
                    </v-card>
                </v-col>
                <v-responsive width="100%" v-if="$vuetify.breakpoint.xsOnly"/>
                <v-col xs="12" sm="6" md="4">                                    
                    <v-card flat>
                        <v-card-title>PEMOHON / PESERTA:</v-card-title>  
                        <v-card-subtitle>
                            {{datakegiatan.pemohon}}
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
                            {{datakegiatan.nama_kegiatan}}
                        </v-card-subtitle>
                    </v-card>
                </v-col>
                <v-responsive width="100%" v-if="$vuetify.breakpoint.xsOnly"/>
                <v-col xs="12" sm="6" md="4">                                    
                    <v-card flat>
                        <v-card-title>STATUS:</v-card-title>  
                        <v-card-subtitle>
                            {{datakegiatan.id_status}}
                        </v-card-subtitle>
                    </v-card>
                </v-col>
                <v-responsive width="100%" v-if="$vuetify.breakpoint.xsOnly"/>
                <v-col xs="12" sm="6" md="4">                                    
                    <v-card flat>
                        <v-card-title>CREATED / UPDATED:</v-card-title>  
                        <v-card-subtitle>
                            {{$date(datakegiatan.created_at).format('DD/MM/YYYY HH:mm')}} / {{$date(datakegiatan.updated_at).format('DD/MM/YYYY HH:mm')}}
                        </v-card-subtitle>
                    </v-card>
                </v-col>
                <v-responsive width="100%" v-if="$vuetify.breakpoint.xsOnly"/>
            </v-row>
        </v-card-text>                        
    </v-card>
</template>
<script>
export default {
    name:'DataKegiatan',
    props:{
        datakegiatan:{            
            type:Object,
            required:true
        },
        path:{
            default:'/konsultasi/kegiatan'
        }
    }
}
</script>