<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CardItem extends Component
{
    public $item;
    public $type;

    /*
     * Create a new component instance.
     *
     * @param  mixed  $item
     * @param  string  $type
     * @return void
     */
    public function __construct($item, $type)
    {
        $this->item = $item;
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function render()
    {
        return view('components.card-item');
    }
}
