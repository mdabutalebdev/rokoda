<x-admin-layout title="Edit Social Link">
    <form action="{{ route('admin.social-links.update', $socialLink) }}" method="POST" class="max-w-xl bg-white border border-line rounded-lg overflow-hidden">
        @csrf
        @method('PUT')
        <div class="p-6 space-y-4">
            <div>
                <label for="name" class="block text-sm font-medium mb-1">Platform Name <span class="text-sale">*</span></label>
                <input type="text" name="name" id="name" value="{{ old('name', $socialLink->name) }}" class="w-full h-10 px-3 rounded-lg border border-line focus:border-brand focus:ring-1 focus:ring-brand outline-none" required>
            </div>
            
            <div>
                <label for="url" class="block text-sm font-medium mb-1">URL <span class="text-sale">*</span></label>
                <input type="url" name="url" id="url" value="{{ old('url', $socialLink->url) }}" class="w-full h-10 px-3 rounded-lg border border-line focus:border-brand focus:ring-1 focus:ring-brand outline-none" required>
            </div>

            <div>
                <label for="icon_class" class="block text-sm font-medium mb-1">FontAwesome Icon Class</label>
                <input type="text" name="icon_class" id="icon_class" value="{{ old('icon_class', $socialLink->icon_class) }}" class="w-full h-10 px-3 rounded-lg border border-line focus:border-brand focus:ring-1 focus:ring-brand outline-none">
            </div>

            <div>
                <label for="sort_order" class="block text-sm font-medium mb-1">Sort Order</label>
                <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $socialLink->sort_order) }}" class="w-full h-10 px-3 rounded-lg border border-line focus:border-brand focus:ring-1 focus:ring-brand outline-none">
            </div>
        </div>
        
        <div class="p-4 bg-canvas/50 border-t border-line flex justify-end gap-3">
            <a href="{{ route('admin.social-links.index') }}" class="h-10 px-4 rounded-lg bg-white border border-line text-sm font-medium hover:bg-canvas transition-colors inline-flex items-center">Cancel</a>
            <button type="submit" class="h-10 px-6 rounded-lg bg-brand text-white text-sm font-medium hover:bg-brand-dark transition-colors inline-flex items-center">Update Link</button>
        </div>
    </form>
</x-admin-layout>
