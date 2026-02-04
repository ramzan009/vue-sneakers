<template>
  <div>
    <h2 class="text-3xl mb-8 font-bold">Мои закладки</h2>

    <CardList :items="favorites" is-favorites></CardList>
  </div>
</template>

<script setup>
import { onMounted, ref } from 'vue'
import axios from 'axios'
import CardList from '@/components/CardList.vue'

const favorites = ref([])

onMounted(async () => {
  try {
    const { data } = await axios.get('http://localhost:8000/api/favorites', {
      headers: {
        Authorization: `Bearer ${localStorage.getItem('token')}`,
      },
    })

    favorites.value = data
  } catch (err) {
    console.log(err)
  }
})
</script>

<style scoped></style>
