document.addEventListener("DOMContentLoaded", () => {
const chatToggle = document.getElementById("chat-toggle");
const chatWindow = document.getElementById("chat-window");
const chatClose = document.getElementById("chat-close");
const chatSend = document.getElementById("chat-send");
const chatInput = document.getElementById("chat-input");
const chatMessages = document.getElementById("chat-messages");

if (!chatToggle || !chatWindow) {
console.error("Chatbot elements not found.");
return;
}

chatToggle.addEventListener("click", () => {
chatWindow.classList.toggle("hidden");
});

if (chatClose) {
chatClose.addEventListener("click", () => {
chatWindow.classList.add("hidden");
});
}

function addMessage(text, sender = "bot") {
if (!chatMessages) return;

const msg = document.createElement("div");
msg.className = `chat-message ${sender}`;
msg.textContent = text;
chatMessages.appendChild(msg);
chatMessages.scrollTop = chatMessages.scrollHeight;
}

async function sendMessage() {
if (!chatInput) return;

const message = chatInput.value.trim();
if (!message) return;

addMessage(message, "user");
chatInput.value = "";

try {
const res = await fetch("/api/chat", {
method: "POST",
headers: {
"Content-Type": "application/json",
"Accept": "application/json",
"X-CSRF-TOKEN": document
.querySelector('meta[name="csrf-token"]')
?.getAttribute("content") || ""
},
credentials: "same-origin",
body: JSON.stringify({ message })
});

const data = await res.json();
addMessage(data.reply || "Sorry, I couldn't process that.", "bot");
} catch (error) {
console.error("Chatbot error:", error);
addMessage("Sorry, there was a problem connecting to the chatbot.", "bot");
}
}

if (chatSend) {
chatSend.addEventListener("click", sendMessage);
}

if (chatInput) {
chatInput.addEventListener("keypress", (e) => {
if (e.key === "Enter") {
e.preventDefault();
sendMessage();
}
});
}
});
