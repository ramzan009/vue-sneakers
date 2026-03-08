/**
 *  Возвращает базовый URL API.
 */
export const getUrl = () => {
  return 'http://localhost:8000/api'
}

/**
 * Добавляет JWT-токен в Authorization header (Bearer token).
 */
export const getAuthHeaders = (params) => {
  return {
    headers: {
      Authorization: `Bearer ${localStorage.getItem('token')}`,
    },
    params,
  }
}
