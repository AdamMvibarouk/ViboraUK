const API_BASE = "http://localhost:5000";

async function registerUser(data) {
  const res = await fetch(`${API_BASE}/api/auth/register`, {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(data),
  });

  const body = await res.json().catch(() => ({}));
  if (!res.ok) throw new Error(body.message || "Registration failed");
  return body;
}

async function loginUser(data) {
  const res = await fetch(`${API_BASE}/api/auth/login`, {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(data),
  });

  const body = await res.json().catch(() => ({}));
  if (!res.ok) throw new Error(body.message || "Login failed");

  if (body.token) localStorage.setItem("authToken", body.token);
  return body;
}

function getAuthToken() {
  return localStorage.getItem("authToken");
}