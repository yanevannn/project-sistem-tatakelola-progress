<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class navbar extends Component
{
    /**
     * Create a new component instance.
     */
    // public function __construct()
    // {
    //     //
    // }
    public $title; // Properti untuk menyimpan judul

    public function __construct($title)
    {
        $this->title = $title; // Menyimpan judul yang diteruskan ke komponen
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.navbar');
    }
}
