<!-- src/App.vue -->
<template>
  <v-app>
    <v-app-bar
        elevation="0"
        class="app-bar-gradient"
    >
      <template #prepend>
        <v-icon size="32" class="ml-2">mdi-file-document</v-icon>
      </template>

      <v-app-bar-title class="text-h5 font-weight-bold">
        OrthoNest
      </v-app-bar-title>

      <template #append>
        <!-- Toggle dark mode -->
        <v-btn
            icon
            variant="text"
            @click="toggleDark"
            :aria-label="isDark ? 'Passer en mode clair' : 'Passer en mode sombre'"
        >
          <v-icon>
            {{ isDark ? "mdi-weather-sunny" : "mdi-weather-night" }}
          </v-icon>
        </v-btn>

        <v-btn icon variant="text">
          <v-icon>mdi-magnify</v-icon>
        </v-btn>
        <v-btn icon variant="text">
          <v-icon>mdi-account-circle</v-icon>
        </v-btn>
      </template>
    </v-app-bar>

    <v-main class="bg-surface">
      <router-view v-slot="{ Component }">
        <transition name="fade" mode="out-in">
          <component :is="Component" />
        </transition>
      </router-view>
    </v-main>
  </v-app>
</template>

<script setup>
import { computed } from "vue"
import { useTheme } from "vuetify"

const THEME_STORAGE_KEY = "orthonest-theme"

const theme = useTheme()

const isDark = computed({
  get() {
    return theme.global.current.value.dark
  },
  set(val) {
    theme.global.name.value = val ? "dark" : "light"
    localStorage.setItem(THEME_STORAGE_KEY, val ? "dark" : "light")
  },
})

function toggleDark() {
  isDark.value = !isDark.value
}
</script>

<style scoped>
.app-bar-gradient {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
}

.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>
