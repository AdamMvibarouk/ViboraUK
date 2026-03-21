document.addEventListener("DOMContentLoaded", () => {
    const chatToggle = document.getElementById("chat-toggle");
    const chatWindow = document.getElementById("chat-window");
    const chatClose = document.getElementById("chat-close");
    const chatSend = document.getElementById("chat-send");
    const chatInput = document.getElementById("chat-input");
    const chatMessages = document.getElementById("chat-messages");

    if (!chatToggle || !chatWindow || !chatClose || !chatSend || !chatInput || !chatMessages) {
        console.error("Chatbot elements not found.");
        return;
    }

    chatToggle.addEventListener("click", () => {
        chatWindow.classList.toggle("hidden");
    });

    chatClose.addEventListener("click", () => {
        chatWindow.classList.add("hidden");
    });

    function addMessage(text, type) {
        const msg = document.createElement("div");
        msg.classList.add("chat-message");
        msg.classList.add(type === "user" ? "user-message" : "bot-message");
        msg.textContent = text;
        chatMessages.appendChild(msg);
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    async function sendMessage() {
        const message = chatInput.value.trim();
        if (!message) return;

        addMessage(message, "user");
        chatInput.value = "";

        try {
            const response = await fetch("/api/chat", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({ message })
            });

            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }

            const data = await response.json();

            if (data.reply) {
                addMessage(data.reply, "bot");
            } else {
                addMessage("Sorry, I couldn't get a response.", "bot");
            }
        } catch (error) {
            console.error("Chat error:", error);
            addMessage("Server error. Please try again later.", "bot");
        }
    }

    chatSend.addEventListener("click", sendMessage);

    chatInput.addEventListener("keypress", (e) => {
        if (e.key === "Enter") {
            sendMessage();
        }
    });
});