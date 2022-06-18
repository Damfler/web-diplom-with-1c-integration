<?php

namespace App\View\Components;

use Illuminate\View\Component;

class slidebarItemListItem extends Component
{
    public $route;
    public $name;

    public function __construct($route, $name)
    {
        $this->route = $route;
        $this->name = $name;
    }

    public function render()
    {
        return view('components.slidebar-item-list-item');
    }
}
