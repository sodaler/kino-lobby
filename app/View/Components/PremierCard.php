<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PremierCard extends Component
{
    public $premier;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($premier)
    {
        $this->premier = $premier;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.premier-card');
    }
}
