(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-4a9f796f"],{"969c":function(t,i,e){"use strict";e.r(i);var s=function(){var t=this,i=t.$createElement,e=t._self._c||i;return e("AdminLayout")},a=[],n=(e("96cf"),e("1da1")),r=e("a1b3"),o={name:"Dashboard",created:function(){this.TOKEN=this.$route.params.token,this.breadcrumbs=[{text:"HOME",disabled:!1,href:"/dashboard/"+this.TOKEN},{text:"DASHBOARD",disabled:!0,href:"#"}],this.initialize()},data:function(){return{breadcrumbs:[],TOKEN:null,dashboard:null,tahun_pendaftaran:""}},methods:{initialize:function(){var t=Object(n["a"])(regeneratorRuntime.mark((function t(){var i=this;return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:return t.next=2,this.$ajax.get("/auth/me",{headers:{Authorization:"Bearer "+this.TOKEN}}).then((function(t){var e=t.data;i.dashboard=e.role[0],i.$store.dispatch("uiadmin/changeDashboard",i.dashboard)}));case 2:this.$store.dispatch("uiadmin/init",this.$ajax),this.tahun_pendaftaran=this.$store.getters["uiadmin/getTahunPendaftaran"];case 4:case"end":return t.stop()}}),t,this)})));function i(){return t.apply(this,arguments)}return i}()},computed:{},components:{AdminLayout:r["a"]}},l=o,c=e("2877"),v=Object(c["a"])(l,s,a,!1,null,null,null);i["default"]=v.exports},a1b3:function(t,i,e){"use strict";var s=function(){var t=this,i=t.$createElement,e=t._self._c||i;return e("div",[e("v-system-bar",{staticClass:"yellow",attrs:{app:"",dark:""}}),e("v-app-bar",{attrs:{app:""}},[e("v-app-bar-nav-icon",{staticClass:"grey--text",on:{click:function(i){i.stopPropagation(),t.drawer=!t.drawer}}}),e("v-toolbar-title",{staticClass:"headline clickable",on:{click:function(i){i.stopPropagation(),t.$router.push("/dashboard/"+t.$store.getters["auth/AccessToken"]).catch((function(t){}))}}},[e("span",{staticClass:"hidden-sm-and-down"},[t._v(t._s(t.APP_NAME))])]),e("v-spacer"),e("v-menu",{attrs:{"close-on-content-click":!0,origin:"center center",transition:"scale-transition","offset-y":!0,bottom:"",left:""},scopedSlots:t._u([{key:"activator",fn:function(i){var s=i.on;return[e("v-avatar",{attrs:{size:"30"}},[e("v-img",t._g({attrs:{src:t.photoUser}},s))],1)]}}])},[e("v-list",[e("v-list-item",[e("v-list-item-avatar",[e("v-img",{attrs:{src:t.photoUser}})],1),e("v-list-item-content",[e("v-list-item-title",{staticClass:"title"},[t._v(" "+t._s(t.ATTRIBUTE_USER("username"))+" ")]),e("v-list-item-subtitle",[t._v(" "+t._s(t.ROLE)+" ")])],1)],1),e("v-divider"),e("v-list-item",{attrs:{to:"/system-users/profil"}},[e("v-list-item-icon",{staticClass:"mr-2"},[e("v-icon",[t._v("mdi-account")])],1),e("v-list-item-title",[t._v("Profil")])],1),e("v-divider"),e("v-list-item",{on:{click:function(i){return i.preventDefault(),t.logout(i)}}},[e("v-list-item-icon",{staticClass:"mr-2"},[e("v-icon",[t._v("mdi-power")])],1),e("v-list-item-title",[t._v("Logout")])],1)],1)],1),e("v-divider",{staticClass:"mx-4",attrs:{inset:"",vertical:""}}),e("v-app-bar-nav-icon",{on:{click:function(i){i.stopPropagation(),t.drawerRight=!t.drawerRight}}},[e("v-icon",[t._v("mdi-menu-open")])],1)],1),e("v-navigation-drawer",{staticClass:"indigo darken-4",attrs:{width:"300",dark:"",temporary:t.isReportPage,app:""},model:{value:t.drawer,callback:function(i){t.drawer=i},expression:"drawer"}},[e("v-list-item",[e("v-list-item-avatar",[e("v-img",{attrs:{src:t.photoUser},on:{click:function(i){return i.stopPropagation(),t.toProfile(i)}}})],1),e("v-list-item-content",[e("v-list-item-title",{staticClass:"title"},[t._v(" "+t._s(t.ATTRIBUTE_USER("username"))+" ")]),e("v-list-item-subtitle",[t._v(" "+t._s(t.ROLE)+" ")])],1)],1),e("v-divider"),e("v-list",{attrs:{expand:""}},[t.CAN_ACCESS("AKADEMIK-GROUP")?e("v-list-item",{attrs:{to:{path:"/dashboard/"+t.ACCESS_TOKEN},link:"","active-class":"yellow",color:"green"}},[e("v-list-item-icon",{staticClass:"mr-2"},[e("v-icon",[t._v("mdi-monitor-dashboard")])],1),e("v-list-item-content",[e("v-list-item-title",[t._v("DASHBOARD")])],1)],1):t._e(),t.CAN_ACCESS("DMASTER-GROUP")?e("v-subheader",[t._v("DATA MASTER")]):t._e(),t.CAN_ACCESS("DMASTER-JENISKEGIATAN_BROWSE")?e("v-list-item",{attrs:{link:"","active-class":"yellow darken-4",to:"/dmaster/jeniskegiatan"}},[e("v-list-item-icon",{staticClass:"mr-2"},[e("v-icon",[t._v("mdi-format-list-bulleted-triangle")])],1),e("v-list-item-content",[e("v-list-item-title",[t._v(" JENIS KEGIATAN ")])],1)],1):t._e(),t.CAN_ACCESS("KONSULTASI-GROUP")?e("v-subheader",[t._v("KONSULTASI")]):t._e(),t.CAN_ACCESS("KONSULTASI-KEGIATAN_BROWSE")?e("v-list-item",{attrs:{link:"",to:"/konsultasi/kegiatan"}},[e("v-list-item-icon",{staticClass:"mr-2"},[e("v-icon",[t._v("mdi-calendar-blank-multiple")])],1),e("v-list-item-content",[e("v-list-item-title",[t._v(" KEGIATAN ")])],1)],1):t._e(),t.CAN_ACCESS("REPORT-GROUP")?e("v-subheader",[t._v("LAPORAN")]):t._e(),t.CAN_ACCESS("AKADEMIK-DULANG-BARU_BROWSE")?e("v-list-item",{attrs:{link:"",to:"/laporan/kegiatan"}},[e("v-list-item-icon",{staticClass:"mr-2"},[e("v-icon",[t._v("mdi-clipboard-list-outline")])],1),e("v-list-item-content",[e("v-list-item-title",[t._v(" LAPORAN KEGIATAN ")])],1)],1):t._e(),t.CAN_ACCESS("SYSTEM-SETTING-GROUP")?e("v-subheader",[t._v("SETTING")]):t._e(),t.CAN_ACCESS("SYSTEM-SETTING-PERMISSIONS")?e("v-list-item",{attrs:{link:"",to:"/system-users/permissions"}},[e("v-list-item-icon",{staticClass:"mr-2"},[e("v-icon",[t._v("mdi-account-key")])],1),e("v-list-item-content",[e("v-list-item-title",[t._v(" HAK AKSES PENGGUNA ")])],1)],1):t._e(),t.CAN_ACCESS("SYSTEM-SETTING-ROLES")?e("v-list-item",{attrs:{link:"",to:"/system-users/roles"}},[e("v-list-item-icon",{staticClass:"mr-2"},[e("v-icon",[t._v("mdi-account-group")])],1),e("v-list-item-content",[e("v-list-item-title",[t._v(" ROLE PENGGUNA ")])],1)],1):t._e(),e("v-divider"),t.CAN_ACCESS("SYSTEM-USERS-GROUP")?e("v-list-group",{attrs:{group:"/system-users","active-class":"yellow","no-action":"",color:"green"},scopedSlots:t._u([{key:"activator",fn:function(){return[e("v-list-item-icon",{staticClass:"mr-2"},[e("v-icon",[t._v("mdi-home-floor-b")])],1),e("v-list-item-content",[e("v-list-item-title",[t._v("PENGGUNA")])],1)]},proxy:!0}],null,!1,2599702521)},[e("div",[t.CAN_ACCESS("SYSTEM-USERS-SUPERADMIN_BROWSE")?e("v-list-item",{attrs:{link:"",to:"/system-users/superadmin"}},[e("v-list-item-icon",{staticClass:"mr-2"},[e("v-icon",[t._v("mdi-account")])],1),e("v-list-item-content",[e("v-list-item-title",[t._v(" SUPERADMIN ")])],1)],1):t._e(),t.CAN_ACCESS("SYSTEM-USERS-PARALEGAL_BROWSE")?e("v-list-item",{attrs:{link:"",to:"/system-users/paralegal"}},[e("v-list-item-icon",{staticClass:"mr-2"},[e("v-icon",[t._v("mdi-account")])],1),e("v-list-item-content",[e("v-list-item-title",[t._v(" PARALEGAL ")])],1)],1):t._e(),t.CAN_ACCESS("SYSTEM-USERS-KADES_BROWSE")?e("v-list-item",{attrs:{link:"",to:"/system-users/kades"}},[e("v-list-item-icon",{staticClass:"mr-2"},[e("v-icon",[t._v("mdi-account")])],1),e("v-list-item-content",[e("v-list-item-title",[t._v(" KADES ")])],1)],1):t._e(),t.CAN_ACCESS("SYSTEM-USERS-AKADEMIK_BROWSE")?e("v-list-item",{attrs:{link:"",to:"/system-users/pmb"}},[e("v-list-item-icon",{staticClass:"mr-2"},[e("v-icon",[t._v("mdi-account")])],1),e("v-list-item-content",[e("v-list-item-title",[t._v(" PMB ")])],1)],1):t._e(),t.CAN_ACCESS("SYSTEM-USERS-OBH_BROWSE")?e("v-list-item",{attrs:{link:"",to:"/system-users/obh"}},[e("v-list-item-icon",{staticClass:"mr-2"},[e("v-icon",[t._v("mdi-account")])],1),e("v-list-item-content",[e("v-list-item-title",[t._v(" OBH ")])],1)],1):t._e(),t.CAN_ACCESS("SYSTEM-USERS-HUMKAM_BROWSE")?e("v-list-item",{attrs:{link:"",to:"/system-users/humkam"}},[e("v-list-item-icon",{staticClass:"mr-2"},[e("v-icon",[t._v("mdi-account")])],1),e("v-list-item-content",[e("v-list-item-title",[t._v(" HUMKAM ")])],1)],1):t._e()],1)]):t._e()],1)],1),e("v-navigation-drawer",{attrs:{width:"300",app:"",fixed:"",right:"",temporary:""},model:{value:t.drawerRight,callback:function(i){t.drawerRight=i},expression:"drawerRight"}},[e("v-list",{attrs:{dense:""}},[e("v-list-item",[e("v-list-item-icon",{staticClass:"mr-2"},[e("v-icon",[t._v("mdi-menu-open")])],1),e("v-list-item-content",[e("v-list-item-title",{staticClass:"title"},[t._v(" OPTIONS ")])],1)],1),e("v-divider"),e("v-list-item",{staticClass:"teal lighten-5 mb-5"},[e("v-list-item-icon",{staticClass:"mr-2"},[e("v-icon",[t._v("mdi-filter")])],1),e("v-list-item-content",[e("v-list-item-title",[t._v("FILTER")])],1)],1),t._t("filtersidebar")],2)],1),e("v-main",{staticClass:"mx-4 mb-4"},[t._t("default")],2)],1)},a=[],n=(e("b0c0"),e("ac1f"),e("5319"),e("5530")),r=e("2f62"),o={name:"AdminLayout",created:function(){this.dashboard=this.$store.getters["uiadmin/getDefaultDashboard"]},data:function(){return{loginTime:0,drawer:null,drawerRight:null,dashboard:null}},methods:{logout:function(){var t=this;this.loginTime=0,this.$ajax.post("/auth/logout",{},{headers:{Authorization:this.TOKEN}}).then((function(){t.$store.dispatch("auth/logout"),t.$store.dispatch("uifront/reinit"),t.$store.dispatch("uiadmin/reinit"),t.$router.push("/")})).catch((function(){t.$store.dispatch("auth/logout"),t.$store.dispatch("uifront/reinit"),t.$store.dispatch("uiadmin/reinit"),t.$router.push("/")}))},isBentukPT:function(t){return this.$store.getters["uifront/getBentukPT"]==t}},computed:Object(n["a"])({},Object(r["b"])("auth",{AUTHENTICATED:"Authenticated",ACCESS_TOKEN:"AccessToken",TOKEN:"Token",ROLE:"Role",CAN_ACCESS:"can",ATTRIBUTE_USER:"AttributeUser"}),{APP_NAME:function(){return"SEPAKAT"},photoUser:function(){var t,i=this.ATTRIBUTE_USER("foto");return t=""==i?this.$api.url+"/storage/images/users/no_photo.png":this.$api.url+"/"+i,t},isReportPage:function(){return"ReportFormBMurni"==this.$route.name}}),watch:{loginTime:{handler:function(t){var i=this;t>=0?setTimeout((function(){i.loginTime=1==i.AUTHENTICATED?i.loginTime+1:-1}),1e3):(this.$store.dispatch("auth/logout"),this.$router.replace("/login"))},immediate:!0}}},l=o,c=e("2877"),v=e("6544"),m=e.n(v),u=e("40dc"),d=e("5bc1"),S=e("8212"),A=e("ce7e"),_=e("132d"),h=e("adda"),E=e("8860"),p=e("56b0"),C=e("da13"),T=e("8270"),f=e("5d23"),R=e("34c3"),g=e("f6c4"),b=e("e449"),N=e("f774"),O=e("2fa4"),k=e("e0c7"),U=e("afd9"),I=e("2a7f"),P=Object(c["a"])(l,s,a,!1,null,null,null);i["a"]=P.exports;m()(P,{VAppBar:u["a"],VAppBarNavIcon:d["a"],VAvatar:S["a"],VDivider:A["a"],VIcon:_["a"],VImg:h["a"],VList:E["a"],VListGroup:p["a"],VListItem:C["a"],VListItemAvatar:T["a"],VListItemContent:f["a"],VListItemIcon:R["a"],VListItemSubtitle:f["b"],VListItemTitle:f["c"],VMain:g["a"],VMenu:b["a"],VNavigationDrawer:N["a"],VSpacer:O["a"],VSubheader:k["a"],VSystemBar:U["a"],VToolbarTitle:I["a"]})}}]);