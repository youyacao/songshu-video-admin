webpackJsonp([5],{"/5Jc":function(t,e){},NHnr:function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var o=n("xd7I"),r={render:function(){var t=this.$createElement,e=this._self._c||t;return e("div",{attrs:{id:"app"}},[e("router-view")],1)},staticRenderFns:[]};var a=n("C7Lr")({name:"App",mounted:function(){var t=this;this.$store.dispatch("isLogin",this).then(function(e){1==e.code&&t.$router.replace({name:"login"})})}},r,!1,function(t){n("Y3UB")},null,null).exports,u=n("7LQH"),i={render:function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"hello"},[n("h1",[t._v(t._s(t.msg))]),t._v(" "),n("h2",[t._v("Essential Links")]),t._v(" "),t._m(0),t._v(" "),n("h2",[t._v("Ecosystem")]),t._v(" "),t._m(1)])},staticRenderFns:[function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("ul",[n("li",[n("a",{attrs:{href:"https://vuejs.org",target:"_blank"}},[t._v("\n        Core Docs\n      ")])]),t._v(" "),n("li",[n("a",{attrs:{href:"https://forum.vuejs.org",target:"_blank"}},[t._v("\n        Forum\n      ")])]),t._v(" "),n("li",[n("a",{attrs:{href:"https://chat.vuejs.org",target:"_blank"}},[t._v("\n        Community Chat\n      ")])]),t._v(" "),n("li",[n("a",{attrs:{href:"https://twitter.com/vuejs",target:"_blank"}},[t._v("\n        Twitter\n      ")])]),t._v(" "),n("br"),t._v(" "),n("li",[n("a",{attrs:{href:"http://vuejs-templates.github.io/webpack/",target:"_blank"}},[t._v("\n        Docs for This Template\n      ")])])])},function(){var t=this.$createElement,e=this._self._c||t;return e("ul",[e("li",[e("a",{attrs:{href:"http://router.vuejs.org/",target:"_blank"}},[this._v("\n        vue-router\n      ")])]),this._v(" "),e("li",[e("a",{attrs:{href:"http://vuex.vuejs.org/",target:"_blank"}},[this._v("\n        vuex\n      ")])]),this._v(" "),e("li",[e("a",{attrs:{href:"http://vue-loader.vuejs.org/",target:"_blank"}},[this._v("\n        vue-loader\n      ")])]),this._v(" "),e("li",[e("a",{attrs:{href:"https://github.com/vuejs/awesome-vue",target:"_blank"}},[this._v("\n        awesome-vue\n      ")])])])}]};n("C7Lr")({name:"HelloWorld",data:function(){return{msg:"Welcome to Your Vue.js App"}}},i,!1,function(t){n("YMUi")},"data-v-3b884edb",null).exports;o.default.use(u.a);var l=new u.a({routes:[{path:"/",redirect:"/admin/dashboard"},{path:"/admin",name:"HelloWorld",component:function(){return n.e(2).then(n.bind(null,"MpTN"))},children:[{path:"dashboard",component:function(){return n.e(0).then(n.bind(null,"a52u"))},meta:{title:"系统首页"}},{path:"user-list",component:function(){return n.e(0).then(n.bind(null,"WWGw"))},meta:{title:"用户列表"}},{path:"user-log",component:function(){return n.e(0).then(n.bind(null,"9VA4"))},meta:{title:"用户日志"}},{path:"user-comment",component:function(){return n.e(0).then(n.bind(null,"nJw1"))},meta:{title:"评论列表"}},{path:"user-action-log",component:function(){return n.e(0).then(n.bind(null,"+b7G"))},meta:{title:"用户操作日志"}},{path:"video-list",component:function(){return n.e(0).then(n.bind(null,"7nm3"))},meta:{title:"视频列表"}},{path:"text-image-list",component:function(){return n.e(0).then(n.bind(null,"UPI5"))},meta:{title:"图文列表"}},{path:"config-basic",component:function(){return n.e(0).then(n.bind(null,"gi4i"))},meta:{title:"基本配置"}},{path:"config-sms",component:function(){return n.e(0).then(n.bind(null,"Yroq"))},meta:{title:"短信配置"}},{path:"config-ext",component:function(){return n.e(0).then(n.bind(null,"IELU"))},meta:{title:"附件配置"}},{path:"config-seo",component:function(){return n.e(0).then(n.bind(null,"GSaI"))},meta:{title:"SEO配置"}},{path:"login-wechat",component:function(){return n.e(0).then(n.bind(null,"XyK7"))},meta:{title:"微信登录设置"}},{path:"login-qq",component:function(){return n.e(0).then(n.bind(null,"QCTo"))},meta:{title:"QQ登录设置"}},{path:"login-weibo",component:function(){return n.e(0).then(n.bind(null,"LU9Z"))},meta:{title:"微博登录设置"}},{path:"upload-qiniu",component:function(){return n.e(0).then(n.bind(null,"vS9E"))},meta:{title:"七牛云配置"}},{path:"admin-list",component:function(){return n.e(0).then(n.bind(null,"cB1E"))},meta:{title:"管理员列表"}},{path:"admin-log",component:function(){return n.e(0).then(n.bind(null,"p5u2"))},meta:{title:"管理员日志"}},{path:"type-list",component:function(){return n.e(0).then(n.bind(null,"8U0R"))},meta:{title:"分类管理"}},{path:"advert-list",component:function(){return n.e(0).then(n.bind(null,"hvNO"))},meta:{title:"广告列表"}},{path:"update-manager",component:function(){return n.e(0).then(n.bind(null,"op2K"))},meta:{title:"APP版本管理"}},{path:"*",component:function(){return n.e(1).then(n.bind(null,"3bH0"))}}]},{path:"*",component:function(){return n.e(1).then(n.bind(null,"3bH0"))}},{name:"login",path:"/login",component:function(){return n.e(3).then(n.bind(null,"GF4k"))},meta:{title:"登录"}},{path:"*",redirect:"/404"}]}),d=n("NxjZ"),c=n.n(d);n("zlkP"),n("/5Jc");o.default.directive("dialogDrag",{bind:function(t,e,n,o){var r=t.querySelector(".el-dialog__header"),a=t.querySelector(".el-dialog");r.style.cssText+=";cursor:move;",a.style.cssText+=";top:0px;";var u=window.document.currentStyle?function(t,e){return t.currentStyle[e]}:function(t,e){return getComputedStyle(t,!1)[e]};r.onmousedown=function(t){var e=t.clientX-r.offsetLeft,n=t.clientY-r.offsetTop,o=document.body.clientWidth,i=document.documentElement.clientHeight,l=a.offsetWidth,d=a.offsetHeight,c=a.offsetLeft,p=o-a.offsetLeft-l,s=a.offsetTop,m=i-a.offsetTop-d,h=u(a,"left"),f=u(a,"top");h.includes("%")?(h=+document.body.clientWidth*(+h.replace(/\%/g,"")/100),f=+document.body.clientHeight*(+f.replace(/\%/g,"")/100)):(h=+h.replace(/\px/g,""),f=+f.replace(/\px/g,"")),document.onmousemove=function(t){var o=t.clientX-e,r=t.clientY-n;-o>c?o=-c:o>p&&(o=p),-r>s?r=-s:r>m&&(r=m),a.style.cssText+=";left:"+(o+h)+"px;top:"+(r+f)+"px;"},document.onmouseup=function(t){document.onmousemove=null,document.onmouseup=null}}}});var p=n("b4Ps"),s=n.n(p),m=n("BvhE"),h=m.Base64.decode("LS0tLS1CRUdJTiBQVUJMSUMgS0VZLS0tLS1NSUdmTUEwR0NTcUdTSWIzRFFFQkFRVUFBNEdOQURDQmlRS0JnUURsT0p1NlR5eWdxeGZXVDdlTHRHRHdhanRORk9iOUk1WFJiNmtoeWZEMVl0M1lpQ2dRV01OVzY0OTg4N1ZHSmlHci9MNWkyb3NibDhDOStXSlRldWNGK1M3NnhGeGRVNmpFME5RK1orekVkaFVUb29OUmFZNW5aaXU1UGdEQjBFRC9aS0JVU0xLTDdlaWJNeFp0TWxVREhqbTRnd1FjbzFLUk1EU21YU01rRHdJREFRQUItLS0tLUVORCBQVUJMSUMgS0VZLS0tLS0="),f=m.Base64.decode("LS0tLS1CRUdJTiBSU0EgUFJJVkFURSAgS0VZLS0tLS1NSUlDWFFJQkFBS0JnUURsT0p1NlR5eWdxeGZXVDdlTHRHRHdhanRORk9iOUk1WFJiNmtoeWZEMVl0M1lpQ2dRV01OVzY0OTg4N1ZHSmlHci9MNWkyb3NibDhDOStXSlRldWNGK1M3NnhGeGRVNmpFME5RK1orekVkaFVUb29OUmFZNW5aaXU1UGdEQjBFRC9aS0JVU0xLTDdlaWJNeFp0TWxVREhqbTRnd1FjbzFLUk1EU21YU01rRHdJREFRQUJBb0dBZlk5THBudVdLNUJzNTBVVmVwNWM5M1NKZFVpODJ1N3lNeDRpSEZNYy9aMmhmZW5mWUV6dSs1N2ZJNGZ2eFRRLy81RGJ6UlIvWEtiOHVsTnY2K0NIeVBGMzF4azdZT0Jma0dJOHFqTG9xMDZWK0Z5QmZEU3dMOEtiTHllSG03S1VabkxOUWJrOHlHTHpCM2lZS2tSSGxtVWFuUUdhTk1JSnppV09rTitOOWRFQ1FRRDBPTllSTlpldU04emQ4WEpUU2RjSVg0YTNneTNHR0NKeE96djE2WEh4RDAzR1c2VU5MbWZQd2VuS3UrY2RyUWVhcUVpeHJDZWpYZEFGei83K0JTTXBBa0VBOEVhU09lUDVYcjNacmJpS3ppNlRHTXdITXZDN0hkSnhhQkpiVlJmQXBGckUwL21Qd21QNXJON1F3anJNWSswK0FiWGNtOG1SUXlRMStJR0VlbWJzZHdKQkFONmF6OFJ2N1FuRC9ZQnZpNTJQT0lsUlNTSU1WN1N3V3ZTSzRXU01uR2IxWkJiaGdkZzU3RFhhc3Bjd0hzRlY3aEJ5UTVCdk10SWR1SGNUMTRFQ2ZjRUNRQVRlYVRnakZucUUvbFEyMlJrMGVHYVlPODBjYzY0M0JYVkdhZk5mZDlmY3Z3Qk1uazBpR1gwWFJzT296VnQ1QXppbHBzTEJZdUFwYTY2TmNWSEpwQ0VDUVFEVGpJMkFRaEZjMXlSbkNVL1lnRG5TcEpWbTFuQVNvUlVuVThKZm0zT3p1a3U3SlVYY1ZwdDA4REZTY2VDRVg5dW5DdU1jVDcyckFRbExwZFppcjg3Ni0tLS0tRU5EIFJTQSBQUklWQVRFIEtFWS0tLS0t"),g=new s.a;g.setPublicKey(h);var U=new s.a;U.setPrivateKey(f);var v={encrypt:function(t){return g.encrypt(t)},decrypt:function(t){return U.decrypt(t)}},b={formatUrl:function(t){if(void 0!=t)return 0==t.indexOf("http")?t:"http://videofree.youyacao.com/"+t}},R=n("rVsN"),S=n.n(R),V=n("84iU"),T=n.n(V);T.a.defaults.withCredentials=!0;var N=T.a.create({baseURL:"http://videofreeadmin.youyacao.com/admin/",timeout:5e3});N.interceptors.request.use(function(t){return t},function(t){return console.log(t),S.a.reject()}),N.interceptors.response.use(function(t){if(200===t.status)return t.data;S.a.reject()},function(t){return console.log(t),S.a.reject()});var F=N,y={login:{login:function(t){return F({url:"/login/login",method:"post",data:t})},logout:function(t){return F({url:"/login/logout",method:"get",params:t})},isLogin:function(t){return F({url:"/login/islogin",method:"get",params:t})}},video:{list:function(t){return F({url:"/video/getList",method:"get",params:t})},delete:function(t){return F({url:"/video/deleteVideo",method:"get",params:t})},update:function(t){return F({url:"/video/updateVideo",method:"post",data:t})}},textimage:{list:function(t){return F({url:"/text_image/getList",method:"get",params:t})},delete:function(t){return F({url:"/text_image/delete",method:"get",params:t})},update:function(t){return F({url:"/text_image/update",method:"post",data:t})}},user:{list:function(t){return F({url:"/user/getList",method:"get",params:t})},delete:function(t){return F({url:"/user/deleteUser",method:"get",params:t})},update:function(t){return F({url:"/user/updateUser",method:"get",params:t})},log:function(t){return F({url:"/user/userLog",method:"get",params:t})},comment:function(t){return F({url:"/comment/getList",method:"get",params:t})},commentDelete:function(t){return F({url:"/comment/del",method:"get",params:t})},commentUpdate:function(t){return F({url:"/comment/update",method:"post",data:t})}},type:{list:function(t){return F({url:"/type/getList",method:"get",params:t})},update:function(t){return F({url:"/type/updateType",method:"get",params:t})},add:function(t){return F({url:"/type/addType",method:"get",params:t})},delete:function(t){return F({url:"/type/delete",method:"get",params:t})}},config:{get:function(t){return F({url:"/config/getConfig",method:"get",params:t})},set:function(t){return F({url:"/config/setConfig",method:"post",data:t})}},admin:{list:function(t){return F({url:"/manager/getList",method:"get",data:t})},add:function(t){return F({url:"/manager/addUser",method:"post",data:t})},update:function(t){return F({url:"/manager/updateUser",method:"post",data:t})},delete:function(t){return F({url:"/manager/deleteUser",method:"post",data:t})},log:function(t){return F({url:"/manager/log",method:"post",data:t})}},update:{list:function(t){return F({url:"/update/getList",method:"get",data:t})},update:function(t){return F({url:"/update/update",method:"post",data:t})},delete:function(t){return F({url:"/update/delete",method:"post",data:t})},add:function(t){return F({url:"/update/add",method:"post",data:t})}},advert:{list:function(t){return F({url:"/advert/getList",method:"post",data:t})},add:function(t){return F({url:"/advert/add",method:"post",data:t})},update:function(t){return F({url:"/advert/update",method:"post",data:t})},delete:function(t){return F({url:"/advert/delete",method:"post",data:t})}}},E=n("2bvH");o.default.use(E.a);var k=new E.a.Store({state:{user:{},baseUrl:"http://videofreeadmin.youyacao.com",frontUrl:"http://videofree.youyacao.com"},mutations:{setUser:function(t,e){t.user=e}},actions:{isLogin:function(t,e){var n=JSON.parse(localStorage.getItem("admin"));return n&&t.commit("setUser",n),new S.a(function(t,n){e.$api.login.isLogin().then(function(e){t(e)})})}},modules:{}});o.default.prototype.$decrypt=v,o.default.prototype.$xskf="j9AHRJfa5lqItRS83vUhWG1CVbwJax2UWqo0zHFcvc12EtTAq3N/5eVXCYKP8/3eYk82KpNEIPNZf8VreNMa8g2De48dsZs7WY7xLeLUdOj+lenW9qduw76tJonrc4D3YLMcLR37oGRCA+8xNTH9MS6UA4aaB9NiqF5RVRpqfUo=",o.default.prototype.$video_url="zBh3lD2jbvIQRzgOGjf9Z3TTQ7bXOor17NoZNo1Hu0gz/SQHNx0u4IShAk/i3m7RYIC7sqyZSHUFCfzXB4FCE8mzimLM7YK6SXH4Ig7J50Vtk278uB587a2Hd+G8Ko1VDl0Tbel4cdtX6o1rCCVmNzoaRnYdx6WiWmutHcYI7lI=",o.default.prototype.$video_title="yj45KMYPEsZEAUe8mdFHfhIdqe0ZFsc5Ma/51PUPU36nJ9Eb5pJ5J3bzGJdXwIHov0Frq0AJIV+sZsHNewhn0Ucm7wuToPOckpF+NaaV5LHkYdJwrBekanvkk4FyryyfqqUfpd8Y4sblQd9Xcb4i72G9Lc28n8xrMlwtLiLTWSc=",o.default.prototype.$yyc_url="pKayqmD74HSKnqSeuCq6ZfrRFsa7Z0IbcjCUz4w60V/+iYShxTOFlo+xokvOe9Hxyj9KoQdlY5tVZFacRrckvhCBkkOJ9tDEjoOQoFtC8quIQrYyWSltEfZrccBSvAnGjReTntU/ZWC8XGM752WYHTXnHL8118DSrOKdAAXSSpM=",o.default.prototype.$copy_right="gdDaS8lU/RKDsG3CX9QEAw2uqV/XuPL1cnRUb+bCR51gfIst77TC5Kcio2l8dnw10AgGor3ty6wjIxCIxpiL/qyVqICmATd2w1j7FCs/PSC4NhVlk4JTbxhZrfQRx9EWbBqzj5dPKB4IWbYHLzu4ThkfIq3FOaQ3v+NCCrDUHv0=",o.default.prototype.$gszj="Z+ub8KnSKnnITrPgbL9NhcGUmncpdq4y5psegq+q7ZdsTiFwbGgXr7Xl27UM8E78EE+iT5cnmA30XCCHgSbhyFdrkQ8X1DbYZAMRGVI4f5GTChOEQOUUDl7bkDhMHeCEyj05g623ehauaQpGiW1RCulwQa3A0AuFJCE645BStws=",o.default.config.productionTip=!1,o.default.use(c.a),o.default.prototype.$api=y,o.default.prototype.$utils=b,o.default.prototype.$store=k,l.beforeEach(function(t,e,n){document.title=t.meta.title+" | 松鼠短视频系统后台管理";var r=localStorage.getItem("admin");r||"/login"===t.path?t.meta.permission?"admin"===r.username?n():n("/403"):navigator.userAgent.indexOf("MSIE")>-1&&"/editor"===t.path?o.default.prototype.$alert("不兼容IE10及以下浏览器，请使用更高版本的浏览器查看","浏览器不兼容通知",{confirmButtonText:"确定"}):n():n("/login")}),window.vue=new o.default({el:"#app",router:l,store:k,components:{App:a},template:"<App/>",render:function(t){return t(a)}})},Y3UB:function(t,e){},YMUi:function(t,e){},zlkP:function(t,e){}},["NHnr"]);