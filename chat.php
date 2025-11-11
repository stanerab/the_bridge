<?php include("header.php"); ?>

<div class="container mt-4">
    <h3>Chat (Moods & Notes)</h3>
    <div id="chat-box" class="border rounded p-3" style="height:400px; overflow-y:auto; background:#f8f9fa;">
        <!-- Messages will load here -->
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function loadMessages() {
        const moodEmojis = {
            "Happy": "😊",
            "Sad": "😢",
            "Okay": "😐",
            "Angry": "😠",
            "Excited": "😃",
            "Tired": "😴"
        };

        const moodColors = {
            "Happy": "#FFF59D",
            "Sad": "#90CAF9",
            "Okay": "#E0E0E0",
            "Angry": "#EF9A9A",
            "Excited": "#FFCC80",
            "Tired": "#CE93D8"
        };

        $.get("fetch_chat.php", function (data) {
            let html = "";
            data.forEach(msg => {
                const emoji = moodEmojis[msg.mood] || "😐";
                const color = moodColors[msg.mood] || "#ffffff";

                html += `
                <div class="mb-3">
                    <div style="background:${color}; padding:10px; border-radius:15px; max-width:70%; box-shadow:0 1px 3px rgba(0,0,0,0.1);">
                        <div style="font-size:2rem;">${emoji}</div>
                        <strong>${msg.mood}</strong><br>
                        <span>${msg.note || "—"}</span><br>
                        <small class="text-muted">${msg.created_at}</small>
                    </div>
                </div>
                `;
            });
            $("#chat-box").html(html);
            $("#chat-box").scrollTop($("#chat-box")[0].scrollHeight);
        });
    }

    setInterval(loadMessages, 30000); // refresh every 30s
    loadMessages();
</script>

<?php include("footer.php"); ?>