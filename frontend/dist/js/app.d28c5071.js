(function(e){function t(t){for(var n,r,c=t[0],o=t[1],i=t[2],d=0,f=[];d<c.length;d++)r=c[d],Object.prototype.hasOwnProperty.call(s,r)&&s[r]&&f.push(s[r][0]),s[r]=0;for(n in o)Object.prototype.hasOwnProperty.call(o,n)&&(e[n]=o[n]);l&&l(t);while(f.length)f.shift()();return u.push.apply(u,i||[]),a()}function a(){for(var e,t=0;t<u.length;t++){for(var a=u[t],n=!0,r=1;r<a.length;r++){var c=a[r];0!==s[c]&&(n=!1)}n&&(u.splice(t--,1),e=o(o.s=a[0]))}return e}var n={},r={app:0},s={app:0},u=[];function c(e){return o.p+"js/"+({}[e]||e)+"."+{"chunk-2d0a45db":"f9938791","chunk-2d0e571a":"e1107dba","chunk-2d0e982b":"ab85d322","chunk-2d210fc1":"70800486","chunk-2d215cff":"4654c3e2","chunk-2d21e433":"2dd543b6","chunk-2d22d765":"120e8288","chunk-541126a2":"a32eec0b","chunk-1dd4fc7d":"0e0d0cf4","chunk-4a9f796f":"ed90b29d","chunk-59cee769":"56761056","chunk-664ba206":"a42b5f66","chunk-a327f56a":"b296f9fa","chunk-f5c7adac":"d04280d1","chunk-06c002b4":"184ce864","chunk-2d0ae944":"9d3a742e","chunk-2d0cf894":"cf7f12a3","chunk-64993f71":"3afefef7","chunk-bfae4a8a":"7136b29f","chunk-c428a618":"69c03186","chunk-ef99e0d0":"8c8ccc35","chunk-fb843f8c":"d1b51804","chunk-2d0be10c":"23fa8eee","chunk-2d0e5e94":"8a6a1c78","chunk-5dcda1e2":"050171c9","chunk-82097d2c":"9613305b"}[e]+".js"}function o(t){if(n[t])return n[t].exports;var a=n[t]={i:t,l:!1,exports:{}};return e[t].call(a.exports,a,a.exports,o),a.l=!0,a.exports}o.e=function(e){var t=[],a={"chunk-541126a2":1,"chunk-1dd4fc7d":1,"chunk-59cee769":1,"chunk-664ba206":1,"chunk-a327f56a":1,"chunk-f5c7adac":1,"chunk-06c002b4":1,"chunk-64993f71":1,"chunk-bfae4a8a":1,"chunk-c428a618":1,"chunk-fb843f8c":1,"chunk-5dcda1e2":1,"chunk-82097d2c":1};r[e]?t.push(r[e]):0!==r[e]&&a[e]&&t.push(r[e]=new Promise((function(t,a){for(var n="css/"+({}[e]||e)+"."+{"chunk-2d0a45db":"31d6cfe0","chunk-2d0e571a":"31d6cfe0","chunk-2d0e982b":"31d6cfe0","chunk-2d210fc1":"31d6cfe0","chunk-2d215cff":"31d6cfe0","chunk-2d21e433":"31d6cfe0","chunk-2d22d765":"31d6cfe0","chunk-541126a2":"1b31d97b","chunk-1dd4fc7d":"7d887a01","chunk-4a9f796f":"31d6cfe0","chunk-59cee769":"454ad30e","chunk-664ba206":"9de656ec","chunk-a327f56a":"e65ea6a3","chunk-f5c7adac":"04cd7e4c","chunk-06c002b4":"3fc27d66","chunk-2d0ae944":"31d6cfe0","chunk-2d0cf894":"31d6cfe0","chunk-64993f71":"aa35bca3","chunk-bfae4a8a":"49830f27","chunk-c428a618":"49830f27","chunk-ef99e0d0":"31d6cfe0","chunk-fb843f8c":"6daefb45","chunk-2d0be10c":"31d6cfe0","chunk-2d0e5e94":"31d6cfe0","chunk-5dcda1e2":"a0112952","chunk-82097d2c":"dc27fae0"}[e]+".css",s=o.p+n,u=document.getElementsByTagName("link"),c=0;c<u.length;c++){var i=u[c],d=i.getAttribute("data-href")||i.getAttribute("href");if("stylesheet"===i.rel&&(d===n||d===s))return t()}var f=document.getElementsByTagName("style");for(c=0;c<f.length;c++){i=f[c],d=i.getAttribute("data-href");if(d===n||d===s)return t()}var l=document.createElement("link");l.rel="stylesheet",l.type="text/css",l.onload=t,l.onerror=function(t){var n=t&&t.target&&t.target.src||s,u=new Error("Loading CSS chunk "+e+" failed.\n("+n+")");u.code="CSS_CHUNK_LOAD_FAILED",u.request=n,delete r[e],l.parentNode.removeChild(l),a(u)},l.href=s;var h=document.getElementsByTagName("head")[0];h.appendChild(l)})).then((function(){r[e]=0})));var n=s[e];if(0!==n)if(n)t.push(n[2]);else{var u=new Promise((function(t,a){n=s[e]=[t,a]}));t.push(n[2]=u);var i,d=document.createElement("script");d.charset="utf-8",d.timeout=120,o.nc&&d.setAttribute("nonce",o.nc),d.src=c(e);var f=new Error;i=function(t){d.onerror=d.onload=null,clearTimeout(l);var a=s[e];if(0!==a){if(a){var n=t&&("load"===t.type?"missing":t.type),r=t&&t.target&&t.target.src;f.message="Loading chunk "+e+" failed.\n("+n+": "+r+")",f.name="ChunkLoadError",f.type=n,f.request=r,a[1](f)}s[e]=void 0}};var l=setTimeout((function(){i({type:"timeout",target:d})}),12e4);d.onerror=d.onload=i,document.head.appendChild(d)}return Promise.all(t)},o.m=e,o.c=n,o.d=function(e,t,a){o.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:a})},o.r=function(e){"undefined"!==typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},o.t=function(e,t){if(1&t&&(e=o(e)),8&t)return e;if(4&t&&"object"===typeof e&&e&&e.__esModule)return e;var a=Object.create(null);if(o.r(a),Object.defineProperty(a,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var n in e)o.d(a,n,function(t){return e[t]}.bind(null,n));return a},o.n=function(e){var t=e&&e.__esModule?function(){return e["default"]}:function(){return e};return o.d(t,"a",t),t},o.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},o.p="/",o.oe=function(e){throw console.error(e),e};var i=window["webpackJsonp"]=window["webpackJsonp"]||[],d=i.push.bind(i);i.push=t,i=i.slice();for(var f=0;f<i.length;f++)t(i[f]);var l=d;u.push([0,"chunk-vendors"]),a()})({0:function(e,t,a){e.exports=a("56d7")},"56d7":function(e,t,a){"use strict";a.r(t);a("4de4"),a("baa5"),a("a9e3"),a("b680"),a("ac1f"),a("5319"),a("e260"),a("e6cf"),a("cca6"),a("a79d");var n=a("2b0e"),r=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("v-app",[a("router-view"),a("v-snackbar",{attrs:{color:e.snackbar_color,top:!0},model:{value:e.snackbar_success,callback:function(t){e.snackbar_success=t},expression:"snackbar_success"}},[e._v(" "+e._s(e.page_message)),a("br")]),a("v-snackbar",{attrs:{color:e.snackbar_color,top:!0},model:{value:e.snackbar_error,callback:function(t){e.snackbar_error=t},expression:"snackbar_error"}},[e._v(" "+e._s(e.page_message)),a("br"),e._l(e.page_form_error_message,(function(t){return a("div",{key:t.name},[a("strong",[e._v(e._s(t.field))]),e._l(t.error,(function(t){return a("div",{key:t.message},[e._v(" "+e._s(t.message)+" ")])}))],2)}))],2),a("confirm",{ref:"confirm"})],1)},s=[],u=(a("d3b7"),function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("v-dialog",{style:{zIndex:e.options.zIndex},attrs:{"max-width":e.options.width},on:{keydown:function(t){return!t.type.indexOf("key")&&e._k(t.keyCode,"esc",27,t.key,["Esc","Escape"])?null:e.cancel(t)}},model:{value:e.dialog,callback:function(t){e.dialog=t},expression:"dialog"}},[a("v-card",[a("v-toolbar",{attrs:{dark:"",color:e.options.color,dense:"",flat:""}},[a("v-toolbar-title",{staticClass:"white--text"},[e._v(e._s(e.title))])],1),a("v-card-text",{directives:[{name:"show",rawName:"v-show",value:!!e.message,expression:"!!message"}],staticClass:"pa-4"},[a("p",[e._v(" "+e._s(e.message)+" ")]),a("v-alert",{directives:[{name:"show",rawName:"v-show",value:!!e.options.desc,expression:"!!options.desc"}],attrs:{dense:"",text:"",type:e.options.type}},[e._v(" "+e._s(e.options.desc)+" ")])],1),"yescancel"==e.options.action?a("v-card-actions",{staticClass:"pt-0"},[a("v-spacer"),a("v-btn",{attrs:{color:"primary darken-1",text:""},nativeOn:{click:function(t){return e.agree(t)}}},[e._v("YA")]),a("v-btn",{attrs:{color:"grey",text:""},nativeOn:{click:function(t){return e.cancel(t)}}},[e._v("TIDAK")])],1):a("v-card-actions",{staticClass:"pt-0"},[a("v-spacer"),a("v-btn",{attrs:{color:"primary darken-1",text:""},nativeOn:{click:function(t){return e.agree(t)}}},[e._v("YA")])],1)],1)],1)}),c=[],o={data:function(){return{dialog:!1,resolve:null,reject:null,message:null,title:null,options:{color:"primary",width:290,zIndex:200,desc:null,type:"error",action:"yescancel"}}},methods:{open:function(e,t,a){var n=this;return this.dialog=!0,this.title=e,this.message=t,this.options=Object.assign(this.options,a),new Promise((function(e,t){n.resolve=e,n.reject=t}))},agree:function(){this.resolve(!0),this.dialog=!1},cancel:function(){this.resolve(!1),this.dialog=!1}}},i=o,d=a("2877"),f=a("6544"),l=a.n(f),h=a("0798"),m=a("8336"),p=a("b0af"),k=a("99d9"),g=a("169a"),b=a("2fa4"),_=a("71d9"),v=a("2a7f"),A=Object(d["a"])(i,u,c,!1,null,null,null),S=A.exports;l()(A,{VAlert:h["a"],VBtn:m["a"],VCard:p["a"],VCardActions:k["a"],VCardText:k["c"],VDialog:g["a"],VSpacer:b["a"],VToolbar:_["a"],VToolbarTitle:v["a"]});var y={name:"PortalEkampus",created:function(){var e=this;this.$ajax.interceptors.response.use((function(t){var a=t.data;switch(a.pid){case"store":case"update":case"destroy":case"resendemail":e.snackbar_color="success",e.snackbar_success=!0,e.page_message=a.message;break}return t}),(function(t){var a=t.config,n=t.response,r=n.data,s=n.status;switch(s){case 401:"login"!=r.page&&(e.$store.dispatch("auth/logout"),e.$store.dispatch("uifront/reinit"),e.$store.dispatch("uiadmin/reinit"),e.snackbar_color="error",e.snackbar_error=!0,e.page_message="("+s+": "+r.error+") Token telah expire mohon login kembali");break;case 403:e.snackbar_error=!0,e.snackbar_color="error",e.page_message="("+s+": Forbidden) "+r.message+" to access resource ["+a.baseURL+a.url+"]";break;case 404:e.snackbar_error=!0,e.snackbar_color="error",e.page_message="("+s+": "+r.error+") Mohon untuk dicek url route ("+a.baseURL+a.url+") apakah tersedia";break;case 405:e.snackbar_error=!0,e.snackbar_color="error",e.page_message="("+s+": "+r.exception+") Mohon untuk dicek HTTP METHOD ";break;case 422:e.snackbar_color="error",e.snackbar_error=!0;var u=[];for(var c in r){var o=[],i=r[c];if(Array.isArray(i)){for(var d=0;d<i.length;d++)o.push({message:i[d]});u.push({field:c,error:o})}else u.push({field:c,error:[{message:r[c]}]})}e.page_form_error_message=u,e.page_message="("+s+": Unprocessible Entity) ";break;case 500:e.snackbar_error=!0,e.snackbar_color="error",e.page_message="("+s+" (internal server eror): "+r.message;break}return Promise.reject(t)}))},mounted:function(){this.$root.$confirm=this.$refs.confirm},data:function(){return{snackbar_success:!1,snackbar_error:!1,snackbar_color:"error",page_message:"",page_form_error_message:{}}},components:{confirm:S}},P=y,T=a("7496"),w=a("2db4"),D=Object(d["a"])(P,r,s,!1,null,null,null),x=D.exports;l()(D,{VApp:T["a"],VSnackbar:w["a"]});a("45fc");var I=a("8c4f"),E=a("2f62"),O=a("bfa9"),N=(a("96cf"),a("1da1")),K=function(){return{loaded:!1,tahun_data:(new Date).getFullYear(),identitas:{nama_app:"",nama_app_alias:""}}},U=K(),L={setLoaded:function(e,t){e.loaded=t},setTahunData:function(e,t){e.tahun_data=t},setIdentitas:function(e,t){e.identitas=t},resetState:function(e){Object.assign(e,K())}},j={isLoaded:function(e){return e.loaded},getTahunData:function(e){return e.tahun_data},getNamaAPP:function(e){return e.identitas.nama_app},getNamaAPPAlias:function(e){return e.identitas.nama_app_alias}},R={init:function(){var e=Object(N["a"])(regeneratorRuntime.mark((function e(t,a){var n,r;return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:if(n=t.commit,r=t.state,n("setLoaded",!1),r.loaded){e.next=5;break}return e.next=5,a.get("/system/setting/uifront").then((function(e){var t=e.data;console.log(t),n("setTahunData",t.tahun_data),n("setIdentitas",t.identitas),n("setLoaded",!0)}));case 5:case"end":return e.stop()}}),e)})));function t(t,a){return e.apply(this,arguments)}return t}(),reinit:function(e){var t=e.commit;t("resetState")}},M={namespaced:!0,state:U,mutations:L,getters:j,actions:R},C=(a("7db0"),a("4160"),a("a434"),a("b0c0"),a("159b"),function(){return{loaded:!1,default_dashboard:null,pages:[],daftar_ta:[],tahun_pendaftaran:null,tahun_akademik:null,daftar_semester:[],semester_pendaftaran:null,semester_akademik:null,daftar_fakultas:[],fakultas_id:null,daftar_prodi:[],prodi_id:null,daftar_kelas:[],idkelas:null,daftar_status_mhs:[],k_status:null}}),q=C(),F={setNewPage:function(e,t){e.pages.push(t)},replacePage:function(e,t,a){e.pages[a]=t},removePage:function(e,t){var a;for(a=0;a<e.pages.length;a++)if(e.pages[a].name==t){e.pages.splice(a,1);break}},setLoaded:function(e,t){e.loaded=t},setDashboard:function(e,t){e.default_dashboard=t},setDaftarTA:function(e,t){e.daftar_ta=t},setTahunPendaftaran:function(e,t){e.tahun_pendaftaran=t},setTahunAkademik:function(e,t){e.tahun_akademik=t},setDaftarSemester:function(e,t){e.daftar_semester=t},setSemesterPendaftaran:function(e,t){e.semester_pendaftaran=t},setSemesterAkademik:function(e,t){e.semester_akademik=t},setDaftarFakultas:function(e,t){e.daftar_fakultas=t},setFakultasID:function(e,t){e.fakultas_id=t},setDaftarProdi:function(e,t){e.daftar_prodi=t},setProdiID:function(e,t){e.prodi_id=t},setDaftarKelas:function(e,t){e.daftar_kelas=t},setIDKelas:function(e,t){e.idkelas=t},setDaftarStatusMahasiswa:function(e,t){e.daftar_status_mhs=t},setStatusMahasiswa:function(e,t){e.k_status=t},resetState:function(e){Object.assign(e,C())}},V={Page:function(e){return function(t){var a=e.pages.find((function(e){return e.name==t}));return a}},AtributeValueOfPage:function(e){return function(t,a){var n=e.pages.find((function(e){return e.name==t}));return n[a]}},getDefaultDashboard:function(e){return e.default_dashboard},getDaftarTA:function(e){return e.daftar_ta},getTahunPendaftaran:function(e){return parseInt(e.tahun_pendaftaran)},getTahunAkademik:function(e){return parseInt(e.tahun_akademik)},getDaftarSemester:function(e){return e.daftar_semester},getNamaSemester:function(e){return function(t){var a="",n=e.daftar_semester.find((function(e){return e.id==t}));return"undefined"!==typeof n&&(a=n.text),a}},getSemesterPendaftaran:function(e){return parseInt(e.semester_pendaftaran)},getSemesterAkademik:function(e){return parseInt(e.semester_akademik)},getDaftarProdi:function(e){return e.daftar_prodi.filter((function(e){return null!=e}))},getProdiID:function(e){return parseInt(e.prodi_id)},getProdiName:function(e){return function(t){return null==e.daftar_prodi?"":e.daftar_prodi[t].nama_prodi}},getDaftarFakultas:function(e){return e.daftar_fakultas.filter((function(e){return null!=e}))},getFakultasID:function(e){return e.fakultas_id},getFakultasName:function(e){return function(t){var a="",n=e.daftar_fakultas.find((function(e){return e.id==t}));return"undefined"!==typeof n&&(a=n.text),a}},getDaftarKelas:function(e){return e.daftar_kelas},getIDKelas:function(e){return e.idkelas},getNamaKelas:function(e){return function(t){var a="N.A",n=e.daftar_kelas.find((function(e){return e.id==t}));return"undefined"!==typeof n&&(a=n.text),a}},getDaftarStatusMahasiswa:function(e){return e.daftar_status_mhs},getKStatus:function(e){return e.k_status},getStatusMahasiswa:function(e){return function(t){var a="N.A",n=e.daftar_status_mhs.find((function(e){return e.id==t}));return"undefined"!==typeof n&&(a=n.text),a}}},$={init:function(){var e=Object(N["a"])(regeneratorRuntime.mark((function e(t,a){var n,r,s,u;return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:if(n=t.commit,r=t.state,s=t.rootGetters,n("setLoaded",!1),r.loaded||!s["auth/Authenticated"]){e.next=7;break}return n("setSemesterPendaftaran",s["uifront/getSemesterPendaftaran"]),u=s["auth/Token"],e.next=7,a.get("/system/setting/uiadmin",{headers:{Authorization:u}}).then((function(e){var t=e.data;n("setDaftarTA",t.daftar_ta),n("setTahunPendaftaran",t.tahun_pendaftaran),n("setTahunAkademik",t.tahun_akademik),n("setDaftarSemester",t.daftar_semester),n("setSemesterAkademik",t.semester_akademik);var a=t.daftar_fakultas,r=[];a.forEach((function(e){r.push({id:e.kode_fakultas,text:e.nama_fakultas,nama_fakultas:e.nama_fakultas})})),n("setDaftarFakultas",r),n("setFakultasID",t.fakultas_id);var s=t.daftar_prodi,u=[];s.forEach((function(e){u[e.id]={id:e.id,text:e.nama_prodi_alias+" ("+e.nama_jenjang+")",nama_prodi:e.nama_prodi+" ("+e.nama_jenjang+")"}})),n("setDaftarProdi",u),n("setProdiID",t.prodi_id),n("setDaftarKelas",t.daftar_kelas),n("setIDKelas",t.idkelas),n("setDaftarStatusMahasiswa",t.daftar_status_mhs),n("setStatusMahasiswa",t.k_status),n("setLoaded",!0)}));case 7:case"end":return e.stop()}}),e)})));function t(t,a){return e.apply(this,arguments)}return t}(),addToPages:function(e,t){var a=e.commit,n=e.state,r=n.pages.find((function(e){return e.name==t.name}));r||a("setNewPage",t)},updatePage:function(e,t){var a,n=e.commit,r=e.state;for(a=0;a<r.pages.length;a++)if(r.pages[a].name==t.name)break;n("replacePage",t,a)},deletePage:function(e,t){var a=e.commit;a("removePage",t)},changeDashboard:function(e,t){var a=e.commit;a("setDashboard",t)},updateFakultas:function(e,t){var a=e.commit;a("setFakultasID",t)},updateProdi:function(e,t){var a=e.commit;a("setProdiID",t)},updateTahunPendaftaran:function(e,t){var a=e.commit;a("setTahunPendaftaran",t)},updateTahunAkademik:function(e,t){var a=e.commit;a("setTahunAkademik",t)},updateSemesterPendaftaran:function(e,t){var a=e.commit;a("setSemesterPendaftaran",t)},updateSemesterAkademik:function(e,t){var a=e.commit;a("setSemesterAkademik",t)},updateIDKelas:function(e,t){var a=e.commit;a("setIDKelas",t)},reinit:function(e){var t=e.commit;t("resetState")}},G={namespaced:!0,state:q,mutations:F,getters:V,actions:$},B=function(){return{access_token:null,token_type:null,expires_in:null,user:null}},H=B(),z={setToken:function(e,t){e.access_token=t.access_token,e.token_type=t.token_type,e.expires_in=t.expires_in},setUser:function(e,t){e.user=t},resetState:function(e){Object.assign(e,B())}},Y={Authenticated:function(e){return null!=e.access_token&&null!=e.user},AccessToken:function(e){return e.access_token},Token:function(e){return e.token_type+" "+e.access_token},Roles:function(e){return e.user.role},Role:function(e){var t="";if(null!=e.access_token&&null!=e.user)for(var a=e.user.role,n=0;n<a.length;n++)switch(a[n]){case"mahasiswabaru":t+="[mahasiswabaru] ";break;case"mahasiswa":t+="[mahasiswa] ";break;default:t=t+"["+a[n]+"] "}return t},User:function(e){return e.user},AttributeUser:function(e){return function(t){return null==e.user?"":e.user[t]}},can:function(e){return function(t){if(null==e.user)return!1;if(e.user.issuperadmin)return!0;var a=e.user.permissions;return t in a}}},J={afterLoginSuccess:function(e,t){var a=e.commit;a("setToken",t.token),a("setUser",t.user)},logout:function(e){var t=e.commit;t("resetState")}},W={namespaced:!0,state:H,mutations:z,getters:Y,actions:J},Q=new O["a"]({storage:localStorage});n["a"].use(E["a"]);var X=new E["a"].Store({modules:{uifront:M,auth:W,uiadmin:G},plugins:[Q.plugin]}),Z=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("v-container",{staticClass:"text-center",staticStyle:{height:"calc(100vh - 58px)"},attrs:{"fill-height":""}},[a("v-row",{attrs:{align:"center"}},[a("v-col",[a("h1",{staticClass:"display-2 primary--text"},[e._v("Whoops, 404")]),a("p",[e._v("The page you were looking for does not exist")]),a("v-btn",{attrs:{color:"primary",outlined:""},on:{click:function(t){return e.$router.go(-1)}}},[e._v(" Get me out of here! ")])],1)],1)],1)},ee=[],te={name:"NotFound"},ae=te,ne=a("62ad"),re=a("a523"),se=a("0fd9"),ue=Object(d["a"])(ae,Z,ee,!1,null,null,null),ce=ue.exports;l()(ue,{VBtn:m["a"],VCol:ne["a"],VContainer:re["a"],VRow:se["a"]}),n["a"].use(I["a"]);var oe=[{path:"/",name:"FrontDashboard",meta:{title:"DASHBOARD"},component:function(){return a.e("chunk-82097d2c").then(a.bind(null,"bfc7"))}},{path:"/login",name:"FrontLogin",meta:{title:"LOGIN"},component:function(){return a.e("chunk-5dcda1e2").then(a.bind(null,"a56a"))}},{path:"/dashboard/:token",name:"AdminDashboard",meta:{title:"DASHBOARD"},component:function(){return Promise.all([a.e("chunk-541126a2"),a.e("chunk-4a9f796f")]).then(a.bind(null,"969c"))}},{path:"/dmaster/jeniskegiatan",name:"DMasterKelas",meta:{title:"DATA MASTER - KELAS",requiresAuth:!0},component:function(){return Promise.all([a.e("chunk-541126a2"),a.e("chunk-f5c7adac"),a.e("chunk-06c002b4"),a.e("chunk-2d0cf894")]).then(a.bind(null,"63ab"))}},{path:"/konsultasi/kegiatan",name:"KonsultasiKegiatan",meta:{title:"KONSULTASI - KEGIATAN",requiresAuth:!0},component:function(){return Promise.all([a.e("chunk-541126a2"),a.e("chunk-f5c7adac"),a.e("chunk-06c002b4"),a.e("chunk-2d0ae944")]).then(a.bind(null,"0b51"))}},{path:"/konsultasi/kegiatan/tambah",name:"KonsultasiKegiatanTambah",meta:{title:"KONSULTASI - KEGIATAN",requiresAuth:!0},component:function(){return Promise.all([a.e("chunk-541126a2"),a.e("chunk-f5c7adac"),a.e("chunk-fb843f8c"),a.e("chunk-2d0e5e94")]).then(a.bind(null,"9700"))}},{path:"/konsultasi/kegiatan/:kegiatan_id/ubah",name:"KonsultasiKegiatanUbah",meta:{title:"KONSULTASI - KEGIATAN",requiresAuth:!0},component:function(){return Promise.all([a.e("chunk-541126a2"),a.e("chunk-f5c7adac"),a.e("chunk-fb843f8c"),a.e("chunk-2d0be10c")]).then(a.bind(null,"2f57"))}},{path:"/konsultasi/kegiatan/:kegiatan_id/files",name:"KonsultasiKegiatanFiles",meta:{title:"KONSULTASI - KEGIATAN",requiresAuth:!0},component:function(){return a.e("chunk-2d0e571a").then(a.bind(null,"9508"))}},{path:"/konsultasi/kegiatan/:kegiatan_id/detail",name:"KonsultasiKegiatanDetail",meta:{title:"KONSULTASI - KEGIATAN",requiresAuth:!0},component:function(){return a.e("chunk-2d22d765").then(a.bind(null,"f830"))}},{path:"/laporan/kegiatan",name:"LaporanKegiatan",meta:{title:"LAPORAN - KEGIATAN",requiresAuth:!0},component:function(){return a.e("chunk-2d215cff").then(a.bind(null,"c095"))}},{path:"/system-setting/identitasdiri",name:"IdentitasDiri",meta:{title:"SETTING - IDENTITAS DIRI",requiresAuth:!0},component:function(){return Promise.all([a.e("chunk-541126a2"),a.e("chunk-664ba206")]).then(a.bind(null,"a899"))}},{path:"/system-setting/captcha",name:"SettingCaptcha",meta:{title:"SETTING - CAPTCHA",requiresAuth:!0},component:function(){return Promise.all([a.e("chunk-541126a2"),a.e("chunk-1dd4fc7d")]).then(a.bind(null,"b746"))}},{path:"/system-setting/email",name:"SettingEmail",meta:{title:"SETTING - EMAIL",requiresAuth:!0},component:function(){return Promise.all([a.e("chunk-541126a2"),a.e("chunk-59cee769")]).then(a.bind(null,"28b3"))}},{path:"/system-users/permissions",name:"UsersPermissions",meta:{title:"USERS - PERMISSIONS",requiresAuth:!0},component:function(){return Promise.all([a.e("chunk-541126a2"),a.e("chunk-f5c7adac"),a.e("chunk-06c002b4"),a.e("chunk-ef99e0d0")]).then(a.bind(null,"8c24"))}},{path:"/system-users/roles",name:"UsersRoles",meta:{title:"USERS - ROLES",requiresAuth:!0},component:function(){return Promise.all([a.e("chunk-541126a2"),a.e("chunk-f5c7adac"),a.e("chunk-06c002b4"),a.e("chunk-64993f71")]).then(a.bind(null,"d90d"))}},{path:"/system-users/superadmin",name:"UsersSuperadmin",meta:{title:"USERS - SUPER ADMIN",requiresAuth:!0},component:function(){return Promise.all([a.e("chunk-541126a2"),a.e("chunk-f5c7adac"),a.e("chunk-06c002b4"),a.e("chunk-bfae4a8a")]).then(a.bind(null,"c820"))}},{path:"/system-users/paralegal",name:"UsersParaLegal",meta:{title:"USERS - LEGAL",requiresAuth:!0},component:function(){return Promise.all([a.e("chunk-541126a2"),a.e("chunk-f5c7adac"),a.e("chunk-06c002b4"),a.e("chunk-c428a618")]).then(a.bind(null,"9a3e"))}},{path:"/system-users/pmb",name:"UsersPMB",meta:{title:"USERS - PMB",requiresAuth:!0},component:function(){return a.e("chunk-2d21e433").then(a.bind(null,"d58d"))}},{path:"/system-users/kades",name:"UsersKades",meta:{title:"USERS - KADES",requiresAuth:!0},component:function(){return a.e("chunk-2d0a45db").then(a.bind(null,"05aa"))}},{path:"/system-users/obh",name:"UsersDosen",meta:{title:"USERS - OBH",requiresAuth:!0},component:function(){return a.e("chunk-2d0e982b").then(a.bind(null,"8e9a"))}},{path:"/system-users/kumham",name:"UsersKumham",meta:{title:"USERS - KANWIL KEMENHUMKAM",requiresAuth:!0},component:function(){return a.e("chunk-2d210fc1").then(a.bind(null,"b9e9"))}},{path:"/system-users/profil",name:"UsersProfil",meta:{title:"USERS - PROFILE",requiresAuth:!0},component:function(){return Promise.all([a.e("chunk-541126a2"),a.e("chunk-a327f56a")]).then(a.bind(null,"641f"))}},{path:"/404",name:"NotFoundComponent",meta:{title:"PAGE NOT FOUND"},component:ce},{path:"*",redirect:"/404"}],ie=new I["a"]({mode:"history",base:"/",routes:oe});ie.beforeEach((function(e,t,a){if(document.title=e.meta.title,e.matched.some((function(e){return e.meta.requiresAuth}))){if(X.getters["auth/Authenticated"])return void a();a("/login")}else a()}));var de=ie,fe=a("f309"),le=a("a563"),he=a("8654");n["a"].use(fe["a"]),n["a"].component("v-text-field",he["a"]),n["a"].use(le["a"],{decimalLength:0,autoDecimalMode:!0,min:null,max:null,valueAsInteger:!0,defaultValue:0});var me=new fe["a"]({}),pe=a("bc3a"),ke=a.n(pe),ge={install:function(e){var t=ke.a.create({baseURL:"https://api-sepakat.yacanet.com/v1"});e.prototype.$api={url:"https://api-sepakat.yacanet.com",post:function(){var e=Object(N["a"])(regeneratorRuntime.mark((function e(a){return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:return e.next=2,t.post(a);case 2:return e.abrupt("return",e.sent);case 3:case"end":return e.stop()}}),e)})));function a(t){return e.apply(this,arguments)}return a}()},e.prototype.$ajax=t}},be=a("5a0c"),_e=a.n(be),ve=a("4208"),Ae=a.n(ve);_e.a.extend(Ae.a),Object.defineProperties(n["a"].prototype,{$date:{get:function(){return _e.a}}}),n["a"].use(ge),n["a"].config.productionTip=!1,n["a"].filter("formatTA",(function(e){return e=parseInt(e),e+"/"+(e+1)})),n["a"].filter("formatUang",(function(e){var t=new Number(e).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g,"$1."),a=t.lastIndexOf(".");return t=t.substring(0,a)+","+t.substring(a+1),t})),n["a"].mixin({methods:{}}),new n["a"]({router:de,store:X,vuetify:me,render:function(e){return e(x)}}).$mount("#app")}});