<?php
function getUserConversations($pdo, $userId) {
    $stmt = $pdo->prepare("
        SELECT 
            p.provider_id,
            p.provider_name,
            p.profile_pic,
            MAX(m.sent_at) as last_message_time,
            (SELECT message FROM messages 
             WHERE (sender_id = ? AND recipient_id = p.provider_id) 
                OR (sender_id = p.provider_id AND recipient_id = ?) 
             ORDER BY sent_at DESC LIMIT 1) as last_message,
            SUM(CASE WHEN m.recipient_id = ? AND m.is_read = 0 THEN 1 ELSE 0 END) as unread_count
        FROM providers p
        LEFT JOIN messages m ON (
            (m.sender_id = p.provider_id AND m.recipient_id = ?) 
            OR (m.sender_id = ? AND m.recipient_id = p.provider_id)
        )
        WHERE p.provider_id IN (
            SELECT DISTINCT provider_id FROM services WHERE service_id IN (
                SELECT DISTINCT service_id FROM bookings WHERE user_id = ?
            )
        )
        GROUP BY p.provider_id, p.provider_name, p.profile_pic
        ORDER BY last_message_time DESC
    ");
    $stmt->execute([$userId, $userId, $userId, $userId, $userId, $userId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getMessages($pdo, $userId, $providerId) {
    $stmt = $pdo->prepare("
        SELECT * FROM messages 
        WHERE (sender_id = ? AND recipient_id = ?) 
           OR (sender_id = ? AND recipient_id = ?)
        ORDER BY sent_at ASC
    ");
    $stmt->execute([$userId, $providerId, $providerId, $userId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function sendMessage($pdo, $senderId, $recipientId, $message) {
    $stmt = $pdo->prepare("
        INSERT INTO messages (sender_id, recipient_id, message, sent_at, is_read)
        VALUES (?, ?, ?, NOW(), 0)
    ");
    return $stmt->execute([$senderId, $recipientId, $message]);
}

function markMessagesAsRead($pdo, $userId, $providerId) {
    $stmt = $pdo->prepare("
        UPDATE messages SET is_read = 1 
        WHERE sender_id = ? AND recipient_id = ? AND is_read = 0
    ");
    $stmt->execute([$providerId, $userId]);
}

function getProviderInfo($pdo, $providerId) {
    $stmt = $pdo->prepare("
        SELECT p.*, s.service_name 
        FROM providers p
        LEFT JOIN services s ON p.provider_id = s.provider_id
        WHERE p.provider_id = ?
        LIMIT 1
    ");
    $stmt->execute([$providerId]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function truncateMessage($message, $length = 30) {
    if (strlen($message) > $length) {
        return substr($message, 0, $length) . '...';
    }
    return $message;
}
?>