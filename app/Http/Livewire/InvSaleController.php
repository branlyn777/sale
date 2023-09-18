<?php

namespace App\Http\Livewire;

use App\Models\InvProduct;
use App\Models\TxnPaymentsType;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\WithPagination;

class InvSaleController extends MethodsController
{
    // Guarda los tipos de pagos disponibles
    public $list_payments_types;
    // Guarda el id de la sucursal
    public $branch_id;
    // Guarda el id del tipo de pago seleccionado
    public $payment_type_id;
    // Variables para el total cantidad y total bs del Shopping Cart
    public $total_items, $total_money;

    protected $salesCart;
    
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function mount()
    {
        
        // Inicializa la colección como una instancia de Illuminate\Support\Collection
        $this->salesCart = collect([]);

        // Obtieniendo la sucursal del usuario
        $this->branch_id = $this->get_branch_id(Auth()->user()->id);
        // Obteniendo los tipos de pagos disponibles
        $this->list_payments_types = TxnPaymentsType::join("txn_cash_registers as cr", "cr.id","txn_payments_types.txn_cash_registers_id")
        ->where("cr.inv_branch_id", $this->branch_id
        )->get();
    }
    public function render()
    {

        
        // Obteniendo el total cantidad y total bs del Shopping Cart
        $this->total_items = 0;
        $this->total_money = 0;
        foreach ($this->salesCart as $c)
        {
            $this->total_items = $this->total_items + $c['quantity'];
            $this->total_money = $this->total_money + ($c['quantity'] * $c['price']);
        }



        $products = InvProduct::where("status", "active")->paginate(5);
        return view('livewire.template.sale.sale.sale', [
            'products' => $products
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }
}
