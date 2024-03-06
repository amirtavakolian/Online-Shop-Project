<?php

namespace Modules\Banner\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Faker\Core\File;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Banner\App\Http\Requests\StoreBannerRequest;
use Modules\Banner\App\Http\Requests\UpdateBannerRequest;
use Modules\Banner\App\Models\Banner;
use Modules\Banner\App\Repositories\Contract\IBannerRepository;
use Modules\Banner\App\Services\FileUploader;

class BannerController extends Controller
{

    public function __construct(
        private FileUploader      $fileUploader,
        private IBannerRepository $bannerRepository
    )
    {
    }

    public function index()
    {
        $banners = $this->bannerRepository->all();
        return view('banner::index', compact('banners'));
    }

    public function create()
    {
        return view('banner::create');
    }

    public function store(StoreBannerRequest $request)
    {
        $bannerData = $request->validated();
        $bannerImage = $this->fileUploader->upload($request->file('image'), '/banners');
        $bannerData['image'] = $bannerImage;
        $this->bannerRepository->store($bannerData);
        return redirect()->route('panel.banners.index')->with('success', 'بنر با موفقیت ساخته شد');
    }

    public function edit(Banner $banner)
    {
        return view('banner::edit', compact('banner'));
    }

    public function update(UpdateBannerRequest $request, Banner $banner)
    {
        $bannerData = $request->validated();
        if ($request->has('image')) {
            $bannerData['image'] = $this->fileUploader->upload($request->file('image'), '/banners');
        }
        $this->bannerRepository->update($bannerData, $banner);
        return redirect()->route('panel.banners.index')->with('success', 'بنر با موفقیت بروز رسانی شد');
    }
}








