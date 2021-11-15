<?php

namespace App\Action;

use App\Events\NotificationEvent;
use App\Models\Reminder;
use Pusher\PushNotifications\PushNotifications;

class Notification
{

  public static function send($message, $users = [])
  {
    foreach($users as $user) {
      Reminder::create([
        'title' => $message['title'],
        'body' => $message['body'],
        'link' => $message['link'],
        'user_id' => $user
      ]);
    }

    event(new NotificationEvent(json_encode($message), $users));

    app(PushNotifications::class)->publishToUsers(
      array_map(fn ($id) => 'user_id_' . $id, $users),
      array(
        "web" => array(
          "notification" => array(
            "title" => $message['title'],
            "body" => $message['body']
          )
        )
      )
    );
  }
}
