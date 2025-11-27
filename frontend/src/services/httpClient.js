const API_BASE_URL = import.meta.env.VITE_API_BASE_URL

function buildUrl(path, params) {
    const url = new URL(path, API_BASE_URL)

    if (params && typeof params === "object") {
        Object.entries(params).forEach(([key, value]) => {
            if (value !== undefined && value !== null) {
                url.searchParams.append(key, String(value))
            }
        })
    }

    return url.toString()
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

    // Ici tu peux gérer globalement les erreurs HTTP
    if (!response.ok) {
        let message = `Erreur HTTP ${response.status}`
        try {
            const data = await response.json()
            if (data && data.message) {
                message = data.message
            }
        } catch (e) {
            // on ignore si pas de JSON
        }
        throw new Error(message)
    }

    // Si pas de contenu, on renvoie null
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
