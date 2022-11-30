<?php

namespace App\Http\Livewire;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class ShowArticles extends Component
{
    public $searchString = '';

    public function updatingSearchString($value): void
    {
        $this->searchString = $value;
    }

    public function render(): Factory|View|Application
    {
        $articles = $this->getArticles();

        return view('livewire.show-articles', compact('articles'));
    }

    private function getArticles(): array
    {
        $apiKey = config('app.g_news_key');

        try {
            if (Cache::has($this->searchString)) {
                return Cache::get($this->searchString);
            }
            $response = Http::get('https://gnews.io/api/v4/search', [
                'q'       => empty($this->searchString) ? 'Latest' : $this->searchString,
                'token'   => $apiKey,
                'lang'    => 'en',
                'country' => 'us',
                'max'     => '9',
            ]);
            $responseBody = json_decode($response->body(), false);
            $articles = $responseBody->articles ?? [];
            if (! empty($articles)) {
                Cache::put($this->searchString, $articles);
            }

            return $articles;
        } catch (\Exception $exception) {
            throw new UnprocessableEntityHttpException($exception->getMessage(), $exception);
        }
    }
}
