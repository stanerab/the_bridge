<?php include("header.php"); ?>

<div class="container mt-5">
  <h2 class="text-center mb-4">How are you feeling today?</h2>

  <form action="save_mood.php" method="POST" id="moodForm">
    <div class="row justify-content-center">

      <?php
      $moods = [
        ["Happy", "😊", "bg-success text-white"],
        ["Okay", "🙂", "bg-info text-white"],
        ["Neutral", "😐", "bg-secondary text-white"],
        ["Sad", "😞", "bg-primary text-white"],
        ["Angry", "😡", "bg-danger text-white"]
      ];
      foreach ($moods as $m) {
        echo "
        <div class='col-6 col-md-2 mb-3'>
          <div class='card mood-option text-center {$m[2]}' data-mood='{$m[0]}' style='cursor:pointer;'>
            <div class='card-body'>
              <div style='font-size: 2rem;'>{$m[1]}</div>
              <h6 class='mt-2'>{$m[0]}</h6>
            </div>
          </div>
        </div>
        ";
      }
      ?>
    </div>

    <input type="hidden" name="mood" id="selectedMood">

    <div class="mt-4">
      <label for="note" class="form-label">Add a note (optional)</label>
      <textarea class="form-control" name="note" id="note" rows="3"></textarea>
    </div>

    <div class="text-center mt-4">
      <button type="submit" class="btn btn-primary btn-lg">Save Mood</button>
    </div>
  </form>
</div>

<script>
  document.querySelectorAll('.mood-option').forEach(card => {
    card.addEventListener('click', () => {
      document.querySelectorAll('.mood-option').forEach(c => c.classList.remove('border', 'border-dark', 'shadow-lg'));
      card.classList.add('border', 'border-dark', 'shadow-lg');
      document.getElementById('selectedMood').value = card.dataset.mood;
    });
  });

  document.getElementById('moodForm').addEventListener('submit', function (e) {
    if (!document.getElementById('selectedMood').value) {
      e.preventDefault();
      alert("Please select a mood before submitting.");
    }
  });
</script>

<?php include("footer.php"); ?>