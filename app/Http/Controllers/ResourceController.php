<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

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
            'cta_link' => ['nullable', 'string', 'max:2048'],
            'show_on_landing' => ['sometimes', 'boolean'],

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

        $bannerImage = $request->file('banner_image');

        $speakerPayload = $this->buildCleanSpeakersFromRequest($request);

        // Create the resource record
        $resourceData = $validated;
        $resourceData['benefits'] = $this->filterStringList($request->input('benefits'));
        $resourceData['event_highlights'] = $this->filterStringList($request->input('event_highlights'));
        $resourceData['target_audience'] = $this->filterStringList($request->input('target_audience'));
        $resourceData['speakers'] = $speakerPayload['speakers'];
        $resourceData['cta_link'] = filled($validated['cta_link'] ?? null) ? trim((string) $validated['cta_link']) : null;
        $resourceData['show_on_landing'] = $request->boolean('show_on_landing');

        $resource = Resource::create($resourceData);

        // Handle banner image via Spatie Media Library
        if ($bannerImage) {
            $resource->addMedia($bannerImage)->toMediaCollection('banner');
        }

        foreach ($speakerPayload['media_files'] as $index => $file) {
            $resource
                ->addMedia($file)
                ->withCustomProperties(['speaker_index' => $index])
                ->toMediaCollection('speakers');
        }

        return redirect()->route('resource.public.view', $resource);

    }

    public function view(Resource $resource)
    {
        $resource->loadMissing('media');

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
            'cta_link' => ['nullable', 'string', 'max:2048'],
            'show_on_landing' => ['sometimes', 'boolean'],

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
        $speakerPayload = $this->buildCleanSpeakersFromRequest($request);

        $resourceData = $validated;
        $resourceData['benefits'] = $this->filterStringList($request->input('benefits'));
        $resourceData['event_highlights'] = $this->filterStringList($request->input('event_highlights'));
        $resourceData['target_audience'] = $this->filterStringList($request->input('target_audience'));
        $resourceData['speakers'] = $speakerPayload['speakers'];
        $resourceData['cta_link'] = filled($validated['cta_link'] ?? null) ? trim((string) $validated['cta_link']) : null;
        $resourceData['show_on_landing'] = $request->boolean('show_on_landing');

        // Extract banner_image from validated data so we don't store it as JSON
        $bannerImage = $request->file('banner_image');

        // Update the resource record in the database
        $resource->update($resourceData);

        // If there's a new banner image, replace the existing one
        if ($bannerImage) {
            // Remove old banner if you want a clean replace
            $resource->clearMediaCollection('banner');
            $resource->addMedia($bannerImage)->toMediaCollection('banner');
        }

        foreach ($speakerPayload['media_files'] as $index => $file) {
            $resource
                ->addMedia($file)
                ->withCustomProperties(['speaker_index' => $index])
                ->toMediaCollection('speakers');
        }

        return redirect()
            ->route('admin.events.edit', $resource->id)
            ->with('success', 'Event updated successfully!');
    }

    public function destroy(Resource $resource)
    {
        // Delete the resource from the database.
        // If you're using Spatie Media Library, associated media will also be deleted.
        $resource->delete();

        // Redirect back to the resources index with a success message
        return redirect()
            ->route('admin.events')
            ->with('success', 'Event deleted successfully!');
    }

    /**
     * @return list<string>
     */
    private function filterStringList(mixed $items): array
    {
        if (! is_array($items)) {
            return [];
        }

        $out = [];
        foreach ($items as $item) {
            if (! is_string($item) && ! is_numeric($item)) {
                continue;
            }
            $s = trim((string) $item);
            if ($s !== '') {
                $out[] = $s;
            }
        }

        return $out;
    }

    /**
     * @return array{speakers: list<array{name: string, designation: string}>, media_files: array<int, UploadedFile>}
     */
    private function buildCleanSpeakersFromRequest(Request $request): array
    {
        $rows = $request->input('speakers', []);
        if (! is_array($rows)) {
            return ['speakers' => [], 'media_files' => []];
        }

        $speakers = [];
        $mediaFiles = [];

        foreach ($rows as $origIndex => $row) {
            if (! is_array($row)) {
                continue;
            }

            $name = trim((string) ($row['name'] ?? ''));
            $designation = trim((string) ($row['designation'] ?? ''));
            $hasFile = $request->hasFile("speakers.$origIndex.image");

            if ($name === '' && $designation === '' && ! $hasFile) {
                continue;
            }

            $newIndex = count($speakers);
            $speakers[] = [
                'name' => $name,
                'designation' => $designation,
            ];

            if ($hasFile) {
                $mediaFiles[$newIndex] = $request->file("speakers.$origIndex.image");
            }
        }

        return [
            'speakers' => $speakers,
            'media_files' => $mediaFiles,
        ];
    }
}
