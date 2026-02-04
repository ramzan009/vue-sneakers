import './assets/main.css'

import { createApp } from 'vue'
import { autoAnimatePlugin } from '@formkit/auto-animate/vue'
import App from './App.vue'
import { createWebHistory, createRouter } from 'vue-router'

import Home from '@/pages/Home.vue'
import Favorites from '@/pages/Favorites.vue'
import Login from '@/pages/Login.vue'
import MainLayout from '@/layouts/MainLayout.vue'
import Register from '@/pages/Register.vue'

const app = createApp(App)

const routes = [
  {
    path: '/',
    redirect: '/login',
  },

  {
    path: '/login',
    name: 'Login',
    component: Login,
  },

  {
    path: '/register',
    name: 'Register',
    component: Register,
  },

  {
    path: '/app',
    component: MainLayout,
    meta: { requiresAuth: true },
    children: [
      {
        path: '',
        name: 'Home',
        component: Home,
      },
      {
        path: 'favorites',
        name: 'Favorites',
        component: Favorites,
      },
    ],
  },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

router.beforeEach((to) => {
  const isAuth = localStorage.getItem('isAuth')

  if (to.meta.requiresAuth && !isAuth) {
    return '/login'
  }
})

app.use(autoAnimatePlugin)

app.use(router)

app.mount('#app')
