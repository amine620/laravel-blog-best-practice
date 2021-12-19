<?php

namespace App\View\Components;

use Illuminate\View\Component;

class mostActive extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $title;
    public $users;

    public function __construct($title=null,$users=null)
    {
        $this->title=$title;
        $this->users=$users;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.most-active');
    }
}
