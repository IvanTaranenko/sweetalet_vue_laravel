import {createRouter, createWebHistory} from "vue-router";
import Post from '../components/Post.vue'


const routes = [
    {path: "/", name: "Post", component: Post},
]

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
