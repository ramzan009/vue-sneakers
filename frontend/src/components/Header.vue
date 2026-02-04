<template>
  <header class="flex justify-between border-b border-slate-200 px-8 py-8">
    <router-link :to="{ name: 'Home' }">
      <div class="flex items-center gap-4">
        <img class="w-10" src="/logo.png" alt="Logo" />
        <div>
          <h2 class="text-xl font-bold uppercase">Vue sneakers</h2>
          <p class="text-slate-500">Магазин лучших кроссовок</p>
        </div>
      </div>
    </router-link>
    <ul class="flex items-center gap-10">
      <li
        @click="() => emit('openDrawer')"
        class="flex items-center gap-3 text-gray-500 cursor-pointer hover:text-black"
      >
        <img src="/cart.svg" alt="Cart" />
        <b>{{ totalPrice }} руб.</b>
      </li>

      <router-link :to="{ name: 'Favorites' }">
        <li class="flex items-center gap-3 text-gray-500 cursor-pointer hover:text-black">
          <img src="/heart.svg" alt="" />
          <span>Закладки</span>
        </li>
      </router-link>

      <li class="flex items-center gap-3 text-gray-500 cursor-pointer hover:text-black">
        <span @click="logout" class="cursor-pointer text-red-500">Выйти</span>
      </li>
    </ul>
  </header>
</template>

<script setup>
import { useRouter } from 'vue-router'

defineProps({
  totalPrice: Number,
})

const emit = defineEmits(['openDrawer'])

const router = useRouter()

const logout = () => {
  localStorage.removeItem('isAuth')
  router.push('/login')
}
</script>
