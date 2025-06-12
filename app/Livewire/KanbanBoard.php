<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Trabajo;

class KanbanBoard extends Component
{
    public $trabajosPorPrioridad = [];

    public function mount()
    {
        $this->actualizarListas();
    }

    public function actualizarListas()
    {
        $this->trabajosPorPrioridad = [
            'normal' => Trabajo::where('prioridad', 'normal')->orderBy('orden')->get(),
            'alta' => Trabajo::where('prioridad', 'alta')->orderBy('orden')->get(),
            'urgente' => Trabajo::where('prioridad', 'urgente')->orderBy('orden')->get(),
        ];
    }

    public function actualizarOrden($orden, $prioridad)
    {
        foreach ($orden as $index => $item) {
            Trabajo::where('id', $item['id'])->update([
                'prioridad' => $prioridad,
                'orden' => $index
            ]);
        }

        $this->actualizarListas();
    }

    public function render()
    {
        return view('livewire.kanban-board');
    }
}
