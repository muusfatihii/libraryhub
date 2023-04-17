import { createRouter, createWebHistory } from 'vue-router'
import FavorisView from '../views/FavorisView.vue'
import MyReadingGroups from '../views/MyReadingGroups.vue'
import ReadingGroups from '../views/ReadingGroups.vue'


const routes = [
  {
    path: '/favoris',
    name: 'favoris',
    component: FavorisView
  },
  {
    path: '/myreadinggroups',
    name: 'myreadinggroups',
    component: MyReadingGroups
  },
  {
    path: '/readinggroups',
    name: 'readinggroups',
    component: ReadingGroups
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
