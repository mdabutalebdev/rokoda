<x-layout>
    {{-- ===== Hero: admin-managed auto-sliding banner (multiple images) =====
         Fully dynamic — upload hero slides from Admin → Banners (type: hero).
         Whatever images are uploaded slide automatically here. --}}
    <style>
        [data-hero-dot] { background-color: rgba(244, 102, 26, 0.5) !important; }
        [data-hero-dot].bg-accent, [data-hero-dot].bg-white { background-color: rgba(244, 102, 26, 1) !important; opacity: 1 !important; }
    </style>
    <section class="container-x pt-3 sm:pt-4">
        <div data-hero class="relative rounded-2xl overflow-hidden shadow-card bg-brand-light">
            <div data-hero-track class="flex transition-transform duration-500 ease-out">
                @forelse($centerSlides as $slide)
                    <a href="{{ $slide->link ?? '#' }}" class="w-full shrink-0 block">
                        <img src="{{ image_url($slide->image, 'Rokda') }}" alt="{{ $slide->title }}"
                             class="w-full aspect-[16/6] sm:aspect-[16/5] object-cover">
                    </a>
                @empty
                    <div class="w-full aspect-[16/6] sm:aspect-[16/5] bg-accent grid place-items-center text-white text-2xl font-bold tracking-wide">Rokda</div>
                @endforelse
            </div>

            @if($centerSlides->count() > 1)
                <button type="button" data-hero-prev class="absolute left-2 sm:left-4 top-1/2 -translate-y-1/2 w-9 h-9 sm:w-11 sm:h-11 rounded-full bg-white/85 hover:bg-white grid place-items-center shadow text-ink">
                    <i class="fa-solid fa-chevron-left"></i>
                </button>
                <button type="button" data-hero-next class="absolute right-2 sm:right-4 top-1/2 -translate-y-1/2 w-9 h-9 sm:w-11 sm:h-11 rounded-full bg-white/85 hover:bg-white grid place-items-center shadow text-ink">
                    <i class="fa-solid fa-chevron-right"></i>
                </button>
                <div class="absolute bottom-3 inset-x-0 flex justify-center gap-1.5">
                    @foreach($centerSlides as $i => $b)
                        <button type="button" data-hero-dot class="w-2.5 h-2.5 rounded-full bg-white/50 {{ $i === 0 ? 'bg-accent' : '' }}"></button>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    {{-- ===== Trust bar (image#2 style) ===== --}}
    <section class="container-x mt-4">
        <div class="rounded-xl overflow-hidden grid grid-cols-1 sm:grid-cols-3 text-white" style="background: var(--color-brand-dark);">
            @foreach([
                ['fa-shield-halved', 'Safe Payment', 'নিরাপদ পেমেন্ট'],
                ['fa-truck-fast', 'Fast Delivery', 'দ্রুত ডেলিভারি'],
                ['fa-rotate-left', 'Free Return', '৩ দিনে রিটার্ন'],
            ] as $i => $t)
                <div class="flex items-center justify-center gap-3 py-3.5 px-4 {{ $i > 0 ? 'sm:border-l border-white/10' : '' }}">
                    <i class="fa-solid {{ $t[0] }} text-accent text-xl"></i>
                    <div class="leading-tight">
                        <div class="font-bold text-sm">{{ $t[1] }}</div>
                        <div class="text-white/70 text-xs">{{ $t[2] }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- ===== Shop by Category — promo-image cards (image#4 style) =====
         Each tile shows the category's wide promo image (Admin → Categories → Promo
         image). Falls back to the square category image, then a coloured tile.
         Plain CSS so the section deploys by editing this Blade file alone. --}}
    @if($categories->isNotEmpty())
        <style>
            .mcat-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: .75rem; }
            @media (min-width: 768px) { .mcat-grid { grid-template-columns: repeat(4, 1fr); gap: 1rem; } }

            .mcat-card {
                position: relative; display: block; overflow: hidden;
                border-radius: 14px; aspect-ratio: 1350 / 690;
                border: 1px solid var(--color-line);
                box-shadow: 0 2px 8px rgba(16, 24, 40, .06);
                background: var(--color-brand-light);
            }
            .mcat-card img { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; transition: transform .4s ease; }
            .mcat-card:hover img { transform: scale(1.06); }
            .mcat-card:hover { box-shadow: 0 12px 30px rgba(16, 24, 40, .16); }

            /* Name label — only shown when we fall back to the plain square image. */
            .mcat-label {
                position: absolute; left: 0; right: 0; bottom: 0;
                padding: 1.5rem .75rem .6rem;
                background: linear-gradient(to top, rgba(0, 0, 0, .74), rgba(0, 0, 0, 0));
                color: #fff; font-weight: 700; font-size: .8125rem; line-height: 1.2;
            }
            @media (min-width: 640px) { .mcat-label { font-size: .9rem; } }

            /* Coloured fallback tile when a category has no image at all. */
            .mcat-fallback {
                position: absolute; inset: 0;
                display: flex; flex-direction: column; gap: .5rem;
                align-items: center; justify-content: center;
                text-align: center; padding: .5rem; color: #fff;
                background: linear-gradient(135deg, var(--color-brand), var(--color-brand-dark));
            }
            .mcat-fallback i { font-size: 1.9rem; }
            .mcat-fallback span { font-weight: 700; font-size: .8125rem; line-height: 1.2; }

            .mcat-all {
                display: inline-flex; align-items: center; gap: .5rem;
                color: var(--color-brand); font-weight: 700; font-size: .95rem;
                background: none; border: 1px solid var(--color-brand); cursor: pointer;
                padding: .6rem 1.5rem; border-radius: 999px; line-height: 1;
                transition: background-color .15s ease, color .15s ease;
            }
            .mcat-all:hover { background: var(--color-brand); color: #fff; }
        </style>

        <section class="container-x mt-8" x-data="{ showAll: false }">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg sm:text-xl font-extrabold flex items-center gap-2">
                    <span class="w-1.5 h-6 rounded-full bg-accent inline-block"></span>ক্যাটাগরি
                </h2>
            </div>

            {{-- First 8 categories show always (2 rows × 4). The rest stay hidden
                 until the shopper taps "See All Categories". --}}
            <div class="mcat-grid">
                @foreach($categories as $cat)
                    <a href="{{ route('shop', ['category' => $cat->slug]) }}"
                       class="mcat-card" aria-label="{{ $cat->name }}"
                       @if($loop->index >= 8) x-show="showAll" x-cloak @endif>
                        @if($cat->promo_image)
                            <img src="{{ image_url($cat->promo_image, $cat->name) }}" alt="{{ $cat->name }}" loading="lazy">
                        @elseif($cat->image)
                            <img src="{{ image_url($cat->image, $cat->name) }}" alt="{{ $cat->name }}" loading="lazy">
                            <span class="mcat-label">{{ $cat->name }}</span>
                        @else
                            <span class="mcat-fallback"><i class="{{ $cat->icon ?? 'fa-solid fa-tag' }}"></i><span>{{ $cat->name }}</span></span>
                        @endif
                    </a>
                @endforeach
            </div>

            @if($categories->count() > 8)
                <div class="text-center mt-6">
                    <button type="button" @click="showAll = !showAll" class="mcat-all">
                        <span x-show="!showAll">See All Categories <i class="fa-solid fa-chevron-down"></i></span>
                        <span x-show="showAll" x-cloak>Show Less <i class="fa-solid fa-chevron-up"></i></span>
                    </button>
                </div>
            @endif
        </section>
    @endif

    {{-- ===== Dynamic product sections (each controlled from the admin panel) ===== --}}
    @include('partials.product-row', ['title' => 'Flash Sale',   'icon' => '⚡', 'products' => $flashSale,   'viewAll' => route('shop', ['flash_sale' => 1])])
    @include('partials.product-row', ['title' => 'Featured',     'icon' => '⭐', 'products' => $featured,    'viewAll' => route('shop', ['featured' => 1])])
    @include('partials.product-row', ['title' => 'Best Selling', 'icon' => '🔥', 'products' => $bestSelling, 'viewAll' => route('shop', ['best_seller' => 1])])
    @include('partials.product-row', ['title' => 'New Arrival',  'icon' => '🆕', 'products' => $newArrival,  'viewAll' => route('shop', ['new_arrival' => 1])])

    {{-- ===== All Products grid with Load More ===== --}}
    @if($homeProducts->total() > 0)
        <section class="container-x mt-10"
                 x-data="{
                    page: 1,
                    loading: false,
                    hasMore: {{ $homeProducts->hasMorePages() ? 'true' : 'false' }},
                    async loadMore() {
                        if (this.loading || !this.hasMore) return;
                        this.loading = true;
                        const next = this.page + 1;
                        try {
                            const res = await fetch(`{{ route('home.load-more') }}?page=${next}`, { headers: { 'X-Requested-With': 'XMLHttpRequest' } });
                            const data = await res.json();
                            this.$refs.grid.insertAdjacentHTML('beforeend', data.html);
                            this.page = next;
                            this.hasMore = data.hasMore;
                        } catch (e) {
                            console.error('Load more failed', e);
                        } finally {
                            this.loading = false;
                        }
                    }
                 }">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-extrabold flex items-center gap-2">
                    <span class="w-1.5 h-6 rounded-full bg-accent inline-block"></span>All Products
                </h2>
                <a href="{{ route('shop') }}" class="text-brand text-sm font-semibold hover:underline">View All →</a>
            </div>

            <div x-ref="grid" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-3">
                @include('partials.home-products', ['products' => $homeProducts])
            </div>

            <div class="text-center mt-6" x-show="hasMore" x-cloak>
                <button type="button" @click="loadMore()" :disabled="loading"
                        class="btn-brand h-11 px-8 inline-flex items-center justify-center gap-2 disabled:opacity-60">
                    <span x-show="!loading">Load More</span>
                    <span x-show="loading" x-cloak class="inline-flex items-center gap-2"><i class="fa-solid fa-spinner fa-spin"></i> Loading...</span>
                </button>
            </div>
        </section>
    @endif

    {{-- ===== Customer reviews (sliding) ===== --}}
    @include('partials.reviews', ['testimonials' => $testimonials])

    {{-- ===== Trust badges (sits right before the footer) ===== --}}
    <section class="container-x mt-12">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
            @foreach([
                ['fa-truck-fast', 'Free Delivery', 'On selected orders'],
                ['fa-money-bill-wave', 'Cash on Delivery', 'Pay when you receive'],
                ['fa-rotate-left', 'Easy Return', 'Within 3 days'],
                ['fa-headset', '24/7 Support', 'Anytime, anywhere'],
            ] as $badge)
                <div class="bg-white rounded-xl border border-line p-4 flex items-center gap-3">
                    <span class="w-11 h-11 rounded-full bg-accent-light text-accent grid place-items-center text-lg shrink-0"><i class="fa-solid {{ $badge[0] }}"></i></span>
                    <div>
                        <div class="font-bold text-sm">{{ $badge[1] }}</div>
                        <div class="text-xs text-muted">{{ $badge[2] }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</x-layout>
