<x-filament-widgets::widget>
    <x-filament::section>
        <div class="flex items-center justify-between">

            <div>
                <h2 class="text-2xl font-bold text-gray-800">
                    🏫 SchoolOS
                </h2>

                <p class="mt-2 text-lg text-gray-600">
                    Hoş Geldiniz,
                    <strong>{{ auth()->user()->name }}</strong>
                </p>

                <p class="text-sm text-gray-500">
                    {{ now()->format('d.m.Y') }}
                </p>
            </div>

            <div class="text-right">
                <div class="text-sm text-gray-500">
                    Sistem Durumu
                </div>

                <div class="text-green-600 font-bold">
                    ● Aktif
                </div>
            </div>

        </div>
    </x-filament::section>
</x-filament-widgets::widget>
