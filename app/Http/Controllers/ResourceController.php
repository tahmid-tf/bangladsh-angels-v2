<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    public function __invoke()
    {
        $resources = Resource::all();

        return view('admin.resource.index', compact('resources'));
    }

    public function create()
    {
        return view('admin.resource.create');
    }

    public function store(Request $request)
    {
        // Validate input, including 'type' which must be 'event' or 'webinar'
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:event,webinar',
            'location' => 'nullable|string|max:255',
            'date' => 'nullable|date',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i',
            'registration_fee' => 'nullable|numeric',
            'description' => 'required|string',
            'registration_details' => 'nullable|string',

            // Arrays for benefits, highlights, audience
            'benefits' => 'nullable|array',
            'event_highlights' => 'nullable|array',
            'target_audience' => 'nullable|array',

            // Each speaker is an array with optional image
            'speakers' => 'nullable|array',
            'speakers.*.name' => 'nullable|string|max:255',
            'speakers.*.designation' => 'nullable|string|max:255',
            'speakers.*.image' => 'nullable|image|max:2048',

            // Banner image
            'banner_image' => 'nullable|image|max:2048',
        ]);

        // Remove images from the validated data, so we don't store them as JSON
        $bannerImage = $request->file('banner_image');
        if (isset($validated['speakers'])) {
            foreach ($validated['speakers'] as $index => &$speaker) {
                unset($speaker['image']); // We'll handle image separately
            }
        }

        // Create the resource record
        $resourceData = $validated;
        // This ensures we store JSON arrays as arrays, not nested arrays with images
        $resourceData['benefits'] = $request->input('benefits', []);
        $resourceData['event_highlights'] = $request->input('event_highlights', []);
        $resourceData['target_audience'] = $request->input('target_audience', []);
        $resourceData['speakers'] = $request->input('speakers', []);

        $resource = Resource::create($resourceData);

        // Handle banner image via Spatie Media Library
        if ($bannerImage) {
            $resource->addMedia($bannerImage)->toMediaCollection('banner');
        }

        // Handle each speaker image
        if ($request->has('speakers')) {
            foreach ($request->speakers as $index => $speakerData) {
                if (isset($speakerData['image'])) {
                    $resource
                        ->addMedia($speakerData['image'])
                        ->withCustomProperties(['speaker_index' => $index])
                        ->toMediaCollection('speakers');
                }
            }
        }

        return redirect()->route('resource.public.view', $resource->id);

    }

    public function view(Resource $resource)
    {
        return view('resources.single', compact('resource'));
    }

    public function edit(Resource $resource)
    {
        return view('admin.resource.edit', compact('resource'));
    }

    public function update(Request $request, Resource $resource)
    {
        // Validate input, including 'type' which must be 'event' or 'webinar'
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:event,webinar',
            'location' => 'nullable|string|max:255',
            'date' => 'nullable|date',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i',
            'registration_fee' => 'nullable|numeric',
            'description' => 'required|string',
            'registration_details' => 'nullable|string',

            // Arrays for benefits, highlights, audience
            'benefits' => 'nullable|array',
            'event_highlights' => 'nullable|array',
            'target_audience' => 'nullable|array',

            // Each speaker is an array with optional image
            'speakers' => 'nullable|array',
            'speakers.*.name' => 'nullable|string|max:255',
            'speakers.*.designation' => 'nullable|string|max:255',
            'speakers.*.image' => 'nullable|image|max:2048',

            // Banner image
            'banner_image' => 'nullable|image|max:2048',
        ]);

        // Convert JSON fields to arrays if needed
        // We'll store them as arrays in the DB, so cast them in the model as well.
        $resourceData = $validated;
        $resourceData['benefits'] = $request->input('benefits', []);
        $resourceData['event_highlights'] = $request->input('event_highlights', []);
        $resourceData['target_audience'] = $request->input('target_audience', []);
        $resourceData['speakers'] = $request->input('speakers', []);

        // Extract banner_image from validated data so we don't store it as JSON
        $bannerImage = $request->file('banner_image');

        // For each speaker, remove 'image' so it's not stored in the JSON column
        if (isset($resourceData['speakers'])) {
            foreach ($resourceData['speakers'] as $index => &$speaker) {
                unset($speaker['image']); // We'll handle image uploads separately
            }
        }

        // Update the resource record in the database
        $resource->update($resourceData);

        // If there's a new banner image, replace the existing one
        if ($bannerImage) {
            // Remove old banner if you want a clean replace
            $resource->clearMediaCollection('banner');
            $resource->addMedia($bannerImage)->toMediaCollection('banner');
        }

        // Handle speaker images
        if ($request->has('speakers')) {
            foreach ($request->speakers as $index => $speakerData) {
                // If a new image was uploaded for this speaker
                if (isset($speakerData['image'])) {
                    // Optionally remove the old image for this index if you want a one-to-one replacement:
                    // $oldImage = $resource->getMedia('speakers')->first(function($media) use($index) {
                    //     return $media->getCustomProperty('speaker_index') == $index;
                    // });
                    // if ($oldImage) {
                    //     $oldImage->delete();
                    // }

                    // Add the new speaker image
                    $resource
                        ->addMedia($speakerData['image'])
                        ->withCustomProperties(['speaker_index' => $index])
                        ->toMediaCollection('speakers');
                }
            }
        }

        return redirect()
            ->route('resource.edit', $resource->id)
            ->with('success', 'Resource updated successfully!');
    }

    public function destroy(Resource $resource)
    {
        // Delete the resource from the database.
        // If you're using Spatie Media Library, associated media will also be deleted.
        $resource->delete();

        // Redirect back to the resources index with a success message
        return redirect()
            ->route('admin.resources')
            ->with('success', 'Resource deleted successfully!');
    }
}
