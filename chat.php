<?php
include("header.php");
if (isset($_GET['uid']) && is_numeric($_GET['uid'])) {
    $_SESSION['current_patient_id'] = (int) $_GET['uid'];
}

$service_user_id = $_SESSION['current_patient_id'] ?? null;

if (!$service_user_id) {
    echo "No patient selected.";
    exit;
}


// Enable error reporting (safe for localhost & InfinityFree)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<div class="container mt-4">
    <h3>Chat (Moods & Notes)</h3>
    <div id="chat-box" class="border rounded p-3"
         style="height:600px; overflow-y:auto; background:#f8f9fa;">
        <!-- Messages will load here -->
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
/* =========================
   Mood Emojis & Colours
   ========================= */
const moodEmojis = {
    happy: "😊",
    sad: "😢",
    neutral: "😐",
    okay: "🙂",
    angry: "😠"
};

const moodColors = {
    happy: "#0cf38bff",    // green
    sad: "#116bf2ff",      // blue
    neutral: "#949595ff",  // grey
    okay: "#76d5ebff",     // light blue
    angry: "#ed1628ff"     // red
};

// AUTO-DETECT environment
let fetchUrl = "fetch_chat.php?uid=<?= $service_user_id ?>";
if (location.hostname !== "localhost" && location.hostname !== "127.0.0.1") {
    fetchUrl = "chat_data.php";
}

function loadMessages() {
    $.get(fetchUrl, function (data) {
        let html = "";

        if (data.error) {
            html = `<div class="text-danger">Error: ${data.error}</div>`;
        }
        else if (Array.isArray(data) && data.length > 0) {

            data.forEach(msg => {
                // 🔑 NORMALISE MOOD
                const mood = (msg.mood || "neutral").toLowerCase();

                const emoji = moodEmojis[mood] || "😐";
                const color = moodColors[mood] || "#e9ecef";

                html += `
                    <div class="mb-3">
                        <div style="
                            background:${color};
                            padding:12px;
                            border-radius:15px;
                            max-width:70%;
                            box-shadow:0 1px 3px rgba(0,0,0,0.1);
                        ">
                            <div style="font-size:1.8rem;">${emoji}</div>
                            <strong style="text-transform:capitalize;">${mood}</strong><br>
                            <span>${msg.note || "—"}</span><br>
                            <small class="text-muted">${msg.created_at}</small>
                        </div>
                    </div>
                `;
            });

        } else {
            html = `<div class="text-muted">No chat messages yet.</div>`;
        }

        $("#chat-box").html(html);
        $("#chat-box").scrollTop($("#chat-box")[0].scrollHeight);

    }, "json").fail(function (xhr, status, error) {
        $("#chat-box").html(`<div class="text-danger">AJAX failed: ${error}</div>`);
    });
}

// Load immediately + refresh every 30s
setInterval(loadMessages, 30000);
loadMessages();
</script>

<?php include("footer.php"); ?>
