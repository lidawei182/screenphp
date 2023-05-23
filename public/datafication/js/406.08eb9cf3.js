"use strict";(self["webpackChunkdatafication"]=self["webpackChunkdatafication"]||[]).push([[406],{13406:function(t,e,a){a.r(e),a.d(e,{default:function(){return p}});var i=function(){var t=this,e=t._self._c;return e("el-dialog",{attrs:{title:t.textMap[t.dialogStatus],visible:t.dialogFormVisible},on:{"update:visible":function(e){t.dialogFormVisible=e}}},[e("el-form",{ref:"dataForm",staticStyle:{width:"100%",height:"50vh","overflow-y":"scroll"},attrs:{rules:t.rules,model:t.temp,"label-position":"left","label-width":"70px"}},[e("el-form-item",{attrs:{label:"上级",prop:"pid"}},[e("el-cascader",{attrs:{options:t.getRulesList,props:t.props_pid,placeholder:"请选择","change-on-select":""},on:{change:t.handleChange},model:{value:t.pid,callback:function(e){t.pid=e},expression:"pid"}})],1),e("el-form-item",{attrs:{label:"名称",prop:"title"}},[e("el-input",{attrs:{clearable:""},model:{value:t.temp.title,callback:function(e){t.$set(t.temp,"title",e)},expression:"temp.title"}})],1),e("el-form-item",{attrs:{label:"标识",prop:"name"}},[e("el-input",{attrs:{clearable:""},model:{value:t.temp.name,callback:function(e){t.$set(t.temp,"name",e)},expression:"temp.name"}})],1),e("el-form-item",{attrs:{label:"图标",prop:"icon"}},[e("el-input",{attrs:{clearable:""},model:{value:t.temp.icon,callback:function(e){t.$set(t.temp,"icon",e)},expression:"temp.icon"}})],1),e("el-form-item",{attrs:{label:"路径",prop:"path"}},[e("el-input",{attrs:{clearable:""},model:{value:t.temp.path,callback:function(e){t.$set(t.temp,"path",e)},expression:"temp.path"}})],1),e("el-form-item",{attrs:{label:"组件",prop:"component"}},[e("el-input",{attrs:{clearable:""},model:{value:t.temp.component,callback:function(e){t.$set(t.temp,"component",e)},expression:"temp.component"}})],1),e("el-form-item",{attrs:{label:"跳转",prop:"redirect"}},[e("el-input",{attrs:{clearable:""},model:{value:t.temp.redirect,callback:function(e){t.$set(t.temp,"redirect",e)},expression:"temp.redirect"}})],1),e("el-form-item",{attrs:{label:"状态"}},[e("el-radio-group",{model:{value:t.temp.status,callback:function(e){t.$set(t.temp,"status",e)},expression:"temp.status"}},[e("el-radio",{attrs:{label:1}},[t._v("正常")]),e("el-radio",{attrs:{label:0}},[t._v("禁用")])],1)],1),e("el-form-item",{attrs:{label:"隐藏"}},[e("el-radio-group",{model:{value:t.temp.hidden,callback:function(e){t.$set(t.temp,"hidden",e)},expression:"temp.hidden"}},[e("el-radio",{attrs:{label:1}},[t._v("是")]),e("el-radio",{attrs:{label:0}},[t._v("否")])],1)],1),e("el-form-item",{attrs:{label:"缓存"}},[e("el-radio-group",{model:{value:t.temp.noCache,callback:function(e){t.$set(t.temp,"noCache",e)},expression:"temp.noCache"}},[e("el-radio",{attrs:{label:0}},[t._v("是")]),e("el-radio",{attrs:{label:1}},[t._v("否")])],1)],1),e("el-form-item",{attrs:{label:"展示"}},[e("el-radio-group",{model:{value:t.temp.alwaysShow,callback:function(e){t.$set(t.temp,"alwaysShow",e)},expression:"temp.alwaysShow"}},[e("el-radio",{attrs:{label:1}},[t._v("是")]),e("el-radio",{attrs:{label:0}},[t._v("否")])],1)],1)],1),e("div",{staticClass:"dialog-footer",attrs:{slot:"footer"},slot:"footer"},[e("el-button",{on:{click:function(e){t.dialogFormVisible=!1}}},[t._v("取消")]),e("el-button",{attrs:{loading:t.btnLoading,type:"primary"},on:{click:function(e){return t.saveData()}}},[t._v("保存")])],1)],1)},l=[],r=a(94053),n=a(57801),o={name:"RulesForm",components:{},props:{ruleList:{type:Array,default:[]}},data(){return{btnLoading:!1,ruleTop:[{id:0,title:"顶级"}],pid:[],props_pid:{label:"title",value:"id"},temp:{id:0,pid:0,title:"",name:"",status:1,icon:"",path:"",component:"layout/Layout",hidden:0,noCache:1,alwaysShow:1,redirect:"noredirect"},dialogFormVisible:!1,dialogStatus:"",textMap:{update:"编辑",create:"添加"},rules:{title:[{required:!0,message:"名称必填",trigger:"blur"}],name:[{required:!0,message:"标识必填",trigger:"blur"}],icon:[{required:!0,message:"图标必填",trigger:"blur"}],path:[{required:!0,message:"路径必填",trigger:"blur"}],component:[{required:!0,message:"组件必填",trigger:"blur"}]}}},computed:{getRulesList(){return this.ruleTop.concat(n.Z.listToTreeMulti(this.ruleList))}},watch:{dialogFormVisible:function(){this.resetTemp()},temp:{handler(t,e){},immediate:!0,deep:!0}},created(){},destroyed(){},methods:{resetTemp(){this.temp={id:0,pid:0,title:"",name:"",status:1,icon:"",path:"",component:"layout/Layout",hidden:0,noCache:1,alwaysShow:1,redirect:"noredirect"}},handleCreate(){this.dialogStatus="create",this.dialogFormVisible=!0,this.currentIndex=-1,this.pid=[],this.$nextTick((()=>{this.$refs["dataForm"].clearValidate()}))},handleUpdate(t){this.dialogStatus="update",this.dialogFormVisible=!0;const e=this;(0,r.Y1)(t).then((a=>{1===a.status&&(e.temp.id=a.data.id,e.temp.pid=a.data.pid,e.temp.title=a.data.title,e.temp.name=a.data.name,e.temp.status=a.data.status,e.temp.icon=a.data.icon,e.temp.path=a.data.path,e.temp.component=a.data.component,e.temp.hidden=a.data.hidden,e.temp.noCache=a.data.noCache,e.temp.alwaysShow=a.data.alwaysShow,e.temp.redirect=a.data.redirect,e.pid=n.Z.getParentsId(this.ruleList,t))})),this.$nextTick((()=>{this.$refs["dataForm"].clearValidate()}))},saveData(){this.btnLoading=!0,this.$refs["dataForm"].validate((t=>{if(t){const t=this,e=this.temp;(0,r.a1)(e).then((a=>{1===a.status?(e.id||(e.id2=a.data.id),this.$emit("updateRow",e),t.dialogFormVisible=!1,t.$message.success(a.msg)):t.$message.error(a.msg),t.btnLoading=!1})).catch((t=>{this.btnLoading=!1}))}else this.btnLoading=!1}))},handleChange(t){t.length&&(this.temp.pid=t[t.length-1])}}},s=o,d=a(1001),u=(0,d.Z)(s,i,l,!1,null,null,null),p=u.exports},94053:function(t,e,a){a.d(e,{IV:function(){return s},Im:function(){return r},Y1:function(){return n},a1:function(){return o},gp:function(){return l},hc:function(){return p},m:function(){return d},yu:function(){return u}});var i=a(84471);function l(t){return(0,i.Z)({url:"/admin/rules/index",method:"post",data:t})}function r(){return(0,i.Z)({url:"/admin/rules/getLists",method:"post"})}function n(t){return(0,i.Z)({url:"/admin/rules/getinfo",method:"get",params:{id:t}})}function o(t){return(0,i.Z)({url:"/admin/rules/save",method:"post",data:t})}function s(t){return(0,i.Z)({url:"/admin/rules/del",method:"get",params:{id:t}})}function d(t,e,a){const l={val:t,field:e,value:a};return(0,i.Z)({url:"/admin/rules/change",method:"post",data:l})}function u(t){return(0,i.Z)({url:"/admin/rules/delall",method:"post",data:t})}function p(t){return(0,i.Z)({url:"/admin/rules/changeall",method:"post",data:t})}},57801:function(t,e,a){a(57658),a(30541);var i=a(42325);function l(t,e=0,a="id",r="pid",n="children",o=null){const s=[];return t&&t.forEach((d=>{if(d[r]===e){null!==o&&(d=(0,i.hq)(d,o));const e=l(t,d[a],a,r,n,o);e.length&&(d[n]=e),s.push(d)}})),s}function r(t,e,a="id",i="pid"){let l=[];return t&&t.forEach((n=>{if(n[a]===e){l.unshift(n[i]);const e=r(t,n[i],a,i);e.length&&(l=l.concat(e))}})),l}function n(t,e,a,l){return t&&t.map((t=>{t[e]===a?(0,i.hq)(t,l):n(t.children,e,a,l)})),t}const o={listToTreeMulti:l,getParentsId:r,upadteArr:n};e["Z"]=o}}]);