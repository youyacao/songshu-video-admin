webpackJsonp([3],{"3cXf":function(e,r,t){e.exports={default:t("L+o2"),__esModule:!0}},GF4k:function(e,r,t){"use strict";Object.defineProperty(r,"__esModule",{value:!0});var s=t("3cXf"),a=t.n(s),n={data:function(){return{param:{username:"admin",password:"123123"},rules:{username:[{required:!0,message:"请输入用户名",trigger:"blur"}],password:[{required:!0,message:"请输入密码",trigger:"blur"}]}}},created:function(){},methods:{submitForm:function(){var e=this;this.$refs.login.validate(function(r){if(!r)return e.$message.error("请输入账号和密码"),console.log("error submit!!"),!1;e.$api.login.login({username:e.param.username,password:e.param.password}).then(function(r){1!=r.code?(e.$message.success("登录成功"),localStorage.setItem("admin",a()(r.data)),e.$store.commit("setUser",r.data),e.$router.push("/")):e.$message.error("用户名或密码错误")}).catch(function(r){e.$message.error("用户名或密码错误"),console.log("error",r)})})}}},o={render:function(){var e=this,r=e.$createElement,t=e._self._c||r;return t("div",{staticClass:"login-wrap"},[t("div",{staticClass:"ms-login"},[t("div",{staticClass:"ms-title"},[e._v("松鼠短视频系统-后台管理")]),e._v(" "),t("el-form",{ref:"login",staticClass:"ms-content",attrs:{model:e.param,rules:e.rules,"label-width":"0px"}},[t("el-form-item",{attrs:{prop:"username"}},[t("el-input",{attrs:{placeholder:"username"},model:{value:e.param.username,callback:function(r){e.$set(e.param,"username",r)},expression:"param.username"}},[t("el-button",{attrs:{slot:"prepend",icon:"el-icon-lx-people"},slot:"prepend"})],1)],1),e._v(" "),t("el-form-item",{attrs:{prop:"password"}},[t("el-input",{attrs:{type:"password",placeholder:"password"},nativeOn:{keyup:function(r){return!r.type.indexOf("key")&&e._k(r.keyCode,"enter",13,r.key,"Enter")?null:e.submitForm()}},model:{value:e.param.password,callback:function(r){e.$set(e.param,"password",r)},expression:"param.password"}},[t("el-button",{attrs:{slot:"prepend",icon:"el-icon-lx-lock"},slot:"prepend"})],1)],1),e._v(" "),t("div",{staticClass:"login-btn"},[t("el-button",{attrs:{type:"primary"},on:{click:function(r){return e.submitForm()}}},[e._v("登录")])],1),e._v(" "),t("p",{staticClass:"login-tips"},[e._v("CopyRight © 松鼠短视频系统")])],1)],1)])},staticRenderFns:[]};var i=t("C7Lr")(n,o,!1,function(e){t("fQSx")},"data-v-1367e502",null);r.default=i.exports},"L+o2":function(e,r,t){var s=t("ZuHZ"),a=s.JSON||(s.JSON={stringify:JSON.stringify});e.exports=function(e){return a.stringify.apply(a,arguments)}},fQSx:function(e,r){}});