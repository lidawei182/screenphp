"use strict";(self["webpackChunkdatafication"]=self["webpackChunkdatafication"]||[]).push([[496],{71496:function(e,t,a){a.r(t),a.d(t,{default:function(){return f}});var l=function(){var e=this,t=e._self._c;return t("div",{staticClass:"app-container"},[t("el-form",{ref:"dataForm",staticStyle:{width:"100%"},attrs:{model:e.temp,"label-position":"left","label-width":"70px"}},[t("el-form-item",{attrs:{label:"角色",prop:"groupId"}},[t("el-input",{attrs:{disabled:!0},model:{value:e.group,callback:function(t){e.group=t},expression:"group"}})],1),t("el-form-item",{attrs:{label:"账号",prop:"userName"}},[t("el-input",{attrs:{disabled:!0},model:{value:e.name,callback:function(t){e.name=t},expression:"name"}})],1),t("el-form-item",{attrs:{label:"密码",prop:"password"}},[t("el-input",{attrs:{clearable:"",placeholder:"不修改，则留空"},model:{value:e.temp.password,callback:function(t){e.$set(e.temp,"password",t)},expression:"temp.password"}})],1),t("el-form-item",{attrs:{label:"头像",prop:"img"}},[t("Upload",{attrs:{config:e.config},model:{value:e.temp.img,callback:function(t){e.$set(e.temp,"img",t)},expression:"temp.img"}})],1),t("el-form-item",{attrs:{label:"姓名",prop:"realName"}},[t("el-input",{attrs:{clearable:""},model:{value:e.temp.realName,callback:function(t){e.$set(e.temp,"realName",t)},expression:"temp.realName"}})],1),t("el-form-item",{attrs:{label:"手机",prop:"phone"}},[t("el-input",{attrs:{clearable:""},model:{value:e.temp.phone,callback:function(t){e.$set(e.temp,"phone",t)},expression:"temp.phone"}})],1),t("el-form-item",{attrs:{label:"邮箱",prop:"email"}},[t("el-input",{attrs:{clearable:""},model:{value:e.temp.email,callback:function(t){e.$set(e.temp,"email",t)},expression:"temp.email"}})],1)],1),t("el-button",{attrs:{loading:e.btnLoading,type:"primary"},on:{click:function(t){return e.saveData()}}},[e._v("保存")])],1)},m=[],i=a(63613),o=a(29958),r=a(63822),s=a(67682),n=a(61073),p={name:"MyInfo",components:{Upload:i.Z},data(){return{btnLoading:!1,temp:{password:"",realName:s.Z.getters.realName,phone:s.Z.getters.phone,email:s.Z.getters.email,img:[s.Z.getters.avatar]},config:{fileName:"img",limit:1,multiple:!0,accept:"image/*",action:n.Z.uploadUrl.img}}},computed:{...(0,r.Se)(["name","group"])},watch:{temp:{handler(e,t){},immediate:!0,deep:!0}},created(){},destroyed(){},methods:{saveData(){this.btnLoading=!0,this.$refs["dataForm"].validate((e=>{if(e){const e=this,t=this.temp;"object"===typeof t.img&&(t.img=t.img.join(",")),(0,o.Pj)(t).then((t=>{1===t.status?(s.Z.commit("SET_AVATAR",e.temp.img),s.Z.commit("SET_REALNAME",e.temp.realName),s.Z.commit("SET_PHONE",e.temp.phone),s.Z.commit("SET_EMAIL",e.temp.email),e.$message.success(t.msg)):e.$message.error(t.msg),e.btnLoading=!1})).catch((e=>{this.btnLoading=!1}))}else this.btnLoading=!1}))}}},c=p,d=a(1001),u=(0,d.Z)(c,l,m,!1,null,null,null),f=u.exports}}]);