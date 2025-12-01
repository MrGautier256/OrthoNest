const API_BASE_URL = import.meta.env.VITE_API_BASE_URL ?? "http://localhost:8000/api"

function buildUrl(path = "", params) {

    const base = API_BASE_URL.replace(/\/+$/, "")        // enlève les / à la fin
    const cleanedPath = path.replace(/^\/+/, "")         // enlève les / au début

    let url = `${base}/${cleanedPath}`

    if (params && typeof params === "object") {
        const search = new URLSearchParams()
        Object.entries(params).forEach(([key, value]) => {
            if (value !== undefined && value !== null) {
                search.append(key, String(value))
            }
        })
        const qs = search.toString()
        if (qs) {
            url += `?${qs}`
        }
    }

    return url
}

async function request(path, { method = "GET", params, body, headers } = {}) {
    const url = buildUrl(path, params)

    const options = {
        method,
        headers: {
            "Content-Type": "application/json",
            ...(headers || {}),
        },
    }

    if (body !== undefined && body !== null) {
        options.body = JSON.stringify(body)
    }

    const response = await fetch(url, options)

    if (!response.ok) {
        let message = `Erreur HTTP ${response.status}`
        try {
            const data = await response.json()
            if (data && data.message) {
                message = data.message
            }
        } catch {
            // ignore
        }
        throw new Error(message)
    }

    if (response.status === 204) {
        return null
    }

    return response.json()
}

export function get(path, params) {
    return request(path, { method: "GET", params })
}

export function post(path, body) {
    return request(path, { method: "POST", body })
}

export function put(path, body) {
    return request(path, { method: "PUT", body })
}

export function del(path) {
    return request(path, { method: "DELETE" })
}

export { request }
