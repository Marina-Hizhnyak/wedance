<template>
  <div>
    <h1 class="text-3xl font-bold text-primary mb-4">Cours</h1>

    <!-- Bouton Ajouter un cours -->
    <div class="flex justify-end mb-4">
      <button
        @click="openCreateCourseForm"
        class="px-4 py-2 bg-primary text-background font-bold rounded hover:bg-secondary"
      >
        ➕ Ajouter un cours
      </button>
    </div>

    <!-- Table des cours -->
    <div class="overflow-x-auto">
      <table class="min-w-full table-auto bg-background border border-primary rounded-lg mb-6">
        <thead class="bg-[#1f1f1f] text-left text-white">
          <tr>
            <th class="px-4 py-2 border-b border-primary">Titre</th>
            <th class="px-4 py-2 border-b border-primary">Durée</th>
            <th class="px-4 py-2 border-b border-primary">Jour/Heure</th>
            <th class="px-4 py-2 border-b border-primary">Prix</th>
            <th class="px-4 py-2 border-b border-primary">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="(course, index) in courses"
            :key="course.id"
            :class="[
                'hover:bg-[#2a2a2a] text-gray-100',
                index === courses.length - 1 ? 'border-b border-primary' : 'border-b border-[#333]'
            ]"
            >
            <td class="px-4 py-2">{{ course.title }}</td>
            <td class="px-4 py-2">{{ course.duration }}</td>
            <td class="px-4 py-2">{{ course.day_time }}</td>
            <td class="px-4 py-2">{{ course.price }} €</td>
            <td class="px-4 py-2 space-x-2">
              <button @click="openEditCourseForm(course)" class="px-3 py-1 text-sm font-bold bg-primary text-black rounded hover:bg-secondary">Éditer</button>
              <button @click="deleteCourse(course.id)" class="px-3 py-1 text-sm font-bold bg-accent text-white rounded hover:bg-secondary">Supprimer</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Formulaire -->
    <form
      v-if="isCreatingCourse || isEditingCourse"
      ref="courseFormSection"
      @submit.prevent="saveCourse"
      class="scroll-mt-36 bg-[#1e1e1e] p-6 rounded-lg border border-primary max-w-xl mb-10"
    >
      <h2 class="text-xl font-bold mb-4 text-primary">{{ isEditingCourse ? 'Modifier' : 'Ajouter' }} un cours</h2>

      <div class="mb-4">
        <label class="block text-sm mb-1">Titre</label>
        <input v-model="courseForm.title" type="text" class="w-full px-4 py-2 rounded bg-background border focus:outline-none focus:ring-0 focus:border-primary" />
      </div>

      <div class="mb-4">
        <label class="block text-sm mb-1">Description</label>
        <textarea v-model="courseForm.description" class="w-full px-4 py-2 rounded bg-background border focus:outline-none focus:ring-0 focus:border-primary"></textarea>
      </div>

      <div class="mb-4">
        <label class="block text-sm mb-1">Enseignant</label>
        <select v-model="courseForm.instructor_id" class="w-full px-4 py-2 rounded bg-background border focus:outline-none focus:ring-0 focus:border-primary">
          <option v-for="teacher in teachers" :key="teacher.id" :value="teacher.id">
            {{ teacher.name }}
          </option>
        </select>
      </div>

      <div class="mb-4">
        <label class="block text-sm mb-1">Catégorie</label>
        <select v-model="courseForm.course_category_id" class="w-full px-4 py-2 rounded bg-background border focus:outline-none focus:ring-0 focus:border-primary">
          <option v-for="cat in categories" :key="cat.id" :value="cat.id">
            {{ cat.name }}
          </option>
        </select>
      </div>

      <div class="mb-4">
        <label class="block text-sm mb-1">Niveau</label>
        <select v-model="courseForm.course_level_id" class="w-full px-4 py-2 rounded bg-background border focus:outline-none focus:ring-0 focus:border-primary">
          <option v-for="lvl in levels" :key="lvl.id" :value="lvl.id">
            {{ lvl.name }}
          </option>
        </select>
      </div>

      <div class="mb-4">
        <label class="block text-sm mb-1">Image</label>
        <input type="file" @change="handleImageChange" class="w-full px-4 py-2 rounded bg-background border text-white focus:outline-none focus:ring-0 focus:border-primary" />
        <div v-if="previewImage" class="mt-2">
          <img :src="previewImage" alt="Preview" class="h-24 object-cover" />
        </div>
      </div>

      <div class="mb-4">
        <label class="block text-sm mb-1">Durée</label>
        <input v-model="courseForm.duration" type="text" class="w-full px-4 py-2 rounded bg-background border focus:outline-none focus:ring-0 focus:border-primary" />
      </div>

      <div class="mb-4">
        <label class="block text-sm mb-1">Jour/Heure</label>
        <input v-model="courseForm.day_time" type="text" class="w-full px-4 py-2 rounded bg-background border focus:outline-none focus:ring-0 focus:border-primary" />
      </div>

      <div class="mb-4">
        <label class="block text-sm mb-1">Prix (€)</label>
        <input v-model="courseForm.price" type="number" class="w-full px-4 py-2 rounded bg-background border focus:outline-none focus:ring-0 focus:border-primary" />
      </div>

      <div class="flex justify-end space-x-4">
        <button type="button" @click="cancelCourseForm" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-400">Annuler</button>
        <button type="submit" class="px-4 py-2 bg-primary text-black font-bold rounded hover:bg-secondary">
          {{ isEditingCourse ? 'Enregistrer' : 'Créer' }}
        </button>
      </div>
    </form>
  </div>
