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
</script>

<template>
  <div class="item-wrapper">
    <v-list-item class="item-row" :title="item.title">
      <template #prepend>
        <v-avatar :color="type.color || 'primary'" size="40">
          <v-icon :color="theme.global.current.value.dark ? '#212121' : 'white'">
            {{ type.icon || 'mdi-file-document' }}
          </v-icon>
        </v-avatar>
      </template>

      <template #subtitle>
        <div class="mt-1">
          <p v-if="item.description" class="text-body-2 mb-2">
            {{ item.description }}
          </p>

          <div class="d-flex flex-wrap align-center gap-2">
            <v-chip
                v-if="type.label"
                size="x-small"
                :color="type.color || 'primary'"
                variant="tonal"
                label
            >
              {{ type.label }}
            </v-chip>

            <v-chip
                v-if="status"
                size="x-small"
                :color="status === 'officiel' ? 'success' : 'warning'"
                variant="outlined"
            >
              {{ status === 'officiel' ? 'Officiel' : 'DIY' }}
            </v-chip>

            <span
                v-if="item.creator"
                class="text-caption text-medium-emphasis"
            >
              · {{ item.creator }}
            </span>
          </div>
        </div>
      </template>

      <template #append>
        <v-btn icon variant="text" color="primary">
          <v-icon>mdi-chevron-right</v-icon>
        </v-btn>
      </template>
    </v-list-item>
  </div>
</template>

<style scoped>
.item-wrapper {
  background: rgb(var(--v-theme-surface)); /* même fond que v-main */
  border-radius: 14px;
  padding: 12px 4px;
  margin-bottom: 16px;

  /* ombre matérielle */
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.06);
  transition: box-shadow 0.2s ease, transform 0.1s ease;
}

.item-wrapper:hover {
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.10);
  transform: translateY(-2px);
}

.item-wrapper::after {
  display: none !important;
}

/* Empêche v-list d’ajouter ses séparateurs */
:deep(.v-list-item--nav:not(:last-child)) {
  border-bottom: none !important;
}

:deep(.v-list-item) {
  border-bottom: none !important;
}
</style>
