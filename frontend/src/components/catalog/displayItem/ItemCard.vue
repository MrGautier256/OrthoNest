<script setup>
import { useTheme } from "vuetify"

const theme = useTheme()

const props = defineProps({
  item: {
    type: Object,
    required: true,
  },
})

const type = props.item.type ?? {}
const status = props.item.status

const fallbackTypeConfig = {
  label: "Outil",
  icon: "mdi-file-document",
  color: "#4facfe",
  gradient: "linear-gradient(135deg, #4facfe 0%, #00f2fe 100%)",
}

function getGradient() {
  if (type.color && type.color.startsWith("#")) {
    return `linear-gradient(135deg, ${type.color} 0%, #764ba2 100%)`
  }
  return type.gradient || fallbackTypeConfig.gradient
}
</script>

<template>
  <v-card
      class="item-card"
      elevation="2"
      hover
  >
    <div class="card-header" :style="{ background: getGradient() }">
      <v-icon
          size="40"
          :color="theme.global.current.value.dark ? '#212121' : 'white'"
      >
        {{ type.icon || fallbackTypeConfig.icon }}
      </v-icon>
    </div>

    <v-card-title class="pt-4 pb-2">
      <div class="d-flex align-center justify-space-between">
        <span class="text-h6 font-weight-bold flex-grow-1">
          {{ item.title }}
        </span>
        <v-tooltip location="top">
          <template #activator="{ props }">
            <v-icon
                v-bind="props"
                :color="status === 'officiel' ? 'success' : 'warning'"
                size="20"
            >
              {{ status === 'officiel' ? 'mdi-check-decagram' : 'mdi-hammer-wrench' }}
            </v-icon>
          </template>
          {{ status === 'officiel' ? 'Officiel' : 'DIY' }}
        </v-tooltip>
      </div>
    </v-card-title>
    <v-card-subtitle class="pb-2">
      <v-chip
          size="small"
          :color="type.color || fallbackTypeConfig.color"
          variant="tonal"
          label
      >
        {{ type.label || fallbackTypeConfig.label }}
      </v-chip>
    </v-card-subtitle>

    <v-card-text>
      <p v-if="item.description" class="text-body-2 mb-3">
        {{ item.description }}
      </p>

      <v-divider v-if="item.creator" class="my-3" />

      <div v-if="item.creator" class="d-flex align-center">
        <v-avatar size="32" color="grey-lighten-2" class="mr-2">
          <v-icon size="20">mdi-account</v-icon>
        </v-avatar>
        <div>
          <p class="text-caption text-medium-emphasis mb-0">Créateur</p>
          <p class="text-body-2 font-weight-medium mb-0">
            {{ item.creator }}
          </p>
        </div>
      </div>
    </v-card-text>

    <v-card-actions>
      <v-btn
          variant="tonal"
          color="primary"
          block
          prepend-icon="mdi-eye"
      >
        Voir les détails
      </v-btn>
    </v-card-actions>
  </v-card>
</template>


<style scoped>
.item-card {
  height: 100%;
  display: flex;
  flex-direction: column;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  border-radius: 16px !important;
  overflow: hidden;
}

.item-card:hover {
  transform: translateY(-8px);
  box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15) !important;
}

.card-header {
  height: 100px;
  display: flex;
  align-items: center;
  justify-content: center;
  position: relative;
  overflow: hidden;
}

.card-header::before {
  content: '';
  position: absolute;
  top: -50%;
  right: -50%;
  width: 200%;
  height: 200%;
  background: rgba(255, 255, 255, 0.1);
  transform: rotate(45deg);
  transition: all 0.5s ease;
}

.item-card:hover .card-header::before {
  top: -100%;
  right: -100%;
}
</style>