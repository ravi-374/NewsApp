<div>
    <!--Section: Content-->
    <section class="text-center">
        <div class="mb-4">
            <h4 class="mb-3"><strong>{{ empty($searchString) ? 'Latest' : $searchString }} Articles</strong></h4>
            <input class="form-control me-2" type="search"
                   wire:model.debounce.400ms="searchString"
                   placeholder="Search Articles" aria-label="Search">
        </div>
        <div class="row">
            @foreach($articles as $article)
                <div class="col-lg-4 col-md-12 mb-4">
                    <div class="card">
                        <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                            <img src="{{ $article->image }}" style="width: 100%; height: 235px; object-fit: cover;"
                                 alt="Image"/>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ strlen($article->title) > 25 ? substr($article->title,0,25)."..." : $article->title }}</h5>
                            <p class="card-text">
                                {{ strlen($article->description) > 90 ? substr($article->description,0,90)."..." : $article->description }}
                            </p>
                            <a href="{{ $article->url }}" target="_blank" class="btn btn-primary">Read Article</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    {{--        <nav class="my-4" aria-label="...">--}}
    {{--            <ul class="pagination pagination-circle justify-content-center">--}}
    {{--                <li class="page-item">--}}
    {{--                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>--}}
    {{--                </li>--}}
    {{--                <li class="page-item"><a class="page-link" href="#">1</a></li>--}}
    {{--                <li class="page-item active" aria-current="page">--}}
    {{--                    <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>--}}
    {{--                </li>--}}
    {{--                <li class="page-item"><a class="page-link" href="#">3</a></li>--}}
    {{--                <li class="page-item">--}}
    {{--                    <a class="page-link" href="#">Next</a>--}}
    {{--                </li>--}}
    {{--            </ul>--}}
    {{--        </nav>--}}
</div>
