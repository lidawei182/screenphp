"use strict";(self["webpackChunkdatafication"]=self["webpackChunkdatafication"]||[]).push([[21],{26776:function(e,t,n){n.d(t,{Z:function(){return c}});var a=function(){var e=this,t=e._self._c;return t("div",{staticStyle:{display:"inline-block"}},[t("label",{staticClass:"radio-label",staticStyle:{color:"#C0C4CC","font-size":"14px"}},[e._v("选择文件类型 : ")]),t("el-select",{staticStyle:{width:"80px"},model:{value:e.bookType,callback:function(t){e.bookType=t},expression:"bookType"}},e._l(e.options,(function(e){return t("el-option",{key:e,attrs:{label:e,value:e}})})),1)],1)},i=[],l={props:{value:{type:String,default:"xlsx"}},data(){return{options:["xlsx","csv","txt"]}},computed:{bookType:{get(){return this.value},set(e){this.$emit("input",e)}}}},o=l,s=n(1001),r=(0,s.Z)(o,a,i,!1,null,null,null),c=r.exports},67556:function(e,t,n){n.d(t,{Z:function(){return c}});var a=function(){var e=this,t=e._self._c;return t("div",{staticStyle:{display:"inline-block"}},[t("label",{staticClass:"radio-label",staticStyle:{"padding-left":"0",color:"#C0C4CC","font-size":"14px"}},[e._v("文件名称 : ")]),t("el-input",{staticStyle:{width:"200px"},attrs:{placeholder:"请输入文件名称","prefix-icon":"el-icon-document"},model:{value:e.filename,callback:function(t){e.filename=t},expression:"filename"}})],1)},i=[],l={props:{value:{type:String,default:""}},computed:{filename:{get(){return this.value},set(e){this.$emit("input",e)}}}},o=l,s=n(1001),r=(0,s.Z)(o,a,i,!1,null,null,null),c=r.exports},19021:function(e,t,n){n.r(t),n.d(t,{default:function(){return f}});var a=function(){var e=this,t=e._self._c;return t("div",{staticClass:"app-container"},[e.showSearch?t("div",{staticClass:"filter-container"},[t("el-form",{staticClass:"form-inline",attrs:{inline:!0,model:e.listQuery}},[t("el-form-item",{attrs:{label:""}},[t("el-input",{attrs:{placeholder:"用户名",clearable:"",size:"small"},model:{value:e.listQuery.oldmanname,callback:function(t){e.$set(e.listQuery,"oldmanname",t)},expression:"listQuery.oldmanname"}})],1),t("el-form-item",[t("el-button",{directives:[{name:"waves",rawName:"v-waves"}],attrs:{type:"primary",icon:"el-icon-search",size:"small"},on:{click:e.handleFilter}},[e._v("搜索")])],1),t("el-form-item",[t("el-button",{directives:[{name:"waves",rawName:"v-waves"}],attrs:{type:"warning",icon:"el-icon-refresh",size:"small"},on:{click:e.handleFilterClear}},[e._v("重置")])],1)],1)],1):e._e(),e.showExport?t("div",{staticClass:"filter-container",staticStyle:{"margin-bottom":"20px"}},[t("FilenameOption",{staticStyle:{"margin-right":"10px"},model:{value:e.filename,callback:function(t){e.filename=t},expression:"filename"}}),t("BookTypeOption",{staticStyle:{"margin-right":"10px"},model:{value:e.bookType,callback:function(t){e.bookType=t},expression:"bookType"}}),t("el-button",{directives:[{name:"waves",rawName:"v-waves"}],attrs:{loading:e.downloadLoading,type:"primary",icon:"el-icon-download"},on:{click:e.handleDownload}},[e._v("下载")])],1):e._e(),t("el-row",{staticStyle:{"margin-bottom":"10px"}},[t("el-col",{attrs:{xs:24,sm:24,lg:24}},[t("el-tooltip",{attrs:{content:"刷新",placement:"top"}},[t("el-button",{directives:[{name:"waves",rawName:"v-waves"}],attrs:{type:"warning",icon:"el-icon-refresh",circle:""},on:{click:e.handleFilterClear}})],1),t("el-tooltip",{attrs:{content:"搜索",placement:"top"}},[t("el-button",{directives:[{name:"waves",rawName:"v-waves"}],attrs:{type:"primary",icon:"el-icon-search",circle:""},on:{click:function(t){e.showSearch=!e.showSearch}}})],1),t("el-tooltip",{attrs:{content:"Export",placement:"top"}},[t("el-button",{directives:[{name:"waves",rawName:"v-waves"}],attrs:{loading:e.downloadLoading,circle:"",type:"primary",icon:"el-icon-download"},on:{click:function(t){e.showExport=!e.showExport}}})],1),t("el-tooltip",{attrs:{content:"首页",placement:"top"}},[t("el-button",{directives:[{name:"waves",rawName:"v-waves"}],attrs:{type:"success",icon:"el-icon-s-home",circle:""},on:{click:e.routerPushPush}})],1)],1)],1),t("el-table",{directives:[{name:"loading",rawName:"v-loading",value:e.listLoading,expression:"listLoading"}],key:e.tableKey,staticClass:"headercellclassname",staticStyle:{width:"100%"},attrs:{data:e.list,stripe:"","row-style":{backgroundColor:"#000e21"},"cell-style":{borderColor:"#000e21"},"header-cell-style":{background:"#011531",borderColor:"#000e21"},border:"",fit:""},on:{"selection-change":e.handleSelectionChange}},[t("el-table-column",{attrs:{align:"center",type:"selection",width:"50"}}),t("el-table-column",{attrs:{label:"名称","min-width":"100px"},scopedSlots:e._u([{key:"default",fn:function(n){return[t("span",[e._v(e._s(n.row.oldmanname))])]}}])}),t("el-table-column",{attrs:{label:"地址","min-width":"150px"},scopedSlots:e._u([{key:"default",fn:function(n){return[t("span",[e._v(e._s(n.row.Address))])]}}])}),t("el-table-column",{attrs:{label:"状态",width:"120px",align:"center"},scopedSlots:e._u([{key:"default",fn:function(n){return[t("span",[e._v(e._s(e._f("statusFilter")(n.row,e.this_)))])]}}])}),t("el-table-column",{attrs:{label:"呼叫时间",width:"160px",align:"center"},scopedSlots:e._u([{key:"default",fn:function(n){return[t("span",[e._v(e._s(e._f("parseTime")(n.row.calltime,"{y}-{m}-{d} {h}:{i}:{s}")))])]}}])}),t("el-table-column",{attrs:{label:"结束时间",width:"160px",align:"center"},scopedSlots:e._u([{key:"default",fn:function(n){return[t("span",[e._v(e._s(e._f("parseTime")(n.row.endtime,"{y}-{m}-{d} {h}:{i}:{s}")))])]}}])})],1),t("div",{staticClass:"pagination-container"},[t("el-pagination",{directives:[{name:"show",rawName:"v-show",value:e.total>0,expression:"total>0"}],attrs:{"current-page":e.listQuery.page,"page-sizes":[10,20,30,50],"page-size":e.listQuery.psize,total:e.total,background:"",layout:"total, sizes, prev, pager, next, jumper"},on:{"size-change":e.handleSizeChange,"current-change":e.handleCurrentChange}})],1)],1)},i=[],l=(n(57658),n(63822)),o=n(60555),s=n(40204),r=n(42325),c=n(67556),d=n(26776),u={name:"logLog",components:{FilenameOption:c.Z,BookTypeOption:d.Z},directives:{waves:s.Z},filters:{statusFilter(e,t){let n=e.taketime,a="挂断";(""==n||null==n&&""==e.endtime||null==e.endtime)&&(a="异常挂断"),(""==n||null==n&&e.endtime)&&(a="已处理"),n&&"挂断"==e.status&&(a="已处理");for(let i=0;t.list.length>i;i++)t.list[i].No==e.No&&(t.list[i].statusNo=a);return a}},computed:{...(0,l.Se)(["jdno"])},data(){return{exportList:[],this_:this,filename:"",bookType:"xlsx",downloadLoading:!1,showExport:!1,tableKey:0,list:null,total:null,listLoading:!0,showSearch:!1,listQuery:{jdno:"",id:"",oldmanname:"",page:1},dateTime:"",pickerOptions:r.Pk}},watch:{dateTime:function(e){this.listQuery.calltime=e[0],this.listQuery.endtime=e[1]}},created(){this.fetchList()},methods:{handleSelectionChange(e){e.length>0?(this.exportList=[],this.exportList=e):(this.exportList=[],this.exportList=this.list)},routerPushPush(){this.$router.push({path:"/dashboard"})},fetchList(){this.listLoading=!0,this.listQuery.jdno=this.jdno,(0,o.w1)(this.listQuery).then((e=>{this.list=e.data.data,this.exportList=this.list,this.total=e.data.total,this.listLoading=!1}))},handleFilter(){this.listQuery.page=1,this.fetchList()},handleFilterClear(){this.listQuery={page:1,psize:10,id:"",oldmanname:"",calltime:"",endtime:""},this.dateTime="",this.fetchList()},handleSizeChange(e){this.listQuery.psize=e,this.fetchList()},handleCurrentChange(e){this.listQuery.page=e,this.fetchList()},handleDownload(){this.downloadLoading=!0,n.e(490).then(n.bind(n,45788)).then((e=>{const t=["名称","地址","状态","呼叫时间","结束时间"],n=["oldmanname","Address","statusNo","calltime","endtime"],a=this.formatJson(n,this.exportList);e.export_json_to_excel({header:t,data:a,filename:this.filename,bookType:this.bookType}),this.downloadLoading=!1}))},formatJson(e,t){return t.map((t=>e.map((e=>"timestamp"===e?(0,r.TD)(t[e]):t[e]))))}}},p=u,m=n(1001),h=(0,m.Z)(p,a,i,!1,null,"6599e5e4",null),f=h.exports},60555:function(e,t,n){n.d(t,{AM:function(){return o},Fj:function(){return l},s0:function(){return r},vh:function(){return i},w1:function(){return s}});var a=n(84471);function i(e){return(0,a.Z)({url:"/admin/Index/dataIntegration",method:"get",params:{data:e}})}function l(e){return(0,a.Z)({url:"/admin/Index/mapIntegration",method:"post",data:{jdno:e}})}function o(e){return(0,a.Z)({url:"/admin/Index/dateCallsList",method:"post",data:e})}function s(e){return(0,a.Z)({url:"/admin/Index/historyCallsList",method:"post",data:e})}function r(e){return(0,a.Z)({url:"/admin/Index/getPeopleList",method:"post",data:e})}},40204:function(e,t,n){n.d(t,{Z:function(){return s}});const a="@@wavesContext";function i(e,t){function n(n){const a=Object.assign({},t.value),i=Object.assign({ele:e,type:"hit",color:"rgba(0, 0, 0, 0.15)"},a),l=i.ele;if(l){l.style.position="relative",l.style.overflow="hidden";const e=l.getBoundingClientRect();let t=l.querySelector(".waves-ripple");switch(t?t.className="waves-ripple":(t=document.createElement("span"),t.className="waves-ripple",t.style.height=t.style.width=Math.max(e.width,e.height)+"px",l.appendChild(t)),i.type){case"center":t.style.top=e.height/2-t.offsetHeight/2+"px",t.style.left=e.width/2-t.offsetWidth/2+"px";break;default:t.style.top=(n.pageY-e.top-t.offsetHeight/2-document.documentElement.scrollTop||document.body.scrollTop)+"px",t.style.left=(n.pageX-e.left-t.offsetWidth/2-document.documentElement.scrollLeft||document.body.scrollLeft)+"px"}return t.style.backgroundColor=i.color,t.className="waves-ripple z-active",!1}}return e[a]?e[a].removeHandle=n:e[a]={removeHandle:n},n}var l={bind(e,t){e.addEventListener("click",i(e,t),!1)},update(e,t){e.removeEventListener("click",e[a].removeHandle,!1),e.addEventListener("click",i(e,t),!1)},unbind(e){e.removeEventListener("click",e[a].removeHandle,!1),e[a]=null,delete e[a]}};const o=function(e){e.directive("waves",l)};window.Vue&&(window.waves=l,Vue.use(o)),l.install=o;var s=l}}]);