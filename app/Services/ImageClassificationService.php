<?php

namespace App\Services;

class ImageClassificationService
{
    /**
     * Analyzes an uploaded image and determines priority level
     * Returns: 'low', 'medium', or 'high'
     */
    public static function classifyImage($imagePath)
    {
        try {
            $fullPath = storage_path('app/public/' . $imagePath);
            
            if (!file_exists($fullPath)) {
                return 'low';
            }

            // Get file size and basic image info
            $fileSize = filesize($fullPath);
            $imageInfo = getimagesize($fullPath);
            
            if (!$imageInfo) {
                return 'low';
            }

            // Use GD to analyze the image when available
            if (!function_exists('imagecreatefromstring') || !function_exists('imagesx') || !function_exists('imagesy')) {
                return 'low';
            }

            $damageScore = self::analyzeDamage($fullPath);
            
            if ($damageScore >= 65) {
                return 'high';
            } elseif ($damageScore >= 35) {
                return 'medium';
            } else {
                return 'low';
            }

        } catch (\Throwable $e) {
            // Log error but return default priority
            \Log::warning('Image classification error: ' . $e->getMessage());
            return 'low';
        }
    }

    /**
     * Analyzes image for damage indicators
     */
    private static function analyzeDamage($imagePath)
    {
        try {
            if (!function_exists('imagecreatefromstring') || !function_exists('imagesx') || !function_exists('imagesy') || !function_exists('imagecolorat')) {
                return 0;
            }

            $image = imagecreatefromstring(file_get_contents($imagePath));
            if (!$image) {
                return 0;
            }

            $width = imagesx($image);
            $height = imagesy($image);
            
            if ($width <= 0 || $height <= 0) {
                imagedestroy($image);
                return 0;
            }

            $score = 0;
            $darkPixels = 0;
            $brownishPixels = 0;
            $sampleCount = 0;
            
            // Sample pixels in a grid pattern (not all pixels to improve performance)
            $sampleRate = max(1, intval(max($width, $height) / 30));
            
            for ($y = 0; $y < $height; $y += $sampleRate) {
                for ($x = 0; $x < $width; $x += $sampleRate) {
                    $rgb = imagecolorat($image, $x, $y);
                    $r = ($rgb >> 16) & 0xFF;
                    $g = ($rgb >> 8) & 0xFF;
                    $b = $rgb & 0xFF;
                    
                    $brightness = ($r + $g + $b) / 3;
                    $sampleCount++;

                    // Dark areas indicate cracks, shadows, or deep damage
                    if ($brightness < 85) {
                        $darkPixels++;
                    }

                    // Brownish/reddish tones indicate rust, stains, or burn marks
                    if ($r > $g && $r > $b && $r > 100 && $r - $g > 20) {
                        $brownishPixels++;
                    }
                }
            }

            imagedestroy($image);

            if ($sampleCount === 0) {
                return 0;
            }

            // Calculate percentages
            $darkPercentage = ($darkPixels / $sampleCount) * 100;
            $brownishPercentage = ($brownishPixels / $sampleCount) * 100;

            // Score based on damage indicators
            if ($darkPercentage > 40) {
                $score += 40;
            } elseif ($darkPercentage > 25) {
                $score += 20;
            }

            if ($brownishPercentage > 35) {
                $score += 30;
            } elseif ($brownishPercentage > 15) {
                $score += 15;
            }

            return min(100, $score);

        } catch (\Exception $e) {
            \Log::warning('Damage analysis error: ' . $e->getMessage());
            return 0;
        }
    }
}
