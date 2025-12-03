document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("signup-form");
  const messageEl = document.getElementById("signup-message");

  form.addEventListener("submit", async (event) => {
    event.preventDefault();

    const first_name = document.getElementById("first_name").value.trim();
    const last_name = document.getElementById("last_name").value.trim();
    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value;
    const phone = document.getElementById("phone").value.trim() || null;

    if (!first_name || !last_name || !email || !password) {
      show("Please fill in all required fields.", "red");
      return;
    }

    try {
      await registerUser({ first_name, last_name, email, password, phone });
      show("Account created! Redirecting...", "green");
      setTimeout(() => (window.location.href = "login.html"), 1000);
    } catch (err) {
      show(err.message, "red");
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