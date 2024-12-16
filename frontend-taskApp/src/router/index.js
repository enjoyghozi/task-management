import { createRouter, createWebHistory } from 'vue-router'
import Home from '@/views/Home.vue'
import SignIn from '@/views/SignIn.vue'
import SignUp from '@/views/SignUp.vue'
import Task from '@/views/Task.vue'
import CreateTask from '../views/Task/CreateTask.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: Home,
    },
    {
      path: '/task',
      name: 'task',
      component: Task,
    },
    {
      path: '/task/create',
      name: 'create-task',
      component: CreateTask,
    },
    {
      path: '/task/:id/edit',
      name: 'edit-task',
    },
    {
      path: '/login',
      name: 'signin',
      component: SignIn,
    },
    {
      path: '/register',
      name: 'signup',
      component: SignUp,
    },
  ],
});

export default router
