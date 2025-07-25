// file: public/js/custom-chat.js

// Notifikasi dengan SweetAlert dan Toastr
document.addEventListener("DOMContentLoaded", function () {
    const successMsg = document.querySelector(
        'meta[name="flash-success"]'
    )?.content;
    const errorMsg = document.querySelector(
        'meta[name="flash-error"]'
    )?.content;

    if (successMsg) {
        Swal.fire({
            title: "Berhasil!",
            text: successMsg,
            icon: "success",
        });
    }

    if (errorMsg) {
        toastr.options.closeButton = true;
        toastr.error(errorMsg, "Gagal!");
    }

    // Chat Box Functionality
    const token = document
        .querySelector('meta[name="csrf-token"]')
        ?.getAttribute("content");

    const openBtn = document.getElementById("customer-service-btn");
    const closeBtn = document.getElementById("close-chat");
    const sendBtn = document.getElementById("send-chat");
    const input = document.getElementById("chat-input");
    const chatBody = document.getElementById("chat-body");

    if (openBtn && closeBtn && sendBtn && input && chatBody) {
        openBtn.addEventListener("click", () => {
            document.getElementById("chat-box").style.display = "flex";
        });

        closeBtn.addEventListener("click", () => {
            document.getElementById("chat-box").style.display = "none";
        });

        sendBtn.addEventListener("click", async () => {
            const msg = input.value.trim();
            if (!msg) return;

            appendMessage("user", msg);
            input.value = "";

            const reply = await getBotReply(msg);
            appendMessage("bot", reply);
        });

        function appendMessage(sender, text) {
            const msgDiv = document.createElement("div");
            msgDiv.classList.add("chat-message", sender);

            const avatar = document.createElement("div");
            avatar.classList.add("chat-avatar");
            avatar.innerHTML =
                sender === "user"
                    ? '<i class="bi bi-person"></i>'
                    : '<i class="bi bi-headset"></i>';

            const bubble = document.createElement("div");
            bubble.classList.add("chat-bubble");
            bubble.textContent = text;

            if (sender === "user") {
                msgDiv.appendChild(bubble);
                msgDiv.appendChild(avatar);
            } else {
                msgDiv.appendChild(avatar);
                msgDiv.appendChild(bubble);
            }

            chatBody.appendChild(msgDiv);
            chatBody.scrollTop = chatBody.scrollHeight;
        }

        function getBotReply(message) {
            return fetch("/chatbot", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                    "X-CSRF-TOKEN": token,
                },
                body: JSON.stringify({ message }),
            })
                .then((res) => res.json())
                .then((data) => data.reply)
                .catch(() => "Oops! Failed to connect to support.");
        }
    }
});
