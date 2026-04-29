<?php

namespace App\Http\Controllers;

use App\Models\SalesPage;
use App\Services\GroqService;
use Illuminate\Http\Request;
use Exception;

class GeneratorController extends Controller
{
    protected GroqService $groq;

    public function __construct(GroqService $groq)
    {
        $this->groq = $groq;
    }

    public function create()
    {
        return view('sales-pages.create');
    }

    public function generate(Request $request)
    {
        $validated = $request->validate([
            'product_name'          => 'required|string|max:255',
            'description'           => 'required|string',
            'key_features'          => 'required|string',
            'target_audience'       => 'required|string|max:255',
            'price'                 => 'nullable|string|max:100',
            'unique_selling_points' => 'nullable|string',
            'tone'                  => 'required|in:formal,casual,persuasive,urgent,friendly',
            'template'              => 'required|in:modern,minimalist,dark',
        ]);

        if (! empty($validated['price'])) {
            $validated['price'] = (int) str_replace('.', '', $validated['price']);
        }



        try {
            $generated = $this->groq->generateSalesPage($validated);

            $salesPage = SalesPage::create([
                'user_id'               => auth()->id(),
                'product_name'          => $validated['product_name'],
                'target_audience'       => $validated['target_audience'],
                'price'                 => $validated['price'] ?? null,
                'description'           => $validated['description'],
                'key_features'          => $validated['key_features'],
                'unique_selling_points' => $validated['unique_selling_points'] ?? null,
                'tone'                  => $validated['tone'],
                'template'              => $validated['template'],
                'generated_content'     => $generated,
                'status'                => 'published',
            ]);

            return redirect()->route('sales-pages.preview', $salesPage->id)
                ->with('success', 'Sales page generated successfully!');

        } catch (Exception $e) {
            return back()
                ->withInput()
                ->withErrors(['error' => 'Generation failed: ' . $e->getMessage()]);
        }
    }
}