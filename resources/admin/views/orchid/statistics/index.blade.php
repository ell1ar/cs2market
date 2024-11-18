@foreach ($groups_statistics_cards as $title => $statistics_cards)
    <div class="mb-3">
        <div class="grid gap-3 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
            @foreach ($statistics_cards as $statistics_card)
                <div class="rounded-[2px] shadow-md p-3 bg-white">
                    <p>{{ $statistics_card['title'] }}</p>
                    <span @class([
                        'text-xl',
                        'text-red-500' =>
                            isset($statistics_card['type']) &&
                            $statistics_card['type'] === 'danger',
                        'text-green-500' =>
                            isset($statistics_card['type']) &&
                            $statistics_card['type'] === 'success',
                    ])>{{ $statistics_card['value'] }}</span>
                </div>
            @endforeach
        </div>
    </div>
@endforeach
