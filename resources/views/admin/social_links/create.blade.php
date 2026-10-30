<x-admin-layout title="Add Social Link">
    <form action="{{ route('admin.social-links.store') }}" method="POST" class="max-w-xl bg-white border border-line rounded-lg overflow-hidden">
        @csrf
        <div class="p-6 space-y-4">
            <div>
                <label for="name" class="block text-sm font-medium mb-1">Platform Name <span class="text-sale">*</span></label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" class="w-full h-10 px-3 rounded-lg border border-line focus:border-brand focus:ring-1 focus:ring-brand outline-none" placeholder="e.g. Facebook" required>
            </div>
            
            <div>
                <label for="url" class="block text-sm font-medium mb-1">URL <span class="text-sale">*</span></label>
                <input type="url" name="url" id="url" value="{{ old('url') }}" class="w-full h-10 px-3 rounded-lg border border-line focus:border-brand focus:ring-1 focus:ring-brand outline-none" placeholder="https://..." required>
            </div>

            <div>
                <label for="icon_class" class="block text-sm font-medium mb-1">FontAwesome Icon Class</label>
                <input type="text" name="icon_class" id="icon_class" value="{{ old('icon_class', 'fa-brands fa-') }}" class="w-full h-10 px-3 rounded-lg border border-line focus:border-brand focus:ring-1 focus:ring-brand outline-none" placeholder="e.g. fa-brands fa-facebook-f">
                <p class="text-xs text-muted mt-1">Visit <a href="https://fontawesome.com/search?o=r&m=free" target="_blank" class="text-brand hover:underline">FontAwesome</a> to find icon classes.</p>
            </div>

            <div>
                <label for="sort_order" class="block text-sm font-medium mb-1">Sort Order</label>
                <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', 0) }}" class="w-full h-10 px-3 rounded-lg border border-line focus:border-brand focus:ring-1 focus:ring-brand outline-none">
            </div>
        </div>
        
        <div class="p-4 bg-canvas/50 border-t border-line flex justify-end gap-3">
            <a href="{{ route('admin.social-links.index') }}" class="h-10 px-4 rounded-lg bg-white border border-line text-sm font-medium hover:bg-canvas transition-colors inline-flex items-center">Cancel</a>
            <button type="submit" class="h-10 px-6 rounded-lg bg-brand text-white text-sm font-medium hover:bg-brand-dark transition-colors inline-flex items-center">Save Link</button>
        </div>
    </form>
</x-admin-layout>
