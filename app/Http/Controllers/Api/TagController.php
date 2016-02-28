<?php


namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\CreateTagRequest;
use App\Tag;

class TagController extends Controller
{
    /**
     * @var TagRepository
     */
    private $tag;

    public function __construct(Tag $tag)
    {
        $this->tag = $tag;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return $this->tag->all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return \View::make('collection.create');
    }

    /**
     * Find the resource by name
     *
     * @param $name
     * @return Response
     */
    public function findByName($name)
    {
        return Response::json($this->tag->findByName($name));
    }
}
