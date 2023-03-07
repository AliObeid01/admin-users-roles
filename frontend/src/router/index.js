import Vue from 'vue'
import VueRouter from 'vue-router'
import LoginView from '../views/LoginView.vue'
import AdminView from '../views/AdminView.vue'
import RegisterView from '../views/RegisterView.vue'
import AddCertificate from '../views/AddCertificate.vue'
import UserProfile from '../views/UserProfile.vue'
import EditProfile from '../views/EditProfile.vue'

Vue.use(VueRouter)

const routes = [
  {
    path: '/admin',
    name: 'admin',
    component: AdminView
  },
  {
    path: '/login',
    name: 'login',
    component: LoginView
  },
  {
    path: '/register',
    name: 'register',
    component: RegisterView
  },
  {
    path: '/add_certificate',
    name: 'add_certificate',
    component: AddCertificate
  },
  {
    path: '/user_profile',
    name: 'user_profile',
    component: UserProfile
  },
  {
    path: '/edit_profile',
    name: 'edit_profile',
    component: EditProfile
  },

]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
