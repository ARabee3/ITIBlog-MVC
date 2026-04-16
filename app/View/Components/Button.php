<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Button extends Component
{
    public string $type;
    public string $buttonType;

    /**
     * Create a new component instance.
     */
    public function __construct(string $type = 'primary', string $buttonType = 'button')
    {
        $this->type = $type;
        $this->buttonType = $buttonType;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.button');
    }
}
