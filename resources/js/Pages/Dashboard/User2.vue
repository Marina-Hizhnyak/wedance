<script setup>
import BaseLayout from '@/Layouts/BaseLayout.vue'
import { ref } from 'vue'
import { usePage } from '@inertiajs/vue3'
import { router } from '@inertiajs/vue3'


defineOptions({ layout: BaseLayout })

const props = defineProps({
  user: Object,
  courses: Array,
})

// Управляем вкладками в личном кабинете
const currentTab = ref('profile')

// ✅ Переносим сюда функцию
function tabBtn(tab) {
  return [
    'block w-full text-left px-4 py-2 rounded-lg font-bold transition',
    tab === currentTab.value
      ? 'bg-primary text-black'
      : 'hover:bg-secondary text-white',
  ].join(' ')
}

const formatDate = (date) => {
  if (!date) return '';
  return new Date(date).toLocaleDateString('fr-FR', {
    day: '2-digit',
    month: '2-digit',
    year: 'numeric',
  });
}


const isEditing = ref(false)

// Поля для формы редактирования
const form = ref({
  name: props.user.name,
  email: props.user.email,
})

// Функция сохранить изменения
const saveProfile = () => {
  const payload = new FormData()
  payload.append('_method', 'put')
  payload.append('name', form.value.name)
  payload.append('email', form.value.email)
  if (form.value.photo) {
    payload.append('photo', form.value.photo)
  }

  router.post('/dashboard/profile', payload, {
    preserveScroll: true,
    forceFormData: true,
    onSuccess: () => {
      isEditing.value = false
      previewPhoto.value = null

      // 🔁 Обновляем данные пользователя с сервера
      router.reload({
        only: ['user'],
        preserveScroll: true,
      })
    }
  })
}


const previewPhoto = ref(null)


const handlePhotoChange = (event) => {
  const file = event.target.files[0]
  if (file) {
    form.value.photo = file
    previewPhoto.value = URL.createObjectURL(file)
  }
}

</script>




<template>
  <div class="min-h-screen bg-gradient-to-b from-[#1a0a05] to-background text-white font-inter">
    <div class="flex">
      <!-- Боковая панель -->
      <aside class="w-64 min-h-screen bg-[#121212] p-6 space-y-6 sticky top-0">
        <div class="text-2xl font-title font-bold text-primary">Mon Espace</div>

        <nav class="space-y-2">
          <button @click="currentTab = 'profile'" :class="tabBtn('profile')">👤 Profil</button>
          <button @click="currentTab = 'courses'" :class="tabBtn('courses')">🎓 Mes cours</button>
          <button @click="currentTab = 'favorites'" :class="tabBtn('favorites')">⭐ Favoris</button>
          <button @click="currentTab = 'history'" :class="tabBtn('history')">📜 Historique</button>
        </nav>
      </aside>

      <!-- Контент -->
      <main class="flex-1 p-10 space-y-6">

        <div v-if="currentTab === 'profile'">
        <h1 class="text-3xl font-bold text-primary mb-12">Bienvenue, {{ user.name }}</h1>

        <div class="flex items-center space-x-6 mb-6">
            <!-- Фото профиля -->
            <img
            v-if="user.profile_photo_url"
            :src="user.profile_photo_url"
            alt="Photo de profil"
            class="w-24 h-24 rounded-full border-2 border-primary"
            />

            <div class="text-white">
            <p class="text-lg m-4"><strong>Email :</strong> {{ user.email }}</p>
            <p class="text-lg m-4"><strong>Date d'inscription :</strong> {{ formatDate(user.created_at) }}</p>
            </div>
        </div>

        <!-- Кнопка Modifier -->
        <div v-if="!isEditing">
            <button
            @click="isEditing = true"
            class="px-5 py-2 bg-primary text-black font-bold rounded-full hover:bg-secondary transition mt-12"
            >
            Modifier mon profil
            </button>
        </div>

        <!-- Форма редактирования -->
        <div v-else class="space-y-4" enctype="multipart/form-data">
        <div>
            <label class="block mb-1 text-sm">Nom</label>
            <input v-model="form.name" type="text" class="w-[30%] px-4 py-2 rounded bg-background border" />
        </div>

        <div>
            <label class="block mb-1 text-sm">Email</label>
            <input v-model="form.email" type="email" class="w-[30%] px-4 py-2 rounded bg-background border" />
        </div>

        <div>
            <label class="block mb-1 text-sm">Photo de profil</label>
            <input type="file" @change="handlePhotoChange" class="w-[30%] px-4 py-2 rounded bg-background border" />
            <img
            v-if="previewPhoto"
            :src="previewPhoto"
            alt="Photo preview"
            class="w-24 h-24 rounded-full border-2 border-primary"
            />

            <img
            v-else-if="user.profile_photo_url"
            :src="user.profile_photo_url"
            alt="Photo de profil"
            class="w-24 h-24 rounded-full border-2 border-primary"
            />

        </div>

        <div class="flex space-x-4 mt-4">
            <button
            @click="saveProfile"
            class="px-5 py-2 bg-primary text-black font-bold rounded-full hover:bg-secondary transition"
            >
            Enregistrer
            </button>

            <button
            @click="isEditing = false"
            class="px-5 py-2 bg-gray-600 text-white font-bold rounded-full hover:bg-gray-400 transition"
            >
            Annuler
            </button>
        </div>
        </div>

        </div>



        <div v-if="currentTab === 'courses'">
        <h1 class="text-3xl font-bold text-primary mb-4">Mes cours</h1>

        <div v-if="courses.length" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div
            v-for="course in courses"
            :key="course.id"
            class="bg-background rounded-2xl overflow-hidden shadow-md hover:shadow-lg transition-shadow border border-primary"
            >
            <img :src="`/storage/${course.image}`" alt="course image" class="w-full h-48 object-cover" />

            <div class="p-5">
                <h2 class="text-xl font-semibold text-[#121212] mb-2">{{ course.title }}</h2>
                <p class="text-gray-600 text-sm">{{ course.description }}</p>

                <div class="mt-4 flex flex-col gap-1 text-sm text-gray-500">
                <span><strong>Durée:</strong> {{ course.duration }}</span>
                <span><strong>Jour:</strong> {{ course.day_time }}</span>
                <span><strong>Prix:</strong> {{ course.price }} €</span>
                <span v-if="course.level"><strong>Niveau:</strong> {{ course.level.name }}</span>
                </div>
            </div>
            </div>
        </div>

        <div v-else class="text-center text-gray-400 mt-10">
            Vous n'êtes inscrit à aucun cours pour le moment.
        </div>
        </div>


        <div v-if="currentTab === 'favorites'">
          <h1 class="text-3xl font-bold text-primary mb-4">Mes favoris</h1>
          <!-- Контент избранного -->
        </div>

        <div v-if="currentTab === 'history'">
          <h1 class="text-3xl font-bold text-primary mb-4">Historique</h1>
          <!-- Контент истории -->
        </div>
      </main>
    </div>
  </div>
</template>
