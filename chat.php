<?php
// Database connection
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "adhd";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ---- AJAX Fetch: Return JSON ----
if (isset($_GET['fetch'])) {
    $sql = "SELECT id, mood, note, created_at FROM mood_table ORDER BY created_at ASC";
    $result = $conn->query($sql);

    $messages = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $messages[] = $row;
        }
    }

    header('Content-Type: application/json');
    echo json_encode($messages);
    exit;
}

include("header.php");
?>

<div class="container mt-4">
    <h3>Chat (Moods & Notes)</h3>
    <div id="chat-box" class="border rounded p-3" style="height:400px; overflow-y:auto; background:#f8f9fa;">
        <!-- Messages will load here -->
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function loadMessages() {

        // Map moods to emojis
        const moodEmojis = {
            "Happy": "😊",
            "Sad": "😢",
            "Okay": "😐",      // Neutral emoji
            "Angry": "😠",
            "Excited": "😃",
            "Tired": "😴"
        };

        // Map moods to colors
        const moodColors = {
            "Happy": "#FFF59D",   // yellow
            "Sad": "#90CAF9",     // blue
            "Okay": "#E0E0E0",    // gray
            "Angry": "#EF9A9A",   // red
            "Excited": "#FFCC80", // orange
            "Tired": "#CE93D8"    // purple
        };

        $.get("chat.php?fetch=1", function (data) {
            let html = "";
            data.forEach(msg => {
                const emoji = moodEmojis[msg.mood] || "😐"; // default to neutral
                const color = moodColors[msg.mood] || "#ffffff";

                // Left-aligned bubbles
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

    // Refresh every 30 seconds
    setInterval(loadMessages, 30000);
    loadMessages();
</script>

<?php include("footer.php"); ?>