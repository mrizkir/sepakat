<template>
    <AdminLayout>		                   
		<v-container fluid>
			<v-row>
				<v-cols col="6">
					
				</v-cols>
			</v-row>
		</v-container>
    </AdminLayout>
</template>
<script>
import AdminLayout from '@/views/layouts/AdminLayout';
export default {
    name: 'Dashboard',
    created ()
	{
        this.TOKEN = this.$route.params.token;        
		this.breadcrumbs = [
			{
				text:'HOME',
				disabled:false,
				href:'/dashboard/'+this.TOKEN
			},
			{
				text:'DASHBOARD',
				disabled:true,
				href:'#'
			}
		];		
		this.initialize();
		this.fetchData();

	},
	data: () => ({
        breadcrumbs:[],
        TOKEN:null,
        dashboard:null,

		tahun_pendaftaran:'',

		data_jenis_kegiatan:[],
	}),
	methods : {
		initialize:async function()
		{	
            
            await this.$ajax.get('/auth/me',                
            {
                headers: {
                    Authorization:'Bearer '+this.TOKEN
                }
            }).then(({data})=>{          
                this.dashboard = data.role[0];    
                this.$store.dispatch('uiadmin/changeDashboard',this.dashboard);                                       
            });                 
            this.$store.dispatch('uiadmin/init',this.$ajax);              
			this.tahun_pendaftaran = this.$store.getters['uiadmin/getTahunPendaftaran'];            
			
		},
		async fetchData ()
		{
			await this.$ajax.get('/dashboard',                
            {
                headers: {
                    Authorization:'Bearer '+this.TOKEN
                }
            }).then(({data})=>{          
                this.data_jenis_kegiatan=data.jenis_kegiatan;
            });    
		}
	},
	computed:{
        
	},
    components:{
		AdminLayout,                
	}
}
</script>