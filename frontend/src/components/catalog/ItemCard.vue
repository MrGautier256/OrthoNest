<script setup>
const props = defineProps({
  item: {
    type: Object,
    required: true,
  },
})

const typeLabels = {
  bilan: "Bilan",
  outil: "Outil, matériel",
  jeu: "Jeu",
}

const statusLabels = {
  officiel: "Officiel",
  diy: "DIY",
}
</script>

<template>
  <v-card variant="outlined">
    <v-card-title class="d-flex flex-column align-start">
      <span class="text-subtitle-1 font-weight-medium">
        {{ item.title }}
      </span>
      <div class="d-flex align-center mt-1 gap-2" style="gap: 8px">
        <v-chip size="x-small" color="primary" variant="elevated">
          {{ typeLabels[item.type] ?? item.type }}
        </v-chip>
        <v-chip size="x-small" color="secondary" variant="tonal">
          {{ statusLabels[item.status] ?? item.status }}
        </v-chip>
      </div>
    </v-card-title>

    <v-card-text>
      <p v-if="item.description" class="mb-2">
        {{ item.description }}
      </p>

      <p v-if="item.creator" class="text-caption text-medium-emphasis">
        Créateur, {{ item.creator }}
      </p>
    </v-card-text>

    <!-- plus tard: bouton "voir le détail", "voir les pièces jointes" etc -->
  </v-card>
</template>
