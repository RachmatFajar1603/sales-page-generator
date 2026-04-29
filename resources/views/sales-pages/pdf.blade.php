<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; color: #111; background: #fff; }

        .hero {
            background: #7c3aed;
            color: white;
            padding: 48px 40px;
            text-align: center;
        }
        .badge {
            display: inline-block;
            background: rgba(255,255,255,0.2);
            color: white;
            font-size: 11px;
            padding: 4px 12px;
            border-radius: 20px;
            margin-bottom: 16px;
        }
        .hero h1 { font-size: 28px; font-weight: bold; margin-bottom: 12px; line-height: 1.3; }
        .hero p  { font-size: 14px; color: rgba(255,255,255,0.85); line-height: 1.6; margin-bottom: 8px; }
        .cta-btn {
            display: inline-block;
            margin-top: 20px;
            background: white;
            color: #7c3aed;
            font-weight: bold;
            padding: 10px 28px;
            border-radius: 8px;
            font-size: 13px;
        }

        .section { padding: 36px 40px; }
        .section-title { font-size: 20px; font-weight: bold; text-align: center; margin-bottom: 24px; color: #111; }

        .grid-3 { width: 100%; border-collapse: collapse; }
        .grid-3 td { width: 33%; padding: 12px; vertical-align: top; }

        .benefit-card {
            background: #f5f3ff;
            border-radius: 8px;
            padding: 16px;
            text-align: center;
        }
        .benefit-icon { font-size: 24px; margin-bottom: 8px; }
        .benefit-title { font-size: 13px; font-weight: bold; margin-bottom: 6px; color: #111; }
        .benefit-desc { font-size: 11px; color: #555; line-height: 1.5; }

        .feature-row { width: 100%; border-collapse: collapse; }
        .feature-row td { width: 50%; padding: 8px; vertical-align: top; }
        .feature-item {
            background: #fafafa;
            border: 1px solid #eee;
            border-radius: 8px;
            padding: 12px;
            display: flex;
        }
        .feature-check { color: #7c3aed; font-weight: bold; margin-right: 8px; font-size: 13px; }
        .feature-title { font-size: 12px; font-weight: bold; color: #111; margin-bottom: 3px; }
        .feature-desc { font-size: 11px; color: #666; line-height: 1.4; }

        .testimonial-card {
            background: #fff;
            border: 1px solid #eee;
            border-radius: 8px;
            padding: 16px;
        }
        .stars { color: #f59e0b; font-size: 13px; margin-bottom: 8px; }
        .testimonial-text { font-size: 11px; color: #444; line-height: 1.6; margin-bottom: 10px; font-style: italic; }
        .testimonial-name { font-size: 12px; font-weight: bold; color: #111; }
        .testimonial-role { font-size: 11px; color: #888; }

        .pricing-section { background: #f5f3ff; padding: 36px 40px; text-align: center; }
        .pricing-card {
            max-width: 320px;
            margin: 0 auto;
            background: white;
            border: 2px solid #7c3aed;
            border-radius: 12px;
            padding: 28px;
        }
        .original-price { font-size: 12px; color: #999; text-decoration: line-through; margin-bottom: 4px; }
        .display-price { font-size: 32px; font-weight: bold; color: #7c3aed; margin-bottom: 4px; }
        .billing { font-size: 12px; color: #888; margin-bottom: 16px; }
        .includes-list { text-align: left; margin-bottom: 16px; }
        .includes-item { font-size: 12px; color: #444; margin-bottom: 6px; }
        .includes-check { color: #22c55e; margin-right: 6px; }
        .cta-price-btn {
            display: block;
            background: #7c3aed;
            color: white;
            padding: 10px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: bold;
            text-align: center;
        }
        .cta-secondary { font-size: 11px; color: #888; margin-top: 8px; }

        .faq-item { border-bottom: 1px solid #eee; padding: 12px 0; }
        .faq-question { font-size: 13px; font-weight: bold; color: #111; margin-bottom: 6px; }
        .faq-answer { font-size: 12px; color: #555; line-height: 1.6; }

        .footer {
            background: #111;
            color: white;
            text-align: center;
            padding: 20px;
            font-size: 11px;
            color: #888;
        }
    </style>
</head>
<body>

{{-- Hero --}}
<div class="hero">
    <div class="badge">✨ AI Generated Sales Page</div>
    <h1>{{ $content['headline'] ?? '' }}</h1>
    <p>{{ $content['sub_headline'] ?? '' }}</p>
    <p>{{ $content['hero_description'] ?? '' }}</p>
    <div class="cta-btn">{{ $content['cta']['primary'] ?? 'Get Started' }}</div>
</div>

{{-- Benefits --}}
@if(!empty($content['benefits']))
<div class="section">
    <div class="section-title">Why Choose Us?</div>
    <table class="grid-3">
        <tr>
            @foreach($content['benefits'] as $i => $benefit)
            <td>
                <div class="benefit-card">
                    <div class="benefit-icon">{{ $benefit['icon'] ?? '✅' }}</div>
                    <div class="benefit-title">{{ $benefit['title'] ?? '' }}</div>
                    <div class="benefit-desc">{{ $benefit['description'] ?? '' }}</div>
                </div>
            </td>
            @if(($i + 1) % 3 === 0 && !$loop->last)
        </tr><tr>
            @endif
            @endforeach
        </tr>
    </table>
</div>
@endif

{{-- Features --}}
@if(!empty($content['features']))
<div class="section" style="background: #fafafa;">
    <div class="section-title">Features</div>
    <table class="feature-row">
        @foreach(collect($content['features'])->chunk(2) as $row)
        <tr>
            @foreach($row as $feature)
            <td>
                <div style="background:#fff;border:1px solid #eee;border-radius:8px;padding:12px;">
                    <div style="color:#7c3aed;font-weight:bold;margin-bottom:4px;">✓ {{ $feature['title'] ?? '' }}</div>
                    <div style="font-size:11px;color:#666;">{{ $feature['description'] ?? '' }}</div>
                </div>
            </td>
            @endforeach
        </tr>
        @endforeach
    </table>
</div>
@endif

{{-- Social Proof --}}
@if(!empty($content['social_proof']))
<div class="section">
    <div class="section-title">What Our Customers Say</div>
    <table class="grid-3">
        <tr>
            @foreach($content['social_proof'] as $i => $proof)
            <td>
                <div class="testimonial-card">
                    <div class="stars">
                        @for($s = 0; $s < ($proof['rating'] ?? 5); $s++)★@endfor
                    </div>
                    <div class="testimonial-text">"{{ $proof['testimonial'] ?? '' }}"</div>
                    <div class="testimonial-name">{{ $proof['name'] ?? '' }}</div>
                    <div class="testimonial-role">{{ $proof['role'] ?? '' }}</div>
                </div>
            </td>
            @if(($i + 1) % 3 === 0 && !$loop->last)
        </tr><tr>
            @endif
            @endforeach
        </tr>
    </table>
</div>
@endif

{{-- Pricing --}}
@if(!empty($content['pricing']))
<div class="pricing-section">
    <div class="section-title">Simple Pricing</div>
    <div class="pricing-card">
        @if(!empty($content['pricing']['original_price']))
        <div class="original-price">{{ $content['pricing']['original_price'] }}</div>
        @endif
        <div class="display-price">{{ $content['pricing']['display_price'] ?? '' }}</div>
        <div class="billing">{{ $content['pricing']['billing'] ?? '' }}</div>
        @if(!empty($content['pricing']['includes']))
        <div class="includes-list">
            @foreach($content['pricing']['includes'] as $item)
            <div class="includes-item">
                <span class="includes-check">✓</span>{{ $item }}
            </div>
            @endforeach
        </div>
        @endif
        <div class="cta-price-btn">{{ $content['cta']['primary'] ?? 'Get Started' }}</div>
        @if(!empty($content['cta']['secondary']))
        <div class="cta-secondary">{{ $content['cta']['secondary'] }}</div>
        @endif
    </div>
</div>
@endif

{{-- FAQ --}}
@if(!empty($content['faq']))
<div class="section">
    <div class="section-title">Frequently Asked Questions</div>
    @foreach($content['faq'] as $item)
    <div class="faq-item">
        <div class="faq-question">{{ $item['question'] ?? '' }}</div>
        <div class="faq-answer">{{ $item['answer'] ?? '' }}</div>
    </div>
    @endforeach
</div>
@endif

<div class="footer">
    Generated by SalesGen AI · {{ now()->format('Y') }}
</div>

</body>
</html>