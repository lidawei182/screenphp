(self["webpackChunkdatafication"]=self["webpackChunkdatafication"]||[]).push([[128],{76551:function(e,i,t){"use strict";t.r(i),t.d(i,{default:function(){return c}});var s=function(){var e=this,i=e._self._c;return i("div",{ref:"drag",staticClass:"binding-right",class:{"binding-hidden":!e.show},style:{width:e.wb+"%",height:e.hb+"px"}},[i("el-card",{attrs:{shadow:"always","body-style":"{padding:'10px'}"}},[i("div",{staticClass:"binding-header binding-clearfix"},[i("span",{domProps:{textContent:e._s(e.title)},on:{mousedown:e.move}}),i("el-button",{staticStyle:{float:"right",padding:"3px 0"},attrs:{type:"text"},on:{click:e.setBindingBar}},[e._v("关闭")])],1)]),e._t("default")],2)},n=[],r=t(63822),o={name:"BindingIndex",props:{show:{type:Boolean,default:!0},title:{type:String,default:""},wb:{type:Number,default:310},hb:{type:Number,default:155}},data(){return{bindingShow:!0}},computed:{...(0,r.Se)([])},methods:{setBindingBar(){this.$emit("showBindingBar",!1)},move(e){let i=this.$refs.drag;i.style.cursor="pointer",i.style.borderStyle="solid",i.style.borderColor="red",i.style.borderWidth="3px";let t=parseInt(i.offsetLeft),s=parseInt(i.offsetTop),n=e.clientX-t,r=e.clientY-s;document.onmousemove=function(e){i.style.left=e.clientX-n+"px",i.style.top=e.clientY-r+"px",parseInt(i.style.left)<=0&&(i.style.left="0px"),parseInt(i.style.left)>=window.innerWidth-parseInt(i.style.width)&&(i.style.left=window.innerWidth-parseInt(i.style.width)+"px")},document.onmouseup=function(){document.onmousemove=null,document.onmouseup=null,i.style.borderStyle="",i.style.borderColor="",i.style.borderWidth=""}}}},a=o,l=t(1001),d=(0,l.Z)(a,s,n,!1,null,"f7354628",null),c=d.exports},34927:function(e,i,t){"use strict";t.r(i),t.d(i,{default:function(){return p}});var s=function(){var e=this,i=e._self._c;return i("div",[i("el-form",{ref:"bindingForm",attrs:{model:e.bindingForm,"status-icon":"",rules:e.bindingrules,"label-width":"100px"}},[i("el-form-item",{attrs:{label:"账号名称",prop:"userName"}},[i("el-input",{model:{value:e.bindingForm.userName,callback:function(i){e.$set(e.bindingForm,"userName",i)},expression:"bindingForm.userName"}})],1),i("el-form-item",{attrs:{label:"头像",prop:"img"}},[i("Upload",{attrs:{config:e.config},on:{input:function(i){return e.bindingFormImg(i)},dataurl:e.dataurl},model:{value:e.bindingForm.img,callback:function(i){e.$set(e.bindingForm,"img",i)},expression:"bindingForm.img"}})],1),i("el-form-item",{attrs:{label:"密码",prop:"password"}},[i("el-input",{attrs:{type:"password",autocomplete:"off"},model:{value:e.bindingForm.password,callback:function(i){e.$set(e.bindingForm,"password",i)},expression:"bindingForm.password"}})],1),i("el-form-item",{attrs:{label:"确认密码",prop:"checkPass"}},[i("el-input",{attrs:{type:"password",autocomplete:"off"},model:{value:e.bindingForm.checkPass,callback:function(i){e.$set(e.bindingForm,"checkPass",i)},expression:"bindingForm.checkPass"}})],1),i("el-form-item",{attrs:{label:"序列码",prop:"UnitNo"}},[i("el-input",{model:{value:e.bindingForm.UnitNo,callback:function(i){e.$set(e.bindingForm,"UnitNo",i)},expression:"bindingForm.UnitNo"}})],1),i("el-form-item",[i("el-button",{attrs:{type:"primary"},on:{click:function(i){return e.submitForm("bindingForm")}}},[e._v("提交")]),i("el-button",{on:{click:function(i){return e.resetForm("bindingForm")}}},[e._v("重置")])],1)],1)],1)},n=[],r=t(63613),o=t(42325),a=t(61073),l=t(63822),d=t(12223),c=t(23518),g={name:"bindingForm",props:{delfileName:{type:String,default:"0"}},components:{Upload:r.Z},watch:{delfileName:{handler:function(e){"1"==e&&(this.bindingForm.img=[])},immediate:!0,deep:!0}},data(){var e=(e,i,t)=>{""===i?t(new Error("请输入序列码")):t()},i=(e,i,t)=>{""===i?t(new Error("请输入账号名称")):t()},t=(e,i,t)=>{""===i?t(new Error("请输入密码")):(""!==this.bindingForm.checkPass&&this.$refs.bindingForm.validateField("checkPass"),t())},s=(e,i,t)=>{""===i?t(new Error("请再次输入密码")):i!==this.bindingForm.password?t(new Error("两次输入密码不一致!")):t()};return{config:{fileName:"img",limit:1,multiple:!0,accept:"image/*",action:a.Z.uploadUrl.img},bindingForm:{id:0,userName:"",realName:"核心",password:"",isEnabled:1,phone:"",email:"",regTime:(0,o.Ei)(),img:[],checkPass:"",UnitNo:""},bindingrules:{userName:[{validator:i,trigger:"blur"}],password:[{validator:t,trigger:"blur"}],checkPass:[{validator:s,trigger:"blur"}],UnitNo:[{validator:e,trigger:"blur"}]}}},computed:{...(0,l.Se)([])},methods:{bindingFormImg(e){this.bindingForm.img=e},dataurl(e){this.$emit("bindingDataurl",e)},submitForm(e){let i=this;this.$refs[e].validate((e=>{if(!e)return!1;{this.$emit("bindingSubmit","");let e={UnitNo:i.bindingForm.UnitNo,checkPass:i.bindingForm.checkPass,email:i.bindingForm.email,id:i.bindingForm.id,img:"",isEnabled:i.bindingForm.isEnabled,password:i.bindingForm.password,phone:i.bindingForm.phone,realName:i.bindingForm.realName,regTime:i.bindingForm.regTime,userName:i.bindingForm.userName};i.bindingForm.img.length>0?e.img=i.bindingForm.img[0]:e.img="",(0,d.qF)(e).then((e=>{1===e.status?(c.log(e),i.$message.success(e.msg)):i.$alert(e.msg,"注意！",{confirmButtonText:"确定",callback:e=>{this.$message({type:"info",message:`action: ${e}`})}})})).catch((e=>{if(c.log(e),this.bindingForm.img.length>0){let e={img:this.bindingForm.img[0]};(0,d.WB)(e).then((e=>{e.data.unlink&&(i.bindingForm.img=[])}))}}))}}))},resetForm(e){if(this.bindingForm.img.length>0){let i={img:this.bindingForm.img[0]},t=this;(0,d.WB)(i).then((i=>{i.data.unlink?(t.$message({message:i.msg,type:"success"}),this.$emit("bindingDataurl",""),this.$refs[e].resetFields()):(t.$message({message:i.msg,type:"warning"}),this.$refs[e].resetFields())}))}else this.$refs[e].resetFields()}}},m=g,h=t(1001),u=(0,h.Z)(m,s,n,!1,null,"007886bc",null),p=u.exports},79066:function(e,i,t){"use strict";t.r(i),t.d(i,{default:function(){return m}});var s=function(){var e=this,i=e._self._c;return i("div",{staticClass:"slide-verify-container"},[i("div",{staticClass:"slide-verify-block-box"}),i("div",{staticClass:"slide-verify",style:{width:e.w},attrs:{id:"slideVerify",onselectstart:"return false;"}},[i("img",{staticClass:"photos-img",attrs:{src:e.photos}}),i("canvas",{ref:"canvas",attrs:{width:e.w,height:e.h}}),i("div",{staticClass:"slide-verify-refresh-icon",on:{click:e.refresh}}),i("canvas",{ref:"block",staticClass:"slide-verify-block",attrs:{width:e.w,height:e.h}}),i("div",{staticClass:"slide-verify-slider",class:{"container-active":e.containerActive,"container-success":e.containerSuccess,"container-fail":e.containerFail},style:{width:e.w}},[i("div",{staticClass:"slide-verify-slider-mask",style:{width:e.sliderMaskWidth}},[i("div",{staticClass:"slide-verify-slider-mask-item",style:{left:e.sliderLeft},on:{mousedown:e.sliderDown,touchstart:e.touchStartEvent,touchmove:e.touchMoveEvent,touchend:e.touchEndEvent}},[i("div",{staticClass:"slide-verify-slider-mask-item-icon"})])]),i("span",{staticClass:"slide-verify-slider-text"},[e._v(e._s(e.sliderText))])])])])},n=[];t(57658);const r=Math.PI;function o(e,i){return e+i}function a(e){return e*e}var l={name:"SlideVerify",props:{l:{type:Number,default:42},r:{type:Number,default:10},w:{type:Number,default:310},h:{type:Number,default:155},sliderText:{type:String,default:"Slide filled right"}},data(){return{photos:t(83509),containerActive:!1,containerSuccess:!1,containerFail:!1,canvasCtx:null,blockCtx:null,block:null,block_x:void 0,block_y:void 0,L:this.l+2*this.r+3,img:void 0,originX:void 0,originY:void 0,isMouseDown:!1,trail:[],sliderLeft:0,sliderMaskWidth:0}},mounted(){this.init()},methods:{init(){this.initDom(),this.initImg(),this.bindEvents()},initDom(){this.block=this.$refs.block,this.canvasCtx=this.$refs.canvas.getContext("2d"),this.blockCtx=this.block.getContext("2d")},initImg(){const e=this.createImg((()=>{this.drawBlock(),this.canvasCtx.drawImage(e,0,0,this.w,this.h),this.blockCtx.drawImage(e,0,0,this.w,this.h);let{block_x:i,block_y:t,r:s,L:n}=this,r=t-2*s-1,o=this.blockCtx.getImageData(i,r,n,n);this.block.width=n,this.blockCtx.putImageData(o,0,r)}));this.img=e},drawBlock(){this.block_x=this.getRandomNumberByRange(this.L+10,this.w-(this.L+10)),this.block_y=this.getRandomNumberByRange(10+2*this.r,this.h-(this.L+10)),this.draw(this.canvasCtx,this.block_x,this.block_y,"fill"),this.draw(this.blockCtx,this.block_x,this.block_y,"clip")},draw(e,i,t,s){let{l:n,r:o}=this;e.beginPath(),e.moveTo(i,t),e.arc(i+n/2,t-o+2,o,.72*r,2.26*r),e.lineTo(i+n,t),e.arc(i+n+o-2,t+n/2,o,1.21*r,2.78*r),e.lineTo(i+n,t+n),e.lineTo(i,t+n),e.arc(i+o-2,t+n/2,o+.4,2.76*r,1.24*r,!0),e.lineTo(i,t),e.lineWidth=2,e.fillStyle="rgba(255, 255, 255, 0.7)",e.strokeStyle="rgba(255, 255, 255, 0.7)",e.stroke(),e[s](),e.globalCompositeOperation="overlay"},createImg(e){const i=document.createElement("img");return i.crossOrigin="Anonymous",i.onload=e,i.onerror=()=>{i.src=this.getRandomImgError()},i.src=this.getRandomImg(),i},getRandomImg(){return t(66721)("./img"+this.getRandomNumberByRange(0,3)+".jpg")},getRandomImgError(){return t(59122)},getRandomNumberByRange(e,i){return Math.round(Math.random()*(i-e)+e)},refresh(){this.reset(),this.$emit("refresh")},sliderDown(e){this.originX=e.clientX,this.originY=e.clientY,this.isMouseDown=!0},touchStartEvent(e){this.originX=e.changedTouches[0].pageX,this.originY=e.changedTouches[0].pageY,this.isMouseDown=!0},bindEvents(){document.addEventListener("mousemove",(e=>{if(!this.isMouseDown)return!1;const i=e.clientX-this.originX,t=e.clientY-this.originY;if(i<0||i+38>=this.w)return!1;this.sliderLeft=i+"px";let s=(this.w-40-20)/(this.w-40)*i;this.block.style.left=s+"px",this.containerActive=!0,this.sliderMaskWidth=i+"px",this.trail.push(t)})),document.addEventListener("mouseup",(e=>{if(!this.isMouseDown)return!1;if(this.isMouseDown=!1,e.clientX===this.originX)return!1;this.containerActive=!1;const{spliced:i,TuringTest:t}=this.verify();i?t?(this.containerSuccess=!0,this.$emit("success")):(this.containerFail=!0,this.reset()):(this.containerFail=!0,this.$emit("fail"),setTimeout((()=>{this.reset()}),1e3))}))},touchMoveEvent(e){if(!this.isMouseDown)return!1;const i=e.changedTouches[0].pageX-this.originX,t=e.changedTouches[0].pageY-this.originY;if(i<0||i+38>=this.w)return!1;this.sliderLeft=i+"px";let s=(this.w-40-20)/(this.w-40)*i;this.block.style.left=s+"px",this.containerActive=!0,this.sliderMaskWidth=i+"px",this.trail.push(t)},touchEndEvent(e){if(!this.isMouseDown)return!1;if(this.isMouseDown=!1,e.changedTouches[0].pageX===this.originX)return!1;this.containerActive=!1;const{spliced:i,TuringTest:t}=this.verify();i?t?(this.containerSuccess=!0,this.$emit("success")):(this.containerFail=!0,this.reset()):(this.containerFail=!0,this.$emit("fail"),setTimeout((()=>{this.reset()}),1e3))},verify(){const e=this.trail,i=e.reduce(o)/e.length,t=e.map((e=>e-i)),s=Math.sqrt(t.map(a).reduce(o)/e.length),n=parseInt(this.block.style.left);return{spliced:Math.abs(n-this.block_x)<10,TuringTest:i!==s}},reset(){this.containerActive=!1,this.containerSuccess=!1,this.containerFail=!1,this.sliderLeft=0,this.block.style.left=0,this.sliderMaskWidth=0;let{w:e,h:i}=this;this.canvasCtx.clearRect(0,0,e,i),this.blockCtx.clearRect(0,0,e,i),this.block.width=e,this.img.src=this.getRandomImg()}}},d=l,c=t(1001),g=(0,c.Z)(d,s,n,!1,null,"5f46b47c",null),m=g.exports},52128:function(e,i,t){"use strict";t.r(i),t.d(i,{default:function(){return p}});var s=function(){var e=this,i=e._self._c;return i("el-form",{directives:[{name:"loading",rawName:"v-loading.fullscreen.lock",value:e.fullscreenLoading,expression:"fullscreenLoading",modifiers:{fullscreen:!0,lock:!0}}],ref:"loginForm",staticClass:"login-form-li",attrs:{model:e.loginForm,rules:e.loginRules,"auto-complete":"off","label-position":"left"}},[i("div",{staticClass:"loginCodeImg-item"},[i("div",{staticClass:"title-container"},[i("dv-decoration-7",{staticStyle:{width:"280px",height:"50px"},attrs:{color:["#14267f","#14267f"]}},[e._v("   "),i("h3",{staticClass:"title"},[e._v(e._s(e.$t("login.title")))]),e._v("   ")])],1)]),e._v("> "),i("div",{staticClass:"login-form-li-box"},[i("el-form-item",{ref:"userdom",attrs:{prop:"username"}},[i("span",{staticClass:"svg-container"},[i("svg-icon",{attrs:{"icon-class":"user"}})],1),i("el-input",{attrs:{placeholder:e.$t("login.username"),name:"username",type:"text","auto-complete":"off",clearable:""},model:{value:e.loginForm.username,callback:function(i){e.$set(e.loginForm,"username",i)},expression:"loginForm.username"}})],1),i("el-form-item",{attrs:{prop:"password"}},[i("span",{staticClass:"svg-container"},[i("svg-icon",{attrs:{"icon-class":"password"}})],1),i("el-input",{attrs:{type:e.passwordType,placeholder:e.$t("login.password"),name:"password","auto-complete":"off",clearable:""},nativeOn:{keyup:function(i){return!i.type.indexOf("key")&&e._k(i.keyCode,"enter",13,i.key,"Enter")?null:e.handleLogin.apply(null,arguments)}},model:{value:e.loginForm.password,callback:function(i){e.$set(e.loginForm,"password",i)},expression:"loginForm.password"}}),i("span",{staticClass:"show-pwd",on:{click:e.showPwd}},[i("svg-icon",{attrs:{"icon-class":"password"===e.passwordType?"eye":"eye-open"}})],1)],1),i("el-form-item",{attrs:{prop:"code"}},[i("el-row",{attrs:{span:24}},[i("el-col",{attrs:{span:14}},[i("span",{staticClass:"svg-container"},[i("svg-icon",{attrs:{"icon-class":"guide"}})],1),i("el-input",{attrs:{placeholder:e.$t("login.code"),name:"code","auto-complete":"off",maxlength:e.code.len,clearable:""},nativeOn:{keyup:function(i){return!i.type.indexOf("key")&&e._k(i.keyCode,"enter",13,i.key,"Enter")?null:e.handleLogin.apply(null,arguments)}},model:{value:e.loginForm.code,callback:function(i){e.$set(e.loginForm,"code",i)},expression:"loginForm.code"}})],1),i("el-col",{attrs:{span:6}},[i("div",{staticClass:"login-code"},["text"==e.code.type?i("span",{staticClass:"login-code-img",on:{click:e.refreshCode}},[e._v(e._s(e.code.value))]):i("img",{staticClass:"login-code-img",attrs:{src:e.code.src},on:{click:e.refreshCode}}),i("span",{staticClass:"show-pwd",on:{click:e.refreshCode}},[i("i",{staticClass:"el-icon-refresh"})])])])],1)],1),i("div",{staticClass:"login-logIn"},[i("el-button",{staticStyle:{width:"71%"},attrs:{loading:e.loading},nativeOn:{click:function(i){return i.preventDefault(),e.handleLogin.apply(null,arguments)}}},[e._v(e._s(e.$t("login.logIn")))])],1),i("div",{staticClass:"binding-button",on:{click:e.bindingClick}},[e._v("绑定序列码")])],1),"displayLogin"==e.msg?i("slide-verify",{attrs:{l:42,r:10,w:e.w_img,h:e.h_img,"slider-text":e.sy},on:{success:e.onSuccess,fail:e.onFail,refresh:e.onRefresh}}):e._e(),i("binding",{attrs:{show:e.bindingBar,title:e.bindingTitle,wb:e.wb,hb:e.hb},on:{showBindingBar:function(i){return e.showBindingBar(i)}}},[i("div",{staticClass:"binding-bar"},[i("bindingForm",{attrs:{"delfile-name":e.delfileName},on:{bindingSubmit:e.bindingSubmit,bindingDataurl:e.bindingDataurl}})],1)])],1)},n=[],r=(t(57658),t(79066)),o=t(84722),a=t(76551),l=t(34927),d=t(12223),c=t(23518),g={name:"userLogin",components:{slideVerify:r["default"],binding:a["default"],bindingForm:l["default"]},data(){const e=(e,i,t)=>{i?t():t(new Error("请输入账号"))},i=(e,i,t)=>{i.length<6?t(new Error("密码不能少于6位")):t()},t=(e,i,t)=>{this.code.value!=i?(this.loginForm.code="",this.refreshCode(),t(new Error("请输入正确的验证码"))):t()};return{delfileName:"0",wb:100,hb:640,bindingTitle:"绑定账号",bindingBar:!1,fullscreenLoading:!1,w_img:440,h_img:250,loginForm:{username:"",password:"",code:"",redomStr:""},code:{src:"",value:"",len:4,type:"text"},loginRules:{username:[{required:!0,trigger:"blur",validator:e}],password:[{required:!0,trigger:"blur",validator:i}],code:[{required:!0,message:"请输入验证码",trigger:"blur"},{min:4,max:4,message:"验证码长度为4位",trigger:"blur"},{required:!0,trigger:"blur",validator:t}]},passwordType:"password",loading:!1,redirect:void 0,msg:"",sy:"向右滑动",bindingDataurlVal:""}},watch:{$route:{handler:function(e){this.redirect=e.query&&e.query.redirect},immediate:!0}},created(){this.refreshCode()},destroyed(){},mounted(){this.msg="",this.setimgm()},methods:{bindingDataurl(e){this.bindingDataurlVal=e},bindingSubmit(){this.bindingBar=!this.bindingBar},showBindingBar(e){if(""!=this.bindingDataurlVal){let e={img:this.bindingDataurlVal},i=this;(0,d.WB)(e).then((e=>{e.data.unlink?(i.$message({message:e.msg,type:"success"}),i.delfileName="1"):(i.$message({message:e.msg,type:"warning"}),i.delfileName="0")}))}this.bindingBar=e},bindingClick(){this.delfileName="0",this.bindingBar=!this.bindingBar},refreshCode(){this.loginForm.redomStr=(0,o.kK)(this.code.len,!0),"text"==this.code.type?this.code.value=(0,o.kK)(this.code.len):this.code.src=`${this.codeUrl}/${this.loginForm.redomStr}`},showPwd(){"password"===this.passwordType?this.passwordType="":this.passwordType="password"},handleLogin(){this.$refs.loginForm.validate((e=>{if(!e)return this.$message.error("请输入正确的账号和密码"),!1;this.msg="displayLogin"}))},openFullScreen(){this.fullscreenLoading=!0,setTimeout((()=>{this.fullscreenLoading=!1}),2e3)},setimgm(){let e=this.$refs.userdom.$el.offsetWidth;this.w_img=e<450?e:450},onSuccess(){this.openFullScreen(),this.msg="login",this.loading=!0,this.$store.dispatch("LoginByUsername",this.loginForm).then((()=>{this.$router.push({path:this.redirect||"/"})})).catch((e=>{c.log(e),this.loading=!1,this.msg=""}))},onFail(){this.$message.error("请正确滑动验证"),this.msg=""},onRefresh(){this.msg="displayLogin"}}},m=g,h=t(1001),u=(0,h.Z)(m,s,n,!1,null,"a506a3e8",null),p=u.exports},84722:function(e,i,t){"use strict";t.d(i,{kK:function(){return s}});t(57658),t(82801);const s=(e,i)=>{let t="";return t=Math.ceil(1e14*Math.random()).toString().substr(0,e||4),i&&(t+=Date.now()),t}},66721:function(e,i,t){var s={"./img0.jpg":97107,"./img1.jpg":59122,"./img2.jpg":31324,"./img3.jpg":83599};function n(e){var i=r(e);return t(i)}function r(e){if(!t.o(s,e)){var i=new Error("Cannot find module '"+e+"'");throw i.code="MODULE_NOT_FOUND",i}return s[e]}n.keys=function(){return Object.keys(s)},n.resolve=r,e.exports=n,n.id=66721},97107:function(e,i,t){"use strict";e.exports=t.p+"img/img0.74daeb32.jpg"},59122:function(e,i,t){"use strict";e.exports=t.p+"img/img1.4cbb16cc.jpg"},31324:function(e,i,t){"use strict";e.exports=t.p+"img/img2.6398655d.jpg"},83599:function(e,i,t){"use strict";e.exports=t.p+"img/img3.36eb527d.jpg"},83509:function(e,i,t){"use strict";e.exports=t.p+"img/photos.38442fef.gif"}}]);