@extends('layouts.admin')

@section('title', 'Courts Management')
@section('page-title', 'Courts Management')
@section('page-subtitle', 'Manage all sport courts, pricing, and availability')

@section('content')

    @php
        // $courts and $avgPrice are passed from AdminFieldController
        $sportColors = [
            'Futsal'     => ['bg' => 'bg-emerald-50',  'text' => 'text-emerald-700',  'icon_bg' => 'bg-emerald-100'],
            'Badminton'  => ['bg' => 'bg-sky-50',      'text' => 'text-sky-700',      'icon_bg' => 'bg-sky-100'],
            'Tennis'     => ['bg' => 'bg-amber-50',     'text' => 'text-amber-700',    'icon_bg' => 'bg-amber-100'],
            'Basketball' => ['bg' => 'bg-orange-50',    'text' => 'text-orange-700',   'icon_bg' => 'bg-orange-100'],
            'Volleyball' => ['bg' => 'bg-violet-50',    'text' => 'text-violet-700',   'icon_bg' => 'bg-violet-100'],
        ];
    @endphp


{{-- Page Header --}}
                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h1 class="text-2xl font-extrabold tracking-tight text-gray-900 sm:text-3xl">Courts Management</h1>
                        <p class="mt-1 text-sm text-gray-500">Manage all sport courts, pricing, and availability.</p>
                    </div>
                    <button type="button" onclick="openModal()" class="inline-flex items-center justify-center gap-2 rounded-2xl bg-[#0047D4] px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-blue-500/10 hover:bg-[#003cb5] active:scale-[0.98] transition-all duration-200">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"></path><path d="M12 5v14"></path></svg>
                        Add Court
                    </button>
                </div>

                {{-- Stats Row --}}
                <div class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                    <div class="rounded-2xl border border-gray-100 bg-white p-4 shadow-xs">
                        <p class="text-xs font-bold uppercase tracking-wider text-gray-400">Total Courts</p>
                        <p class="mt-1 text-2xl font-extrabold text-gray-900">{{ count($courts) }}</p>
                    </div>
                    <div class="rounded-2xl border border-gray-100 bg-white p-4 shadow-xs">
                        <p class="text-xs font-bold uppercase tracking-wider text-gray-400">Active</p>
                        <p class="mt-1 text-2xl font-extrabold text-emerald-600">{{ collect($courts)->where('status', 'aktif')->count() }}</p>
                    </div>
                    <div class="rounded-2xl border border-gray-100 bg-white p-4 shadow-xs">
                        <p class="text-xs font-bold uppercase tracking-wider text-gray-400">Maintenance</p>
                        <p class="mt-1 text-2xl font-extrabold text-amber-600">{{ collect($courts)->where('status', 'maintenance')->count() }}</p>
                    </div>
                    <div class="rounded-2xl border border-gray-100 bg-white p-4 shadow-xs">
                        <p class="text-xs font-bold uppercase tracking-wider text-gray-400">Avg. Price</p>
                        <p class="mt-1 text-2xl font-extrabold text-gray-900">Rp {{ number_format($avgPrice, 0, ',', '.') }}</p>
                    </div>
                </div>

                {{-- Alert Messages --}}
                @if(session('success'))
                    <div class="mt-4 p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                @if($errors->any())
                    <div class="mt-4 p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
                        <ul class="list-disc pl-5">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Court Cards Grid --}}
                <div class="mt-8 grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-3">
                    @foreach ($courts as $court)
                        @php
                            $colors = $sportColors[$court->jenis_olahraga] ?? ['bg' => 'bg-gray-50', 'text' => 'text-gray-700', 'icon_bg' => 'bg-gray-100'];
                            $isActive = $court->status === 'aktif';
                            $sportIcon = strtolower($court->jenis_olahraga);
                        @endphp
                        <div class="group relative overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-xs transition-all duration-200 hover:-translate-y-0.5 hover:shadow-lg hover:shadow-blue-500/10">

                            {{-- Image Placeholder --}}
                            <div class="relative flex h-44 items-center justify-center {{ $colors['icon_bg'] }} overflow-hidden">
                                @if($court->foto)
                                    <img src="{{ asset('storage/' . $court->foto) }}" alt="{{ $court->nama_lapangan }}" class="absolute inset-0 h-full w-full object-cover">
                                    <div class="absolute inset-0 bg-black/10"></div>
                                @endif
                                @if (!$isActive)
                                    <div class="absolute inset-0 bg-gray-900/30 backdrop-blur-[1px]"></div>
                                    <span class="absolute right-3 top-3 z-10 rounded-full bg-red-500 px-3 py-1 text-xs font-bold text-white shadow-sm">Maintenance</span>
                                @endif

                                @if ($sportIcon === 'futsal')
                                    <svg class="h-16 w-16 text-emerald-400/70" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><path d="m12 2 3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01z"></path></svg>
                                @elseif ($sportIcon === 'badminton')
                                    <svg class="h-16 w-16 text-sky-400/70" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path><path d="M2 12h20"></path></svg>
                                @elseif ($sportIcon === 'tennis')
                                    <svg class="h-16 w-16 text-amber-400/70" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><path d="M18.09 5.91A5.97 5.97 0 0 0 12 4a5.97 5.97 0 0 0-6.09 1.91"></path><path d="M5.91 18.09A5.97 5.97 0 0 0 12 20a5.97 5.97 0 0 0 6.09-1.91"></path><path d="M2 12h20"></path></svg>
                                @elseif ($sportIcon === 'basketball')
                                    <svg class="h-16 w-16 text-orange-400/70" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><path d="M12 2v20"></path><path d="M2 12h20"></path><path d="M4.93 4.93c4.08 2.64 4.08 11.5 0 14.14"></path><path d="M19.07 4.93c-4.08 2.64-4.08 11.5 0 14.14"></path></svg>
                                @elseif ($sportIcon === 'volleyball')
                                    <svg class="h-16 w-16 text-violet-400/70" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><path d="M12 2a10 10 0 0 1 0 20"></path><path d="M2 12h10"></path><path d="M12 12 7.5 3.5"></path><path d="M12 12 7.5 20.5"></path></svg>
                                @else
                                    <svg class="h-16 w-16 text-gray-400/70" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle></svg>
                                @endif
                            </div>

                            {{-- Card Body --}}
                            <div class="p-5">
                                {{-- Sport Badge + Status --}}
                                <div class="flex items-center justify-between">
                                    <span class="inline-flex items-center rounded-lg px-2.5 py-1 text-xs font-semibold {{ $colors['bg'] }} {{ $colors['text'] }}">
                                        {{ $court->jenis_olahraga }}
                                    </span>
                                    <span class="inline-flex items-center gap-1.5 text-xs font-medium {{ $isActive ? 'text-emerald-600' : 'text-amber-500' }}">
                                        <span class="h-2 w-2 rounded-full {{ $isActive ? 'bg-emerald-500' : 'bg-amber-500' }}"></span>
                                        {{ ucfirst($court->status) }}
                                    </span>
                                </div>

                                {{-- Name --}}
                                <h3 class="mt-3 text-lg font-bold text-gray-900">{{ $court->nama_lapangan }}</h3>

                                {{-- Price --}}
                                <p class="mt-1 text-sm font-semibold text-[#0047D4]">Rp {{ number_format($court->harga, 0, ',', '.') }}<span class="font-normal text-gray-400">/hour</span></p>

                                {{-- Description --}}
                                <p class="mt-3 line-clamp-2 text-sm leading-relaxed text-gray-500">{{ $court->deskripsi ?: 'No description provided.' }}</p>

                                {{-- Actions --}}
                                <div class="mt-5 flex items-center gap-2">
                                    <button type="button" onclick='openEditModal(@json($court))' class="inline-flex flex-1 items-center justify-center gap-1.5 rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 shadow-xs transition-all duration-150 hover:border-[#0047D4] hover:text-[#0047D4]">
                                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"></path><path d="m15 5 4 4"></path></svg>
                                        Edit
                                    </button>
                                    <form action="{{ route('admin.courts.destroy', $court->id) }}" method="POST" class="flex-1" onsubmit="return confirm('Are you sure you want to delete this court?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full inline-flex items-center justify-center gap-1.5 rounded-xl border border-red-200 bg-white px-4 py-2.5 text-sm font-semibold text-red-600 shadow-xs transition-all duration-150 hover:bg-red-50">
                                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"></path><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>


