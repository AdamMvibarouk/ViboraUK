document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("login-form");
  const messageEl = document.getElementById("login-message");

  form.addEventListener("submit", async (event) => {
    event.preventDefault();

    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value;

    if (!email || !password) {
      show("Please enter email and password.", "red");
      return;
    }

    try {
      await loginUser({ email, password });
      show("Login successful!", "green");
      setTimeout(() => (window.location.href = "account.html"), 1000);
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