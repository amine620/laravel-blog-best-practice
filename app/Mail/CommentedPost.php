<?php

namespace App\Mail;

use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CommentedPost extends Mailable
{
    use Queueable, SerializesModels;

   public $comment;
    public function __construct(Comment $comment)
    {
        $this->comment=$comment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject="comment  for {$this->comment->commentable->title}";
        return $this
        // ->attach(storage_path('app/public')."/".$this->comment->user->image->path,['as'=>'profile_picture.jpeg'])
         ->attachFromStorage($this->comment->user->image->path,'profile_picture')
        ->subject($subject)
        ->view('mails.post.comment');
    }
}
