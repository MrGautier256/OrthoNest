<script setup>
import { ref, onMounted } from "vue"
import { getHealth } from "../services/healthApi"
import { getItems } from "../services/itemsApi"
import ItemList from "../components/catalog/ItemList.vue"

const apiStatus = ref("Chargement...")
const items = ref([])
const error = ref("")

onMounted(async () => {
  try {
    const health = await getHealth()
    apiStatus.value = `API OK, app = ${health.app}`

    items.value = await getItems()
  } catch (e) {
    error.value = e.message ?? String(e)
  }
})
</script>

<template>
  <v-container class="py-6" max-width="md">
    <v-row>
      <v-col cols="12">
        <h1 class="text-h4 mb-2">Catalogue OrthoNest</h1>
        <p class="text-body-2 text-medium-emphasis">{{ apiStatus }}</p>
        <p v-if="error" class="text-error">Erreur, {{ error }}</p>
      </v-col>
    </v-row>

    <!-- plus tard on mettra un FiltersPanel ici -->

    <v-row class="mt-4">
      <v-col cols="12">
        <ItemList :items="items" />
      </v-col>
    </v-row>
  </v-container>
</template>
