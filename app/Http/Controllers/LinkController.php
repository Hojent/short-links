<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use App\Http\Requests\LinkRequest;
use App\Models\Link;
use App\Services\LinkService;
use Illuminate\Support\Facades\Log;

class LinkController extends Controller
{
    protected $service;

    public function __construct(LinkService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $recentLinks = Link::orderByDesc('id')->limit(10)->get()->toArray();
        return view('home',
            compact('recentLinks')
        );
    }

    public function send(LinkRequest $request)
    {
        $sourceUrl = $request->input('sourceUrl');
        $currentUrl = Link::select('id','short_url')->orderByDesc('id')->first();
        $error = null;
        if (empty($currentUrl)) {
           $currentPrefix = null;
        } else {
           $currentPrefix = str_split(stristr($currentUrl->short_url, '_', true));
        }
        $base = ['a','b','c'];
        $shortLink = $this->service->generateShortLink($base, $currentPrefix);
        Log::info('=========== ' . json_encode($shortLink));
        if(isset($shortLink['short_link'])) {
            $newLink = Link::create(['source_url' => $sourceUrl, 'short_url' => $shortLink['short_link']]);
        } else {
            $error = $shortLink['error'];
        }
        $recentLinks = Link::orderByDesc('id')->limit(10)->get()->toArray();
        return view('links',
            compact('recentLinks', 'error')
        );

    }
}
