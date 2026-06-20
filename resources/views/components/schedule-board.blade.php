@props([
    'authed' => false,        // when true, the user can navigate to any date
    'title' => 'Schedule',
    'inMain' => false,        // true when placed inside an already-padded <main> container
])

@php
    $fields = \App\Models\Field::all();
    $courts = [];
    $courtIds = [];
    foreach ($fields as $f) {
        $courts[] = $f->nama_lapangan;
        $courtIds[] = $f->id;
    }
    
    $bookings = \App\Models\Booking::where('tanggal', '>=', date('Y-m-d'))
        ->whereIn('status', ['pending', 'confirmed'])
        ->get(['field_id', 'tanggal', 'jam_mulai', 'jam_selesai']);

    $times  = ['08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00', '21:00', '22:00', '23:00', '00:00', '01:00', '02:00'];
    $wrapClass = $inMain
        ? 'mt-8'
        : 'mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8';
@endphp

<section id="schedule" class="{{ $wrapClass }}"
         data-schedule-board
         data-authed="{{ $authed ? '1' : '0' }}"
         data-book-url="{{ $authed ? route('booking') : route('login') }}"
         data-courts='@json($courts)'
         data-court-ids='@json($courtIds)'
         data-bookings='@json($bookings)'
         data-times='@json($times)'>

    <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
        <div>
            <h2 class="text-2xl font-extrabold tracking-tight text-gray-900">{{ $title }}</h2>
            <p class="mt-1 text-sm text-gray-500">
                Viewing <span data-date-label class="font-semibold text-gray-700">today</span> · tap any open slot to book it.
            </p>
        </div>

        <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
            <!-- Date controls -->
            @if ($authed)
                <div class="flex items-center gap-2">
                    <button type="button" data-prev class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-gray-200 bg-white text-gray-500 shadow-xs hover:border-[#0047D4] hover:text-[#0047D4] disabled:cursor-not-allowed disabled:opacity-40 transition-colors duration-150" aria-label="Previous day">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"></path></svg>
                    </button>
                    <div class="relative">
                        <input type="date" data-date-input class="rounded-xl border border-gray-200 bg-white py-2.5 pl-3 pr-3 text-sm font-semibold text-gray-700 shadow-xs focus:border-[#0047D4] focus:ring-3 focus:ring-blue-100 focus:outline-none transition-all duration-200">
                    </div>
                    <button type="button" data-next class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-gray-200 bg-white text-gray-500 shadow-xs hover:border-[#0047D4] hover:text-[#0047D4] transition-colors duration-150" aria-label="Next day">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"></path></svg>
                    </button>
                    <button type="button" data-today class="rounded-xl border border-gray-200 bg-white px-3.5 py-2.5 text-sm font-semibold text-gray-600 shadow-xs hover:border-[#0047D4] hover:text-[#0047D4] transition-colors duration-150">Today</button>
                </div>
            @else
                <!-- Guests: locked to today, prompted to log in for other dates -->
                <div class="flex flex-wrap items-center gap-2.5">
                    <span class="inline-flex items-center gap-2 rounded-xl border border-gray-200 bg-white px-3.5 py-2.5 text-sm font-semibold text-gray-700 shadow-xs">
                        <svg class="h-4 w-4 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2"></rect><path d="M16 2v4M8 2v4M3 10h18"></path></svg>
                        Today
                    </span>
                    <a href="{{ route('login') }}" class="inline-flex items-center gap-2 rounded-xl bg-blue-50 px-3.5 py-2.5 text-sm font-semibold text-[#0047D4] ring-1 ring-inset ring-blue-100 hover:bg-[#0047D4] hover:text-white hover:ring-[#0047D4] transition-all duration-200">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                        Log in to view other dates
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Legend -->
    <div class="mt-4 flex items-center gap-4">
        <span class="flex items-center gap-2 text-xs font-medium text-gray-600">
            <span class="h-3 w-3 rounded bg-blue-50 ring-1 ring-blue-200"></span> Available
        </span>
        <span class="flex items-center gap-2 text-xs font-medium text-gray-600">
            <span class="h-3 w-3 rounded bg-gray-100 ring-1 ring-gray-200"></span> Booked
        </span>
    </div>

    <!-- Mobile hint -->
    <p class="mt-3 text-xs text-gray-400 sm:hidden">Swipe horizontally to see all courts &rarr;</p>

    <!-- Scrollable wrapper: capped height (vertical scroll) + horizontal scroll on mobile -->
    <div class="mt-3 max-h-[28rem] overflow-auto rounded-2xl border border-gray-100 bg-white shadow-xs">
        <table class="w-full min-w-[780px] border-separate border-spacing-0 text-sm">
            <thead>
                <tr>
                    <th class="sticky left-0 top-0 z-30 border-b border-r border-gray-100 bg-gray-50 px-4 py-3.5 text-left text-xs font-bold uppercase tracking-wider text-gray-500">Time</th>
                    @foreach ($courts as $court)
                        <th class="sticky top-0 z-20 border-b border-gray-100 bg-gray-50 px-3 py-3.5 text-center text-xs font-bold uppercase tracking-wider text-gray-700">{{ $court }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody data-schedule-body>
                <!-- rows rendered by JS -->
            </tbody>
        </table>
    </div>

    <p class="mt-3 text-xs text-gray-400">Slots after midnight (00:00–02:00) belong to the next day. Scroll inside the table to see all hours.</p>
</section>

<script>
    (function () {
        function isBooked(dateStr, courtIdx, timeIdx, board) {
            if (courtIdx === null || dateStr === null) return false;
            const courtsIds = JSON.parse(board.dataset.courtIds);
            const bookings = JSON.parse(board.dataset.bookings);
            const times = JSON.parse(board.dataset.times);
            
            const courtId = courtsIds[courtIdx];
            const timeStr = times[timeIdx];
            const checkTimeInt = parseInt(timeStr.replace(':', ''), 10);
            
            return bookings.some(b => {
                if (b.field_id !== courtId || b.tanggal !== dateStr) return false;
                const startInt = parseInt(b.jam_mulai.substring(0, 5).replace(':', ''), 10);
                const endInt = parseInt(b.jam_selesai.substring(0, 5).replace(':', ''), 10);
                return checkTimeInt >= startInt && checkTimeInt < endInt;
            });
        }
        function ymd(d) {
            const m = String(d.getMonth() + 1).padStart(2, '0');
            const day = String(d.getDate()).padStart(2, '0');
            return d.getFullYear() + '-' + m + '-' + day;
        }
        function longLabel(d, isToday) {
            const s = d.toLocaleDateString('en-US', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
            return isToday ? ('today, ' + s) : s;
        }

        const timeCellCls = 'sticky left-0 z-10 border-b border-r border-gray-100 bg-white px-4 py-2.5 text-left font-semibold text-gray-700 whitespace-nowrap';
        const tdCls = 'border-b border-gray-50 px-2 py-2 text-center';
        const bookedCls = 'inline-flex w-full max-w-[8rem] items-center justify-center rounded-lg bg-gray-100 px-3 py-2 text-xs font-semibold text-gray-400 cursor-not-allowed select-none';
        const availCls = 'inline-flex w-full max-w-[8rem] items-center justify-center rounded-lg bg-blue-50 px-3 py-2 text-xs font-semibold text-[#0047D4] ring-1 ring-inset ring-blue-100 transition-all duration-150 hover:bg-[#0047D4] hover:text-white hover:ring-[#0047D4] active:scale-[0.97]';

        function initBoard(board) {
            const authed = board.dataset.authed === '1';
            const courts = JSON.parse(board.dataset.courts);
            const times = JSON.parse(board.dataset.times);
            const bookUrl = board.dataset.bookUrl;
            const body = board.querySelector('[data-schedule-body]');
            const label = board.querySelector('[data-date-label]');

            const today = new Date(); today.setHours(0, 0, 0, 0);
            let current = new Date(today);

            function render() {
                const ds = ymd(current);
                const isToday = ds === ymd(today);
                if (label) label.textContent = longLabel(current, isToday);

                let html = '';
                for (let ti = 0; ti < times.length; ti++) {
                    html += '<tr>';
                    html += '<td class="' + timeCellCls + '">' + times[ti] + '</td>';
                    for (let ci = 0; ci < courts.length; ci++) {
                        html += '<td class="' + tdCls + '">';
                        if (isBooked(ds, ci, ti, board)) {
                            html += '<span class="' + bookedCls + '">Booked</span>';
                        } else {
                            var href = bookUrl;
                            if (authed) {
                                href += '?court=' + encodeURIComponent(courts[ci])
                                      + '&date=' + encodeURIComponent(ds)
                                      + '&time=' + encodeURIComponent(times[ti]);
                            }
                            html += '<a href="' + href + '" title="Book ' + courts[ci] + ' at ' + times[ti] + '" class="' + availCls + '">Available</a>';
                        }
                        html += '</td>';
                    }
                    html += '</tr>';
                }
                body.innerHTML = html;
            }

            if (authed) {
                const input = board.querySelector('[data-date-input]');
                const prev = board.querySelector('[data-prev]');
                const next = board.querySelector('[data-next]');
                const todayBtn = board.querySelector('[data-today]');

                if (input) {
                    input.min = ymd(today);
                    input.value = ymd(current);
                    input.addEventListener('change', function () {
                        if (!input.value) return;
                        const picked = new Date(input.value + 'T00:00:00');
                        current = picked < today ? new Date(today) : picked;
                        input.value = ymd(current);
                        syncPrev();
                        render();
                    });
                }
                function syncPrev() { if (prev) prev.disabled = ymd(current) === ymd(today); }
                if (prev) prev.addEventListener('click', function () {
                    const n = new Date(current); n.setDate(n.getDate() - 1);
                    if (n >= today) { current = n; if (input) input.value = ymd(current); syncPrev(); render(); }
                });
                if (next) next.addEventListener('click', function () {
                    current.setDate(current.getDate() + 1);
                    if (input) input.value = ymd(current); syncPrev(); render();
                });
                if (todayBtn) todayBtn.addEventListener('click', function () {
                    current = new Date(today); if (input) input.value = ymd(current); syncPrev(); render();
                });
                syncPrev();
            }

            render();
        }

        document.querySelectorAll('[data-schedule-board]').forEach(initBoard);
    })();
</script>
