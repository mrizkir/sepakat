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
		name: 'DMasterJenisKegiatan',
		meta:{
			title: "DATA MASTER - JENIS KEGIATAN",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/dmaster/JenisKegiatan.vue'),		
	},	
	{
		path: '/dmaster/dokumenkegiatan',
		name: 'DMasterDokumenKegiatan',
		meta:{
			title: "DATA MASTER - DOKUMEN KEGIATAN",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/dmaster/DokumenKegiatan.vue'),		
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

	//kegiatan - negoisasi
	{
		path: '/kegiatan/negoisasi',
		name: 'KegiatanNegoisasi',
		meta:{
			title: "KEGIATAN - NEGOISASI",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/negoisasi/KegiatanNegoisasi.vue'),		
	},
	{
		path: '/kegiatan/negoisasi/tambah',
		name: 'KegiatanNegoisasiTambah',
		meta:{
			title: "KEGIATAN - NEGOISASI",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/negoisasi/KegiatanNegoisasiTambah.vue'),		
	},
	{
		path: '/kegiatan/negoisasi/:kegiatan_id/ubah',
		name: 'KegiatanNegoisasiUbah',
		meta:{
			title: "KEGIATAN - NEGOISASI",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/negoisasi/KegiatanNegoisasiUbah.vue'),		
	},
	{
		path: '/kegiatan/negoisasi/:kegiatan_id/files',
		name: 'KegiatanNegoisasiFiles',
		meta:{
			title: "KEGIATAN - NEGOISASI",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/negoisasi/KegiatanNegoisasiFiles.vue'),		
	},
	{
		path: '/kegiatan/negoisasi/:kegiatan_id/detail',
		name: 'KegiatanNegoisasiDetail',
		meta:{
			title: "KEGIATAN - NEGOISASI",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/negoisasi/KegiatanNegoisasiDetail.vue'),		
	},

	//kegiatan - pemberdayaan masyarakat
	{
		path: '/kegiatan/pemberdayaanmasyarakat',
		name: 'KegiatanPemberdayaanMasyarakat',
		meta:{
			title: "KEGIATAN - PEMBERDAYAAN MASYARAKAT",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/pemberdayaanmasyarakat/KegiatanPemberdayaanMasyarakat.vue'),		
	},
	{
		path: '/kegiatan/pemberdayaanmasyarakat/tambah',
		name: 'KegiatanPemberdayaanMasyarakatTambah',
		meta:{
			title: "KEGIATAN - PEMBERDAYAAN MASYARAKAT",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/pemberdayaanmasyarakat/KegiatanPemberdayaanMasyarakatTambah.vue'),		
	},
	{
		path: '/kegiatan/pemberdayaanmasyarakat/:kegiatan_id/ubah',
		name: 'KegiatanPemberdayaanMasyarakatUbah',
		meta:{
			title: "KEGIATAN - PEMBERDAYAAN MASYARAKAT",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/pemberdayaanmasyarakat/KegiatanPemberdayaanMasyarakatUbah.vue'),		
	},
	{
		path: '/kegiatan/pemberdayaanmasyarakat/:kegiatan_id/files',
		name: 'KegiatanPemberdayaanMasyarakatFiles',
		meta:{
			title: "KEGIATAN - PEMBERDAYAAN MASYARAKAT",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/pemberdayaanmasyarakat/KegiatanPemberdayaanMasyarakatFiles.vue'),		
	},
	{
		path: '/kegiatan/pemberdayaanmasyarakat/:kegiatan_id/detail',
		name: 'KegiatanPemberdayaanMasyarakatDetail',
		meta:{
			title: "KEGIATAN - PEMBERDAYAAN MASYARAKAT",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/pemberdayaanmasyarakat/KegiatanPemberdayaanMasyarakatDetail.vue'),		
	},

	//kegiatan - penyuluhan hukum
	{
		path: '/kegiatan/penyuluhanhukum',
		name: 'KegiatanPenyuluhanHukum',
		meta:{
			title: "KEGIATAN - PENYULUHAN HUKUM",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/penyuluhanhukum/KegiatanPenyuluhanHukum.vue'),		
	},
	{
		path: '/kegiatan/penyuluhanhukum/tambah',
		name: 'KegiatanPenyuluhanHukumTambah',
		meta:{
			title: "KEGIATAN - PENYULUHAN HUKUM",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/penyuluhanhukum/KegiatanPenyuluhanHukumTambah.vue'),		
	},
	{
		path: '/kegiatan/penyuluhanhukum/:kegiatan_id/ubah',
		name: 'KegiatanPenyuluhanHukumUbah',
		meta:{
			title: "KEGIATAN - PENYULUHAN HUKUM",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/penyuluhanhukum/KegiatanPenyuluhanHukumUbah.vue'),		
	},
	{
		path: '/kegiatan/penyuluhanhukum/:kegiatan_id/files',
		name: 'KegiatanPenyuluhanHukumFiles',
		meta:{
			title: "KEGIATAN - PENYULUHAN HUKUM",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/penyuluhanhukum/KegiatanPenyuluhanHukumFiles.vue'),		
	},
	{
		path: '/kegiatan/penyuluhanhukum/:kegiatan_id/detail',
		name: 'KegiatanPenyuluhanHukumDetail',
		meta:{
			title: "KEGIATAN - PENYULUHAN HUKUM",
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
	//kegiatan - investigasi perkara
	{
		path: '/kegiatan/investigasiperkara',
		name: 'KegiatanInvestigasiPerkara',
		meta:{
			title: "KEGIATAN - INVESTIGASI PERKARA",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/investigasiperkara/KegiatanInvestigasiPerkara.vue'),		
	},
	{
		path: '/kegiatan/investigasiperkara/tambah',
		name: 'KegiatanInvestigasiPerkaraTambah',
		meta:{
			title: "KEGIATAN - INVESTIGASI PERKARA",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/investigasiperkara/KegiatanInvestigasiPerkaraTambah.vue'),		
	},
	{
		path: '/kegiatan/investigasiperkara/:kegiatan_id/ubah',
		name: 'KegiatanInvestigasiPerkaraUbah',
		meta:{
			title: "KEGIATAN - INVESTIGASI PERKARA",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/investigasiperkara/KegiatanInvestigasiPerkaraUbah.vue'),		
	},
	{
		path: '/kegiatan/investigasiperkara/:kegiatan_id/files',
		name: 'KegiatanInvestigasiPerkaraFiles',
		meta:{
			title: "KEGIATAN - INVESTIGASI PERKARA",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/investigasiperkara/KegiatanInvestigasiPerkaraFiles.vue'),		
	},
	{
		path: '/kegiatan/investigasiperkara/:kegiatan_id/detail',
		name: 'KegiatanInvestigasiPerkaraDetail',
		meta:{
			title: "KEGIATAN - INVESTIGASI PERKARA",
			requiresAuth:true,
        },
		component: () => import('../views/pages/admin/investigasiperkara/KegiatanInvestigasiPerkaraDetail.vue'),		
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
