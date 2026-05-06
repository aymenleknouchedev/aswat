<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImageResizeController extends Controller
{
    private const ALLOWED_WIDTHS = [200, 400, 600, 800, 1200, 1600, 1920];
    private const ALLOWED_EXTS = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
    private const QUALITY = 82;

    public function show(Request $request, int $width, string $path)
    {
        if (!in_array($width, self::ALLOWED_WIDTHS, true)) {
            abort(404);
        }

        $path = ltrim($path, '/');

        if (str_contains($path, '..')) {
            abort(404);
        }

        $relative = preg_replace('#^storage/#', '', $path);

        if (!Storage::disk('public')->exists($relative)) {
            abort(404);
        }

        $ext = strtolower(pathinfo($relative, PATHINFO_EXTENSION));
        if (!in_array($ext, self::ALLOWED_EXTS, true)) {
            return redirect(asset('storage/' . $relative), 302);
        }

        $wantsWebp = str_contains($request->header('Accept', ''), 'image/webp');
        $outExt = $wantsWebp ? 'webp' : ($ext === 'jpeg' ? 'jpg' : $ext);

        $cacheRel = "cache/img/{$width}/" . pathinfo($relative, PATHINFO_DIRNAME)
            . '/' . pathinfo($relative, PATHINFO_FILENAME) . '.' . $outExt;
        $cacheRel = preg_replace('#/+#', '/', $cacheRel);

        $disk = Storage::disk('public');

        if (!$disk->exists($cacheRel)) {
            try {
                $manager = new ImageManager(new Driver());
                $img = $manager->read($disk->path($relative));

                if ($img->width() > $width) {
                    $img->scaleDown(width: $width);
                }

                $encoded = match ($outExt) {
                    'webp' => $img->toWebp(self::QUALITY),
                    'png'  => $img->toPng(),
                    'gif'  => $img->toGif(),
                    default => $img->toJpeg(self::QUALITY),
                };

                $disk->put($cacheRel, (string) $encoded);
            } catch (\Throwable $e) {
                return redirect(asset('storage/' . $relative), 302);
            }
        }

        $absPath = $disk->path($cacheRel);
        $mime = match ($outExt) {
            'webp' => 'image/webp',
            'png'  => 'image/png',
            'gif'  => 'image/gif',
            default => 'image/jpeg',
        };

        return response()->file($absPath, [
            'Content-Type'  => $mime,
            'Cache-Control' => 'public, max-age=31536000, immutable',
            'Vary'          => 'Accept',
        ]);
    }
}
