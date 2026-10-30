<x-admin-layout title="Orders">
    <form method="GET" class="flex items-center gap-2 mb-4 flex-wrap">
        <div class="relative flex-1 max-w-xs">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Search order/phone..." class="w-full h-10 rounded-lg border border-line pl-9 pr-3 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-brand/30">
            <i class="fa-solid fa-magnifying-glass absolute left-3 top-3 text-muted text-sm"></i>
        </div>
        <select name="status" onchange="this.form.submit()" class="h-10 rounded-lg border border-line px-3 text-sm bg-white">
            <option value="">All Statuses</option>
            @foreach(\App\Models\Order::STATUS_LABELS as $key => $label)
                <option value="{{ $key }}" @selected(request('status')===$key)>{{ $label }}</option>
            @endforeach
        </select>
        <button class="h-10 px-4 rounded-lg bg-brand text-white text-sm font-semibold">Filter</button>
    </form>

    <div x-data="{ 
        selectAll: false, 
        selected: [], 
        toggleAll() { 
            this.selectAll = !this.selectAll; 
            if(this.selectAll) { this.selected = {{ $orders->pluck('id')->toJson() }}; } else { this.selected = []; }
        }
    }">
        <form method="POST" action="{{ route('admin.orders.bulk_print') }}" target="_blank">
            @csrf
            <div class="flex justify-end mb-3" x-show="selected.length > 0" x-cloak>
                <button type="submit" class="h-10 px-4 rounded-lg bg-ink text-white text-sm font-semibold flex items-center gap-2">
                    <i class="fa-solid fa-print"></i> Print Selected Invoices (<span x-text="selected.length"></span>)
                </button>
            </div>

            <div class="bg-white rounded-xl border border-line overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-canvas text-muted text-left">
                            <tr>
                                <th class="px-4 py-3 w-10"><input type="checkbox" @click="toggleAll()" :checked="selectAll" class="accent-brand w-4 h-4 rounded border-line"></th>
                                <th class="px-4 py-3 font-semibold">Order No</th>
                                <th class="px-4 py-3 font-semibold">Customer</th>
                                <th class="px-4 py-3 font-semibold">Products</th>
                                <th class="px-4 py-3 font-semibold">Total</th>
                                <th class="px-4 py-3 font-semibold">Payment</th>
                                <th class="px-4 py-3 font-semibold">Status</th>
                                <th class="px-4 py-3 font-semibold text-right"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-line">
                            @forelse($orders as $order)
                                <tr class="hover:bg-canvas">
                                    <td class="px-4 py-3"><input type="checkbox" name="order_ids[]" value="{{ $order->id }}" x-model="selected" class="accent-brand w-4 h-4 rounded border-line"></td>
                                    <td class="px-4 py-3"><a href="{{ route('admin.orders.show', $order) }}" class="font-semibold text-brand">{{ $order->order_number }}</a><div class="text-xs text-muted">{{ $order->created_at->format('d M, g:i A') }}</div></td>
                                    <td class="px-4 py-3">{{ $order->name }}<div class="text-xs text-muted">{{ $order->phone }}</div></td>
                                    <td class="px-4 py-3">{{ $order->items_count }} items</td>
                                    <td class="px-4 py-3 font-bold">{{ bdt($order->total) }}</td>
                                    <td class="px-4 py-3"><span class="text-xs">{{ $order->payment_method === 'cod' ? 'COD' : 'Mobile' }}</span></td>
                                    <td class="px-4 py-3"><span class="text-xs font-semibold px-2 py-1 rounded-full bg-brand-light text-brand">{{ \App\Models\Order::STATUS_LABELS[$order->status] ?? $order->status }}</span></td>
                                    <td class="px-4 py-3 text-right"><a href="{{ route('admin.orders.show', $order) }}" class="text-brand"><i class="fa-solid fa-eye"></i></a></td>
                                </tr>
                            @empty
                                <tr><td colspan="8" class="px-4 py-10 text-center text-muted">No orders yet.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
    </div>

    <div class="mt-4">{{ $orders->links() }}</div>
</x-admin-layout>
