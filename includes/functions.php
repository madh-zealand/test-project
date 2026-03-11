<?php
/**
 * General-purpose utility functions.
 */

/**
 * Escapes a value for safe HTML output.
 */
function h(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/**
 * Returns all rows from the messages table, newest first.
 *
 * @return array<int, array<string, mixed>>
 */
function getMessages(): array
{
    $db  = Database::getInstance()->getPdo();
    $stmt = $db->query('SELECT id, content, created_at FROM messages ORDER BY id DESC');
    return $stmt->fetchAll();
}

/**
 * Inserts a new message and returns its id.
 *
 * @throws InvalidArgumentException when content is blank.
 */
function addMessage(string $content): int
{
    $content = trim($content);
    if ($content === '') {
        throw new InvalidArgumentException('Message content must not be empty.');
    }

    $db   = Database::getInstance()->getPdo();
    $stmt = $db->prepare('INSERT INTO messages (content) VALUES (:content)');
    $stmt->execute([':content' => $content]);
    return (int) $db->lastInsertId();
}
