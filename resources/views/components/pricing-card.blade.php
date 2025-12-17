@props([
    'title',
    'price',
    'features' => [],
    'buttonText' => 'Souscrire',
    'buttonUrl' => '#',
    'isHighlighted' => false,
    'isPremium' => false,
    'period' => null,
])
@php
    $features = collect(is_string($features) ? json_decode($features, true) : $features)
        ->filter()
        ->values();
@endphp

<style>
    .modern-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        height: 100%;
        filter: blur(5px);
        opacity: 0.6;
        pointer-events: none;
        user-select: none;
    }

    .modern-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1),
            0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    .modern-card.highlighted {
        border: 2px solid var(--orangish);
        box-shadow: 0 10px 15px -3px rgba(249, 137, 72, 0.2);
    }

    .modern-card.premium {
        border: 2px solid var(--aquamarine);
    }

    .popular-badge {
        position: absolute;
        top: -12px;
        left: 50%;
        transform: translateX(-50%);
        background: linear-gradient(135deg, var(--orangish), var(--larch-bolete));
        color: var(--sand);
        padding: 4px 16px;
        border-radius: 20px;
        font-size: 0.875rem;
        font-weight: 600;
        z-index: 10;
        opacity: 0.6;
        filter: blur(3px);
        pointer-events: none;
        user-select: none;
    }

    .price-gradient {
        background: linear-gradient(135deg, var(--orangish), var(--larch-bolete));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-size: 2.5rem;
        font-weight: 800;
    }

    .feature-check {
        width: 20px;
        height: 20px;
        background: linear-gradient(135deg, #89b910, #3a9605);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 12px;
        flex-shrink: 0;
    }

    .btn-modern {
        border-radius: 12px;
        font-weight: 600;
        padding: 12px 24px;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 100%;
    }

    .btn-outline-modern {
        background: transparent;
        border: 2px solid var(--aquamarine);
        color: var(--aquamarine);
    }

    .btn-primary-gradient {
        background: linear-gradient(135deg, var(--indigo), var(--aquamarine));
        color: var(--sand);
        border: none;
    }

    .btn-highlight {
        background: linear-gradient(135deg, var(--orangish), var(--larch-bolete));
        color: var(--sand);
        border: none;
    }

    @media (max-width: 768px) {
        .price-gradient {
            font-size: 2rem;
        }

        .modern-card {
            padding: 1.5rem;
        }
    }
</style>

<div class="position-relative h-100">
    @if ($isHighlighted)
        <div class="popular-badge">Populaire</div>
    @endif

    <div
        class="modern-card p-4 d-flex flex-column
                @if ($isPremium) premium
                @elseif($isHighlighted) highlighted @endif">

        <div class="text-center mb-4">
            <h3 class="fw-bold mb-3" style="color: var(--indigo); font-size: 1.5rem;">
                {{ $title }}
            </h3>

            <div class="d-flex align-items-baseline justify-content-center mb-2">
                <span class="price-gradient">{{ $price }}</span>
                @if ($period)
                    <span class="ms-2" style="color: var(--black);">{{ $period }}</span>
                @endif
            </div>
        </div>

        <div class="flex-grow-1 mb-4">
            <ul class="list-unstyled">
                @foreach ($features as $feature)
                    <li class="d-flex align-items-start mb-3">
                        <div class="feature-check">
                            <svg width="12" height="12" fill="white" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <span style="color: var(--black); opacity: 0.7;">{{ $feature }}</span>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="mt-auto">
            @if ($isPremium)
                <a href="{{ $buttonUrl }}" class="btn-modern btn-primary-gradient">
                    {{ $buttonText }}
                </a>
            @elseif($isHighlighted)
                <a href="{{ $buttonUrl }}" class="btn-modern btn-highlight">
                    {{ $buttonText }}
                </a>
            @else
                <a href="{{ $buttonUrl }}" class="btn-modern btn-outline-modern">
                    {{ $buttonText }}
                </a>
            @endif
        </div>
    </div>
</div>
