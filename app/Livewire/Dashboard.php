<?php

namespace App\Livewire;

use App\Models\Raffle;
use App\Models\Reviews;
use App\Models\Ticket;
use DragonCode\Contracts\Cashier\Auth\Auth;
use Illuminate\Container\Attributes\DB;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\DB as FacadesDB;
use Livewire\Component;

class Dashboard extends Component
{


    public $rifas;
    public $reseñas;
    public $boletos;

    public function mount()
    {
        $this->rifas = FacadesDB::table('raffles')->where('status', 'activa')->get(); // Obtener rifas activas
        $this->reseñas = Reviews::latest()->take(5)->get(); // Obtener las últimas reseñas
        $this->boletos = Ticket::where('user_id', FacadesAuth::id())->with('rifa')->get(); // Obtener boletos del usuario autenticado
    }

    public function comprarBoleto($rifaId)
    {
        // Lógica para comprar un boleto
        Ticket::create([
            'user_id' => Auth::id(),
            'rifa_id' => $rifaId,
            'numero' => rand(1, 1000), // Número de boleto generado aleatoriamente
            'fecha_compra' => now(),
        ]);

        // Refrescar la lista de boletos
        $this->boletos = Ticket::where('user_id', Auth::id())->with('rifa')->get();

        session()->flash('mensaje', '¡Boleto comprado con éxito!');
    }
    public function render()
    {
        return view('livewire.dashboard')->layout('layouts.app');
    }
}