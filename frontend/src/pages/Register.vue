<template>
  <div class="flex justify-center items-center h-screen bg-gray-100">
    <div class="bg-white p-8 rounded shadow-md w-96">
      <h1 class="text-2xl font-bold mb-8 text-center">Регистрация</h1>
      <div class="mb-4">
        <span v-if="errors.name" class="text-xs text-red-500">
          {{ errors.name }}
        </span>
        <input
          v-model="user.name"
          @input="clearError('name')"
          type="text"
          placeholder="Имя"
          class="w-full p-2 border rounded"
        />
      </div>
      <div class="mb-4">
        <span v-if="errors.email" class="text-xs text-red-500">
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
      <div class="mb-5">
        <span v-if="errors.passwordConfirm" class="text-xs text-red-500">
          {{ errors.passwordConfirm }}
        </span>
        <input
          v-model="user.passwordConfirm"
          @input="clearError('passwordConfirm')"
          type="password"
          placeholder="Подтвердите пароль"
          class="w-full p-2 border rounded"
        />
      </div>
      <div class="mb-7">
        <button
          @click.prevent="register"
          class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600"
        >
          Зарегистрироваться
        </button>
      </div>
      <div class="text-center">
        <router-link :to="{ name: 'Login' }">
          <span
            >У вас есть аккаунт? <b class="text-blue-500 cursor-pointer">Авторизоваться</b></span
          >
        </router-link>
      </div>
    </div>
  </div>
</template>

<script setup>
import { reactive } from 'vue'
import { useRouter } from 'vue-router'
import { registerRequest, setToken } from '@/api/auth.js'

const router = useRouter()

const errors = reactive({
  name: '',
  email: '',
  password: '',
  passwordConfirm: '',
})

const user = reactive({
  name: '',
  email: '',
  password: '',
  passwordConfirm: '',
})

const register = async () => {
  errors.name = ''
  errors.email = ''
  errors.password = ''
  errors.passwordConfirm = ''

  if (!user.name) {
    errors.name = 'Имя обязателен'
  }

  if (!user.email) {
    errors.email = 'Почта обязателен'
  }

  if (!user.password) {
    errors.password = 'Пароль обязателен'
  }

  if (user.password && user.password.length < 8) {
    errors.password = 'Пароль должен быть минимум 8 символов'
  }

  if (!user.passwordConfirm) {
    errors.passwordConfirm = 'Подтвердите пароль'
  }

  if (user.password && user.passwordConfirm && user.password !== user.passwordConfirm) {
    errors.passwordConfirm = 'Пароли не совпадают'
  }

  if (errors.name || errors.email || errors.password || errors.passwordConfirm) {
    return
  }

  try {
    const { data } = await registerRequest(user)

    setToken(data.token)

    router.push('/')
  } catch (err) {
    if (err.response && err.response.data) {
      console.log(err.response.data)
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
