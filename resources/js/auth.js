// auth.js

/**
 * Vérifie si un token est expiré
 */
// export function isTokenExpired(token) {
//     if (!token) return true;

//     try {
//         const payload = JSON.parse(atob(token.split('.')[1]));
//         const now = Date.now() / 1000;
//         return payload.exp < now;
//     } catch (e) {
//         console.error("Token invalide :", e);
//         return true;
//     }
// }

/**
 * Récupère un token valide : le token actuel ou un nouveau via refresh
 */
// export async function getValidToken() {
//     let token = localStorage.getItem('accessToken');

//     if (!token || isTokenExpired(token)) {
//         console.log("🔄 Token expiré, tentative de refresh...");
//         try {
//             const response = await fetch('http://localhost:3000/auth/refresh-token', {
//                 method: 'POST',
//                 credentials: 'include',
//             });

//             if (!response.ok) throw new Error('Échec du refresh');

//             const data = await response.json();
//             localStorage.setItem('accessToken', data.accessToken);
//             return data.accessToken;
//         } catch (err) {
//             console.error("❌ Échec du refresh", err);
//             localStorage.removeItem('accessToken');
//             window.location.href = '/login';
//             return null;
//         }
//     }

//     return token;
// }

/**
 * Utilise ce helper pour faire des requêtes protégées avec token valide
 */
// export async function apiFetch(url, options = {}) {
//     const token = await getValidToken();
//     if (!token) return;

//     return fetch(url, {
//         ...options,
//         headers: {
//             ...options.headers,
//             Authorization: `Bearer ${token}`,
//         },
//     });
// }

// Utiliser getValidToken() avant chaque appel API
