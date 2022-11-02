<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Post extends Model
{
    protected $fillable = [
        'title',
        'content',
        'slug',
        'category_id',
        'cover'
    ];
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    static public function getUniqueSlugFromTitle($title)
    {

        $slug_base = Str::slug($title);
        $slug = $slug_base;
        //controllare che sia unico
        //usando una query sql
        $post_esistente = Post::where('slug', $slug_base)->first();
        $counter = 1;
        //se il post esiste cambio slug e rifaccio la ricerca
        while ($post_esistente) {
            $slug = $slug_base . '-' . $counter;
            $post_esistente = Post::where('slug', $slug)->first();
            $counter++;
        }
        return $slug;
    }

    //così non modifico il cover per non creare problemi con la delete
    public function getCoverPathAttribute()
    {

        // per abilitare riga sotto va modificato APP_URL in env, diventa http://localhost:8800
        // return Storage::disk('image')->url($this->cover);

        return $this->cover ? asset('images/'. $this->cover) :null;

        // return $this->cover ? Storage::disk('image')->url($this->cover) : null;
    }

    public function getDateAttribute()
    {
        return $this->created_at->format('d/m/Y');
    }

    //appendo cover path, per far arrivare la proprietà cover path
    protected $appends = ['cover_path','date'];
}
