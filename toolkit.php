<?php
session_start();
include("header.php");

// Store selected patient globally
if (isset($_GET['uid']) && is_numeric($_GET['uid'])) {
    $_SESSION['current_patient_id'] = (int) $_GET['uid'];
}

// Get active patient
$service_user_id = $_SESSION['current_patient_id'] ?? null;

if (!$service_user_id) {
    echo "<div class='alert alert-danger'>No patient selected. Please return to dashboard.</div>";
    exit;
}
?>


<style>
  .mood-container {
    max-width: 900px;
    margin: 0 auto;
  }

  .page-header {
    text-align: center;
    margin-bottom: 3rem;
    padding-bottom: 1.5rem;
    border-bottom: 2px solid rgba(13, 110, 253, 0.1);
  }

  .mood-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
    gap: 1.5rem;
    margin-bottom: 3rem;
  }

  .mood-card {
    border-radius: 16px;
    padding: 1.5rem 1rem;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;
    border: 2px solid transparent;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 160px;
  }

  .mood-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
  }

  .mood-card.selected {
    border-color: #212529;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
    transform: scale(1.05);
  }

  .mood-emoji {
    font-size: 3rem;
    margin-bottom: 0.75rem;
    transition: transform 0.3s ease;
  }

  .mood-card.selected .mood-emoji {
    transform: scale(1.2);
  }

  .mood-label {
    font-weight: 600;
    font-size: 1rem;
    margin: 0;
  }

  .note-section {
    background: #f8f9fa;
    border-radius: 12px;
    padding: 2rem;
    margin-bottom: 2rem;
  }

  .section-title {
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 1rem;
    font-size: 1.1rem;
  }

  .note-input-group {
    position: relative;
  }

  .note-textarea {
    border-radius: 10px;
    border: 1.5px solid #e9ecef;
    padding: 1rem 3.5rem 1rem 1rem;
    font-size: 1rem;
    resize: vertical;
    min-height: 120px;
    transition: all 0.3s ease;
    background: #ffffff;
  }

  .note-textarea:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.1);
  }

  .mic-button {
    position: absolute;
    right: 0.75rem;
    top: 0.75rem;
    border: none;
    background: transparent;
    font-size: 1.5rem;
    cursor: pointer;
    padding: 0.5rem;
    border-radius: 50%;
    transition: all 0.3s ease;
    width: 45px;
    height: 45px;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .mic-button:hover {
    background: rgba(13, 110, 253, 0.1);
  }

  .mic-button.listening {
    background: #dc3545;
    color: white;
    animation: pulse 1.5s infinite;
  }

  @keyframes pulse {
    0% {
      transform: scale(1);
    }

    50% {
      transform: scale(1.1);
    }

    100% {
      transform: scale(1);
    }
  }

  .help-text {
    font-size: 0.875rem;
    color: #6c757d;
    margin-top: 0.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
  }

  .submit-section {
    text-align: center;
    margin-top: 2rem;
  }

  .submit-btn {
    background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
    border: none;
    border-radius: 50px;
    padding: 1rem 3rem;
    font-weight: 600;
    font-size: 1.1rem;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(13, 110, 253, 0.3);
    min-width: 200px;
  }

  .submit-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(13, 110, 253, 0.4);
  }

  .submit-btn:disabled {
    background: #6c757d;
    transform: none;
    box-shadow: none;
    cursor: not-allowed;
  }

  /* Preserving original mood colors */
  .bg-success {
    background-color: #198754 !important;
  }

  .bg-info {
    background-color: #0dcaf0 !important;
  }

  .bg-secondary {
    background-color: #6c757d !important;
  }

  .bg-primary {
    background-color: #0d6efd !important;
  }

  .bg-danger {
    background-color: #dc3545 !important;
  }

  .text-white {
    color: white !important;
  }

  /* Dark mode support */
  @media (prefers-color-scheme: dark) {
    .note-section {
      background: #1e1e1e;
    }

    .note-textarea {
      background: #2d2d2d;
      border-color: #444;
      color: #e9ecef;
    }

    .note-textarea:focus {
      border-color: #0d6efd;
    }

    .mood-card {
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }
  }

  /* Responsive adjustments */
  @media (max-width: 768px) {
    .mood-grid {
      grid-template-columns: repeat(3, 1fr);
      gap: 1rem;
    }

    .mood-card {
      min-height: 140px;
      padding: 1.25rem 0.75rem;
    }

    .mood-emoji {
      font-size: 2.5rem;
    }

    .note-section {
      padding: 1.5rem;
    }
  }

  @media (max-width: 480px) {
    .mood-grid {
      grid-template-columns: repeat(2, 1fr);
    }
  }
  .mood-card.selected {
  outline: 3px solid #000;
  transform: scale(1.03);
}

