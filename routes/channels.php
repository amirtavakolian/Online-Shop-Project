<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int)$user->id === (int)$id;
});

Broadcast::channel('userregistered', function ($user) {
    return $user->email == 'rezatva@gmail.com';
});

Broadcast::channel('user-has-joined', function ($user) {
    if ($user != null) {
        return ['id' => $user->id, 'name' => $user->name, 'email' => $user->email];
    }
});

Broadcast::channel('private-chat', function ($user) {
    return 2 > 1;
});
