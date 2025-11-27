import { createApp } from "vue"
import App from "./App.vue"
import { createRouter, createWebHistory } from "vue-router"
import { createVuetify } from "vuetify"
import "vuetify/styles"
import "@mdi/font/css/materialdesignicons.css"

import CatalogView from "./views/CatalogView.vue"

const router = createRouter({
    history: createWebHistory(),
    routes: [
        { path: "/", name: "catalog", component: CatalogView },
        // plus tard: { path: "/items/:id", name: "item", component: ItemView },
    ],
})

// Vuetify
const vuetify = createVuetify({
    theme: {
        defaultTheme: "light",
    },
})

createApp(App).use(router).use(vuetify).mount("#app")
