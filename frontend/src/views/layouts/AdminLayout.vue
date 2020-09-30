<template>
    <div>
        <v-system-bar app dark class="yellow">
            
		</v-system-bar>	
        <v-app-bar 
            class="indigo darken-4 yellow--text"
            dark
            app>
            <v-app-bar-nav-icon @click.stop="drawer = !drawer" class="grey--text"></v-app-bar-nav-icon>
            <v-toolbar-title class="headline clickable" @click.stop="$router.push('/dashboard/'+$store.getters['auth/AccessToken']).catch(err => {})">
				<span class="hidden-sm-and-down">{{APP_NAME}}<br/>
                [<small>Sistem Elektronik Paralegal Masyarakat</small>]
                </span>
			</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-menu 
                :close-on-content-click="true"
                origin="center center"
                transition="scale-transition"
                :offset-y="true"
                bottom 
                left>
                <template v-slot:activator="{on}">
                    <v-avatar size="30">
                        <v-img :src="photoUser" v-on="on" />
                    </v-avatar>                    
                </template>
                <v-list>
                    <v-list-item>
                        <v-list-item-avatar>
                            <v-img :src="photoUser"></v-img>
                        </v-list-item-avatar>
                        <v-list-item-content>					
                            <v-list-item-title class="title">
                                {{ATTRIBUTE_USER('username')}}
                            </v-list-item-title>
                            <v-list-item-subtitle>                                
                                {{ROLE}}
                            </v-list-item-subtitle>
                        </v-list-item-content>
                    </v-list-item>                    
                    <v-divider/>
                    <v-list-item to="/system-users/profil">
                        <v-list-item-icon class="mr-2">
							<v-icon>mdi-account</v-icon>
						</v-list-item-icon>
                        <v-list-item-title>Profil</v-list-item-title>
                    </v-list-item>
                    <v-divider/>
                    <v-list-item @click.prevent="logout">
                        <v-list-item-icon class="mr-2">
							<v-icon>mdi-power</v-icon>
						</v-list-item-icon>
                        <v-list-item-title>Logout</v-list-item-title>
                    </v-list-item>
                </v-list>
            </v-menu>
            <v-divider
                class="mx-4"
                inset
                vertical
            ></v-divider>
			<v-app-bar-nav-icon @click.stop="drawerRight = !drawerRight">
                <v-icon>mdi-menu-open</v-icon>
			</v-app-bar-nav-icon>            
        </v-app-bar>    
        <v-navigation-drawer v-model="drawer" width="300" dark class="indigo darken-4" :temporary="isReportPage" app>
			<v-list-item>
				<v-list-item-avatar>
					<v-img :src="photoUser" @click.stop="toProfile"></v-img>
				</v-list-item-avatar>
				<v-list-item-content>					
					<v-list-item-title class="title">
						{{ATTRIBUTE_USER('username')}}
					</v-list-item-title>
					<v-list-item-subtitle>
						{{ROLE}}
					</v-list-item-subtitle>
				</v-list-item-content>
			</v-list-item>
			<v-divider></v-divider>
            <v-list expand>
                <v-list-item :to="{path:'/dashboard/'+ACCESS_TOKEN}" link active-class="yellow" color="green" v-if="CAN_ACCESS('DASHBOARD-SHOW')">
                    <v-list-item-icon class="mr-2">
                        <v-icon>mdi-monitor-dashboard</v-icon>
                    </v-list-item-icon>
                    <v-list-item-content>
                        <v-list-item-title>DASHBOARD</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>      
                <v-subheader v-if="CAN_ACCESS('DMASTER-GROUP')">DATA MASTER</v-subheader>             
                <v-list-item link active-class="yellow darken-4" to="/dmaster/jeniskegiatan" v-if="CAN_ACCESS('DMASTER-JENISKEGIATAN_BROWSE')">
                    <v-list-item-icon class="mr-2">
                        <v-icon>mdi-format-list-bulleted-triangle</v-icon>
                    </v-list-item-icon>
                    <v-list-item-content>
                        <v-list-item-title>
                            JENIS KEGIATAN
                        </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>               
                <v-subheader v-if="CAN_ACCESS('KONSULTASI-GROUP')">KONSULTASI</v-subheader>
                <v-list-item link to="/konsultasi/kegiatan" v-if="CAN_ACCESS('KONSULTASI-KEGIATAN_BROWSE')">
                    <v-list-item-icon class="mr-2">
                        <v-icon>mdi-calendar-blank-multiple</v-icon>
                    </v-list-item-icon>
                    <v-list-item-content>
                        <v-list-item-title>
                            KEGIATAN
                        </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>                
                <v-subheader v-if="CAN_ACCESS('REPORT-GROUP')">LAPORAN</v-subheader>                                         
                <v-list-item link to="/laporan/kegiatan" v-if="CAN_ACCESS('REPORT-KEGIATAN_BROWSE')">
                    <v-list-item-icon class="mr-2">
                        <v-icon>mdi-clipboard-list-outline</v-icon>
                    </v-list-item-icon>
                    <v-list-item-content>
                        <v-list-item-title>
                            LAPORAN KEGIATAN
                        </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>                
                <v-subheader v-if="CAN_ACCESS('SYSTEM-SETTING-GROUP')">SETTING</v-subheader>
                <v-list-item link v-if="CAN_ACCESS('SYSTEM-SETTING-PERMISSIONS')" to="/system-users/permissions">
                    <v-list-item-icon class="mr-2">
                        <v-icon>mdi-account-key</v-icon>
                    </v-list-item-icon>
                    <v-list-item-content>
                        <v-list-item-title>
                            HAK AKSES PENGGUNA
                        </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>  
                <v-list-item link v-if="CAN_ACCESS('SYSTEM-SETTING-ROLES')" to="/system-users/roles">
                    <v-list-item-icon class="mr-2">
                        <v-icon>mdi-account-group</v-icon>
                    </v-list-item-icon>
                    <v-list-item-content>
                        <v-list-item-title>
                            ROLE PENGGUNA
                        </v-list-item-title>
                    </v-list-item-content>                    
                </v-list-item>  
                <v-divider/>
                <v-list-group group="/system-users" active-class="yellow" no-action v-if="CAN_ACCESS('SYSTEM-USERS-GROUP')" color="green">
                    <template v-slot:activator>
                        <v-list-item-icon class="mr-2">
                            <v-icon>mdi-home-floor-b</v-icon>
                        </v-list-item-icon>
                        <v-list-item-content>								
                            <v-list-item-title>PENGGUNA</v-list-item-title>
                        </v-list-item-content>							
                    </template>
					<div>
						<v-list-item link v-if="CAN_ACCESS('SYSTEM-USERS-SUPERADMIN_BROWSE')" to="/system-users/superadmin">
                            <v-list-item-icon class="mr-2">
                                <v-icon>mdi-account</v-icon>
                            </v-list-item-icon>
                            <v-list-item-content>
                                <v-list-item-title>
                                    SUPERADMIN
                                </v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>  
                        <v-list-item link v-if="CAN_ACCESS('SYSTEM-USERS-HUMKAM_BROWSE')" to="/system-users/kumham">
                            <v-list-item-icon class="mr-2">
                                <v-icon>mdi-account</v-icon>
                            </v-list-item-icon>
                            <v-list-item-content>
                                <v-list-item-title>
                                    KANWIL HUKUM DAN HAM
                                </v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>                       
                        <v-list-item link v-if="CAN_ACCESS('SYSTEM-USERS-PARALEGAL_BROWSE')" to="/system-users/paralegal">
                            <v-list-item-icon class="mr-2">
                                <v-icon>mdi-account</v-icon>
                            </v-list-item-icon>
                            <v-list-item-content>
                                <v-list-item-title>
                                    PARALEGAL
                                </v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>    
                        <v-list-item link v-if="CAN_ACCESS('SYSTEM-USERS-KADES_BROWSE')" to="/system-users/kades">
                            <v-list-item-icon class="mr-2">
                                <v-icon>mdi-account</v-icon>
                            </v-list-item-icon>
                            <v-list-item-content>
                                <v-list-item-title>
                                    KADES
                                </v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>    
                        <v-list-item link v-if="CAN_ACCESS('SYSTEM-USERS-AKADEMIK_BROWSE')" to="/system-users/pmb">
                            <v-list-item-icon class="mr-2">
                                <v-icon>mdi-account</v-icon>
                            </v-list-item-icon>
                            <v-list-item-content>
                                <v-list-item-title>
                                    PMD
                                </v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>                       
                        <v-list-item link v-if="CAN_ACCESS('SYSTEM-USERS-OBH_BROWSE')" to="/system-users/obh">
                            <v-list-item-icon class="mr-2">
                                <v-icon>mdi-account</v-icon>
                            </v-list-item-icon>
                            <v-list-item-content>
                                <v-list-item-title>
                                    OBH
                                </v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>                                               
					</div>
                </v-list-group>                
            </v-list>
        </v-navigation-drawer>
        <v-navigation-drawer v-model="drawerRight" width="300" app fixed right temporary>
            <v-list dense>
                <v-list-item>		
                    <v-list-item-icon class="mr-2">
                        <v-icon>mdi-menu-open</v-icon>
                    </v-list-item-icon>			
                    <v-list-item-content>									
                        <v-list-item-title class="title">
                            OPTIONS
                        </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
                <v-divider></v-divider>
                <v-list-item class="teal lighten-5 mb-5">
                    <v-list-item-icon class="mr-2">
                        <v-icon>mdi-filter</v-icon>
                    </v-list-item-icon>
                    <v-list-item-content>								
                        <v-list-item-title>FILTER</v-list-item-title>
                    </v-list-item-content>		
                </v-list-item>
                <slot name="filtersidebar"/>		                	
            </v-list>
		</v-navigation-drawer>
        <v-main class="mx-4 mb-4">			
			<slot />
		</v-main>
    </div>    