{{-- ======================== ADD COURT MODAL ======================== --}}
    <div id="add-court-modal" class="fixed inset-0 z-50 hidden">
        {{-- Backdrop --}}
        <div onclick="closeModal()" class="absolute inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity duration-300"></div>

        {{-- Modal Panel --}}
        <div class="absolute inset-0 flex items-center justify-center p-4">
            <div class="relative w-full max-w-lg rounded-3xl border border-gray-100 bg-white shadow-2xl">

                {{-- Header --}}
                <div class="flex items-center justify-between border-b border-gray-100 px-6 py-4">
                    <h2 class="text-lg font-bold text-gray-900">Add New Court</h2>
                    <button type="button" onclick="closeModal()" class="rounded-xl p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-600 transition-colors duration-150" aria-label="Close modal">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"></path><path d="m6 6 12 12"></path></svg>
                    </button>
                </div>

                {{-- Form --}}
                <form id="court-form" action="{{ route('admin.courts.store') }}" method="POST" enctype="multipart/form-data" class="px-6 py-5 space-y-5">
                    @csrf
                    <input type="hidden" name="_method" id="form-method" value="POST">

                    {{-- Court Name --}}
                    <div>
                        <label for="court-name" class="block text-sm font-semibold text-gray-700">Court Name</label>
                        <input type="text" name="nama_lapangan" id="court-name" placeholder="e.g. Lapangan Futsal" required class="mt-1.5 w-full rounded-xl border border-gray-200 bg-[#F7F8FA] px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 outline-none transition-colors duration-150 focus:border-[#0047D4] focus:ring-2 focus:ring-blue-500/10">
                    </div>

                    {{-- Sport Type --}}
                    <div>
                        <label for="sport-type" class="block text-sm font-semibold text-gray-700">Sport Type</label>
                        <select name="jenis_olahraga" id="sport-type" required class="mt-1.5 w-full rounded-xl border border-gray-200 bg-[#F7F8FA] px-4 py-2.5 text-sm text-gray-900 outline-none transition-colors duration-150 focus:border-[#0047D4] focus:ring-2 focus:ring-blue-500/10">
                            <option value="" disabled selected>Select a sport</option>
                            <option value="Futsal">Futsal</option>
                            <option value="Badminton">Badminton</option>
                            <option value="Tennis">Tennis</option>
                            <option value="Basketball">Basketball</option>
                            <option value="Volleyball">Volleyball</option>
                        </select>
                    </div>

                    {{-- Status (Only for Edit) --}}
                    <div id="status-container" class="hidden">
                        <label for="court-status" class="block text-sm font-semibold text-gray-700">Status</label>
                        <select name="status" id="court-status" class="mt-1.5 w-full rounded-xl border border-gray-200 bg-[#F7F8FA] px-4 py-2.5 text-sm text-gray-900 outline-none transition-colors duration-150 focus:border-[#0047D4] focus:ring-2 focus:ring-blue-500/10">
                            <option value="aktif">Aktif</option>
                            <option value="maintenance">Maintenance</option>
                        </select>
                    </div>

                    {{-- Fixed Price --}}
                    <div>
                        <label for="court-price" class="block text-sm font-semibold text-gray-700">Fixed Price per Hour</label>
                        <div class="relative mt-1.5">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-sm font-semibold text-gray-500">Rp</span>
                            <input type="number" name="harga" id="court-price" placeholder="150000" required min="0" class="w-full rounded-xl border border-gray-200 bg-[#F7F8FA] py-2.5 pl-10 pr-4 text-sm text-gray-900 placeholder-gray-400 outline-none transition-colors duration-150 focus:border-[#0047D4] focus:ring-2 focus:ring-blue-500/10">
                        </div>
                    </div>

                    {{-- Description --}}
                    <div>
                        <label for="court-desc" class="block text-sm font-semibold text-gray-700">Description</label>
                        <textarea name="deskripsi" id="court-desc" rows="3" placeholder="Brief description of the court..." class="mt-1.5 w-full resize-none rounded-xl border border-gray-200 bg-[#F7F8FA] px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 outline-none transition-colors duration-150 focus:border-[#0047D4] focus:ring-2 focus:ring-blue-500/10"></textarea>
                    </div>

                    {{-- Foto Lapangan --}}
                    <div>
                        <label for="court-foto" class="block text-sm font-semibold text-gray-700">Court Photo (Optional)</label>
                        <input type="file" name="foto" id="court-foto" accept="image/*" class="mt-1.5 w-full rounded-xl border border-gray-200 bg-[#F7F8FA] px-4 py-2 text-sm text-gray-900 file:mr-4 file:rounded-full file:border-0 file:bg-blue-50 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-[#0047D4] hover:file:bg-blue-100 transition-colors duration-150 focus:border-[#0047D4] focus:ring-2 focus:ring-blue-500/10">
                    </div>

                    {{-- Footer --}}
                    <div class="flex items-center justify-end gap-3 pt-2">
                        <button type="button" onclick="closeModal()" class="rounded-xl border border-gray-200 bg-white px-5 py-2.5 text-sm font-semibold text-gray-700 shadow-xs transition-colors duration-150 hover:bg-gray-50">
                            Cancel
                        </button>
                        <button type="submit" class="rounded-xl bg-[#0047D4] px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-blue-500/10 transition-all duration-200 hover:bg-[#003cb5] active:scale-[0.98]">
                            Save Court
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Modal open/close
    function openModal() {
        document.getElementById('court-form').reset();
        document.getElementById('court-form').action = "{{ route('admin.courts.store') }}";
        document.getElementById('form-method').value = "POST";
        document.getElementById('status-container').classList.add('hidden');
        document.getElementById('court-status').disabled = true;
        
        document.getElementById('add-court-modal').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function openEditModal(court) {
        document.getElementById('court-form').action = `/admin/courts/${court.id}`;
        document.getElementById('form-method').value = "PUT";
        
        document.getElementById('court-name').value = court.nama_lapangan;
        document.getElementById('sport-type').value = court.jenis_olahraga;
        document.getElementById('court-price').value = Math.round(court.harga);
        document.getElementById('court-desc').value = court.deskripsi || '';
        
        document.getElementById('status-container').classList.remove('hidden');
        document.getElementById('court-status').disabled = false;
        document.getElementById('court-status').value = court.status;

        document.getElementById('add-court-modal').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function closeModal() {
        document.getElementById('add-court-modal').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    // Close modal on Escape key
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeModal();
    });


</script>
@endpush
