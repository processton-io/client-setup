<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('user.{id}', function ($user, $id) {
    if ((int) $user->id === (int) $id) {
        $user->update(['last_online' => new \DateTime("now")]);
        return ['id' => $user->id, 'name' => $user->name];
    }
    return false;
});

Broadcast::channel('presence-public', function ($user) {
    $user->update(['last_online' => new \DateTime("now")]);
    return ['id' => $user->id, 'name' => $user->name];
});

Broadcast::channel('chat.{chatId}', function ($user, $chatId) {
    return $chatId;
    // Check if the user is part of the chat
    return $user->chats()->where('id', $chatId)->exists();
});


