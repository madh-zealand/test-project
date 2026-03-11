<?php
/**
 * Front controller – every request enters through index.php.
 */

declare(strict_types=1);

require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/database.php';
require_once __DIR__ . '/includes/functions.php';

// ── Handle form submission ───────────────────────────────────────────────────
$flash = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $content = isset($_POST['content']) ? trim($_POST['content']) : '';

    if ($content === '') {
        $flash = ['type' => 'error', 'text' => 'Message cannot be empty.'];
    } else {
        try {
            addMessage($content);
            $flash = ['type' => 'success', 'text' => 'Message saved!'];
        } catch (Throwable $e) {
            $flash = ['type' => 'error', 'text' => 'Could not save message.'];
            if (DEBUG) {
                $flash['text'] .= ' ' . $e->getMessage();
            }
        }
    }

    // PRG pattern – redirect to avoid re-submission on refresh
    $qs = $flash['type'] === 'success' ? '?ok=1' : '?err=1';
    header('Location: /' . $qs);
    exit;
}

// Pick up flash state from redirect query string
if (isset($_GET['ok'])) {
    $flash = ['type' => 'success', 'text' => 'Message saved!'];
} elseif (isset($_GET['err'])) {
    $flash = ['type' => 'error', 'text' => 'Could not save the message. Please try again.'];
}

// ── Fetch data ───────────────────────────────────────────────────────────────
$messages = getMessages();

// ── Render ───────────────────────────────────────────────────────────────────
require_once __DIR__ . '/templates/header.php';
?>

<?php if ($flash): ?>
    <div class="alert alert-<?= h($flash['type']) ?>">
        <?= h($flash['text']) ?>
    </div>
<?php endif; ?>

<div class="card">
    <h2>Add a Message</h2>
    <form method="post" action="/">
        <div class="form-group">
            <label for="content">Your message</label>
            <textarea id="content" name="content" rows="3" placeholder="Type something…" required></textarea>
        </div>
        <button type="submit">Save message</button>
    </form>
</div>

<div class="card">
    <h2>Messages</h2>
    <?php if (empty($messages)): ?>
        <p class="empty-state">No messages yet – add one above!</p>
    <?php else: ?>
        <ul class="message-list">
            <?php foreach ($messages as $msg): ?>
                <li>
                    <?= h($msg['content']) ?>
                    <div class="meta"><?= h($msg['created_at']) ?></div>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>

<?php require_once __DIR__ . '/templates/footer.php'; ?>
