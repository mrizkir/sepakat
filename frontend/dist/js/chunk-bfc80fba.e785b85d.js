(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-bfc80fba"],{"2bfd":function(e,t,a){},"4bd4":function(e,t,a){"use strict";a("4de4"),a("7db0"),a("4160"),a("caad"),a("07ac"),a("2532"),a("159b");var n=a("5530"),i=a("58df"),s=a("7e2b"),r=a("3206");t["a"]=Object(i["a"])(s["a"],Object(r["b"])("form")).extend({name:"v-form",provide:function(){return{form:this}},inheritAttrs:!1,props:{disabled:Boolean,lazyValidation:Boolean,readonly:Boolean,value:Boolean},data:function(){return{inputs:[],watchers:[],errorBag:{}}},watch:{errorBag:{handler:function(e){var t=Object.values(e).includes(!0);this.$emit("input",!t)},deep:!0,immediate:!0}},methods:{watchInput:function(e){var t=this,a=function(e){return e.$watch("hasError",(function(a){t.$set(t.errorBag,e._uid,a)}),{immediate:!0})},n={_uid:e._uid,valid:function(){},shouldValidate:function(){}};return this.lazyValidation?n.shouldValidate=e.$watch("shouldValidate",(function(i){i&&(t.errorBag.hasOwnProperty(e._uid)||(n.valid=a(e)))})):n.valid=a(e),n},validate:function(){return 0===this.inputs.filter((function(e){return!e.validate(!0)})).length},reset:function(){this.inputs.forEach((function(e){return e.reset()})),this.resetErrorBag()},resetErrorBag:function(){var e=this;this.lazyValidation&&setTimeout((function(){e.errorBag={}}),0)},resetValidation:function(){this.inputs.forEach((function(e){return e.resetValidation()})),this.resetErrorBag()},register:function(e){this.inputs.push(e),this.watchers.push(this.watchInput(e))},unregister:function(e){var t=this.inputs.find((function(t){return t._uid===e._uid}));if(t){var a=this.watchers.find((function(e){return e._uid===t._uid}));a&&(a.valid(),a.shouldValidate()),this.watchers=this.watchers.filter((function(e){return e._uid!==t._uid})),this.inputs=this.inputs.filter((function(e){return e._uid!==t._uid})),this.$delete(this.errorBag,t._uid)}}},render:function(e){var t=this;return e("form",{staticClass:"v-form",attrs:Object(n["a"])({novalidate:!0},this.attrs$),on:{submit:function(e){return t.$emit("submit",e)}}},this.$slots.default)}})},b9e9:function(e,t,a){"use strict";a.r(t);var n=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("AdminLayout",[a("ModuleHeader",{scopedSlots:e._u([{key:"icon",fn:function(){return[e._v(" mdi-account ")]},proxy:!0},{key:"name",fn:function(){return[e._v(" USERS KANWIL HUKUM DAN HAM ")]},proxy:!0},{key:"breadcrumbs",fn:function(){return[a("v-breadcrumbs",{staticClass:"pa-0",attrs:{items:e.breadcrumbs},scopedSlots:e._u([{key:"divider",fn:function(){return[a("v-icon",[e._v("mdi-chevron-right")])]},proxy:!0}])})]},proxy:!0},{key:"desc",fn:function(){return[a("v-alert",{attrs:{color:"cyan",border:"left","colored-border":"",type:"info"}},[e._v(" User dengan role Kanwil Hukum dan HAM bertanggungjawab terhadap proses keseluruhan sistem. ")])]},proxy:!0}])}),a("v-container",{attrs:{fluid:""}},[a("v-row",{staticClass:"mb-4",attrs:{"no-gutters":""}},[a("v-col",{attrs:{cols:"12"}},[a("v-card",[a("v-card-text",[a("v-text-field",{attrs:{"append-icon":"mdi-database-search",label:"Search","single-line":"","hide-details":""},model:{value:e.search,callback:function(t){e.search=t},expression:"search"}})],1)],1)],1)],1),a("v-row",{staticClass:"mb-4",attrs:{"no-gutters":""}},[a("v-col",{attrs:{cols:"12"}},[a("v-data-table",{staticClass:"elevation-1",attrs:{headers:e.headers,items:e.daftar_users,search:e.search,"item-key":"id","sort-by":"name","show-expand":"",expanded:e.expanded,"single-expand":!0,loading:e.datatableLoading,"loading-text":"Loading... Please wait"},on:{"update:expanded":function(t){e.expanded=t},"click:row":e.dataTableRowClicked},scopedSlots:e._u([{key:"top",fn:function(){return[a("v-toolbar",{attrs:{flat:"",color:"white"}},[a("v-toolbar-title",[e._v("DAFTAR USERS KANWIL HUKUM DAN HAM")]),a("v-divider",{staticClass:"mx-4",attrs:{inset:"",vertical:""}}),a("v-spacer"),a("v-btn",{staticClass:"mb-2",attrs:{color:"primary",loading:e.btnLoading,disabled:e.btnLoading},on:{click:function(t){return t.stopPropagation(),e.showDialogTambahUserSuperAdmin(t)}}},[e._v(" TAMBAH ")]),a("v-dialog",{attrs:{"max-width":"500px",persistent:""},model:{value:e.dialog,callback:function(t){e.dialog=t},expression:"dialog"}},[a("v-form",{ref:"frmdata",attrs:{"lazy-validation":""},model:{value:e.form_valid,callback:function(t){e.form_valid=t},expression:"form_valid"}},[a("v-card",[a("v-card-title",[a("span",{staticClass:"headline"},[e._v(e._s(e.formTitle))])]),a("v-card-text",[a("v-text-field",{attrs:{label:"NAMA USER",outlined:"",rules:e.rule_user_name},model:{value:e.editedItem.name,callback:function(t){e.$set(e.editedItem,"name",t)},expression:"editedItem.name"}}),a("v-text-field",{attrs:{label:"EMAIL",outlined:"",rules:e.rule_user_email},model:{value:e.editedItem.email,callback:function(t){e.$set(e.editedItem,"email",t)},expression:"editedItem.email"}}),a("v-text-field",{attrs:{label:"NOMOR HP",outlined:"",rules:e.rule_user_nomorhp},model:{value:e.editedItem.nomor_hp,callback:function(t){e.$set(e.editedItem,"nomor_hp",t)},expression:"editedItem.nomor_hp"}}),a("v-text-field",{attrs:{label:"USERNAME",outlined:"",rules:e.rule_user_username},model:{value:e.editedItem.username,callback:function(t){e.$set(e.editedItem,"username",t)},expression:"editedItem.username"}}),a("v-text-field",{attrs:{label:"PASSWORD",type:"password",outlined:"",rules:e.rule_user_password},model:{value:e.editedItem.password,callback:function(t){e.$set(e.editedItem,"password",t)},expression:"editedItem.password"}}),a("v-autocomplete",{attrs:{items:e.daftar_roles,label:"ROLES",multiple:"","small-chips":"",outlined:""},model:{value:e.editedItem.role_id,callback:function(t){e.$set(e.editedItem,"role_id",t)},expression:"editedItem.role_id"}})],1),a("v-card-actions",[a("v-spacer"),a("v-btn",{attrs:{color:"blue darken-1",text:""},on:{click:function(t){return t.stopPropagation(),e.close(t)}}},[e._v("BATAL")]),a("v-btn",{attrs:{color:"blue darken-1",text:"",loading:e.btnLoading,disabled:!e.form_valid||e.btnLoading},on:{click:function(t){return t.stopPropagation(),e.save(t)}}},[e._v(" SIMPAN ")])],1)],1)],1)],1),a("v-dialog",{attrs:{"max-width":"500px",persistent:""},model:{value:e.dialogEdit,callback:function(t){e.dialogEdit=t},expression:"dialogEdit"}},[a("v-form",{ref:"frmdata",attrs:{"lazy-validation":""},model:{value:e.form_valid,callback:function(t){e.form_valid=t},expression:"form_valid"}},[a("v-card",[a("v-card-title",[a("span",{staticClass:"headline"},[e._v(e._s(e.formTitle))])]),a("v-card-text",[a("v-text-field",{attrs:{label:"NAMA USER",outlined:"",rules:e.rule_user_name},model:{value:e.editedItem.name,callback:function(t){e.$set(e.editedItem,"name",t)},expression:"editedItem.name"}}),a("v-text-field",{attrs:{label:"EMAIL",outlined:"",rules:e.rule_user_email},model:{value:e.editedItem.email,callback:function(t){e.$set(e.editedItem,"email",t)},expression:"editedItem.email"}}),a("v-text-field",{attrs:{label:"NOMOR HP",outlined:"",rules:e.rule_user_nomorhp},model:{value:e.editedItem.nomor_hp,callback:function(t){e.$set(e.editedItem,"nomor_hp",t)},expression:"editedItem.nomor_hp"}}),a("v-text-field",{attrs:{label:"USERNAME",outlined:"",rules:e.rule_user_username},model:{value:e.editedItem.username,callback:function(t){e.$set(e.editedItem,"username",t)},expression:"editedItem.username"}}),a("v-text-field",{attrs:{label:"PASSWORD",type:"password",outlined:"",rules:e.rule_user_passwordEdit},model:{value:e.editedItem.password,callback:function(t){e.$set(e.editedItem,"password",t)},expression:"editedItem.password"}}),a("v-autocomplete",{attrs:{items:e.daftar_roles,label:"ROLES",multiple:"","small-chips":"",outlined:""},model:{value:e.editedItem.role_id,callback:function(t){e.$set(e.editedItem,"role_id",t)},expression:"editedItem.role_id"}})],1),a("v-card-actions",[a("v-spacer"),a("v-btn",{attrs:{color:"blue darken-1",text:""},on:{click:function(t){return t.stopPropagation(),e.close(t)}}},[e._v("BATAL")]),a("v-btn",{attrs:{color:"blue darken-1",text:"",loading:e.btnLoading,disabled:!e.form_valid||e.btnLoading},on:{click:function(t){return t.stopPropagation(),e.save(t)}}},[e._v("SIMPAN")])],1)],1)],1)],1)],1)]},proxy:!0},{key:"item.actions",fn:function(t){var n=t.item;return[a("v-icon",{staticClass:"mr-2",attrs:{small:"",loading:e.btnLoading,disabled:e.btnLoading},on:{click:function(t){return t.stopPropagation(),e.editItem(n)}}},[e._v(" mdi-pencil ")]),a("v-icon",{attrs:{small:"",loading:e.btnLoading,disabled:e.btnLoading},on:{click:function(t){return t.stopPropagation(),e.deleteItem(n)}}},[e._v(" mdi-delete ")])]}},{key:"item.foto",fn:function(t){var n=t.item;return[a("v-avatar",{attrs:{size:"30"}},[a("v-img",{attrs:{src:e.$api.url+"/"+n.foto}})],1)]}},{key:"expanded-item",fn:function(t){var n=t.headers,i=t.item;return[a("td",{staticClass:"text-center",attrs:{colspan:n.length}},[a("v-col",{attrs:{cols:"12"}},[a("strong",[e._v("ID:")]),e._v(e._s(i.id)+" "),a("strong",[e._v("created_at:")]),e._v(e._s(e.$date(i.created_at).format("DD/MM/YYYY HH:mm"))+" "),a("strong",[e._v("updated_at:")]),e._v(e._s(e.$date(i.updated_at).format("DD/MM/YYYY HH:mm"))+" ")])],1)]}},{key:"no-data",fn:function(){return[e._v(" Data belum tersedia ")]},proxy:!0}])})],1)],1)],1)],1)},i=[],s=(a("4160"),a("c975"),a("a434"),a("b0c0"),a("159b"),a("5530")),r=(a("96cf"),a("1da1")),o=a("2f62"),d=a("a1b3"),l=a("e477"),u={name:"UsersKumham",created:function(){this.breadcrumbs=[{text:"HOME",disabled:!1,href:"/dashboard/"+this.ACCESS_TOKEN},{text:"USER SISTEM",disabled:!1,href:"#"},{text:"USERS KANWIL HUKUM DAN HAM",disabled:!0,href:"#"}],this.initialize()},data:function(){return{role_id:0,datatableLoading:!1,btnLoading:!1,headers:[{text:"",value:"foto"},{text:"USERNAME",value:"username",sortable:!0},{text:"NAME",value:"name",sortable:!0},{text:"EMAIL",value:"email",sortable:!0},{text:"NOMOR HP",value:"nomor_hp",sortable:!0},{text:"AKSI",value:"actions",sortable:!1,width:100}],expanded:[],search:"",daftar_users:[],form_valid:!0,daftar_roles:[],dialog:!1,dialogEdit:!1,editedIndex:-1,editedItem:{id:0,username:"",password:"",name:"",email:"",nomor_hp:"",role_id:["kumham"],created_at:"",updated_at:""},defaultItem:{id:0,username:"",password:"",name:"",email:"",nomor_hp:"",role_id:["kumham"],created_at:"",updated_at:""},rule_user_name:[function(e){return!!e||"Mohon untuk di isi nama User !!!"},function(e){return/^[A-Za-z\s]*$/.test(e)||"Nama User hanya boleh string dan spasi"}],rule_user_email:[function(e){return!!e||"Mohon untuk di isi email User !!!"},function(e){return/.+@.+\..+/.test(e)||"Format E-mail harus benar"}],rule_user_nomorhp:[function(e){return!!e||"Nomor HP mohon untuk diisi !!!"},function(e){return/^\+[1-9]{1}[0-9]{1,14}$/.test(e)||"Nomor HP hanya boleh angka dan gunakan kode negara didepan seperti +6281214553388"}],rule_user_username:[function(e){return!!e||"Mohon untuk di isi username User !!!"},function(e){return/^[A-Za-z_]*$/.test(e)||"Username hanya boleh string dan underscore"}],rule_user_password:[function(e){return!!e||"Mohon untuk di isi password User !!!"},function(e){return!(e&&"undefined"!==typeof e&&e.length>0)||(e.length>=8||"Minimial Password 8 karaketer")}],rule_user_passwordEdit:[function(e){return!(e&&"undefined"!==typeof e&&e.length>0)||(e.length>=8||"Minimial Password 8 karaketer")}]}},methods:{initialize:function(){var e=Object(r["a"])(regeneratorRuntime.mark((function e(){var t=this;return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:return this.datatableLoading=!0,e.next=3,this.$ajax.get("/system/userskumham",{headers:{Authorization:this.TOKEN}}).then((function(e){var a=e.data;t.daftar_users=a.users,t.role_id=a.role.id,t.datatableLoading=!1}));case 3:case"end":return e.stop()}}),e,this)})));function t(){return e.apply(this,arguments)}return t}(),dataTableRowClicked:function(e){e===this.expanded[0]?this.expanded=[]:this.expanded=[e]},showDialogTambahUserSuperAdmin:function(){var e=Object(r["a"])(regeneratorRuntime.mark((function e(){var t=this;return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:return e.next=2,this.$ajax.get("/system/setting/roles",{headers:{Authorization:this.TOKEN}}).then((function(e){var a=e.data,n=a.roles,i=[];n.forEach((function(e){"kumham"==e.name?i.push({text:e.name,disabled:!0}):i.push({text:e.name,disabled:!1})})),t.daftar_roles=i,t.dialog=!0}));case 2:case"end":return e.stop()}}),e,this)})));function t(){return e.apply(this,arguments)}return t}(),editItem:function(){var e=Object(r["a"])(regeneratorRuntime.mark((function e(t){var a=this;return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:return this.editedIndex=this.daftar_users.indexOf(t),t.password="",this.editedItem=Object.assign({},t),e.next=5,this.$ajax.get("/system/setting/roles",{headers:{Authorization:this.TOKEN}}).then((function(e){var t=e.data,n=t.roles,i=[];n.forEach((function(e){"kumham"==e.name?i.push({text:e.name,disabled:!0}):"superadmin"!=e.name&&i.push({text:e.name,disabled:!1})})),a.daftar_roles=i}));case 5:return this.btnLoading=!0,e.next=8,this.$ajax.get("/system/users/"+t.id+"/roles",{headers:{Authorization:this.TOKEN}}).then((function(e){var t=e.data;a.editedItem.role_id=t.roles,a.btnLoading=!1,a.dialogEdit=!0}));case 8:case"end":return e.stop()}}),e,this)})));function t(t){return e.apply(this,arguments)}return t}(),close:function(){var e=this;this.btnLoading=!1,this.dialog=!1,this.dialogEdit=!1,setTimeout((function(){e.editedItem=Object.assign({},e.defaultItem),e.editedIndex=-1,e.$refs.frmdata.reset()}),300)},save:function(){var e=this;this.$refs.frmdata.validate()&&(this.btnLoading=!0,this.editedIndex>-1?this.$ajax.post("/system/userskumham/"+this.editedItem.id,{_method:"PUT",name:this.editedItem.name,email:this.editedItem.email,nomor_hp:this.editedItem.nomor_hp,username:this.editedItem.username,password:this.editedItem.password,role_id:JSON.stringify(Object.assign({},this.editedItem.role_id))},{headers:{Authorization:this.TOKEN}}).then((function(t){var a=t.data;Object.assign(e.daftar_users[e.editedIndex],a.user),e.close()})).catch((function(){e.btnLoading=!1})):this.$ajax.post("/system/userskumham/store",{name:this.editedItem.name,email:this.editedItem.email,nomor_hp:this.editedItem.nomor_hp,username:this.editedItem.username,password:this.editedItem.password,role_id:JSON.stringify(Object.assign({},this.editedItem.role_id))},{headers:{Authorization:this.TOKEN}}).then((function(t){var a=t.data;e.daftar_users.push(a.user),e.close()})).catch((function(){e.btnLoading=!1})))},deleteItem:function(e){var t=this;this.$root.$confirm.open("Delete","Apakah Anda ingin menghapus username "+e.username+" ?",{color:"red"}).then((function(a){a&&(t.btnLoading=!0,t.$ajax.post("/system/userskumham/"+e.id,{_method:"DELETE"},{headers:{Authorization:t.TOKEN}}).then((function(){var a=t.daftar_users.indexOf(e);t.daftar_users.splice(a,1),t.btnLoading=!1})).catch((function(){t.btnLoading=!1})))}))}},computed:Object(s["a"])({formTitle:function(){return-1===this.editedIndex?"TAMBAH USER KANWIL HUKUM DAN HAM":"EDIT USER KANWIL HUKUM DAN HAM"}},Object(o["b"])("auth",{ACCESS_TOKEN:"AccessToken",TOKEN:"Token"})),watch:{dialog:function(e){e||this.close()},dialogEdit:function(e){e||this.close()}},components:{AdminLayout:d["a"],ModuleHeader:l["a"]}},c=u,h=a("2877"),m=a("6544"),f=a.n(m),p=a("0798"),v=a("c6a6"),b=a("8212"),g=a("2bc5"),I=a("8336"),_=a("b0af"),x=a("99d9"),S=a("62ad"),y=a("a523"),k=a("8fea"),w=a("169a"),A=a("ce7e"),E=a("4bd4"),M=a("132d"),O=a("adda"),D=a("0fd9"),T=a("2fa4"),$=a("8654"),L=a("71d9"),C=a("2a7f"),V=Object(h["a"])(c,n,i,!1,null,null,null);t["default"]=V.exports;f()(V,{VAlert:p["a"],VAutocomplete:v["a"],VAvatar:b["a"],VBreadcrumbs:g["a"],VBtn:I["a"],VCard:_["a"],VCardActions:x["a"],VCardText:x["c"],VCardTitle:x["d"],VCol:S["a"],VContainer:y["a"],VDataTable:k["a"],VDialog:w["a"],VDivider:A["a"],VForm:E["a"],VIcon:M["a"],VImg:O["a"],VRow:D["a"],VSpacer:T["a"],VTextField:$["a"],VToolbar:L["a"],VToolbarTitle:C["a"]})},c6a6:function(e,t,a){"use strict";a("4de4"),a("7db0"),a("c975"),a("d81d"),a("45fc"),a("498a");var n=a("5530"),i=(a("2bfd"),a("b974")),s=a("8654"),r=a("d9f7"),o=a("80d2"),d=Object(n["a"])({},i["b"],{offsetY:!0,offsetOverflow:!0,transition:!1});t["a"]=i["a"].extend({name:"v-autocomplete",props:{allowOverflow:{type:Boolean,default:!0},autoSelectFirst:{type:Boolean,default:!1},filter:{type:Function,default:function(e,t,a){return a.toLocaleLowerCase().indexOf(t.toLocaleLowerCase())>-1}},hideNoData:Boolean,menuProps:{type:i["a"].options.props.menuProps.type,default:function(){return d}},noFilter:Boolean,searchInput:{type:String,default:void 0}},data:function(){return{lazySearch:this.searchInput}},computed:{classes:function(){return Object(n["a"])({},i["a"].options.computed.classes.call(this),{"v-autocomplete":!0,"v-autocomplete--is-selecting-index":this.selectedIndex>-1})},computedItems:function(){return this.filteredItems},selectedValues:function(){var e=this;return this.selectedItems.map((function(t){return e.getValue(t)}))},hasDisplayedItems:function(){var e=this;return this.hideSelected?this.filteredItems.some((function(t){return!e.hasItem(t)})):this.filteredItems.length>0},currentRange:function(){return null==this.selectedItem?0:String(this.getText(this.selectedItem)).length},filteredItems:function(){var e=this;return!this.isSearching||this.noFilter||null==this.internalSearch?this.allItems:this.allItems.filter((function(t){var a=Object(o["r"])(t,e.itemText),n=null!=a?String(a):"";return e.filter(t,String(e.internalSearch),n)}))},internalSearch:{get:function(){return this.lazySearch},set:function(e){this.lazySearch=e,this.$emit("update:search-input",e)}},isAnyValueAllowed:function(){return!1},isDirty:function(){return this.searchIsDirty||this.selectedItems.length>0},isSearching:function(){return this.multiple&&this.searchIsDirty||this.searchIsDirty&&this.internalSearch!==this.getText(this.selectedItem)},menuCanShow:function(){return!!this.isFocused&&(this.hasDisplayedItems||!this.hideNoData)},$_menuProps:function(){var e=i["a"].options.computed.$_menuProps.call(this);return e.contentClass="v-autocomplete__content ".concat(e.contentClass||"").trim(),Object(n["a"])({},d,{},e)},searchIsDirty:function(){return null!=this.internalSearch&&""!==this.internalSearch},selectedItem:function(){var e=this;return this.multiple?null:this.selectedItems.find((function(t){return e.valueComparator(e.getValue(t),e.getValue(e.internalValue))}))},listData:function(){var e=i["a"].options.computed.listData.call(this);return e.props=Object(n["a"])({},e.props,{items:this.virtualizedItems,noFilter:this.noFilter||!this.isSearching||!this.filteredItems.length,searchInput:this.internalSearch}),e}},watch:{filteredItems:"onFilteredItemsChanged",internalValue:"setSearch",isFocused:function(e){e?(document.addEventListener("copy",this.onCopy),this.$refs.input&&this.$refs.input.select()):(document.removeEventListener("copy",this.onCopy),this.updateSelf())},isMenuActive:function(e){!e&&this.hasSlot&&(this.lazySearch=void 0)},items:function(e,t){t&&t.length||!this.hideNoData||!this.isFocused||this.isMenuActive||!e.length||this.activateMenu()},searchInput:function(e){this.lazySearch=e},internalSearch:"onInternalSearchChanged",itemText:"updateSelf"},created:function(){this.setSearch()},destroyed:function(){document.removeEventListener("copy",this.onCopy)},methods:{onFilteredItemsChanged:function(e,t){var a=this;e!==t&&(this.setMenuIndex(-1),this.$nextTick((function(){a.internalSearch&&(1===e.length||a.autoSelectFirst)&&(a.$refs.menu.getTiles(),a.setMenuIndex(0))})))},onInternalSearchChanged:function(){this.updateMenuDimensions()},updateMenuDimensions:function(){this.isMenuActive&&this.$refs.menu&&this.$refs.menu.updateDimensions()},changeSelectedIndex:function(e){this.searchIsDirty||(this.multiple&&e===o["y"].left?-1===this.selectedIndex?this.selectedIndex=this.selectedItems.length-1:this.selectedIndex--:this.multiple&&e===o["y"].right?this.selectedIndex>=this.selectedItems.length-1?this.selectedIndex=-1:this.selectedIndex++:e!==o["y"].backspace&&e!==o["y"].delete||this.deleteCurrentItem())},deleteCurrentItem:function(){var e=this.selectedIndex,t=this.selectedItems[e];if(this.isInteractive&&!this.getDisabled(t)){var a=this.selectedItems.length-1;if(-1!==this.selectedIndex||0===a){var n=this.selectedItems.length,i=e!==n-1?e:e-1,s=this.selectedItems[i];s?this.selectItem(t):this.setValue(this.multiple?[]:void 0),this.selectedIndex=i}else this.selectedIndex=a}},clearableCallback:function(){this.internalSearch=void 0,i["a"].options.methods.clearableCallback.call(this)},genInput:function(){var e=s["a"].options.methods.genInput.call(this);return e.data=Object(r["a"])(e.data,{attrs:{"aria-activedescendant":Object(o["p"])(this.$refs.menu,"activeTile.id"),autocomplete:Object(o["p"])(e.data,"attrs.autocomplete","off")},domProps:{value:this.internalSearch}}),e},genInputSlot:function(){var e=i["a"].options.methods.genInputSlot.call(this);return e.data.attrs.role="combobox",e},genSelections:function(){return this.hasSlot||this.multiple?i["a"].options.methods.genSelections.call(this):[]},onClick:function(e){this.isInteractive&&(this.selectedIndex>-1?this.selectedIndex=-1:this.onFocus(),this.isAppendInner(e.target)||this.activateMenu())},onInput:function(e){if(!(this.selectedIndex>-1)&&e.target){var t=e.target,a=t.value;t.value&&this.activateMenu(),this.internalSearch=a,this.badInput=t.validity&&t.validity.badInput}},onKeyDown:function(e){var t=e.keyCode;i["a"].options.methods.onKeyDown.call(this,e),this.changeSelectedIndex(t)},onSpaceDown:function(e){},onTabDown:function(e){i["a"].options.methods.onTabDown.call(this,e),this.updateSelf()},onUpDown:function(e){e.preventDefault(),this.activateMenu()},selectItem:function(e){i["a"].options.methods.selectItem.call(this,e),this.setSearch()},setSelectedItems:function(){i["a"].options.methods.setSelectedItems.call(this),this.isFocused||this.setSearch()},setSearch:function(){var e=this;this.$nextTick((function(){e.multiple&&e.internalSearch&&e.isMenuActive||(e.internalSearch=!e.selectedItems.length||e.multiple||e.hasSlot?null:e.getText(e.selectedItem))}))},updateSelf:function(){(this.searchIsDirty||this.internalValue)&&(this.valueComparator(this.internalSearch,this.getValue(this.internalValue))||this.setSearch())},hasItem:function(e){return this.selectedValues.indexOf(this.getValue(e))>-1},onCopy:function(e){if(-1!==this.selectedIndex){var t=this.selectedItems[this.selectedIndex],a=this.getText(t);e.clipboardData.setData("text/plain",a),e.clipboardData.setData("text/vnd.vuetify.autocomplete.item+plain",a),e.preventDefault()}}}})}}]);