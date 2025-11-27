import { get, post, put, del } from "./httpClient"

export function getItems(params = {}) {
    // params pourra contenir type, domaine, etc quand on les aura
    return get("/items", params)
}

export function getItemById(id) {
    return get(`/items/${id}`)
}

export function createItem(payload) {
    return post("/items", payload)
}

export function updateItem(id, payload) {
    return put(`/items/${id}`, payload)
}

export function deleteItem(id) {
    return del(`/items/${id}`)
}
