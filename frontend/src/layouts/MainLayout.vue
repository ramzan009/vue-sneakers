<template>
  <Drawer v-if="drawerOpen" :total-price="totalPrice" :vat-price="vatPrice"></Drawer>

  <div class="bg-white w-4/5 m-auto rounded-xl shadow-xl mt-14">
    <Header @open-drawer="openDrawer" :total-price="totalPrice"></Header>

    <div class="p-10">
      <router-view></router-view>
    </div>
  </div>
</template>

<script setup>
import Header from '@/components/Header.vue'
import { computed, provide, ref, onMounted } from 'vue'
import Drawer from '@/components/Drawer.vue'
import { getAllCarts, removeCarts } from '@/api/cart.js'

/** Корзина **/
const cart = ref([])

const drawerOpen = ref(false)

const totalPrice = computed(() => cart.value.reduce((acc, item) => acc + item.price, 0))

const vatPrice = computed(() => Math.round((totalPrice.value * 5) / 100))

const closeDrawer = () => {
  drawerOpen.value = false
}
const openDrawer = () => {
  drawerOpen.value = true
}

const removeFromCart = async (item) => {
  try {
    await removeCarts(item)

    cart.value = cart.value.filter((cartItem) => cartItem.id !== item.id)

    item.isAdded = false
  } catch (err) {
    console.log(err)
  }
}

const fetchCart = async () => {
  try {
    const { data } = await getAllCarts()

    cart.value = data.carts.map((item) => ({
      ...item,
      isAdded: true,
    }))
  } catch (err) {
    console.log(err.response?.data)
  }
}

onMounted(fetchCart)

provide('cart', {
  cart,
  closeDrawer,
  openDrawer,
  removeFromCart,
})

/** Корзина (END) **/
</script>

<style scoped>
body {
  background-color: rgb(247 254 231);
}
</style>
