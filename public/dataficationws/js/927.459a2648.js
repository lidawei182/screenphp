"use strict";(self["webpackChunkdatafication"]=self["webpackChunkdatafication"]||[]).push([[927],{34927:function(i,e,n){n.r(e),n.d(e,{default:function(){return p}});var r=function(){var i=this,e=i._self._c;return e("div",[e("el-form",{ref:"bindingForm",attrs:{model:i.bindingForm,"status-icon":"",rules:i.bindingrules,"label-width":"100px"}},[e("el-form-item",{attrs:{label:"账号名称",prop:"userName"}},[e("el-input",{model:{value:i.bindingForm.userName,callback:function(e){i.$set(i.bindingForm,"userName",e)},expression:"bindingForm.userName"}})],1),e("el-form-item",{attrs:{label:"头像",prop:"img"}},[e("Upload",{attrs:{config:i.config},on:{input:function(e){return i.bindingFormImg(e)},dataurl:i.dataurl},model:{value:i.bindingForm.img,callback:function(e){i.$set(i.bindingForm,"img",e)},expression:"bindingForm.img"}})],1),e("el-form-item",{attrs:{label:"密码",prop:"password"}},[e("el-input",{attrs:{type:"password",autocomplete:"off"},model:{value:i.bindingForm.password,callback:function(e){i.$set(i.bindingForm,"password",e)},expression:"bindingForm.password"}})],1),e("el-form-item",{attrs:{label:"确认密码",prop:"checkPass"}},[e("el-input",{attrs:{type:"password",autocomplete:"off"},model:{value:i.bindingForm.checkPass,callback:function(e){i.$set(i.bindingForm,"checkPass",e)},expression:"bindingForm.checkPass"}})],1),e("el-form-item",{attrs:{label:"序列码",prop:"UnitNo"}},[e("el-input",{model:{value:i.bindingForm.UnitNo,callback:function(e){i.$set(i.bindingForm,"UnitNo",e)},expression:"bindingForm.UnitNo"}})],1),e("el-form-item",[e("el-button",{attrs:{type:"primary"},on:{click:function(e){return i.submitForm("bindingForm")}}},[i._v("提交")]),e("el-button",{on:{click:function(e){return i.resetForm("bindingForm")}}},[i._v("重置")])],1)],1)],1)},t=[],s=n(63613),o=n(42325),a=n(61073),m=n(63822),l=n(12223),d=n(23518),g={name:"bindingForm",props:{delfileName:{type:String,default:"0"}},components:{Upload:s.Z},watch:{delfileName:{handler:function(i){"1"==i&&(this.bindingForm.img=[])},immediate:!0,deep:!0}},data(){var i=(i,e,n)=>{""===e?n(new Error("请输入序列码")):n()},e=(i,e,n)=>{""===e?n(new Error("请输入账号名称")):n()},n=(i,e,n)=>{""===e?n(new Error("请输入密码")):(""!==this.bindingForm.checkPass&&this.$refs.bindingForm.validateField("checkPass"),n())},r=(i,e,n)=>{""===e?n(new Error("请再次输入密码")):e!==this.bindingForm.password?n(new Error("两次输入密码不一致!")):n()};return{config:{fileName:"img",limit:1,multiple:!0,accept:"image/*",action:a.Z.uploadUrl.img},bindingForm:{id:0,userName:"",realName:"核心",password:"",isEnabled:1,phone:"",email:"",regTime:(0,o.Ei)(),img:[],checkPass:"",UnitNo:""},bindingrules:{userName:[{validator:e,trigger:"blur"}],password:[{validator:n,trigger:"blur"}],checkPass:[{validator:r,trigger:"blur"}],UnitNo:[{validator:i,trigger:"blur"}]}}},computed:{...(0,m.Se)([])},methods:{bindingFormImg(i){this.bindingForm.img=i},dataurl(i){this.$emit("bindingDataurl",i)},submitForm(i){let e=this;this.$refs[i].validate((i=>{if(!i)return!1;{this.$emit("bindingSubmit","");let i={UnitNo:e.bindingForm.UnitNo,checkPass:e.bindingForm.checkPass,email:e.bindingForm.email,id:e.bindingForm.id,img:"",isEnabled:e.bindingForm.isEnabled,password:e.bindingForm.password,phone:e.bindingForm.phone,realName:e.bindingForm.realName,regTime:e.bindingForm.regTime,userName:e.bindingForm.userName};e.bindingForm.img.length>0?i.img=e.bindingForm.img[0]:i.img="",(0,l.qF)(i).then((i=>{1===i.status?(d.log(i),e.$message.success(i.msg)):e.$alert(i.msg,"注意！",{confirmButtonText:"确定",callback:i=>{this.$message({type:"info",message:`action: ${i}`})}})})).catch((i=>{if(d.log(i),this.bindingForm.img.length>0){let i={img:this.bindingForm.img[0]};(0,l.WB)(i).then((i=>{i.data.unlink&&(e.bindingForm.img=[])}))}}))}}))},resetForm(i){if(this.bindingForm.img.length>0){let e={img:this.bindingForm.img[0]},n=this;(0,l.WB)(e).then((e=>{e.data.unlink?(n.$message({message:e.msg,type:"success"}),this.$emit("bindingDataurl",""),this.$refs[i].resetFields()):(n.$message({message:e.msg,type:"warning"}),this.$refs[i].resetFields())}))}else this.$refs[i].resetFields()}}},b=g,c=n(1001),u=(0,c.Z)(b,r,t,!1,null,"007886bc",null),p=u.exports}}]);