<?php

namespace App\Listeners;

use App\Events\CommentEvent;
use App\Mail\CommentedPostMarkDown;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class CommentEventListner
{
   
    public function handle(CommentEvent $event)
    {

        $when = now()->addSeconds(10);

        Mail::to($event->comment->commentable->user->email)
            // ->send(new CommentedPostMarkDown($comment)); waiting until mail sent
            // ->queue(new CommentedPostMarkDown($comment)) using queue
            ->later($when, new CommentedPostMarkDown($event->comment));

    }
}
