import { get, post } from "./httpClient"

export function login(credentials) {
    return post("/login", credentials)
}

export function getCurrentUser() {
    return get("/me")
}
