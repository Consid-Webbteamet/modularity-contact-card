@if (!empty($contact))
    <section class="contact-card-panel contact-card-panel--{{ $color ?? 'red' }}">
        @if (!empty($panelTitle))
            <h2 class="contact-card-panel__title">{{ $panelTitle }}</h2>
        @endif

        @if (!empty($contact['preamble']))
            <p class="contact-card-panel__preamble preamble">{{ $contact['preamble'] }}</p>
        @endif

        @if (!empty($contact['content']))
            <div class="contact-card-panel__content">
                {!! $contact['content'] !!}
            </div>
        @endif
    </section>
@endif
