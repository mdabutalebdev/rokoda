<x-admin-layout title="Delivery Charge Settings">
    <div class="bg-white rounded-lg border border-line overflow-hidden max-w-3xl">
        <div class="p-4 border-b border-line flex justify-between items-center bg-canvas/50">
            <h2 class="font-semibold">Delivery Charge Settings</h2>
        </div>
        <div class="p-4">
            <form action="{{ route('admin.delivery-charge.update') }}" method="POST">
                @csrf
                <div class="space-y-4 mb-6">
                    <div>
                        <label for="shipping_inside_dhaka" class="block text-sm font-medium text-ink mb-1">Inside Dhaka Delivery Charge (৳)</label>
                        <input type="number" name="shipping_inside_dhaka" id="shipping_inside_dhaka" value="{{ $settings['shipping_inside_dhaka'] ?? 60 }}" class="w-full bg-white border border-line text-sm rounded-lg focus:ring-brand focus:border-brand block px-3 py-2" required min="0">
                    </div>
                    <div>
                        <label for="shipping_outside_dhaka" class="block text-sm font-medium text-ink mb-1">Outside Dhaka Delivery Charge (৳)</label>
                        <input type="number" name="shipping_outside_dhaka" id="shipping_outside_dhaka" value="{{ $settings['shipping_outside_dhaka'] ?? 120 }}" class="w-full bg-white border border-line text-sm rounded-lg focus:ring-brand focus:border-brand block px-3 py-2" required min="0">
                    </div>
                    <div>
                        <label for="free_shipping_threshold" class="block text-sm font-medium text-ink mb-1">Free Delivery Above Amount (৳)</label>
                        <p class="text-xs text-muted mb-2">If a customer's cart total reaches this amount, their delivery charge will automatically become ৳ 0.</p>
                        <input type="number" name="free_shipping_threshold" id="free_shipping_threshold" value="{{ $settings['free_shipping_threshold'] ?? 1000000 }}" class="w-full bg-white border border-line text-sm rounded-lg focus:ring-brand focus:border-brand block px-3 py-2" required min="0">
                    </div>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="h-10 px-6 rounded-lg bg-brand text-white font-medium hover:bg-brand-dark transition-colors">Save Delivery Charges</button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
