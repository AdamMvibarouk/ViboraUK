document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("login-form");
  const messageEl = document.getElementById("login-message");

  if (!form) return;

  form.addEventListener("submit", async (event) => {
    event.preventDefault();

    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value;

    if (!email || !password) {
      show("Please enter email and password.", "red");
      return;
    }

    try {
      const res = await fetch("http://localhost:5000/api/auth/login", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({ email, password }),
      });

      const data = await res.json();

      if (!res.ok) {
        show(data.message || "Login failed", "red");
        return;
      }

      if (data.token) {
        localStorage.setItem("token", data.token);
      }
      if (data.user) {
        localStorage.setItem("user", JSON.stringify(data.user));

        const nameCell = document.getElementById("acct-name");
        const emailCell = document.getElementById("acct-email");
        const phoneCell = document.getElementById("acct-phone");

        if (nameCell)
          nameCell.textContent = `${data.user.first_name} ${data.user.last_name}`;
        if (emailCell) emailCell.textContent = data.user.email;
        if (phoneCell) phoneCell.textContent = data.user.phone || "Not provided";
      }

      show("Login successful!", "green");
    } catch (err) {
      console.error("Login error:", err);
      show("Server error while logging in", "red");
    }
  });

  function show(text, color) {
    if (messageEl) {
      messageEl.textContent = text;
      messageEl.style.color = color;
    } else {
      alert(text);
    }
  }
});
