<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CategoryLinks extends Component
{
    public $content;

    public function __construct($content)
    {
        $this->content = $content;
    }

    public function render()
    {
        return view('components.category-links');
    }
}
