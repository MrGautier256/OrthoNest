import { createApp } from "vue"
import App from "./App.vue"
import { createRouter, createWebHistory } from "vue-router"
import { createVuetify } from "vuetify"
import "vuetify/styles"
import "@mdi/font/css/materialdesignicons.css"

import CatalogView from "./views/CatalogView.vue"

// Router
const router = createRouter({
    history: createWebHistory(),
    routes: [
        { path: "/", name: "catalog", component: CatalogView },
    ],
})

// Vuetify
const vuetify = createVuetify({
    theme: {
        defaultTheme: "light",
    },
})

createApp(App)
    .use(router)
    .use(vuetify)
    .mount("#app")
