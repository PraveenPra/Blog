<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MasterLayout extends Component
{
    public $bgClass;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->bgClass = $bgClass ?? 'bg-gray-100 dark:bg-gray-900';
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.master-layout');
    }
}
