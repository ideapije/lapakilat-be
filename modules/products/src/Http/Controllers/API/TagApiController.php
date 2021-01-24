<?php 

namespace Lapakilat\ProductModule\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Lapakilat\ProductModule\Http\Requests\FilterTag;
use Lapakilat\ProductModule\Http\Requests\StoreTag;
use Lapakilat\ProductModule\Http\Requests\UpdateTag;
use Lapakilat\ProductModule\Tag;

class TagApiController extends Controller
{
	
	public function index(FilterTag $request, Tag $tags)
    {
        $tags = $this->handleByCategory($request, $tags);
        $tags = $tags->get();
        return response()->json([
            'data' => $tags
        ]);
    }

    private function handleByCategory(FilterTag $request, $tags)
    {
        if ($request->has('c')) {
            $tags = $tags->where('as_category', $request->c);
        }
        return $tags;
    }

    public function store(StoreTag $request, Tag $tag)
    {
        $tag = $tag->create($request->all());
        return response()->json([
            'data' => $tag
        ]);
    }

    public function show(Request $request, Tag $tag)
    {
        return response()->json([
            'data' => $tag
        ]);
    }

    public function update(UpdateTag $request, Tag $tag)
    {
        $tag->update($request->all());
        return response()->json([
            'data' => $tag
        ]);
    }

    public function destroy(Request $request, Tag $tag)
    {
        $tag->delete();
        return response()->json([
            'data' => $tag
        ]);
    }
}