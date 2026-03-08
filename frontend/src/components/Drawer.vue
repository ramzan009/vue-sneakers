<template>
  <div class="fixed top-0 left-0 h-full w-full bg-black z-10 opacity-70"></div>
  <div class="bg-white w-96 h-full fixed right-0 top-0 z-20 p-8 flex flex-col">
    <DrawerHead />

    <div v-if="!totalPrice || orderId" class="flex h-full items-center">
      <InfoBlock
        v-if="totalPrice && !orderId"
        title="Корзина пустая"
        description="Добавьте хотя бы одну пару кроссовок, чтобы сделать заказ"
        imageUrl="/package-icon.png"
      ></InfoBlock>
      <InfoBlock
        v-if="orderId"
        title="Заказ оформлен!"
        :description="`Ваш заказ #${orderId} скоро будет передан курьерской доставке`"
        imageUrl="/order-success-icon.png"
      ></InfoBlock>
    </div>

    <CartItemList />

    <div v-if="totalPrice" class="flex flex-col gap-4 mt-auto">
      <div class="flex gap-2">
        <span>Итого:</span>
        <div class="flex-1 border-b border-dashed"></div>
        <b>{{ totalPrice }} ₽</b>
      </div>

      <div class="flex gap-2">
        <span>Налог 5%:</span>
        <div class="flex-1 border-b border-dashed"></div>
        <b>{{ vatPrice }} ₽</b>
      </div>

      <button
        :disabled="buttonDisabled"
        class="transition mt-7 bg-lime-500 w-full rounded-xl py-3 disabled:bg-slate-300 text-white hover:bg-lime-600 active:bg-lime-700"
        @click="createOrder"
      >
        Оформить заказ
      </button>
    </div>
  </div>
</template>

<script setup>
import DrawerHead from '@/components/DrawerHead.vue'
import CartItemList from '@/components/CartItemList.vue'
import InfoBlock from '@/components/InfoBlock.vue'
import { inject, ref, computed, onMounted } from 'vue'
import axios from 'axios'
import { getAuthHeaders, getUrl } from '@/utils/utils.js'
import { getAllCarts } from '@/api/cart.js'

const props = defineProps({
  totalPrice: Number,
  vatPrice: Number,
})

const isCreating = ref(false)

const { cart } = inject('cart')

const orderId = ref(null)

const cartIsEmpty = computed(() => cart.value.length === 0)

const buttonDisabled = computed(() => isCreating.value || cartIsEmpty.value)

const createOrder = async () => {
  try {
    isCreating.value = true

    const { data } = await axios.post(
      `${getUrl()}/order`,
      {
        items: cart.value,
        totalPrice: props.totalPrice.value,
      },
      getAuthHeaders(),
    )

    orderId.value = data.order_id
    cart.value = []
  } catch (err) {
    console.log(err)
  } finally {
    isCreating.value = false
  }
}

const loadCart = async () => {
  try {
    const { data } = await getAllCarts()

    cart.value = data.data.map((item) => ({
      ...item,
      isAdded: true,
    }))
  } catch (err) {
    console.log(err)
  }
}

onMounted(loadCart)
</script>

