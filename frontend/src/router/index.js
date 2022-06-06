import Vue from 'vue'
import VueRouter from 'vue-router'
import store from '../store/index'
import NotFoundComponent from '../components/NotFoundComponent'

Vue.use(VueRouter)
const routes = [
	{
		path: '/',
		name: 'FrontDashboard',
		meta:{
			title: "DASHBOARD"
		},
		component: () => import('../views/pages/front/Home.vue')
	},
	{
		path: '/about',
		name: 'FrontAbout',
		meta:{
			title: "ABOUT"
		},
		component: () => import('../views/pages/front/About.vue')
	},
	{
		path: '/login',
		name: 'FrontLogin',
		meta:{
			title: "LOGIN"
		},
		component: () => import('../views/pages/front/Login.vue')
	},
	{
		path: '/dashboard/:token',
		name: 'AdminDashboard',
		meta:{
			title: "DASHBOARD",			
        },
		component: () => import('../views/pages/admin/Dashboard.vue'),		
	},
	//dmaster		
	{
		path: '/dmaster/jeniskegiatan',
		name: 'DMasterKelas',
		meta:{
			title: "DATA MASTER - KELAS",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/dmaster/JenisKegiatan.vue'),		
	},	
	//kegiatan - mediasi
	{
		path: '/kegiatan/mediasi',
		name: 'KegiatanMediasi',
		meta:{
			title: "KEGIATAN - MEDIASI",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/mediasi/KegiatanMediasi.vue'),		
	},
	{
		path: '/kegiatan/mediasi/tambah',
		name: 'KegiatanMediasiTambah',
		meta:{
			title: "KEGIATAN - MEDIASI",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/mediasi/KegiatanMediasiTambah.vue'),		
	},
	{
		path: '/kegiatan/mediasi/:kegiatan_id/ubah',
		name: 'KegiatanMediasiUbah',
		meta:{
			title: "KEGIATAN - MEDIASI",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/mediasi/KegiatanMediasiUbah.vue'),		
	},
	{
		path: '/kegiatan/mediasi/:kegiatan_id/files',
		name: 'KegiatanMediasiFiles',
		meta:{
			title: "KEGIATAN - MEDIASI",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/mediasi/KegiatanMediasiFiles.vue'),		
	},
	{
		path: '/kegiatan/mediasi/:kegiatan_id/detail',
		name: 'KegiatanMediasiDetail',
		meta:{
			title: "KEGIATAN - MEDIASI",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/mediasi/KegiatanMediasiDetail.vue'),		
	},

	//kegiatan - penyuluhan hukum
	{
		path: '/kegiatan/penyuluhanhukum',
		name: 'KegiatanPenyuluhanHukum',
		meta:{
			title: "KEGIATAN - MEDIASI",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/penyuluhanhukum/KegiatanPenyuluhanHukum.vue'),		
	},
	{
		path: '/kegiatan/penyuluhanhukum/tambah',
		name: 'KegiatanPenyuluhanHukumTambah',
		meta:{
			title: "KEGIATAN - MEDIASI",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/penyuluhanhukum/KegiatanPenyuluhanHukumTambah.vue'),		
	},
	{
		path: '/kegiatan/penyuluhanhukum/:kegiatan_id/ubah',
		name: 'KegiatanPenyuluhanHukumUbah',
		meta:{
			title: "KEGIATAN - MEDIASI",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/penyuluhanhukum/KegiatanPenyuluhanHukumUbah.vue'),		
	},
	{
		path: '/kegiatan/penyuluhanhukum/:kegiatan_id/files',
		name: 'KegiatanPenyuluhanHukumFiles',
		meta:{
			title: "KEGIATAN - MEDIASI",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/penyuluhanhukum/KegiatanPenyuluhanHukumFiles.vue'),		
	},
	{
		path: '/kegiatan/penyuluhanhukum/:kegiatan_id/detail',
		name: 'KegiatanPenyuluhanHukumDetail',
		meta:{
			title: "KEGIATAN - MEDIASI",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/penyuluhanhukum/KegiatanPenyuluhanHukumDetail.vue'),		
	},
	
	//kegiatan - konsultasi hukum
	{
		path: '/kegiatan/konsultasihukum',
		name: 'KegiatanKonsultasiHukum',
		meta:{
			title: "KEGIATAN - KONSULTASI HUKUM",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/konsultasihukum/KegiatanKonsultasiHukum.vue'),		
	},
	{
		path: '/kegiatan/konsultasihukum/tambah',
		name: 'KegiatanKonsultasiHukumTambah',
		meta:{
			title: "KEGIATAN - KONSULTASI HUKUM",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/konsultasihukum/KegiatanKonsultasiHukumTambah.vue'),		
	},
	{
		path: '/kegiatan/konsultasihukum/:kegiatan_id/ubah',
		name: 'KegiatanKonsultasiHukumUbah',
		meta:{
			title: "KEGIATAN - KONSULTASI HUKUM",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/konsultasihukum/KegiatanKonsultasiHukumUbah.vue'),		
	},
	{
		path: '/kegiatan/konsultasihukum/:kegiatan_id/files',
		name: 'KegiatanKonsultasiHukumFiles',
		meta:{
			title: "KEGIATAN - KONSULTASI HUKUM",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/konsultasihukum/KegiatanKonsultasiHukumFiles.vue'),		
	},
	{
		path: '/kegiatan/konsultasihukum/:kegiatan_id/detail',
		name: 'KegiatanKonsultasiHukumDetail',
		meta:{
			title: "KEGIATAN - KONSULTASI HUKUM",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/konsultasihukum/KegiatanKonsultasiHukumDetail.vue'),		
	},
	//laporan	
	{
		path: '/laporan/kegiatan',
		name: 'LaporanKegiatan',
		meta:{
			title: "LAPORAN - KEGIATAN",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/laporan/LaporanKegiatan.vue'),		
	},		
	//setting		
	{
		path: '/system-setting/identitasdiri',
		name: 'IdentitasDiri',
		meta:{
			title: "SETTING - IDENTITAS DIRI",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/system/IdentitasDiri.vue'),		
	},	
	{
		path: '/system-setting/captcha',
		name: 'SettingCaptcha',
		meta:{
			title: "SETTING - CAPTCHA",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/system/Captcha.vue'),		
	},
	{
		path: '/system-setting/email',
		name: 'SettingEmail',
		meta:{
			title: "SETTING - EMAIL",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/system/Email.vue'),		
	},

	{
		path: '/system-users/permissions',
		name: 'UsersPermissions',
		meta:{
			title: "USERS - PERMISSIONS",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/system/Permissions.vue'),		
	},
	{
		path: '/system-users/roles',
		name: 'UsersRoles',
		meta:{
			title: "USERS - ROLES",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/system/Roles.vue'),		
	},
	{
		path: '/system-users/superadmin',
		name: 'UsersSuperadmin',
		meta:{
			title: "USERS - SUPER ADMIN",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/system/UsersSuperadmin.vue'),		
	},
	{
		path: '/system-users/paralegal',
		name: 'UsersParaLegal',
		meta:{
			title: "USERS - LEGAL",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/system/UsersParaLegal.vue'),		
	},
	{
		path: '/system-users/pmb',
		name: 'UsersPMB',
		meta:{
			title: "USERS - PMB",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/system/UsersPMB.vue'),		
	},
	{
		path: '/system-users/kades',
		name: 'UsersKades',
		meta:{
			title: "USERS - KADES",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/system/UsersKades.vue'),		
	},
	{
		path: '/system-users/obh',
		name: 'UsersOBH',
		meta:{
			title: "USERS - ORGANISASI BANTUAN HUKUM",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/system/UsersOBH.vue'),		
	},
	{
		path: '/system-users/kumham',
		name: 'UsersKumham',
		meta:{
			title: "USERS - KANWIL HUKUM DAN HAM",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/system/UsersKumham.vue'),		
	},
	{
		path: '/system-users/profil',
		name: 'UsersProfil',
		meta:{
			title: "USERS - PROFILE",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/system/UsersProfile.vue'),		
	},
	{
		path: '/404',
		name: 'NotFoundComponent',
		meta:{
            title: "PAGE NOT FOUND"
        },
		component: NotFoundComponent
	},
	{ 
		path: '*', 
		redirect: '/404' 
	},
]

const router = new VueRouter({
	mode: 'history',
	base: process.env.BASE_URL,
	routes
})

router.beforeEach((to, from, next) => {
	document.title = to.meta.title;	
	if (to.matched.some(record => record.meta.requiresAuth))	
	{
		if (store.getters['auth/Authenticated'])
		{
			next();
			return;
		}
		next('/login');
	}
	else
	{
		next();
	}
})
export default router
