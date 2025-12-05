document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("signup-form");
  const messageEl = document.getElementById("signup-message");

  if (!form) return;

  form.addEventListener("submit", async (event) => {
    event.preventDefault();

    const first_name = document.getElementById("first_name").value.trim();
    const last_name = document.getElementById("last_name").value.trim();
    const email = document.getElementById("email").value.trim();
    const emailconfirm = document.getElementById("emailconfirm").value.trim();
    const password = document.getElementById("password").value;
    const passwordconfirm = document.getElementById("passwordconfirm").value;
    const phone = document.getElementById("phone")
      ? document.getElementById("phone").value.trim() || null
      : null;

    if (!first_name || !last_name || !email || !password) {
      show("Please fill in all required fields.", "red");
      return;
    }

    if (email !== emailconfirm) {
      show("Emails do not match.", "red");
      return;
    }

    if (password !== passwordconfirm) {
      show("Passwords do not match.", "red");
      return;
    }

    try {
      const res = await fetch("http://localhost:5000/api/auth/register", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({ first_name, last_name, email, password, phone }),
      });

      const data = await res.json();

      if (!res.ok) {
        show(data.message || "Signup failed", "red");
        return;
      }

      show("Account created! Redirecting...", "green");
      setTimeout(() => {
        window.location.href = "accountPage.html";
      }, 1000);
    } catch (err) {
      console.error("Signup error:", err);
      show("Server error while creating account", "red");
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
