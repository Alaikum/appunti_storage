<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::limit(150)->orderBy('id','desc')->get();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categories = Category::orderBy('name', 'asc')->get();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // controllo file caricato bene
        // dd($request->file('image')); 

        $params = $request->validate([
            'title' => 'required|max:255|min:3',
            'content' => 'required',
            'category_id' => 'nullable|exists:App\Category,id',
            'cover' => 'nullable|image|max:2048'  //non supera i due mega, ragiona in kilobyte
        ]);



        // $slug_base = Str::slug($params['title']);
        // $slug=$slug_base;
        // //controllare che sia unico
        // //usando una query sql
        // $post_esistente = Post::where('slug', $slug_base)->first();
        // $counter = 1;
        // //se il post esiste cambio slug e rifaccio la ricerca
        // while ($post_esistente) {
        //     $slug = $slug_base .'-'.$counter;
        //     $post_esistente = Post::where('slug', $slug)->first();
        //     $counter++;
        // }
        // $params['slug'] = $slug;
        $params['slug'] = Post::getUniqueSlugFromTitle($params['title']);

        if (array_key_exists('cover', $params)) {
            // $img_path = Storage::put('uploads', $request->file('cover'));

            //cambio disco di salvataggio
            $img_path = Storage::disk('images')->put('post_covers', $request->file('cover'));
            // dd($img_path);
            // $img_path=Storage::put('uploads', $params['image']);
            $params['cover'] = $img_path;
            // dd(  $params['cover']);
        }

        $post = Post::create($params);
        // dd($post);
        return redirect()->route('admin.posts.show', $post);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {

        $categories = Category::orderBy('name', 'asc')->get();
        return view('admin.posts.edit', compact('categories', 'post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $params = $request->validate([
            'title' => 'required|max:255|min:3',
            'content' => 'required',
            'category_id' => 'nullable|exists:App\Category,id'
        ]);

        if ($params['title'] !== $post->title) {
            $params['slug'] = Post::getUniqueSlugFromTitle($params['title']);
        }


        //   $params['slug']=str_replace(' ','-', $params['title']);
        $post->update($params);

        return redirect()->route('admin.posts.show', $post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //così se elimino il post rimane comunque salvato il percoso per eliminare la cover
        $cover = $post->cover;

        $post->delete();
        //elimino la foto dopo l'eliminazione del post
        if ($cover && Storage::disk('images')->exists($cover)) {
            Storage::disk('images')->delete($cover);
        }

        return redirect()->route('admin.posts.index');
    }
}
