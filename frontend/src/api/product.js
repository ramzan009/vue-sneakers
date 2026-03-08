import axios from 'axios'
import { getAuthHeaders, getUrl } from '@/utils/utils.js'

/**
 * Получить список товаров с фильтрацией и пагинацией
 */
export const getAllProducts = (params) => {
  return axios.get(`${getUrl()}/product`, getAuthHeaders(params))
}
