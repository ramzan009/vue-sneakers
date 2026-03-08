import { getAuthHeaders, getUrl } from '@/utils/utils.js'
import axios from 'axios'

/**
 * Добавить товар в корзину
 */
export const addToCarts = (item) => {
  return axios.post(`${getUrl()}/cart/${item.id}`, null, getAuthHeaders())
}