</template>
<script>
import {mapGetters} from 'vuex';
export default {
    name:'AdminLayout',     
    created()
    {
        this.dashboard = this.$store.getters['uiadmin/getDefaultDashboard'];        
    },
    data:()=>({
        loginTime:0,
        drawer:null,
        drawerRight:null, 
        
        dashboard:null,
    }),       
    methods: {        
        logout ()
        {
            this.loginTime=0;
            this.$ajax.post('/auth/logout',
                {},
                {
                    headers:{
                        'Authorization': this.TOKEN,
                    }
                }
            ).then(()=> {     
                this.$store.dispatch('auth/logout');	
                this.$store.dispatch('uifront/reinit');	
                this.$store.dispatch('uiadmin/reinit');	
                this.$router.push('/');
            })
            .catch(() => {
                this.$store.dispatch('auth/logout');	
                this.$store.dispatch('uifront/reinit');	
                this.$store.dispatch('uiadmin/reinit');	
                this.$router.push('/');
            });
        },
        isBentukPT (bentuk_pt)
        {
            return this.$store.getters['uifront/getBentukPT']==bentuk_pt?true:false;
        }
	},
    computed:{
        ...mapGetters('auth',{
            AUTHENTICATED:'Authenticated',  
            ACCESS_TOKEN:'AccessToken',          
            TOKEN:'Token',          
            ROLE:'Role',
            CAN_ACCESS:'can',         
            ATTRIBUTE_USER:'AttributeUser',               
        }),
        APP_NAME ()
        {
            return process.env.VUE_APP_NAME;
        },
        photoUser()
		{
			let img=this.ATTRIBUTE_USER('foto');
			var photo;
			if (img == '')
			{
				photo = this.$api.url+'/storage/images/users/no_photo.png';	
			}
			else
			{
				photo = this.$api.url+'/'+img;	
			}
			return photo;
        },
        isReportPage ()
		{
			if (this.$route.name=='ReportFormBMurni')
			{
				return true;
			}
			else
			{
				return false;
			}
        },        
    },
    watch: {
        loginTime:{
            handler(value)
            {
                
                if (value >= 0)
                {
                    setTimeout(() => { 
                        this.loginTime=this.AUTHENTICATED==true?this.loginTime+1:-1;                                                                     
					}, 1000);
                }
                else
                {
                    this.$store.dispatch('auth/logout');
                    this.$router.replace('/login');
                }
            },
            immediate:true
        },        
    }
}
</script>