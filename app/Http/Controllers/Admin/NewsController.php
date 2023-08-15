<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\News;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $news = News::latest()->get();
        return view('layouts.admin.berita.index', [
            'news' => $news,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        return view('layouts.admin.berita.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|unique:news|min:5',
            'body' => 'required|min:5',
            'image' => 'required|image|mimes:png,jpg,jpeg',
            'sector' => 'required|in:1,2,3,4'
        ]);

        // summernote save image

        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($request->body, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');

        foreach ($images as $img) {
            $src = $img->getAttribute('src');
            if (preg_match('/data:image/', $src)) {
                // preg_match('/data:image\/(?.*?)\;/',$src,$groups);
                preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                $mimetype = $groups['mime'];
                $path = 'storage/news/image/';
                $filename = uniqid() . '.' . $mimetype;
                $filepath =  $path . $filename;

                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }

                $image = Image::make($src)->encode($mimetype, 100)->save($filepath);

                $new_src = asset($filepath);
                $img->removeAttribute('src');
                $img->setAttribute('src', $new_src);
            }
        }

        // batas

        if ($request->file('image') && $request->file('image')->isValid()) {

            $path = storage_path('app/public/news/');
            $filename = $request->file('image')->hashName();

            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            Image::make($request->file('image')->getRealPath())->resize(500, 500, function ($constraint) {
                $constraint->upsize();
                $constraint->aspectRatio();
            })->save($path . $filename);

            $attr['image'] = $filename;
        }

        News::create([
            'slug' =>  Str::slug($request->title),
            'title' => $request->title,
            'body' => $dom->saveHTML(),
            'image' => $attr['image'],
            'sector' => $request->sector,
        ]);

        return redirect()
            ->route('news.index')
            ->with('success', __('Data berhasil dibuat.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        return view('layouts.admin.berita.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)
    {
        $attr = $this->validate($request, [
            'title'  => 'required',
            'body'   => 'required',
            'sector' => 'required',
        ]);

        // summernote save image

        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($request->body, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');

        foreach ($images as $img) {
            $src = $img->getAttribute('src');
            if (preg_match('/data:image/', $src)) {
                // preg_match('/data:image\/(?.*?)\;/',$src,$groups);
                preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                $mimetype = $groups['mime'];
                $filename = uniqid() . '.' . $mimetype;
                $filepath =  'storage/news/image/' . $filename;

                $image = Image::make($src)->encode($mimetype, 100)->save($filepath);

                $new_src = asset($filepath);
                $img->removeAttribute('src');
                $img->setAttribute('src', $new_src);
            }
        }
        // batas

        //get data news by ID
        $news = News::findOrFail($news->id);

        if ($request->file('image') == "") {

            $news->update([
                'slug' =>  Str::slug($request->title),
                'title'  => $request->title,
                'body' => $dom->saveHTML(),
                'sector' => $request->sector,
            ]);
        } else {

            // hapus image
            $delete = News::findOrFail($news->id);
            $file = public_path('storage/news/') . $delete->image;
            if (file_exists($file)) {
                @unlink($file);
            }
            Storage::delete($file);

            // Upload Kembali Data
            $image = $request->file('image');
            $image->store('news', 'public');

            $news->update([
                'slug' =>  Str::slug($request->title),
                'title'  => $request->title,
                'body'   => $dom->saveHTML(),
                'image'  => $image->hashName(),
                'sector' => $request->sector,
            ]);
        }

        return redirect()
            ->route('news.index')
            ->with('success', __('Artikel berhasil dibuat.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        try {
            // determine path image
            $path = storage_path('app/public/news/');

            // if image exist remove file from directory
            if ($news->image != null && file_exists($path . $news->image)) {
                unlink($path . $news->image);
            }

            // summernote 
            $dom = new \DOMDocument();
            libxml_use_internal_errors(true);
            $dom->loadHTML($news->body, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $images = $dom->getElementsByTagName('img');
            foreach ($images as $img) {
                $src = $img->getAttribute('src');

                // if summernote image exist remove file from directory
                if ($src) {
                    $len = strlen("http://127.0.0.1:8000/storage/news/image/");
                    $fileName = substr($src, $len, strlen($src) - $len);
                    unlink(public_path('storage/news/image/' . $fileName));
                }
            }

            $news->delete();

            return redirect()
                ->route('news.index')
                ->with('success', __('Data berhasil dihapus.'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('news.index')
                ->with('error', __('Data tidak bisa dihapus karena berelasi dengan data lain.' . $th->getMessage()));
        }
    }
}
