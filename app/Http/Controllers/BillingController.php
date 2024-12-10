<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    // Listar todas las facturas
    public function index()
    {
        $billings = Billing::all();

        return response()->json([
            'data' => $billings,
        ]);
    }

    // Obtener factura específica
    public function show($id)
    {
        $billing = Billing::find($id);

        if (!$billing) {
            return response()->json(['message' => 'Factura no encontrada'], 404);
        }

        return response()->json([
            'data' => $billing,
        ]);
    }

    // Crear una nueva factura
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string',
            'customer_email' => 'required|email',
            'company' => 'required|string',
            'invoice_id' => 'required|string|unique:billings',
            'total_amount' => 'required|numeric',
            'paid_amount' => 'required|numeric',
            'remaining_balance' => 'required|numeric',
            'installments' => 'required|integer',
            'next_due_date' => 'nullable|date',
            'status' => 'nullable|string',
        ]);

        $billing = Billing::create($validated);

        return response()->json([
            'message' => 'Factura creada exitosamente',
            'data' => $billing,
        ]);
    }
}
