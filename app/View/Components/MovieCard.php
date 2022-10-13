<?php

namespace App\View\Components;

use Illuminate\View\Component;

class MovieCard extends Component
{
    public $popularMovie;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($popularMovie)
    {
        $this->popularMovie = $popularMovie;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.movie-card');
    }
}
