<template>
  <div class="flex justify-center items-center h-screen bg-gray-100">
    <div class="bg-white p-8 rounded shadow-md w-96">
      <h1 class="text-2xl font-bold mb-8 text-center">Логин</h1>
      <div class="mb-4">
        <span v-if="errors.email" class="text-red-500 text-xs">
          {{ errors.email }}
        </span>
        <input
          v-model="user.email"
          @input="clearError('email')"
          type="email"
          placeholder="Почта"
          class="w-full p-2 border rounded"
        />
      </div>
      <div class="mb-5">
        <span v-if="errors.password" class="text-xs text-red-500">
          {{ errors.password }}
        </span>
        <input
          v-model="user.password"
          @input="clearError('password')"
          type="password"
          placeholder="Пароль"
          class="w-full p-2 border rounded"
        />
      </div>
      <div class="mb-5 text-center text-sm">
        <b class="text-blue-500 cursor-pointer"> Забыли пароль?</b>
      </div>
      <div class="mb-10">
        <button
          @click.prevent="login"
          class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600"
        >
          Вход
        </button>
      </div>
      <div class="text-center">
        <router-link :to="{ name: 'Register' }">
          <span>У вас нет аккаунта? <a href="#" class="text-blue-500">Зарегистрируйтесь</a></span>
        </router-link>
      </div>
    </div>
  </div>
</template>

<script setup>
import { reactive } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'

const router = useRouter()

const user = reactive({
  email: '',
  password: '',
})

const errors = reactive({
  email: '',
  password: '',
})

const login = async () => {
  errors.email = ''
  errors.password = ''

  if (!user.email) errors.email = 'Почта обязателен'
  if (!user.password) errors.password = 'Пароль обязателен'
  if (errors.email || errors.password) return

  try {
    const response = await axios.post('http://localhost:8000/api/login', {
      email: user.email.trim(),
      password: user.password.trim(),
    })

    const data = response.data

    localStorage.setItem('token', data.token)
    localStorage.setItem('isAuth', 'true')

    router.push('/app')
  } catch (err) {
    if (err.response && err.response.status === 401) {
      errors.email = 'Неверная почта или пароль'
    } else {
      console.log(err)
    }
  }
}

const clearError = (field) => {
  errors[field] = ''
}
</script>

<style scoped></style>
