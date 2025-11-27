import { get } from "./httpClient"

export function getHealth() {
    return get("/health")
}
