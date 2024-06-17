<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Image;

class ConvertController extends Controller
{
    public function convert(Request $request) {
     try {
        if ($request->hasFile('images')) {
            $files = $request->file('images');
            foreach ($files as $file) {
                $this->convertFile($file);
            }

            return "Files uploaded successfully!";
        }
     } catch (\Throwable $th) {
        info($th);
     }
    }



    public function convertFile($file) {

        // Get the original name of the image without the extension
        $imageName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

        // Create an Intervention Image instance
        $img = Image::make($file->getRealPath());
        // Create a new PDF
        $pdf = Pdf::loadView('pdf.image', ['img' => $img]);

        // Define the path where the PDF will be saved
        $filePath = "public/pdfs/$imageName.pdf";

        // Save the PDF to the specified path
        Storage::put($filePath, $pdf->output());
        return 'success';
    }
}
