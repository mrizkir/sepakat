(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-1758ffeb"],{"28b3":function(t,e,i){"use strict";i.r(e);var a=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("SystemConfigLayout",[i("ModuleHeader",{scopedSlots:t._u([{key:"icon",fn:function(){return[t._v(" mdi-email ")]},proxy:!0},{key:"name",fn:function(){return[t._v(" EMAIL ")]},proxy:!0},{key:"breadcrumbs",fn:function(){return[i("v-breadcrumbs",{staticClass:"pa-0",attrs:{items:t.breadcrumbs},scopedSlots:t._u([{key:"divider",fn:function(){return[i("v-icon",[t._v("mdi-chevron-right")])]},proxy:!0}])})]},proxy:!0},{key:"desc",fn:function(){return[i("v-alert",{attrs:{color:"cyan",border:"left","colored-border":"",type:"info"}},[t._v(" Setting Email ")])]},proxy:!0}])}),i("v-container",{attrs:{fluid:""}},[i("v-row",{staticClass:"mb-4",attrs:{"no-gutters":""}},[i("v-col",{attrs:{cols:"12"}},[i("v-form",{ref:"frmdata",attrs:{"lazy-validation":""},model:{value:t.form_valid,callback:function(e){t.form_valid=e},expression:"form_valid"}},[i("v-card",[i("v-card-title",[t._v(" Pengiriman Email ")]),i("v-card-text",[i("v-row",[i("v-col",{attrs:{xs:"12",sm:"4",md:"3"}},[i("v-switch",{attrs:{label:"Check Email Mahasiswa Valid"},model:{value:t.formdata.email_mhs_isvalid,callback:function(e){t.$set(t.formdata,"email_mhs_isvalid",e)},expression:"formdata.email_mhs_isvalid"}})],1),t.$vuetify.breakpoint.xsOnly?i("v-responsive",{attrs:{width:"100%"}}):t._e()],1)],1),i("v-card-actions",[i("v-spacer"),i("v-btn",{attrs:{color:"blue darken-1",text:"",loading:t.btnLoading,disabled:!t.form_valid||t.btnLoading},on:{click:function(e){return e.stopPropagation(),t.save(e)}}},[t._v("SIMPAN")])],1)],1)],1)],1)],1)],1)],1)},s=[],n=i("5530"),r=i("1da1"),o=(i("96cf"),i("2f62")),c=i("6135"),l=i("e477"),d={name:"Email",created:function(){this.breadcrumbs=[{text:"HOME",disabled:!1,href:"/dashboard/"+this.ACCESS_TOKEN},{text:"KONFIGURASI SISTEM",disabled:!1,href:"/system-setting"},{text:"SERVER - EMAIL",disabled:!0,href:"#"}],this.initialize()},data:function(){return{breadcrumbs:[],btnLoading:!1,form_valid:!0,formdata:{email_mhs_isvalid:null}}},methods:{initialize:function(){var t=Object(r["a"])(regeneratorRuntime.mark((function t(){var e=this;return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:return this.datatableLoading=!0,t.next=3,this.$ajax.get("/system/setting/variables",{headers:{Authorization:this.TOKEN}}).then((function(t){var i=t.data,a=i.setting;e.formdata.email_mhs_isvalid=parseInt(a.EMAIL_MHS_ISVALID)}));case 3:case"end":return t.stop()}}),t,this)})));function e(){return t.apply(this,arguments)}return e}(),save:function(){var t=this;this.$refs.frmdata.validate()&&(this.btnLoading=!0,this.$ajax.post("/system/setting/variables",{_method:"PUT",pid:"email",setting:JSON.stringify({910:this.formdata.email_mhs_isvalid})},{headers:{Authorization:this.TOKEN}}).then((function(){t.btnLoading=!1})).catch((function(){t.btnLoading=!1})))}},computed:Object(n["a"])({},Object(o["b"])("auth",{ACCESS_TOKEN:"AccessToken",TOKEN:"Token"})),components:{SystemConfigLayout:c["a"],ModuleHeader:l["a"]}},h=d,u=i("2877"),f=i("6544"),m=i.n(f),v=i("0798"),p=i("2bc5"),b=i("8336"),g=i("b0af"),_=i("99d9"),w=i("62ad"),S=i("a523"),y=i("4bd4"),C=i("132d"),E=i("6b53"),x=i("0fd9"),k=i("2fa4"),O=(i("0481"),i("ec29"),i("9d01"),i("fe09")),V=i("c37a"),A=i("c3f0"),L=i("0789"),T=i("490a"),$=i("80d2"),j=O["a"].extend({name:"v-switch",directives:{Touch:A["a"]},props:{inset:Boolean,loading:{type:[Boolean,String],default:!1},flat:{type:Boolean,default:!1}},computed:{classes:function(){return Object(n["a"])(Object(n["a"])({},V["a"].options.computed.classes.call(this)),{},{"v-input--selection-controls v-input--switch":!0,"v-input--switch--flat":this.flat,"v-input--switch--inset":this.inset})},attrs:function(){return{"aria-checked":String(this.isActive),"aria-disabled":String(this.isDisabled),role:"switch"}},validationState:function(){return this.hasError&&this.shouldValidate?"error":this.hasSuccess?"success":null!==this.hasColor?this.computedColor:void 0},switchData:function(){return this.setTextColor(this.loading?void 0:this.validationState,{class:this.themeClasses})}},methods:{genDefaultSlot:function(){return[this.genSwitch(),this.genLabel()]},genSwitch:function(){return this.$createElement("div",{staticClass:"v-input--selection-controls__input"},[this.genInput("checkbox",Object(n["a"])(Object(n["a"])({},this.attrs),this.attrs$)),this.genRipple(this.setTextColor(this.validationState,{directives:[{name:"touch",value:{left:this.onSwipeLeft,right:this.onSwipeRight}}]})),this.$createElement("div",Object(n["a"])({staticClass:"v-input--switch__track"},this.switchData)),this.$createElement("div",Object(n["a"])({staticClass:"v-input--switch__thumb"},this.switchData),[this.genProgress()])])},genProgress:function(){return this.$createElement(L["c"],{},[!1===this.loading?null:this.$slots.progress||this.$createElement(T["a"],{props:{color:!0===this.loading||""===this.loading?this.color||"primary":this.loading,size:16,width:2,indeterminate:!0}})])},onSwipeLeft:function(){this.isActive&&this.onChange()},onSwipeRight:function(){this.isActive||this.onChange()},onKeydown:function(t){(t.keyCode===$["y"].left&&this.isActive||t.keyCode===$["y"].right&&!this.isActive)&&this.onChange()}}}),I=Object(u["a"])(h,a,s,!1,null,null,null);e["default"]=I.exports;m()(I,{VAlert:v["a"],VBreadcrumbs:p["a"],VBtn:b["a"],VCard:g["a"],VCardActions:_["a"],VCardText:_["c"],VCardTitle:_["d"],VCol:w["a"],VContainer:S["a"],VForm:y["a"],VIcon:C["a"],VResponsive:E["a"],VRow:x["a"],VSpacer:k["a"],VSwitch:j})},"9d01":function(t,e,i){}}]);