</style>

<div class="container py-5">
  <div class="mood-container">

   <!-- Page Header -->
<div class="page-header">
  <h1 class="display-5 fw-bold text-dark mb-3">Record Patient Mood</h1>
  <p class="lead text-muted">Select the patient’s current emotional state to support clinical monitoring and care planning.</p>
</div>


    <!-- ✅ FORM STARTS HERE -->
    <form action="save_mood.php" method="POST" id="moodForm">

      <!-- Hidden input (ONLY ONE) -->
    <?php
$service_user_id = $_GET['uid'] ?? null;
if (!$service_user_id) {
    echo "<div class='alert alert-danger'>No patient selected.</div>";
    exit;
}
?>

<input type="hidden" name="service_user_id" value="<?= (int)$service_user_id ?>">
<input type="hidden" name="mood_value" value="3">

      <!-- Mood Selection Grid -->
      <div class="mood-grid">
       <?php
$moods = [
  ["Happy", "😊", "bg-success text-white", 5],
  ["Okay", "🙂", "bg-info text-white", 4],
  ["Neutral", "😐", "bg-secondary text-white", 3],
  ["Sad", "😞", "bg-primary text-white", 2],
  ["Angry", "😡", "bg-danger text-white", 1]
];

foreach ($moods as $m) {
  echo "
    <div class='mood-card {$m[2]}' onclick=\"setMood('{$m[0]}', {$m[3]})\">
      <div class='mood-emoji'>{$m[1]}</div>
      <h4 class='mood-label'>{$m[0]}</h4>
    </div>
  ";
}
?>

      </div>

      <!-- Note Input Section -->
   <!-- Note Input Section -->
<div class="note-section mt-4">

  <h3 class="section-title">Add a note (optional)</h3>

  <div class="note-input-group d-flex align-items-center gap-2">

    <textarea
      class="form-control note-textarea"
      name="note"
      id="note"
      placeholder="Describe what's influencing your mood today..."
    ></textarea>

    <!-- 🎤 MIC BUTTON (THIS WAS MISSING) -->
    <button
      type="button"
      class="mic-button btn btn-outline-secondary"
      id="micButton"
      title="Start voice recording"
    >
      🎤
    </button>

  </div>

  <!-- MIC HELPER TEXT -->
  <div class="help-text mt-2" id="micHelp">
    <i class="bi bi-info-circle"></i>
    <span>Click the microphone to speak your note</span>
  </div>

</div>
<input type="hidden" name="service_user_id" value="<?= (int)$_GET['uid'] ?>">
<input type="hidden" name="worker_id" value="<?= (int)$_SESSION['user_id'] ?>">
<input type="hidden" name="mood" id="moodInput">
<input type="hidden" name="mood_value" id="moodValueInput">


<!-- Submit Section -->
<div class="d-flex justify-content-center mt-4">
    <button type="submit" class="btn submit-btn" id="submitBtn" disabled>
        <i class="bi bi-check-circle me-2"></i>Save Mood Entry
    </button>
</div>


    </form>
    <!--  FORM ENDS HERE -->

  </div>
</div>

<script>
document.getElementById('moodForm').addEventListener('submit', function (e) {
    const mood = document.getElementById('moodInput').value.trim();
    const note = document.getElementById('note').value.trim();

    if (!mood && !note) {
        e.preventDefault();
        alert("Please select a mood or enter a note before saving.");
        return false;
    }
});

