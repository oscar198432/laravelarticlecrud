<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;

class PostComponent extends Component
{
    public $name, $body, $post_id;

    public $accion = "store";

    public function render()
    {
        $posts = Post::latest('id')->get();
        return view('livewire.post-component', compact('posts'));
    }

    //Ingresar datos
    public function store(){
        Post::create([
            'name' => $this->name,
            'body' => $this->body
        ]);

        $this->reset(['name', 'body']);
    }

    public function edit(Post $post){
        $this->name = $post->name;
        $this->body = $post->body;
        $this->post_id = $post->id;

        $this->accion = "update";
    }

    //actualizar registro
    public function update(){
        $post = Post::find($this->post_id);

        $post->update([
            'name' => $this->name,
            'body' => $this->body
        ]);

        //resetear campos
        $this->reset(['name', 'body', 'accion', 'post_id']);
    }

    //eliminar registro
    public function destroy(Post $post){
        $post->delete();
    }

    //resetear campos
    public function default(){
        $this->reset(['name', 'body', 'accion', 'post_id']);
    }
}
