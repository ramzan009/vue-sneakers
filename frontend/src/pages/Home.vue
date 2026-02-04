<template>
  <div class="flex justify-between items-center">
    <h2 class="text-3xl mb-8 font-bold">Все кроссовки</h2>

    <div class="flex gap-4">
      <select @change="onChangeSelect" class="py-2 px-3 border rounded-md outline-none">
        <option value="name">По названию</option>
        <option value="price">По цене (дешевые)</option>
        <option value="-price">По цене (дорогие)</option>
      </select>

      <div class="relative">
        <img class="absolute left-4 top-3" src="/search.svg" alt="Search" />
        <input
          @input="onChangeSearchInput"
          class="border rounded-md py-2 pl-10 pr-4 outline-none"
          placeholder="Поиск..."
          type="text"
        />
      </div>
    </div>
  </div>

  <div class="mt-10">
    <CardList
      :items="items"
      @add-to-favorite="addToFavorite"
      @add-to-cart="onClickAddPlus"
    ></CardList>
  </div>
</template>

<script setup>
import CardList from '@/components/CardList.vue'
import axios from 'axios'
import { inject, onMounted, watch } from 'vue'
import { reactive, ref } from 'vue'

const items = ref([])

const { cart } = inject('cart')

const filters = reactive({
  sortBy: 'title',
  searchQuery: '',
})

const addToFavorite = async (item) => {
  try {
    const { data } = await axios.post(`http://localhost:8000/api/favorites/${item.id}`, null, {
      headers: {
        Authorization: `Bearer ${localStorage.getItem('token')}`,
      },
    })

    item.isFavorite = data.favorited
  } catch (err) {
    console.log(err.response?.data)
  }
}

const fetchItems = async () => {
  try {
    const params = {
      sortBy: filters.sortBy,
    }

    if (filters.searchQuery) {
      params.title = `*${filters.searchQuery}*`
    }

    const { data } = await axios.get(`http://localhost:8000/api/product`, {
      params,
      headers: { Authorization: `Bearer ${localStorage.getItem('token')}` },
    })

    items.value = data.map((obj) => ({
      ...obj,
      isFavorite: false,
      isAdded: false,
    }))
  } catch (err) {
    console.log(err)
  }
}

const fetchFavorites = async () => {
  try {
    const { data } = await axios.get('http://localhost:8000/api/favorites', {
      headers: {
        Authorization: `Bearer ${localStorage.getItem('token')}`,
      },
    })

    items.value = items.value.map((item) => ({
      ...item,
      isFavorite: data.some((fav) => fav.id === item.id),
    }))
  } catch (err) {
    console.log(err.response?.data)
  }
}

const loadCart = async () => {
  try {
    const { data } = await axios.get('http://localhost:8000/api/cart', {
      headers: {
        Authorization: `Bearer ${localStorage.getItem('token')}`,
      },
    })

    cart.value = data.map((item) => ({
      ...item,
      isAdded: true,
    }))
  } catch (err) {
    console.log(err)
  }
}

onMounted(async () => {
  await loadCart()
  await fetchItems()
  await fetchFavorites()

  items.value = items.value.map((item) => ({
    ...item,
    isAdded: cart.value.some((cartItem) => cartItem.id === item.id),
  }))
})

const onChangeSearchInput = (event) => {
  filters.searchQuery = event.target.value
}

const onClickAddPlus = async (item) => {
  if (item.isAdded) return
  try {
    await axios.post(`http://localhost:8000/api/cart/${item.id}`, null, {
      headers: {
        Authorization: `Bearer ${localStorage.getItem('token')}`,
      },
    })

    item.isAdded = true
    cart.value.push(item)
  } catch (err) {
    console.log(err)
  }
}

const onChangeSelect = (event) => {
  filters.sortBy = event.target.value
}

watch(cart, () => {
  items.value = items.value.map((item) => ({
    ...item,
    isAdded: cart.value.some((cartItem) => cartItem.id === item.id),
  }))
})

watch(filters, fetchItems)
</script>

<style scoped></style>
