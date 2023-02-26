<?php

namespace App\Listener;

use Symfony\Contracts\EventDispatcher\Event;

class UserRegisteredListener {

    public function onUserRegistred(Event $event) {
        print_r("Email envoye a " . $event->getUser()->getUsername());
    }

}