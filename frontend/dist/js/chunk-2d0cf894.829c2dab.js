(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-2d0cf894"],{"63ab":function(t,a,e){"use strict";e.r(a);var n=function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("AdminLayout",[e("ModuleHeader",{scopedSlots:t._u([{key:"icon",fn:function(){return[t._v(" mdi-google-classroom ")]},proxy:!0},{key:"name",fn:function(){return[t._v(" JENIS KEGIATAN ")]},proxy:!0},{key:"breadcrumbs",fn:function(){return[e("v-breadcrumbs",{staticClass:"pa-0",attrs:{items:t.breadcrumbs},scopedSlots:t._u([{key:"divider",fn:function(){return[e("v-icon",[t._v("mdi-chevron-right")])]},proxy:!0}])})]},proxy:!0},{key:"desc",fn:function(){return[e("v-alert",{attrs:{color:"cyan",border:"left","colored-border":"",type:"info"}},[t._v(" Halaman untuk menampilkan daftar jenis-jenis kegiatan. ")])]},proxy:!0}])}),e("v-container",{attrs:{fluid:""}},[e("v-row",{staticClass:"mb-4",attrs:{"no-gutters":""}},[e("v-col",{attrs:{cols:"12"}},[e("v-card",[e("v-card-text",[e("v-text-field",{attrs:{"append-icon":"mdi-database-search",label:"Search","single-line":"","hide-details":""},model:{value:t.search,callback:function(a){t.search=a},expression:"search"}})],1)],1)],1)],1),e("v-row",{staticClass:"mb-4",attrs:{"no-gutters":""}},[e("v-col",{attrs:{cols:"12"}},[e("v-data-table",{staticClass:"elevation-1",attrs:{headers:t.headers,items:t.datatable,search:t.search,"item-key":"idkelas","sort-by":"idkelas","show-expand":"",expanded:t.expanded,"single-expand":!0,loading:t.datatableLoading,"loading-text":"Loading... Please wait"},on:{"update:expanded":function(a){t.expanded=a},"click:row":t.dataTableRowClicked},scopedSlots:t._u([{key:"top",fn:function(){return[e("v-toolbar",{attrs:{flat:"",color:"white"}},[e("v-toolbar-title",[t._v("DAFTAR JENIS KEGIATAN")]),e("v-divider",{staticClass:"mx-4",attrs:{inset:"",vertical:""}}),e("v-spacer"),e("v-dialog",{attrs:{"max-width":"500px",persistent:""},model:{value:t.dialogdetailitem,callback:function(a){t.dialogdetailitem=a},expression:"dialogdetailitem"}},[e("v-card",[e("v-card-title",[e("span",{staticClass:"headline"},[t._v("DETAIL DATA")])]),e("v-card-text",[e("v-row",{attrs:{"no-gutters":""}},[e("v-col",{attrs:{xs:"12",sm:"6",md:"6"}},[e("v-card",{attrs:{flat:""}},[e("v-card-title",[t._v("KODE JENIS KEGIATAN:")]),e("v-card-subtitle",[t._v(" "+t._s(t.formdata.idkelas)+" ")])],1)],1),t.$vuetify.breakpoint.xsOnly?e("v-responsive",{attrs:{width:"100%"}}):t._e(),e("v-col",{attrs:{xs:"12",sm:"6",md:"6"}},[e("v-card",{attrs:{flat:""}},[e("v-card-title",[t._v("NAMA JENIS KEGIATAN :")]),e("v-card-subtitle",[t._v(" "+t._s(t.formdata.nkelas)+" ")])],1)],1),t.$vuetify.breakpoint.xsOnly?e("v-responsive",{attrs:{width:"100%"}}):t._e()],1)],1),e("v-card-actions",[e("v-spacer"),e("v-btn",{attrs:{color:"blue darken-1",text:""},on:{click:function(a){return a.stopPropagation(),t.closedialogdetailitem(a)}}},[t._v("KELUAR")])],1)],1)],1)],1)]},proxy:!0},{key:"item.actions",fn:function(a){var n=a.item;return[e("v-icon",{staticClass:"mr-2",attrs:{small:""},on:{click:function(a){return a.stopPropagation(),t.viewItem(n)}}},[t._v(" mdi-eye ")])]}},{key:"expanded-item",fn:function(a){var n=a.headers,i=a.item;return[e("td",{staticClass:"text-center",attrs:{colspan:n.length}},[e("v-col",{attrs:{cols:"12"}},[e("strong",[t._v("ID:")]),t._v(t._s(i.idkelas)+" ")])],1)]}},{key:"no-data",fn:function(){return[t._v(" Data belum tersedia ")]},proxy:!0}])})],1)],1)],1)],1)},i=[],r=(e("c975"),e("a434"),e("5530")),s=(e("96cf"),e("1da1")),d=e("2f62"),o=e("a1b3"),l=e("e477"),c={name:"JenisKegiatan",created:function(){this.breadcrumbs=[{text:"HOME",disabled:!1,href:"/dashboard/"+this.ACCESS_TOKEN},{text:"DATA MASTER",disabled:!1,href:"#"},{text:"JENIS KEGIATAN",disabled:!0,href:"#"}],this.initialize()},data:function(){return{btnLoading:!1,datatableLoading:!1,expanded:[],datatable:[],headers:[{text:"KODE JENIS KEGIATAN",value:"idkelas",width:250},{text:"NAMA JENIS KEGIATAN",value:"nkelas"},{text:"AKSI",value:"actions",sortable:!1,width:100}],search:"",dialogfrm:!1,dialogdetailitem:!1,old_idkelas:"",form_valid:!0,formdata:{idkelas:"",nkelas:""},formdefault:{idkelas:"",nkelas:""},editedIndex:-1,rule_kode_kelas:[function(t){return!!t||"ID Kelas mohon untuk diisi !!!"},function(t){return/^[A-Z]*$/.test(t)||"Name hanya boleh string dan huruf besar"},function(t){return t&&1==t.length||"Kode kelas hanya boleh 1 karakter"}],rule_nama_kelas:[function(t){return!!t||"Mohon untuk di isi nama kelas !!!"}]}},methods:{initialize:function(){var t=Object(s["a"])(regeneratorRuntime.mark((function t(){var a=this;return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:return this.datatableLoading=!0,t.next=3,this.$ajax.get("/datamaster/kelas",{headers:{Authorization:this.TOKEN}}).then((function(t){var e=t.data;a.datatable=e.kelas,a.datatableLoading=!1})).catch((function(){a.datatableLoading=!1}));case 3:case"end":return t.stop()}}),t,this)})));function a(){return t.apply(this,arguments)}return a}(),dataTableRowClicked:function(t){t===this.expanded[0]?this.expanded=[]:this.expanded=[t]},viewItem:function(t){this.formdata=t,this.dialogdetailitem=!0},editItem:function(t){this.editedIndex=this.datatable.indexOf(t),this.formdata=Object.assign({},t),this.old_idkelas=t.idkelas,this.dialogfrm=!0},save:function(){var t=Object(s["a"])(regeneratorRuntime.mark((function t(){var a=this;return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:if(!this.$refs.frmdata.validate()){t.next=9;break}if(this.btnLoading=!0,!(this.editedIndex>-1)){t.next=7;break}return t.next=5,this.$ajax.post("/datamaster/kelas/"+this.old_idkelas,{_method:"PUT",idkelas:this.formdata.idkelas,nkelas:this.formdata.nkelas},{headers:{Authorization:this.TOKEN}}).then((function(t){var e=t.data;Object.assign(a.datatable[a.editedIndex],e.kelas),a.closedialogfrm(),a.btnLoading=!1})).catch((function(){a.btnLoading=!1}));case 5:t.next=9;break;case 7:return t.next=9,this.$ajax.post("/datamaster/kelas/store",{idkelas:this.formdata.idkelas,nkelas:this.formdata.nkelas},{headers:{Authorization:this.TOKEN}}).then((function(t){var e=t.data;a.datatable.push(e.kelas),a.closedialogfrm(),a.btnLoading=!1})).catch((function(){a.btnLoading=!1}));case 9:case"end":return t.stop()}}),t,this)})));function a(){return t.apply(this,arguments)}return a}(),deleteItem:function(t){var a=this;this.$root.$confirm.open("Delete","Apakah Anda ingin menghapus data dengan ID "+t.idkelas+" ?",{color:"red"}).then((function(e){e&&(a.btnLoading=!0,a.$ajax.post("/datamaster/kelas/"+t.idkelas,{_method:"DELETE"},{headers:{Authorization:a.TOKEN}}).then((function(){var e=a.datatable.indexOf(t);a.datatable.splice(e,1),a.btnLoading=!1})).catch((function(){a.btnLoading=!1})))}))},closedialogdetailitem:function(){var t=this;this.dialogdetailitem=!1,setTimeout((function(){t.formdata=Object.assign({},t.formdefault),t.editedIndex=-1}),300)},closedialogfrm:function(){var t=this;this.dialogfrm=!1,setTimeout((function(){t.formdata=Object.assign({},t.formdefault),t.$refs.frmdata.reset(),t.editedIndex=-1}),300)}},computed:Object(r["a"])({},Object(d["b"])("auth",{ACCESS_TOKEN:"AccessToken",TOKEN:"Token"}),{formTitle:function(){return-1===this.editedIndex?"TAMBAH DATA":"UBAH DATA"}}),components:{AdminLayout:o["a"],ModuleHeader:l["a"]}},u=c,f=e("2877"),h=e("6544"),m=e.n(h),v=e("0798"),b=e("2bc5"),k=e("8336"),p=e("b0af"),x=e("99d9"),g=e("62ad"),A=e("a523"),T=e("8fea"),_=e("169a"),E=e("ce7e"),y=e("132d"),I=e("6b53"),w=e("0fd9"),N=e("2fa4"),O=e("8654"),C=e("71d9"),K=e("2a7f"),L=Object(f["a"])(u,n,i,!1,null,null,null);a["default"]=L.exports;m()(L,{VAlert:v["a"],VBreadcrumbs:b["a"],VBtn:k["a"],VCard:p["a"],VCardActions:x["a"],VCardSubtitle:x["b"],VCardText:x["c"],VCardTitle:x["d"],VCol:g["a"],VContainer:A["a"],VDataTable:T["a"],VDialog:_["a"],VDivider:E["a"],VIcon:y["a"],VResponsive:I["a"],VRow:w["a"],VSpacer:N["a"],VTextField:O["a"],VToolbar:C["a"],VToolbarTitle:K["a"]})}}]);