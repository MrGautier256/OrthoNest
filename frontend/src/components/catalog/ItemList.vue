<script setup>
import ItemCard from "./displayItem/ItemCard.vue"
import ItemRow from "./displayItem/ItemRow.vue"

const props = defineProps({
  items: Array,
  displayMode: {
    type: String,
    default: "cards",
  },
})

</script>

<template>
  <!-- État vide -->
  <div v-if="!items.length" class="empty-state text-center py-12">
    <v-icon size="120" color="grey-lighten-1">mdi-package-variant</v-icon>
    <h3 class="text-h5 mt-4 mb-2">Aucun outil trouvé</h3>
    <p class="text-body-1 text-medium-emphasis">
      Essayez de modifier vos filtres de recherche
    </p>
  </div>

  <!-- MODE LISTE -->
  <div v-else-if="displayMode === 'list'">
    <ItemRow
        v-for="item in items"
        :key="item.id"
        :item="item"
        class="mb-4"
    />
  </div>

  <!-- MODE CARDS -->
  <v-row v-else>
    <v-col
        v-for="(item, index) in items"
        :key="item.id"
        cols="12"
        sm="6"
        lg="4"
    >
      <div class="item-wrapper" :style="{ animationDelay: `${index * 0.05}s` }">
        <ItemCard :item="item" />
      </div>
    </v-col>
  </v-row>
</template>


<style scoped>
.empty-state {
  animation: fadeIn 0.5s ease;
}

.item-wrapper {
  animation: slideUp 0.4s ease forwards;
  opacity: 0;
}

@keyframes slideUp {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes fadeIn {
  from {
    opacity: 0;
  }
  to {
    opacity: 1;
  }
}

:deep(.v-list) {
  background: transparent !important;
}
</style>