<x-layout>
    <div class="container">
        <div class="leaderboard">
            <div class="head">
                <i class="fas fa-crown"></i>
            </div>
            <div class="body">
                <ol>
                    <li>
                        <mark>Jerry Wood</mark>
                        <small>948</small>
                    </li>
                    <li>
                        <mark>Brandon Barnes</mark>
                        <small>750</small>
                    </li>
                    <li>
                        <mark>Raymond Knight</mark>
                        <small>684</small>
                    </li>
                    <li>
                        <mark>Trevor McCormick</mark>
                        <small>335</small>
                    </li>
                    <li>
                        <mark>Andrew Fox</mark>
                        <small>296</small>
                    </li>
                </ol>
            </div>
        </div>
    </div>
    @push('quizJs')
        <script src="/quiz.js" defer></script>
        <link rel="stylesheet" href="/quizLeaderboard.css">
    @endpush
</x-layout>

