<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SocialLink;

class SocialLinkController extends Controller
{
    public function index()
    {
        $links = SocialLink::orderBy('sort_order', 'asc')->get();
        return view('admin.social_links.index', compact('links'));
    }

    public function create()
    {
        return view('admin.social_links.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'icon_class' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
        ]);

        SocialLink::create($request->all());

        return redirect()->route('admin.social-links.index')->with('success', 'Social link created successfully.');
    }

    public function edit(SocialLink $socialLink)
    {
        return view('admin.social_links.edit', compact('socialLink'));
    }

    public function update(Request $request, SocialLink $socialLink)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'icon_class' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
        ]);

        $socialLink->update($request->all());

        return redirect()->route('admin.social-links.index')->with('success', 'Social link updated successfully.');
    }

    public function destroy(SocialLink $socialLink)
    {
        $socialLink->delete();

        return redirect()->route('admin.social-links.index')->with('success', 'Social link deleted successfully.');
    }

    public function toggleActive(SocialLink $socialLink)
    {
        $socialLink->update(['is_active' => !$socialLink->is_active]);

        return redirect()->back()->with('success', 'Status updated successfully.');
    }

    public function bulkUpdate(Request $request)
    {
        $request->validate([
            'links' => 'required|array',
            'links.*.id' => 'required|exists:social_links,id',
            'links.*.url' => 'nullable|string|max:255',
            'links.*.is_active' => 'required|boolean',
        ]);

        foreach ($request->links as $linkData) {
            SocialLink::where('id', $linkData['id'])->update([
                'url' => $linkData['url'] ?? '',
                'is_active' => $linkData['is_active'],
            ]);
        }

        return redirect()->route('admin.social-links.index')->with('success', 'Social links updated successfully.');
    }
}
