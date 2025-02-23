<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OwenIt\Auditing\Models\Audit;

class AuditController extends Controller
{
    /**
     * Display a listing of the audit logs.
     */
    public function index(Request $request)
    {
        // Fetch all audit logs with optional filtering
        $audits = Audit::with('auditable')
            ->when($request->input('search'), function ($query, $search) {
                $query->where('user_type', 'LIKE', "%{$search}%")
                      ->orWhere('event', 'LIKE', "%{$search}%")
                      ->orWhere('old_values', 'LIKE', "%{$search}%")
                      ->orWhere('new_values', 'LIKE', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('audits.index', compact('audits'));
    }

    /**
     * Show details for a specific audit log.
     */
    public function show(Audit $audit)
    {
        return view('audits.show', compact('audit'));
    }
}
