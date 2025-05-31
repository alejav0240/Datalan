<?php

namespace App\View\Components\Tables;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ClientesTable extends Component
{
    public $clientes;
    
    public function __construct($clientes)
    {
        $this->clientes = $clientes;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tables.clientes-table');
    }
}
