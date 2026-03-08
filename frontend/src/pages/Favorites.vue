<template>
  <div>
    <h2 class="text-3xl mb-8 font-bold">Мои закладки</h2>

    <CardList :items="favorites" is-favorites></CardList>
  </div>
</template>

<script setup>
import { onMounted, ref } from 'vue'
import CardList from '@/components/CardList.vue'
import { getAllFavorites } from '@/api/favorite.js'

const favorites = ref([])

onMounted(async () => {
  try {
    const { data } = await getAllFavorites()

    favorites.value = data
  } catch (err) {
    console.log(err)
  }
})
</script>

<style scoped></style>
