import Vue from 'vue'
import Router from 'vue-router'
import HelloWorld from '@/components/HelloWorld'
import Kk from '@/components/Kk'
import a1 from '@/components/a1'
import a2 from '@/components/a2'
import a3 from '@/components/a3'
import Login from '@/components/Login'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/login',
      name: 'Login',
      component: Login
    },
    {
      path: '/',
      name: 'HelloWorld',
      component: HelloWorld
    },
    {
      path: '/kk',
      name: 'Kk',
      component: Kk
    },
    {
      path: '/a1',
      name: 'a1',
      component: a1
    },
    {
      path: '/a2',
      name: 'a2',
      component: a2
    },
    {
      path: '/a3',
      name: 'a3',
      component: a3
    }
  ]
})
