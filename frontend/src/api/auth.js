import axios from 'axios'
import { getUrl } from '@/utils/utils.js'

const TOKEN_KEY = 'token'

/**
 * Запрос на авторизацию пользователя.
 */
export const loginRequest = (user) => {
  return axios.post(`${getUrl()}/login`, {
    email: user.email.trim(),
    password: user.password.trim(),
  })
}

/**
 * Запрос на регистрацию пользователя.
 */
export const registerRequest = (user) => {
  return axios.post(`${getUrl()}/register`, {
    name: user.name,
    email: user.email,
    password: user.password,
  })
}

/**
 * Удаляет токен авторизации из localStorage.
 */
export const removeToken = () => {
  localStorage.removeItem(TOKEN_KEY)
}

/**
 * Сохраняет токен авторизации в localStorage.
 */
export const setToken = (token) => {
  localStorage.setItem(TOKEN_KEY, token)
}

/**
 * Возвращает сохранённый токен авторизации.
 */
export const getToken = () => {
  return localStorage.getItem(TOKEN_KEY)
}
