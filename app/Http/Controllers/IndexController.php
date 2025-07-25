<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class IndexController extends Controller
{
    public function index()
    {
        return view('index');
    }
    public function downloadYoutube(Request $request)
    {
        $url = $request->input('url');

        if (!$url || !str_contains($url, 'youtube.com')) {
            throw ValidationException::withMessages(['url' => 'Invalid YouTube URL']);
        }

        $tempDir = storage_path('app/tmp');
        if (!is_dir($tempDir)) {
            mkdir($tempDir, 0777, true);
        }

        $baseFilename = 'youtube_' . time();
        $outputTemplate = $tempDir . DIRECTORY_SEPARATOR . $baseFilename;

        $command = 'yt-dlp -f "bv+ba/b" -o ' . escapeshellarg($outputTemplate) . ' ' . escapeshellarg($url);
        exec($command, $output, $status);

        if ($status !== 0) {
            throw ValidationException::withMessages(['url' => 'Download failed']);
        }

        $files = glob($tempDir . DIRECTORY_SEPARATOR . $baseFilename . '.*');

        if (empty($files)) {
            throw ValidationException::withMessages(['url' => 'Download failed']);
        }

        $finalPath = $files[0];
        $downloadName = basename($finalPath);

        return response()->download($finalPath, $downloadName)->deleteFileAfterSend(true);
    }
}
