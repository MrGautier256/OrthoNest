<script setup>
import { ref, computed, onMounted, watch } from "vue"
import { getItems } from "../services/items.js"
import ItemList from "../components/catalog/ItemList.vue"

const DISPLAY_MODE_KEY = "orthonest-display-mode"

const items = ref([])
const error = ref("")
const loading = ref(true)
const searchQuery = ref("")
const selectedType = ref(null)

// lire la valeur sauvegardée ou "list" par défaut
const displayMode = ref(localStorage.getItem(DISPLAY_MODE_KEY) || "list") // 'cards' ou 'list'

// on sauvegarde à chaque changement
watch(displayMode, (val) => {
  localStorage.setItem(DISPLAY_MODE_KEY, val)
})

const typeFilters = [
  { value: null, title: "Tous", icon: "mdi-view-grid" },
  { value: "bilan", title: "Bilans", icon: "mdi-clipboard-text" },
  { value: "outil", title: "Outils", icon: "mdi-tools" },
  { value: "jeu", title: "Jeux", icon: "mdi-puzzle" },
]

const filteredItems = computed(() => {
  let result = items.value

  if (selectedType.value) {
    result = result.filter(item => item.type?.slug === selectedType.value)
  }

  if (searchQuery.value) {
    const query = searchQuery.value.toLowerCase()
    result = result.filter(item =>
        item.title.toLowerCase().includes(query) ||
        item.description?.toLowerCase().includes(query),
    )
  }

  return result
})

onMounted(async () => {
  try {
    await new Promise(resolve => setTimeout(resolve, 500))
    items.value = await getItems()
  } catch (e) {
    error.value = e.message ?? String(e)
  } finally {
    loading.value = false
  }
})
</script>


<template>
  <div>
    <!-- Hero Section -->
    <div class="hero-section">
      <v-container>
        <v-row justify="center">
          <v-col cols="12" md="8" class="text-center">
            <v-text-field
                v-model="searchQuery"
                variant="solo"
                density="comfortable"
                prepend-inner-icon="mdi-magnify"
                placeholder="Rechercher un outil..."
                rounded="pill"
                class="search-field"
                hide-details
            />
          </v-col>
        </v-row>
      </v-container>
    </div>

    <v-container class="py-8">
      <!-- Filtres par type -->
      <v-row class="mb-6">
        <v-col cols="12" class="d-flex flex-wrap justify-space-between align-center">
          <div class="d-flex flex-wrap gap-3">
            <v-btn
                v-for="filter in typeFilters"
                :key="filter.value"
                :variant="selectedType === filter.value ? 'flat' : 'tonal'"
                :color="selectedType === filter.value ? 'primary' : 'default'"
                size="large"
                rounded="pill"
                @click="selectedType = filter.value"
                class="filter-btn"
            >
              <v-icon start>{{ filter.icon }}</v-icon>
              {{ filter.title }}
            </v-btn>
          </div>

          <!-- Toggle vue cartes / liste -->
          <v-btn-toggle
              v-model="displayMode"
              mandatory
              rounded="pill"
              class="mt-4 mt-md-0"
          >
            <v-btn
                value="cards"
                icon
                :aria-label="'Vue cartes'"
            >
              <v-icon>mdi-view-grid</v-icon>
            </v-btn>
            <v-btn
                value="list"
                icon
                :aria-label="'Vue liste'"
            >
              <v-icon>mdi-view-list</v-icon>
            </v-btn>
          </v-btn-toggle>
        </v-col>
      </v-row>


      <!-- Alerte erreur -->
      <v-row v-if="error">
        <v-col cols="12">
          <v-alert
              type="error"
              variant="tonal"
              prominent
              icon="mdi-alert-circle"
              closable
          >
            <v-alert-title>Erreur de chargement</v-alert-title>
            {{ error }}
          </v-alert>
        </v-col>
      </v-row>

      <!-- Liste des items -->
      <v-row>
        <v-col cols="12">
          <v-fade-transition>
            <div v-if="loading" class="text-center py-12">
              <v-progress-circular
                  indeterminate
                  color="primary"
                  size="64"
              />
              <p class="text-h6 mt-4 text-medium-emphasis">
                Chargement...
              </p>
            </div>
            <ItemList
                v-else
                :items="filteredItems"
                :display-mode="displayMode"
            />
          </v-fade-transition>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<style scoped>
.hero-section {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  padding: 80px 0 100px;
  margin-bottom: -40px;
  position: relative;
}

.hero-section::after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  height: 40px;
  background: rgb(var(--v-theme-surface));
  border-radius: 40px 40px 0 0;
}

.search-field {
  max-width: 600px;
  margin: 0 auto;
}

.filter-btn {
  transition: transform 0.2s ease;
}

.filter-btn:hover {
  transform: translateY(-2px);
}

@keyframes bounce {
  0%, 100% {
    transform: translateY(0);
  }
  50% {
    transform: translateY(-10px);
  }
}

.bounce {
  animation: bounce 2s ease-in-out infinite;
}
</style>