(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-2d0be10c"],{"2f57":function(a,t,e){"use strict";e.r(t);var n=function(){var a=this,t=a.$createElement,e=a._self._c||t;return e("AdminLayout",[e("ModuleHeader",{scopedSlots:a._u([{key:"icon",fn:function(){return[a._v(" mdi-calendar-blank-multiple ")]},proxy:!0},{key:"name",fn:function(){return[a._v(" KONSULTASI KEGIATAN PARALEGAL ")]},proxy:!0},{key:"breadcrumbs",fn:function(){return[e("v-breadcrumbs",{staticClass:"pa-0",attrs:{items:a.breadcrumbs},scopedSlots:a._u([{key:"divider",fn:function(){return[e("v-icon",[a._v("mdi-chevron-right")])]},proxy:!0}])})]},proxy:!0},{key:"desc",fn:function(){return[e("v-alert",{attrs:{color:"cyan",border:"left","colored-border":"",type:"info"}},[a._v(" Halaman ini berisi daftar kegiatan konsultasi hukum paralegal ")])]},proxy:!0}])}),Object.keys(a.datakegiatan).length?e("v-form",{ref:"frmdata",attrs:{"lazy-validation":""},model:{value:a.form_valid,callback:function(t){a.form_valid=t},expression:"form_valid"}},[e("v-container",{attrs:{fluid:""}},[e("v-row",[e("v-col",{attrs:{cols:"12"}},[e("v-card",[e("v-card-title",[e("span",{staticClass:"headline"},[a._v("UBAH KEGIATAN")])]),e("v-card-text",[e("v-select",{attrs:{label:"PARALEGAL",items:a.daftar_paralegal,"item-text":"name","item-value":"id",filled:""},model:{value:a.formdata.user_id,callback:function(t){a.$set(a.formdata,"user_id",t)},expression:"formdata.user_id"}}),e("v-select",{attrs:{label:"JENIS KEGIATAN",items:a.daftar_jenis_kegiatan,"item-text":"nama_jenis","item-value":"id_jenis",filled:"","return-object":""},model:{value:a.formdata.id_jenis_kegiatan,callback:function(t){a.$set(a.formdata,"id_jenis_kegiatan",t)},expression:"formdata.id_jenis_kegiatan"}}),e("v-text-field",{attrs:{label:"NAMA KEGIATAN",rules:a.rule_nama_kegiatan,filled:""},model:{value:a.formdata.nama_kegiatan,callback:function(t){a.$set(a.formdata,"nama_kegiatan",t)},expression:"formdata.nama_kegiatan"}}),e("v-textarea",{attrs:{label:"URAIAN KEGIATAN",rules:a.rule_uraian_kegiatan,filled:""},model:{value:a.formdata.uraian_kegiatan,callback:function(t){a.$set(a.formdata,"uraian_kegiatan",t)},expression:"formdata.uraian_kegiatan"}}),e("v-menu",{ref:"menuTanggalKonsultasi",attrs:{"close-on-content-click":!1,"return-value":a.formdata.tanggal_konsultasi,transition:"scale-transition","offset-y":"","max-width":"290px","min-width":"290px"},on:{"update:returnValue":function(t){return a.$set(a.formdata,"tanggal_konsultasi",t)},"update:return-value":function(t){return a.$set(a.formdata,"tanggal_konsultasi",t)}},scopedSlots:a._u([{key:"activator",fn:function(t){var n=t.on;return[e("v-text-field",a._g({attrs:{label:"TANGGAL KONSULTASI",readonly:"",filled:"",rules:a.rule_tanggal_konsultasi},model:{value:a.formdata.tanggal_konsultasi,callback:function(t){a.$set(a.formdata,"tanggal_konsultasi",t)},expression:"formdata.tanggal_konsultasi"}},n))]}}],null,!1,3969971790),model:{value:a.menuTanggalKonsultasi,callback:function(t){a.menuTanggalKonsultasi=t},expression:"menuTanggalKonsultasi"}},[e("v-date-picker",{attrs:{"no-title":"",scrollable:""},model:{value:a.formdata.tanggal_konsultasi,callback:function(t){a.$set(a.formdata,"tanggal_konsultasi",t)},expression:"formdata.tanggal_konsultasi"}},[e("v-spacer"),e("v-btn",{attrs:{text:"",color:"primary"},on:{click:function(t){a.menuTanggalKonsultasi=!1}}},[a._v("Cancel")]),e("v-btn",{attrs:{text:"",color:"primary"},on:{click:function(t){return a.$refs.menuTanggalKonsultasi.save(a.formdata.tanggal_konsultasi)}}},[a._v("OK")])],1)],1),e("v-menu",{ref:"menuJamKonsultasi",attrs:{"close-on-content-click":!1,"nudge-right":40,"return-value":a.formdata.jam_konsultasi,transition:"scale-transition","offset-y":"","max-width":"290px","min-width":"290px"},on:{"update:returnValue":function(t){return a.$set(a.formdata,"jam_konsultasi",t)},"update:return-value":function(t){return a.$set(a.formdata,"jam_konsultasi",t)}},scopedSlots:a._u([{key:"activator",fn:function(t){var n=t.on,i=t.attrs;return[e("v-text-field",a._g(a._b({attrs:{label:"JAM KONSULTASI",readonly:"",filled:"",rules:a.rule_jam_konsultasi},model:{value:a.formdata.jam_konsultasi,callback:function(t){a.$set(a.formdata,"jam_konsultasi",t)},expression:"formdata.jam_konsultasi"}},"v-text-field",i,!1),n))]}}],null,!1,274310070),model:{value:a.menuJamKonsultasi,callback:function(t){a.menuJamKonsultasi=t},expression:"menuJamKonsultasi"}},[a.menuJamKonsultasi?e("v-time-picker",{attrs:{"full-width":"",format:"24hr"},on:{"click:minute":function(t){return a.$refs.menuJamKonsultasi.save(a.formdata.jam_konsultasi)}},model:{value:a.formdata.jam_konsultasi,callback:function(t){a.$set(a.formdata,"jam_konsultasi",t)},expression:"formdata.jam_konsultasi"}}):a._e()],1),e("v-text-field",{attrs:{label:"TEMPAT",rules:a.rule_tempat,filled:""},model:{value:a.formdata.tempat,callback:function(t){a.$set(a.formdata,"tempat",t)},expression:"formdata.tempat"}}),e("v-text-field",{attrs:{label:"PESERTA / PEMOHON",rules:a.rule_pemohon,filled:""},model:{value:a.formdata.pemohon,callback:function(t){a.$set(a.formdata,"pemohon",t)},expression:"formdata.pemohon"}}),e("v-textarea",{attrs:{label:"REKOMENDASI YANG DIBERIKAN",rules:a.rule_rekomendasi_kegiatan,filled:""},model:{value:a.formdata.rekomendasi_kegiatan,callback:function(t){a.$set(a.formdata,"rekomendasi_kegiatan",t)},expression:"formdata.rekomendasi_kegiatan"}})],1),e("v-card-actions",[e("v-spacer"),e("v-btn",{attrs:{color:"blue darken-1",text:""},on:{click:function(t){return t.stopPropagation(),a.closedialogfrm(t)}}},[a._v("BATAL")]),e("v-btn",{attrs:{color:"blue darken-1",text:"",loading:a.btnLoading,disabled:!a.form_valid||a.btnLoading},on:{click:function(t){return t.stopPropagation(),a.save(t)}}},[a._v(" SIMPAN ")])],1)],1)],1)],1)],1)],1):a._e()],1)},i=[],r=(e("96cf"),e("1da1")),o=e("a1b3"),s=e("e477"),l={name:"KonsultasiKegiatanUbah",created:function(){this.dashboard=this.$store.getters["uiadmin/getDefaultDashboard"],this.kegiatan_id=this.$route.params.kegiatan_id,this.breadcrumbs=[{text:"HOME",disabled:!1,href:"/dashboard/"+this.$store.getters["auth/AccessToken"]},{text:"KONSULTASI",disabled:!1,href:"#"},{text:"KEGIATAN",disabled:!1,href:"/konsultasi/kegiatan"},{text:"UBAH",disabled:!0,href:"#"}],this.initialize()},data:function(){return{dashboard:null,kegiatan_id:null,datakegiatan:{},btnLoading:!1,form_valid:!0,daftar_paralegal:[],menuTanggalKonsultasi:!1,menuJamKonsultasi:!1,daftar_jenis_kegiatan:[],formdata:{id_jenis_kegiatan:"",user_id:"",nama_kegiatan:"",uraian_kegiatan:"",tanggal_konsultasi:"",jam_konsultasi:"",tempat:"",pemohon:"",rekomendasi_kegiatan:""},formdefault:{id_jenis_kegiatan:"",user_id:"",nama_kegiatan:"",uraian_kegiatan:"",tanggal_konsultasi:"",jam_konsultasi:"",tempat:"",pemohon:"",rekomendasi_kegiatan:""},rule_user_id:[function(a){return!!a||"Mohon untuk dipilih paralegal !!!"}],rule_nama_kegiatan:[function(a){return!!a||"Mohon untuk diisi nama kegiata konsultasi !!!"}],rule_uraian_kegiatan:[function(a){return!!a||"Mohon untuk diisi uraian kegiatan konsultasi !!!"}],rule_tanggal_konsultasi:[function(a){return!!a||"Mohon untuk diisi tanggal kegiatan konsultasi !!!"}],rule_jam_konsultasi:[function(a){return!!a||"Mohon untuk diisi jam kegiatan konsultasi !!!"}],rule_tempat:[function(a){return!!a||"Mohon untuk diisi tempat kegiatan konsultasi !!!"}],rule_pemohon:[function(a){return!!a||"Mohon untuk diisi pemohon / peserta kegiatan konsultasi !!!"}],rule_rekomendasi_kegiatan:[function(a){return!!a||"Mohon untuk diisi rekomendasi kegiatan konsultasi !!!"}]}},methods:{initialize:function(){var a=Object(r["a"])(regeneratorRuntime.mark((function a(){var t=this;return regeneratorRuntime.wrap((function(a){while(1)switch(a.prev=a.next){case 0:return a.next=2,this.$ajax.get("/datamaster/jeniskegiatan",{headers:{Authorization:this.$store.getters["auth/Token"]}}).then((function(a){var e=a.data;t.daftar_jenis_kegiatan=e.jenis_kegiatan}));case 2:return a.next=4,this.$ajax.get("/system/usersparalegal",{headers:{Authorization:this.$store.getters["auth/Token"]}}).then((function(a){var e=a.data;t.daftar_paralegal=e.users}));case 4:return a.next=6,this.$ajax.get("/konsultasi/kegiatan/"+this.kegiatan_id,{headers:{Authorization:this.$store.getters["auth/Token"]}}).then((function(a){var e=a.data;t.datakegiatan=e.kegiatan,t.formdata.user_id=t.datakegiatan.user_id,t.formdata.tanggal_konsultasi=t.$date(t.datakegiatan.tanggal).format("YYYY-MM-DD"),t.formdata.jam_konsultasi=t.$date(t.datakegiatan.tanggal).format("HH:mm"),t.formdata.tempat=t.datakegiatan.tempat,t.formdata.id_jenis_kegiatan={id_jenis:t.datakegiatan.id_jenis_kegiatan,nama_jenis:t.datakegiatan.nama_jenis},t.formdata.nama_kegiatan=t.datakegiatan.nama_kegiatan,t.formdata.pemohon=t.datakegiatan.pemohon,t.formdata.uraian_kegiatan=t.datakegiatan.pemohon,t.formdata.rekomendasi_kegiatan=t.datakegiatan.rekomendasi_kegiatan}));case 6:case"end":return a.stop()}}),a,this)})));function t(){return a.apply(this,arguments)}return t}(),save:function(){var a=Object(r["a"])(regeneratorRuntime.mark((function a(){var t=this;return regeneratorRuntime.wrap((function(a){while(1)switch(a.prev=a.next){case 0:if(!this.$refs.frmdata.validate()){a.next=4;break}return this.btnLoading=!0,a.next=4,this.$ajax.post("/konsultasi/kegiatan/"+this.kegiatan_id,{_method:"put",user_id:this.formdata.user_id,tanggal_konsultasi:this.formdata.tanggal_konsultasi,jam_konsultasi:this.formdata.jam_konsultasi,tempat:this.formdata.tempat,id_jenis:this.formdata.id_jenis_kegiatan.id_jenis,nama_jenis:this.formdata.id_jenis_kegiatan.nama_jenis,nama_kegiatan:this.formdata.nama_kegiatan,pemohon:this.formdata.pemohon,uraian_kegiatan:this.formdata.uraian_kegiatan,rekomendasi_kegiatan:this.formdata.rekomendasi_kegiatan},{headers:{Authorization:this.$store.getters["auth/Token"]}}).then((function(a){var e=a.data;t.btnLoading=!1,setTimeout((function(){t.formdata=Object.assign({},t.formdefault),t.$router.push("/konsultasi/kegiatan/"+e.kegiatan.kegiatan_id+"/detail")}),300)})).catch((function(){t.btnLoading=!1}));case 4:case"end":return a.stop()}}),a,this)})));function t(){return a.apply(this,arguments)}return t}(),closedialogfrm:function(){var a=this;setTimeout((function(){a.formdata=Object.assign({},a.formdefault),a.$router.push("/konsultasi/kegiatan")}),300)}},components:{AdminLayout:o["a"],ModuleHeader:s["a"]}},u=l,d=e("2877"),m=e("6544"),f=e.n(m),k=e("0798"),c=e("2bc5"),g=e("8336"),_=e("b0af"),h=e("99d9"),p=e("62ad"),v=e("a523"),b=e("2e4b"),x=e("4bd4"),j=e("132d"),A=e("e449"),T=e("0fd9"),$=e("b974"),K=e("2fa4"),y=e("8654"),V=e("a844"),M=e("c964"),w=Object(d["a"])(u,n,i,!1,null,null,null);t["default"]=w.exports;f()(w,{VAlert:k["a"],VBreadcrumbs:c["a"],VBtn:g["a"],VCard:_["a"],VCardActions:h["a"],VCardText:h["c"],VCardTitle:h["d"],VCol:p["a"],VContainer:v["a"],VDatePicker:b["a"],VForm:x["a"],VIcon:j["a"],VMenu:A["a"],VRow:T["a"],VSelect:$["a"],VSpacer:K["a"],VTextField:y["a"],VTextarea:V["a"],VTimePicker:M["a"]})}}]);