<?php

namespace Modules\Attributes\App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Http\Requests\UpdateAttributeRequest;
use Exception;
use Illuminate\Support\Facades\Log;
use Modules\Attributes\App\Http\Requests\StoreAttributeRequest;
use Modules\Attributes\App\Models\Attribute;
use Modules\Attributes\App\Repositories\Contract\iAttributeRepo;

class AttributesController extends Controller
{

    public function __construct(private iAttributeRepo $attributeRepo)
    {
    }

    public function index()
    {
        $attributes = $this->attributeRepo->all();
        $attributesCount = $this->attributeRepo->count();
        return view('attributes::index', compact('attributesCount', 'attributes'));
    }

    public function create()
    {
        return view('attributes::create');
    }

    public function store(StoreAttributeRequest $request)
    {
        try {
            $this->attributeRepo->create($request->validated());
        } catch (Exception $e) {
            Log::info('something wrong happened: ' . self::class);
            return redirect()->back()->with('failed', 'خطا در ساخت ویژگی');
        }
        return redirect()->route('attributes.index')->with('success', 'ویژگی با موفقیت ساخته شد');
    }

    public function edit(Attribute $attribute)
    {
        return view('attributes::edit', compact('attribute'));
    }

    public function update(UpdateAttributeRequest $request, Attribute $attribute)
    {
        try {
            $this->attributeRepo->update($request->validated(), $attribute);
        } catch (Exception $e) {
            Log::info('something wrong happened: ' . self::class);
            return redirect()->back()->with('failed', 'خطا در آپدیت ویژگی');
        }
        return redirect()->route('attributes.index')->with('success', 'ویژگی با موفقیت آپدیت شد');
    }

    public function destroy(Attribute $attribute)
    {
        try {
            $this->attributeRepo->delete($attribute);
        } catch (Exception $e) {
            Log::info('something bad happened' . self::class);
            return response()->json([
                'status' => 'failed',
                'message' => 'مشکل در حذف ویژگی'
            ]);
        }
        return response()->json([
            'status' => 'success',
            'message' => 'ویژگی با موفقیت حذف شد.'
        ]);
    }

}

