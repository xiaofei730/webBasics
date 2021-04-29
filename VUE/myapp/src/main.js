// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
// 使用es6模块化加载Vue
import Vue from 'vue'
import App from './App'
import router from './router'
import ElementUI from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css'

import './assets/css/style.css'

// 在入口main.js中引入axios
// 直接给Vue构造函数的原型（prototype）赋值，使所有vue组件及实例对象都有共同的公有属性
// 在所有组件中都可以使用$axios
import Axios from 'axios'
Vue.prototype.$axios = Axios

Vue.config.productionTip = false

Vue.use(ElementUI)
/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  components: { App },
  template: '<App/>'
})
