(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-2d0cf894"],{"63ab":function(t,e,a){"use strict";a.r(e);var n=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("AdminLayout",[a("ModuleHeader",{scopedSlots:t._u([{key:"icon",fn:function(){return[t._v(" mdi-format-list-bulleted-triangle ")]},proxy:!0},{key:"name",fn:function(){return[t._v(" JENIS KEGIATAN ")]},proxy:!0},{key:"breadcrumbs",fn:function(){return[a("v-breadcrumbs",{staticClass:"pa-0",attrs:{items:t.breadcrumbs},scopedSlots:t._u([{key:"divider",fn:function(){return[a("v-icon",[t._v("mdi-chevron-right")])]},proxy:!0}])})]},proxy:!0},{key:"desc",fn:function(){return[a("v-alert",{attrs:{color:"cyan",border:"left","colored-border":"",type:"info"}},[t._v(" Halaman untuk menampilkan daftar jenis-jenis kegiatan. ")])]},proxy:!0}])}),a("v-container",{attrs:{fluid:""}},[a("v-row",{staticClass:"mb-4",attrs:{"no-gutters":""}},[a("v-col",{attrs:{cols:"12"}},[a("v-data-table",{staticClass:"elevation-1",attrs:{headers:t.headers,items:t.datatable,"item-key":"id_jenis","sort-by":"id_jenis","disable-pagination":!0,"hide-default-footer":!0,loading:t.datatableLoading,"loading-text":"Loading... Please wait"},scopedSlots:t._u([{key:"top",fn:function(){return[a("v-toolbar",{attrs:{flat:"",color:"white"}},[a("v-toolbar-title",[t._v("DAFTAR JENIS KEGIATAN")]),a("v-divider",{staticClass:"mx-4",attrs:{inset:"",vertical:""}}),a("v-spacer")],1)]},proxy:!0},{key:"expanded-item",fn:function(e){var n=e.headers,i=e.item;return[a("td",{staticClass:"text-center",attrs:{colspan:n.length}},[a("v-col",{attrs:{cols:"12"}},[a("strong",[t._v("ID:")]),t._v(t._s(i.idkelas)+" ")])],1)]}},{key:"no-data",fn:function(){return[t._v(" Data belum tersedia ")]},proxy:!0}])})],1)],1)],1)],1)},i=[],r=a("5530"),o=(a("96cf"),a("1da1")),s=a("2f62"),d=a("a1b3"),c=a("e477"),l={name:"JenisKegiatan",created:function(){this.breadcrumbs=[{text:"HOME",disabled:!1,href:"/dashboard/"+this.ACCESS_TOKEN},{text:"DATA MASTER",disabled:!1,href:"#"},{text:"JENIS KEGIATAN",disabled:!0,href:"#"}],this.initialize()},data:function(){return{btnLoading:!1,datatableLoading:!1,expanded:[],datatable:[],headers:[{text:"ID JENIS",value:"id_jenis",width:150},{text:"NAMA JENIS",value:"nama_jenis"}]}},methods:{initialize:function(){var t=Object(o["a"])(regeneratorRuntime.mark((function t(){var e=this;return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:return this.datatableLoading=!0,t.next=3,this.$ajax.get("/datamaster/jeniskegiatan",{headers:{Authorization:this.TOKEN}}).then((function(t){var a=t.data;e.datatable=a.jenis_kegiatan,e.datatableLoading=!1})).catch((function(){e.datatableLoading=!1}));case 3:case"end":return t.stop()}}),t,this)})));function e(){return t.apply(this,arguments)}return e}(),dataTableRowClicked:function(t){t===this.expanded[0]?this.expanded=[]:this.expanded=[t]}},computed:Object(r["a"])({},Object(s["b"])("auth",{ACCESS_TOKEN:"AccessToken",TOKEN:"Token"}),{formTitle:function(){return-1===this.editedIndex?"TAMBAH DATA":"UBAH DATA"}}),components:{AdminLayout:d["a"],ModuleHeader:c["a"]}},u=l,f=a("2877"),b=a("6544"),h=a.n(b),p=a("0798"),v=a("2bc5"),m=a("62ad"),A=a("a523"),x=a("8fea"),g=a("ce7e"),k=a("132d"),y=a("0fd9"),T=a("2fa4"),_=a("71d9"),E=a("2a7f"),w=Object(f["a"])(u,n,i,!1,null,null,null);e["default"]=w.exports;h()(w,{VAlert:p["a"],VBreadcrumbs:v["a"],VCol:m["a"],VContainer:A["a"],VDataTable:x["a"],VDivider:g["a"],VIcon:k["a"],VRow:y["a"],VSpacer:T["a"],VToolbar:_["a"],VToolbarTitle:E["a"]})}}]);