<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Save Mood</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
  </head>
  <body>
    <div class="container mt-5">
      <h2>Submit Your Mood</h2>
      <form action="save_mood.php" method="post">
        <div class="mb-3">
          <label for="user_id" class="form-label">User:</label>
          <select name="user_id" id="user_id" class="form-select" required>
            <option value="">-- Select User --</option>
            <option value="1">Alice</option>
            <option value="2">Bob</option>
            <!-- Add more users as needed -->
          </select>
        </div>

        <div class="mb-3">
          <label for="mood" class="form-label">Mood:</label>
          <input
            type="text"
            name="mood"
            id="mood"
            class="form-control"
            required
          />
        </div>

        <div class="mb-3">
          <label for="note" class="form-label">Note (optional):</label>
          <textarea
            name="note"
            id="note"
            class="form-control"
            rows="3"
          ></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit Mood</button>
      </form>
    </div>
  </body>
</html>