// Safety check
document.getElementById('moodForm').addEventListener('submit', e => {
  if (!document.getElementById('selectedMood').value) {
    e.preventDefault();
    alert("Please select a mood.");
  }
});
</script>


<script>
document.addEventListener("DOMContentLoaded", () => {

  /* =========================
     Mood Selection
     ========================= */
  const moodCards = document.querySelectorAll('.mood-card');
  const selectedMoodInput = document.getElementById('selectedMood');
  const submitBtn = document.getElementById('submitBtn');
  const moodForm = document.getElementById('moodForm');

  moodCards.forEach(card => {
    card.addEventListener('click', () => {
      moodCards.forEach(c => c.classList.remove('selected'));
      card.classList.add('selected');

      selectedMoodInput.value = card.dataset.mood;
      submitBtn.disabled = false;
    });
  });

  moodForm.addEventListener('submit', e => {
    if (!selectedMoodInput.value) {
      e.preventDefault();
      showAlert('Please select a mood before submitting.', 'warning');
    }
  });

  /* =========================
     Alert helper
     ========================= */
  function showAlert(message, type = 'info') {
    const existing = document.querySelector('.custom-alert');
    if (existing) existing.remove();

    const alert = document.createElement('div');
    alert.className = `alert alert-${type} custom-alert position-fixed top-0 start-50 translate-middle-x mt-3`;
    alert.style.zIndex = '1050';
    alert.innerHTML = `
      <div class="d-flex align-items-center">
        <i class="bi bi-${type === 'warning' ? 'exclamation-triangle' : 'info-circle'}-fill me-2"></i>
        <span>${message}</span>
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
      </div>
    `;
    document.body.appendChild(alert);

    setTimeout(() => alert.remove(), 5000);
  }

  /* =========================
     Speech-to-Text (MIC)
     ========================= */
  const micButton = document.getElementById('micButton');
  const micHelp = document.getElementById('micHelp');
  const noteArea = document.getElementById('note');

  // 🔒 Guard — prevents crashes if elements don’t exist
  if (!micButton || !noteArea || !micHelp) return;

  if ('webkitSpeechRecognition' in window || 'SpeechRecognition' in window) {
    const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
    const recognition = new SpeechRecognition();

    recognition.continuous = false;
    recognition.interimResults = false;
    recognition.lang = 'en-US';

    micButton.addEventListener('click', () => {
      try {
        recognition.start();
        micButton.classList.add('listening');
        micButton.innerHTML = '🔴';
        micHelp.innerHTML = '<i class="bi bi-mic-fill"></i><span> Listening… speak now</span>';
      } catch {
        showAlert('Speech recognition failed to start.', 'warning');
      }
    });

    recognition.onresult = e => {
      const text = e.results[0][0].transcript;
      noteArea.value += (noteArea.value ? " " : "") + text;

      micButton.classList.remove('listening');
      micButton.innerHTML = '🎤';
      micHelp.innerHTML = '<i class="bi bi-info-circle"></i><span> Click the microphone to speak your note</span>';

      showAlert('Voice note added successfully!', 'success');
    };

    recognition.onerror = e => {
      micButton.classList.remove('listening');
      micButton.innerHTML = '🎤';
      micHelp.innerHTML = '<i class="bi bi-info-circle"></i><span> Click the microphone to speak your note</span>';

      showAlert(
        e.error === 'not-allowed'
          ? 'Microphone access denied.'
          : 'Speech recognition error: ' + e.error,
        'warning'
      );
    };

    recognition.onend = () => {
      micButton.classList.remove('listening');
      micButton.innerHTML = '🎤';
    };

  } else {
    micButton.addEventListener('click', () => {
      showAlert('Speech recognition is not supported in this browser.', 'info');
      noteArea.focus();
    });

    micHelp.innerHTML =
      '<i class="bi bi-keyboard"></i><span> Use keyboard dictation instead</span>';
  }

});

function setMood(mood, value) {
    document.getElementById('moodInput').value = mood;
    document.getElementById('moodValueInput').value = value;
    document.getElementById('submitBtn').disabled = false;
}
</script>


<?php include("footer.php"); ?>