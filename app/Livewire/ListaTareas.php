<?php

namespace App\Livewire;

use Livewire\Component;

class ListaTareas extends Component
{
    public array $tareas = [
        ['id' => 1, 'titulo' => 'Tarea 1'],
        ['id' => 2, 'titulo' => 'Tarea 2'],
        ['id' => 3, 'titulo' => 'Tarea 3'],
    ];

    public function actualizarOrden($nuevoOrden)
    {
        $this->tareas = collect($nuevoOrden)->map(function ($item) {
            return collect($this->tareas)->firstWhere('id', $item['id']);
        })->toArray();
    }

    public function render()
    {
        return view('livewire.lista-tareas');
    }
}
