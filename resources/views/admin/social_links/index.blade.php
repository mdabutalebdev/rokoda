<x-admin-layout title="Social Links">
    <div class="bg-white rounded-lg border border-line overflow-hidden">
        <div class="p-4 border-b border-line flex justify-between items-center bg-canvas/50">
            <h2 class="font-semibold">Social Links Settings</h2>
        </div>
        <div class="p-4">
            <form action="{{ route('admin.social-links.bulk-update') }}" method="POST">
                @csrf
                <table class="w-full text-left text-sm mb-4">
                    <thead class="bg-canvas border-b border-line text-muted">
                        <tr>
                            <th class="px-4 py-3 font-medium w-16 text-center">Active</th>
                            <th class="px-4 py-3 font-medium w-48">Platform</th>
                            <th class="px-4 py-3 font-medium">URL</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-line">
                        @forelse($links as $link)
                        <tr class="hover:bg-canvas/50 transition-colors">
                            <td class="px-4 py-3 text-center">
                                <input type="hidden" name="links[{{ $link->id }}][id]" value="{{ $link->id }}">
                                <input type="hidden" name="links[{{ $link->id }}][is_active]" value="0">
                                <input type="checkbox" name="links[{{ $link->id }}][is_active]" value="1" {{ $link->is_active ? 'checked' : '' }} class="w-4 h-4 text-brand bg-white border-line rounded focus:ring-brand focus:ring-2 cursor-pointer">
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-3">
                                    @if($link->icon_class)
                                    <div class="w-8 h-8 rounded bg-canvas grid place-items-center text-muted"><i class="{{ $link->icon_class }}"></i></div>
                                    @endif
                                    <span class="font-medium">{{ $link->name }}</span>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <input type="url" name="links[{{ $link->id }}][url]" value="{{ $link->url }}" class="w-full bg-white border border-line text-sm rounded-lg focus:ring-brand focus:border-brand block px-3 py-2" placeholder="https://...">
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-4 py-8 text-center text-muted">No social links found. Please run the seeder.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="flex justify-end">
                    <button type="submit" class="h-10 px-6 rounded-lg bg-brand text-white font-medium hover:bg-brand-dark transition-colors">Save Settings</button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
