<script setup>
import ItemCard from "./ItemCard.vue"

const props = defineProps({
  items: {
    type: Array,
    required: true,
  },
})
</script>

<template>
  <div v-if="!items.length" class="text-medium-emphasis">
    Aucun outil pour le moment.
  </div>

  <v-row v-else dense>
    <v-col
        v-for="item in items"
        :key="item.id"
        cols="12"
        md="6"
        class="mb-3"
    >
      <ItemCard :item="item" />
    </v-col>
  </v-row>
</template>
