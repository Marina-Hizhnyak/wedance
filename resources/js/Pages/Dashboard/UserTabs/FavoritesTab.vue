<script setup>
import { computed } from 'vue'
import { Link } from '@inertiajs/vue3'   // Inertia Link

// Get favorites from parent props
const props = defineProps({
  favorites: Array
})

// Computed to check if there are favorites
const hasFavorites = computed(() => props.favorites.length > 0)

// Date formatting helper
const formatDate = (date) => {
  if (!date) return ''
  return new Date(date).toLocaleDateString('fr-FR', {
    day: '2-digit',
    month: '2-digit',
    year: 'numeric'
  })
}
</script>

<template>
  <div>
    <h1 class="text-3xl font-bold text-primary mb-4">Mes favoris</h1>

    <!-- Favorites grid -->
    <div v-if="hasFavorites" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
      <!-- Loop all favorites -->
      <div
        v-for="favorite in favorites"
        :key="favorite.id"
        class="bg-background rounded-2xl overflow-hidden shadow-md hover:shadow-lg transition-shadow border border-primary"
      >
        <!-- Optional image -->
        <img
          v-if="favorite.likeable?.image"
          :src="`/storage/${favorite.likeable.image}`"
          alt="Favorite image"
          class="w-full h-48 object-cover"
        />

        <div class="p-5">
          <!-- Title -->
          <h2 class="text-xl font-semibold text-white mb-2">
            {{ favorite.likeable?.title ?? 'Élément inconnu' }}
          </h2>

          <!-- Content (use v-html for BlogPost content) -->
          <div v-if="favorite.likeable?.content" class="text-gray-600 text-sm line-clamp-3" v-html="favorite.likeable.content"></div>

          <!-- Description fallback -->
          <p v-else class="text-gray-600 text-sm">
            {{ favorite.likeable?.description ?? 'Aucune description disponible.' }}
          </p>

          <!-- Type badge + optional price -->
          <div class="mt-4 flex items-center justify-between text-sm text-gray-500">
            <span
              class="inline-flex items-center bg-primary text-black font-bold text-xs uppercase px-2 py-1 rounded"
            >
              <template v-if="favorite.likeable_type?.includes('Course')">
                🎓 Cours
              </template>
              <template v-else-if="favorite.likeable_type?.includes('BlogPost')">
                📝 Article de blog
              </template>
              <template v-else-if="favorite.likeable_type?.includes('Event')">
                📅 Événement
              </template>
              <template v-else>
                ❓ Inconnu
              </template>
            </span>

            <!-- Price if exists -->
            <span v-if="favorite.likeable?.price" class="ml-2">
              {{ favorite.likeable.price }} €
            </span>
          </div>

          <!-- Event date if it's Event -->
          <p
            v-if="favorite.likeable_type?.includes('Event') && favorite.likeable?.date"
            class="text-xs text-gray-400 mt-2"
          >
            Date de l’événement  {{ formatDate(favorite.likeable.date) }}
          </p>

          <!-- Liked at date -->
          <p class="text-xs text-gray-400 mt-2">
            Vous avez ajouté ce
            <template v-if="favorite.likeable_type?.includes('Course')">cours</template>
            <template v-else-if="favorite.likeable_type?.includes('BlogPost')">article</template>
            <template v-else-if="favorite.likeable_type?.includes('Event')">événement</template>
            <template v-else>élément</template>
            le {{ formatDate(favorite.created_at) }}
          </p>

          <!-- Link to BlogPost if it's a BlogPost -->
          <Link
            v-if="favorite.likeable_type?.includes('BlogPost') && favorite.likeable?.slug"
            :href="`/blog/${favorite.likeable.slug}`"
            class="inline-block mt-3 text-primary hover:underline"
          >
            🔗 Voir l’article
          </Link>
        </div>
      </div>
    </div>

    <!-- No favorites -->
    <div v-else class="text-center text-gray-400 mt-10">
     Vous n’avez encore rien ajouté à vos favoris.
    </div>
  </div>
</template>
