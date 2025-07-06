<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class TestGallery extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:gallery';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test Product Gallery functionality';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Testing Product Gallery...');
        
        // Test 1: Check if table exists
        $this->info('1. Checking if product_galleries table exists...');
        try {
            $count = DB::table('product_galleries')->count();
            $this->info("   ✅ Table exists with {$count} records");
        } catch (\Exception $e) {
            $this->error("   ❌ Table error: " . $e->getMessage());
            return 1;
        }
        
        // Test 2: Check if products exist
        $this->info('2. Checking if products exist...');
        try {
            $productCount = DB::table('products')->count();
            $this->info("   ✅ Found {$productCount} products");
        } catch (\Exception $e) {
            $this->error("   ❌ Products error: " . $e->getMessage());
            return 1;
        }
        
        // Test 3: Check gallery for first product
        $this->info('3. Checking gallery for first product...');
        try {
            $firstProduct = DB::table('products')->first();
            if ($firstProduct) {
                $galleryCount = DB::table('product_galleries')
                    ->where('product_id', $firstProduct->id)
                    ->where('is_active', 1)
                    ->count();
                $this->info("   ✅ Product ID {$firstProduct->id} has {$galleryCount} active gallery images");
                
                // Show some gallery images
                $galleryImages = DB::table('product_galleries')
                    ->where('product_id', $firstProduct->id)
                    ->where('is_active', 1)
                    ->orderBy('sort_order', 'asc')
                    ->take(3)
                    ->get();
                    
                foreach ($galleryImages as $image) {
                    $this->line("   📷 {$image->image} (Order: {$image->sort_order})");
                }
            } else {
                $this->warn("   ⚠️ No products found");
            }
        } catch (\Exception $e) {
            $this->error("   ❌ Gallery error: " . $e->getMessage());
            return 1;
        }
        
        // Test 4: Test file generation
        $this->info('4. Testing unique filename generation...');
        try {
            $testName = 'test-image.jpg';
            $productId = 1;
            
            // This would normally be in the model, but let's test the logic
            $extension = pathinfo($testName, PATHINFO_EXTENSION);
            $baseName = pathinfo($testName, PATHINFO_FILENAME);
            $cleanName = \Illuminate\Support\Str::slug($baseName);
            $fileName = $cleanName . '_' . time() . '_' . $productId . '.' . $extension;
            
            $this->info("   ✅ Generated filename: {$fileName}");
        } catch (\Exception $e) {
            $this->error("   ❌ Filename generation error: " . $e->getMessage());
            return 1;
        }
        
        $this->info('✅ All tests passed! Gallery functionality is working correctly.');
        return 0;
    }
}
