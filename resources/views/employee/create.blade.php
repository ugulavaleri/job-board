<x-layout>
    <x-card>
        <form action="{{ route('employee.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="company_name"
                       class="mb-2 block text-sm font-medium text-slate-900">Employer</label>
                <x-text-input type="text" name="company_name"/>
            </div>
            <button class="w-full">submit</button>
        </form>
    </x-card>
</x-layout>
