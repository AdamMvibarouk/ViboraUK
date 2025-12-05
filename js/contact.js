const API_BASE = "http://localhost:5000";

document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("contact-form");
  if (!form) return;

  form.addEventListener("submit", async (e) => {
    e.preventDefault();

    const email = document.getElementById("email").value.trim();
    const message = document.getElementById("message").value.trim();

    if (!email || !message) {
      alert("Please fill in both email and message.");
      return;
    }

    try {
      const res = await fetch(`${API_BASE}/api/contact/submit`, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ email, message })
      });

      if (!res.ok) {
        const text = await res.text().catch(() => "");
        console.error("Contact response not ok:", res.status, text);
        alert("There was an error sending your enquiry. Please try again.");
        return;
      }

      const data = await res.json();
      alert(data.message || "Enquiry submitted.");
      form.reset();
    } catch (err) {
      console.error("Contact form error (fetch failed):", err);
      alert("There was an error sending your enquiry. Please try again.");
    }
  });
});
