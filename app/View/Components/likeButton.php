<?php

namespace App\View\Components;

use Illuminate\View\Component;

class likeButton extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $status;
    public $action;
    public $count;
    public function __construct($status,$action,$count)
    {
        $this->status=$status;
        $this->action = $action;
        $this->count = $count;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.like-button');
    }
}
