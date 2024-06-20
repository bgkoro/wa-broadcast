<x-header title="Saldo Credit : {{ $credit->user->name }}" sub-title="kamu bisa topup saldo credit atau debit saldo dengan mengisi form di bawah ini."/>

<x-header title="Total credit : {{ $credit->balance }}"/>
<x-form action="{{ route('credit.update', [$credit->id]) }}" method="POST" novalidate>
    @method('put')
    <div class="flex gap-4 flex-col sm:flex-row items-start justify-between">
        <div class="w-full">
            <x-form.input-label for="credit">Credit / Topup</x-form.input-label>
                <x-form.input type="number" name="credit" placeholder="0" value="{{ old('credit') }}"/>
            <x-form.input-error name="credit"/>
        </div>
        <div class="w-full">
            <x-form.input-label for="debit">Debit / Pengurangan</x-form.input-label>
            <x-form.input type="number" name="debit" placeholder="0" value="{{ old('debit') }}"/>
            <x-form.input-error name="debit"/>
        </div>

    </div>   <div class="w-full sm:w-auto flex flex-row">
        <x-button type="submit" class="w-full">Submit</x-button>
    </div>
</x-form>
