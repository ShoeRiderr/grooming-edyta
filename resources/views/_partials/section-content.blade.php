<div class="mt-4">
    <div class="d-flex align-items-center">
        @if ($content->end_date)
            <span class="ml-auto alert alert-info" role="alert">
                Wydarzenie skończy się {{ date('d.m.Y', strtotime($content->end_date)); }}
                o godzinie {{ date('H:i', strtotime($content->end_date)); }}
            </span>
        @endif
    </div>
</div>

<div class="ql-editor mb-5">
    {!! $content->content !!}
</div>
