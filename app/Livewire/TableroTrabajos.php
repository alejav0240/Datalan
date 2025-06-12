<?php

namespace App\Livewire;

use App\Models\Trabajo;
use Livewire\Component;

class TableroTrabajos extends Component
{
    public $trabajos;

    public function mount()
    {
        $this->cargarTrabajos();
    }

    public function cargarTrabajos()
    {
        $this->trabajos = [
            'urgente' => Trabajo::where('prioridad', 'urgente')->get(),
            'alta'    => Trabajo::where('prioridad', 'alta')->get(),
            'normal'  => Trabajo::where('prioridad', 'normal')->get(),
        ];
    }

    public function actualizarPrioridad($listaDeGrupos)
    {
        foreach ($listaDeGrupos as $grupo) {
            $prioridad = $grupo['value'];
            foreach ($grupo['items'] as $item) {
                Trabajo::where('id', $item['value'])->update(['prioridad' => $prioridad]);
            }
        }
        $this->cargarTrabajos();
    }

    public function render()
    {
        return view('livewire.tablero-trabajos');
    }
}