</template>


<script setup>
import { ref, nextTick } from 'vue'
import { router } from '@inertiajs/vue3'

const props = defineProps({
  courses: Array,
  teachers: Array,
  categories: Array,
  levels: Array,
})

const isCreatingCourse = ref(false)
const isEditingCourse = ref(false)
const courseFormSection = ref(null)
const previewImage = ref(null)

const courseForm = ref({
  id: null,
  title: '',
  description: '',
  price: '',
  duration: '',
  day_time: '',
  image: null,
  instructor_id: null,
  course_category_id: null,
  course_level_id: null,
})

const resetCourseForm = () => {
  courseForm.value = {
    id: null,
    title: '',
    description: '',
    price: '',
    duration: '',
    day_time: '',
    image: null,
    instructor_id: null,
    course_category_id: null,
    course_level_id: null,
  }
  previewImage.value = null
}

const openCreateCourseForm = () => {
  resetCourseForm()
  isCreatingCourse.value = true
  isEditingCourse.value = false
  nextTick(() => {
    courseFormSection.value?.scrollIntoView({ behavior: 'smooth', block: 'start' })
  })
}

const openEditCourseForm = (course) => {
  courseForm.value = {
    ...course,
    image: null,
  }
  previewImage.value = course.image ? `/storage/${course.image}` : null
  isEditingCourse.value = true
  isCreatingCourse.value = false
  nextTick(() => {
    courseFormSection.value?.scrollIntoView({ behavior: 'smooth', block: 'start' })
  })
}

const cancelCourseForm = () => {
  resetCourseForm()
  isCreatingCourse.value = false
  isEditingCourse.value = false
}

const handleImageChange = (event) => {
  const file = event.target.files[0]
  if (file) {
    courseForm.value.image = file
    previewImage.value = URL.createObjectURL(file)
  }
}

const saveCourse = () => {
  const formData = new FormData()
  for (const key in courseForm.value) {
    if (courseForm.value[key] !== null) {
      formData.append(key, courseForm.value[key])
    }
  }

  if (courseForm.value.image instanceof File) {
    formData.append('image', courseForm.value.image)
  }

  if (isEditingCourse.value) {
    formData.append('_method', 'PUT')
    router.post(`/admin/courses/${courseForm.value.id}`, formData, {
      preserveScroll: true,
      forceFormData: true,
      onSuccess: cancelCourseForm,
    })
  } else {
    router.post('/admin/courses', formData, {
      preserveScroll: true,
      forceFormData: true,
      onSuccess: cancelCourseForm,
    })
  }
}

const deleteCourse = (id) => {
  if (confirm('Voulez-vous vraiment supprimer ce cours ?')) {
    router.delete(`/admin/courses/${id}`, {
      preserveScroll: true,
    })
  }
}
</script>
