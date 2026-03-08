import axios from 'axios'
import { getAuthHeaders, getUrl } from '@/utils/utils.js'

/**
 * Добавление товар в избранный
 */
export const addToFavorites = (item) => {
  return axios.post(`${getUrl()}/favorites/${item.id}`, null, getAuthHeaders())
}

/**
 * Получение всех избранных товаров
 */
export const getAllFavorites = () => {
  return axios.get(`${getUrl()}/favorites`, getAuthHeaders())
}
