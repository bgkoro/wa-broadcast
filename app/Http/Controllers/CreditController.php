<?php

namespace App\Http\Controllers;

use App\Models\Credit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CreditController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('has-permission', 'manage_credits');

        $perPage = request()->has('perPage') && request('perPage') <= 100 ? request('perPage') : '10';

        $data = [
            'title' => 'Client Credit',
            'credits' => Credit::with('user')->has('user')->latest()->filter(request(['search']))->paginate($perPage)->withQueryString()
        ];

        return view('pages.credit.index', $data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Credit $credit)
    {
        $this->authorize('has-permission', [['manage_credits', 'view_credits']]);

        request()->merge(['periode' => ['start' => date('Y-m-d', strtotime('-7 days')), 'end' => date('Y-m-d')]]);

        if (request()->has('start') || request()->has('end')) {
            if (request('start') >= date('Y-m-d', strtotime('-3 month')) && request('end') <= date('Y-m-d')) {
                request()->merge(['periode' => ['start' => request('start'), 'end' => request('end')]]);
            }
        }

        $perPage = request()->has('perPage') && request('perPage') <= 100 ? request('perPage') : '10';

        $data = [
            'title' => 'Credit',
            'credit' => $credit,
            'creditHistories' => $credit->creditsHistory()->filter(request(['periode']))->paginate($perPage)->withQueryString(),
        ];

        return view('pages.credit.show', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Credit $credit)
    {
        $this->authorize('has-permission', 'manage_credits');
        $data = $request->validate(
            ['credit' => 'nullable|numeric', 'debit' => 'nullable|numeric']);
        if ($data['credit'] && $data['debit']) {
            return redirect()->route('credit.show', ['credit' => $credit->id])->with('danger', 'Credit atau Debit tidak diisi bersamaan');
        }
        DB::transaction(function () use ($credit, $data) {
            if ($data['debit']) {
                $update = $credit->balance - $data['debit'];
                $createHistory = [
                    'description' => 'Pengurangan saldo credit oleh ' . auth()->user()->name,
                    'initial_balance' => $credit->balance + $data['debit'],
                    'debit' => $data['debit'],
                ];
            } else {
                $update = $credit->balance + $data['credit'];
                $createHistory = [
                    'description' => 'Top up credit by ' . auth()->user()->name,
                    'initial_balance' => $credit->balance - $data['credit'],
                    'credit' => $data['credit'],
                ];
            }
            $createHistory['ending_balance'] = $credit->balance;
            $success = $credit->update(['balance' => $update]);
            if ($success) {
                $credit->creditsHistory()->create($createHistory);
            }
        });
        return redirect()->route('credit.show', ['credit' => $credit->id])->with('success', 'Top up credit/debit saldo success');
    }
}
