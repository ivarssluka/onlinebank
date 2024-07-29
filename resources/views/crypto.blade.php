<!-- resources/views/home.blade.php -->
<x-layout>
    <x-slot:heading>
        Home page
    </x-slot:heading>

    <style>
        .crypto-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background-color: #fff;
            border-radius: 0.5rem;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .crypto-table th, .crypto-table td {
            padding: 0.75rem;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
        }

        .crypto-table th {
            background-color: #f7fafc;
            font-weight: bold;
        }

        .crypto-table tr:last-child td {
            border-bottom: none;
        }

        .crypto-name {
            display: flex;
            align-items: center;
            font-weight: bold;
        }

        .crypto-name img {
            width: 1.5rem;
            height: 1.5rem;
            margin-right: 0.5rem;
            vertical-align: middle;
        }

        .crypto-change {
            font-weight: bold;
        }

        .crypto-change.positive {
            color: #16A34A;
        }

        .crypto-change.negative {
            color: #DC2626;
        }

        .buy-button {
            background-color: #16A34A;
            color: white;
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
            text-decoration: none;
            font-size: 0.875rem;
            transition: background-color 0.3s;
        }

        .buy-button:hover {
            background-color: #15803D;
        }

        .search-input {
            width: 100%;
            padding: 0.5rem;
            margin-top: 1rem;
            margin-bottom: 1rem;
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
        }
    </style>

    <input type="text" id="searchInput" class="search-input" placeholder="Search for a cryptocurrency...">

    @if(isset($cryptos) && count($cryptos) > 0)
        <table class="crypto-table">
            <thead>
            <tr>
                <th>#</th>
                <th>Coin</th>
                <th></th>
                <th>Price</th>
                <th>24h</th>
                <th>24h Volume</th>
                <th>Market Cap</th>
            </tr>
            </thead>
            <tbody id="cryptoTableBody">
            @foreach($cryptos as $index => $crypto)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td class="crypto-name">
                        <img src="{{ $crypto['image'] }}" alt="{{ $crypto['name'] }}">
                        {{ $crypto['name'] }} ({{ strtoupper($crypto['symbol']) }})
                    </td>
                    <td><a href="#" class="buy-button">Buy</a></td>
                    <td>${{ number_format($crypto['current_price'], 2) }}</td>
                    <td class="crypto-change {{ $crypto['price_change_percentage_24h'] >= 0 ? 'positive' : 'negative' }}">
                        {{ number_format($crypto['price_change_percentage_24h'], 2) }}%
                    </td>
                    <td>${{ number_format($crypto['total_volume'], 0) }}</td>
                    <td>${{ number_format($crypto['market_cap'], 0) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const searchInput = document.getElementById('searchInput');
                const cryptoTableBody = document.getElementById('cryptoTableBody');

                searchInput.addEventListener('keyup', function () {
                    const filter = searchInput.value.toLowerCase();
                    const rows = cryptoTableBody.getElementsByTagName('tr');

                    Array.from(rows).forEach(row => {
                        const coinName = row.getElementsByClassName('crypto-name')[0].innerText.toLowerCase();
                        if (coinName.includes(filter)) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    });
                });
            });
        </script>
    @else
        <p class="text-red-500">No cryptocurrency data available</p>
    @endif
</x-layout>
