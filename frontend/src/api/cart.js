import axios from 'axios'
import { getAuthHeaders, getUrl } from '@/utils/utils.js'

/**
 * Получить все товары из корзины
 */
export const getAllCarts = () => {
  return axios.get(`${getUrl()}/cart`, getAuthHeaders())
}

/**
 *  Удаление товара из корзины
 */
export const removeCarts = (item) => {
  return axios.delete(`${getUrl()}/cart/${item.id}`, getAuthHeaders())
}
