// src/main.js
import { createApp } from "vue"
import App from "./App.vue"
import { createRouter, createWebHistory } from "vue-router"
import { createVuetify } from "vuetify"
import "vuetify/styles"
import "@mdi/font/css/materialdesignicons.css"

import CatalogView from "./views/CatalogView.vue"

if (import.meta.env.DEV) {
    import("@vue/devtools").then(({ devtools }) => {
        devtools.connect()
    })
}

// Router
const router = createRouter({
    history: createWebHistory(),
    routes: [
        { path: "/", name: "catalog", component: CatalogView },
    ],
})

// clé locale pour le thème
const THEME_STORAGE_KEY = "orthonest-theme"
const savedTheme = localStorage.getItem(THEME_STORAGE_KEY) || "light"

// Vuetify
const vuetify = createVuetify({
    theme: {
        defaultTheme: savedTheme, // "light" ou "dark"
    },
})

createApp(App)
    .use(router)
    .use(vuetify)
    .mount("#app")
