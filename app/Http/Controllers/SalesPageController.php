<?php

namespace App\Http\Controllers;

use App\Models\SalesPage;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class SalesPageController extends Controller
{
    public function index()
    {
        $salesPages = auth()->user()
            ->salesPages()
            ->latest()
            ->paginate(10);

        return view('sales-pages.history', compact('salesPages'));
    }

    public function preview(SalesPage $salesPage)
    {
        $this->authorize('view', $salesPage);
        return view('sales-pages.preview', compact('salesPage'));
    }

    public function destroy(SalesPage $salesPage)
    {
        $this->authorize('delete', $salesPage);
        $salesPage->delete();

        return redirect()->route('sales-pages.history')
            ->with('success', 'Sales page deleted successfully!');
    }

    public function exportHtml(SalesPage $salesPage)
    {
        $this->authorize('view', $salesPage);

        $html = view('sales-pages.export', [
            'salesPage' => $salesPage,
            'content'   => $salesPage->generated_content,
        ])->render();

        return response($html)
            ->header('Content-Type', 'text/html')
            ->header('Content-Disposition', 'attachment; filename="' . str()->slug($salesPage->product_name) . '.html"');
    }

    public function exportPdf(SalesPage $salesPage)
    {
        $this->authorize('view', $salesPage);

        $content = $salesPage->generated_content;

        $pdf = Pdf::loadView('sales-pages.pdf', compact('content', 'salesPage'))
            ->setPaper('a4', 'portrait');

        return $pdf->download(str()->slug($salesPage->product_name) . '.pdf');
    }
}