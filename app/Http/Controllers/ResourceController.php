<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resource;

class ResourceController extends Controller
{
    public function __invoke()
    {
        $resources = Resource::all();

        // Return the index view with the resources data
        return view('admin.resource.index', compact('resources'));
    }

    public function create()
    {
        return view('admin.resource.create');
    }

    public function store()
    {
        $validated = $request->validate([
            'title'                 => 'required|string|max:255',
            'description'           => 'nullable|string',
            'date'                  => 'nullable|date',
            'start_time'            => 'nullable|date_format:H:i',
            'end_time'              => 'nullable|date_format:H:i',
            'location'              => 'nullable|string|max:255',
            'registration_fee'      => 'nullable|numeric',
            'benefits'              => 'nullable|array',
            'event_highlights'      => 'nullable|array',
            'target_audience'       => 'nullable|array',
            'registration_details'  => 'nullable|string',

            // Speakers: a JSON array of speaker data
            'speakers'              => 'nullable|array',
            'speakers.*.name'       => 'required_with:speakers|string|max:255',
            'speakers.*.designation'=> 'required_with:speakers|string|max:255',
            // ... any other speaker fields (company, etc.)

            // Banner image
            'banner_image'          => 'nullable|image|max:2048',

            // Speaker images (one per speaker)
            'speakers.*.image'      => 'nullable|image|max:2048',
        ]);

        // Create resource with everything except images
        // (We remove 'banner_image' and 'speakers.*.image' so we don't store them as JSON)
        $resourceData = $validated;
        unset($resourceData['banner_image']);

        // We only store speaker text data in the 'speakers' JSON column, not the images
        if (isset($resourceData['speakers'])) {
            foreach ($resourceData['speakers'] as $index => &$speaker) {
                unset($speaker['image']);
            }
        }

        $resource = Resource::create($resourceData);

        // 1. Attach the banner image (single file collection)
        if ($request->hasFile('banner_image')) {
            $resource
                ->addMedia($request->file('banner_image'))
                ->toMediaCollection('banner');
        }

        // 2. Attach each speaker’s image to the 'speakers' collection
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

        return response()->json([
            'message' => 'Resource created successfully',
            'data'    => $resource
        ], 201);

    }

    public function view()
    {

    }

    public function edit()
    {

    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}
