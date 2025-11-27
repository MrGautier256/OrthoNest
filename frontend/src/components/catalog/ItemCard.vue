<script setup>
const props = defineProps({
  item: {
    type: Object,
    required: true,
  },
})

const typeConfig = {
  bilan: {
    label: "Bilan",
    icon: "mdi-clipboard-text",
    color: "#667eea",
    gradient: "linear-gradient(135deg, #667eea 0%, #764ba2 100%)",
  },
  outil: {
    label: "Outil, matériel",
    icon: "mdi-tools",
    color: "#f093fb",
    gradient: "linear-gradient(135deg, #f093fb 0%, #f5576c 100%)",
  },
  jeu: {
    label: "Jeu",
    icon: "mdi-puzzle",
    color: "#4facfe",
    gradient: "linear-gradient(135deg, #4facfe 0%, #00f2fe 100%)",
  },
}

const statusConfig = {
  officiel: {
    label: "Officiel",
    icon: "mdi-check-decagram",
    color: "success",
  },
  diy: {
    label: "DIY",
    icon: "mdi-hammer-wrench",
    color: "warning",
  },
}

const config = typeConfig[props.item.type] || typeConfig.outil
const statusConf = statusConfig[props.item.status] || statusConfig.diy
</script>

<template>
  <v-card
      class="item-card"
      elevation="2"
      hover
  >
    <!-- Header coloré avec icône -->
    <div class="card-header" :style="{ background: config.gradient }">
      <v-icon size="40" color="white">
        {{ config.icon }}
      </v-icon>
    </div>

    <v-card-title class="pt-4 pb-2">
      <div class="d-flex align-center justify-space-between">
        <span class="text-h6 font-weight-bold flex-grow-1">
          {{ item.title }}
        </span>
        <v-tooltip location="top">
          <template v-slot:activator="{ props }">
            <v-icon
                v-bind="props"
                :color="statusConf.color"
                size="20"
            >
              {{ statusConf.icon }}
            </v-icon>
          </template>
          {{ statusConf.label }}
        </v-tooltip>
      </div>
    </v-card-title>

    <v-card-subtitle class="pb-2">
      <v-chip
          size="small"
          :color="config.color"
          variant="tonal"
          label
      >
        {{ config.label }}
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