
<x-filament-widgets::widget>
    <x-filament::section>

        <div>
            <h1
                style="
                    font-size: 1rem;
                    font-weight: 700;
                    margin-top: -10px;
                    margin-bottom: 15px;
                "
            >
                Ações rápidas
            </h1>

            <div
                style="
                    display: flex;
                    align-items: center;
                "
            >

                <x-filament::button
                    tag="a"
                    :href="route('filament.admin.resources.produtos.create')"
                    icon="heroicon-o-plus"
                    size="md"
                >
                    Criar Produto
                </x-filament::button>

                <div style="margin-left: 20px;">
                    <x-filament::button
                        tag="a"
                        :href="route('filament.admin.resources.movimentos.create')"
                        icon="heroicon-o-arrow-path"
                        size="md"
                    >
                        Criar Movimento
                    </x-filament::button>
                </div>

            </div>

        </div>

    </x-filament::section>
</x-filament-widgets::widget>