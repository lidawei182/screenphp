"use strict";(self["webpackChunkdatafication"]=self["webpackChunkdatafication"]||[]).push([[42],{93042:function(e,t,n){n.r(t),n.d(t,{default:function(){return u}});var a=function(){var e=this,t=e._self._c;return t("div",{attrs:{id:"container"}})},o=[],i=(n(57658),n(89096));let s,r,l,d,c,h;var p={name:"circularLine",props:{},data(){return{geometry:null}},mounted(){this.$nextTick((()=>{this.init(),window.onresize=()=>(()=>{this.clearScene(),this.init()})()}))},destroyed(){this.clearScenedestroyed()},methods:{clearScene:function(){d.dispose(),c.dispose(),h.dispose();let e=document.getElementById("container");e.innerHTML="",l.forceContextLoss(),l.dispose()},clearScenedestroyed:function(){d.dispose(),c.dispose(),h.dispose(),l.forceContextLoss(),l.dispose()},init:function(){const e=document.getElementById("container");s=new i.xsS,r=new i.cPb(75,window.innerWidth/window.innerHeight,.1,1e3);let t=16711680,n=16750848,a=55,o=60;l=new i.CP7({antialias:!0,alpha:!0}),l.setClearColor(0,0),l.setSize(window.innerWidth,window.innerHeight),e.appendChild(l.domElement),r.position.z=-400;let p=new i.ZAu;s.add(p);let w=new i.Mig(4210752);s.add(w);let m=new i.Ox3(16777215,1);m.position.set(0,128,128),s.add(m);let M=new i.Kj0(new i.cJO(a,2),new i.YBo({color:t,ambient:t,wireframe:!0,transparent:!0,shininess:0}));s.add(M);let u=new i.Kj0(new i.cJO(o,3),new i.YBo({color:n,ambient:n,wireframe:!0,transparent:!0,shininess:0}));s.add(u);let f=new i.Kj0(new i.xo$(a,32,32),new i.xoR({color:t,ambient:t,transparent:!0,shininess:25,opacity:.3}));s.add(f);let y=new i.Kj0(new i.xo$(o,32,32),new i.xoR({color:n,ambient:n,transparent:!0,shininess:25,opacity:.3}));d=new i.ZXM;for(let s=0;s<35e3;s++){let e=2*Math.random()-1,t=2*Math.random()-1,n=2*Math.random()-1,a=1/Math.sqrt(Math.pow(e,2)+Math.pow(t,2)+Math.pow(n,2));e*=a,t*=a,n*=a;let s=new i.Pa4(e*o,t*o,n*o);d.vertices.push(s)}let g=new i.ayZ(d,new i.LRR({size:.1,color:n,transparent:!0}));s.add(g),c=new i.ZXM;for(let s=0;s<35e3;s++){let e=2*Math.random()-1,t=2*Math.random()-1,n=2*Math.random()-1,a=1/Math.sqrt(Math.pow(e,2)+Math.pow(t,2)+Math.pow(n,2));e*=a,t*=a,n*=a;let s=new i.Pa4(e*o,t*o,n*o);c.vertices.push(s)}let x=new i.ayZ(c,new i.LRR({size:.1,color:t,transparent:!0}));s.add(x),h=new i.ZXM;for(let s=0;s<5e3;s++){let e=new i.Pa4;e.x=2e3*Math.random()-1e3,e.y=2e3*Math.random()-1e3,e.z=2e3*Math.random()-1e3,h.vertices.push(e)}let L=new i.ayZ(h,new i.LRR({size:2,color:16777113}));s.add(L),r.position.z=-110;let S=new i.SUY,z=function(){r.lookAt(s.position),M.rotation.x+=.002,M.rotation.z+=.002,u.rotation.x+=.001,u.rotation.z+=.001,f.rotation.y+=.005,f.rotation.z+=.005,y.rotation.y+=.01,y.rotation.z+=.01,g.rotation.y+=5e-4,x.rotation.y-=.002,L.rotation.y-=.002;let e=Math.abs(Math.cos((S.getElapsedTime()+2.5)/20)),t=Math.abs(Math.cos((S.getElapsedTime()+5)/10));L.material.color.setHSL(Math.abs(Math.cos(S.getElapsedTime()/10)),1,.5),u.material.color.setHSL(0,1,t),y.material.color.setHSL(0,1,t),g.material.color.setHSL(0,1,t),M.material.color.setHSL(.08,1,e),x.material.color.setHSL(.08,1,e),f.material.color.setHSL(.08,1,e),M.material.opacity=Math.abs(.5*Math.cos((S.getElapsedTime()+.5)/.9)),u.material.opacity=Math.abs(.5*Math.cos(S.getElapsedTime()/.9)),m.position.x=128*Math.cos(S.getElapsedTime()/.5),m.position.y=128*Math.cos(S.getElapsedTime()/.5),m.position.z=128*Math.sin(S.getElapsedTime()/.5),l.render(s,r),requestAnimationFrame(z)};z()}}},w=p,m=n(1001),M=(0,m.Z)(w,a,o,!1,null,null,null),u=M.exports}}]);