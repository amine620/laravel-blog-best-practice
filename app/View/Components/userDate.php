<?php

namespace App\View\Components;

use Illuminate\View\Component;

class userDate extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $user;
    public $date;
    public function __construct($user,$date=null)
    {
        $this->user=$user;
        $this->date =$date;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.user-date');
    }
}
